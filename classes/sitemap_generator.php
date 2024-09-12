<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @package     tool_sitemap
 * @copyright   2024 onwards Steven Harris <steve@harrislineage.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_sitemap;

defined('MOODLE_INTERNAL') || die();

class sitemap_generator
{
    public function generate_sitemap()
    {
        global $CFG, $DB;

        $include_courses = get_config('tool_sitemap', 'include_courses');
        $include_categories = get_config('tool_sitemap', 'include_categories');
        $file_location = $CFG->dirroot . '/sitemap.xml';
        $robots_file = $CFG->dirroot . '/robots.txt';
        $include_static_pages = get_config('tool_sitemap', 'include_static_pages');
        $custom_static_pages = get_config('tool_sitemap', 'custom_static_pages');
        $baseurl = $CFG->wwwroot;

        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        if ($include_static_pages) {
            $home_page = $DB->get_record('course', ['id' => 1], 'timemodified');
            $lastmod = date('Y-m-d', $home_page->timemodified);

            $sitemap .= '<url>';
            $sitemap .= '<loc>' . $baseurl . '</loc>';
            $sitemap .= '<lastmod>' . $lastmod . '</lastmod>';
            $sitemap .= '</url>';
        }

        if (!empty($custom_static_pages)) {
            $pages = explode("\n", $custom_static_pages);
            foreach ($pages as $page) {
                $page = trim($page);
                if (!empty($page)) {
                    $full_url = rtrim($baseurl, '/') . '/' . ltrim($page, '/');
                    $file_path = $CFG->dirroot . '/' . ltrim($page, '/');

                    $sitemap .= '<url>';
                    $sitemap .= '<loc>' . $full_url . '</loc>';

                    if (file_exists($file_path)) {
                        $lastmod = date('Y-m-d', filemtime($file_path));
                        $sitemap .= '<lastmod>' . $lastmod . '</lastmod>';
                    }

                    $sitemap .= '</url>';
                }
            }
        }

        if ($include_courses) {
            $courses = $DB->get_records_select('course', 'visible = 1 AND id <> 1', null, '', 'id, fullname, timemodified');
            foreach ($courses as $course) {
                $last_modified_date = date('Y-m-d', $course->timemodified);
                $sitemap .= '<url>';
                $sitemap .= '<loc>' . $baseurl . '/course/view.php?id=' . $course->id . '</loc>';
                $sitemap .= '<lastmod>' . $last_modified_date . '</lastmod>';
                $sitemap .= '</url>';
            }
        }

        if ($include_categories) {
            $categories = $DB->get_records('course_categories', ['visible' => 1], '', 'id, timemodified');
            foreach ($categories as $category) {
                $sitemap .= '<url>';
                $sitemap .= '<loc>' . $baseurl . '/course/index.php?categoryid=' . $category->id . '</loc>';
                $lastmod = date('Y-m-d', $category->timemodified);
                $sitemap .= '<lastmod>' . $lastmod . '</lastmod>';
                $sitemap .= '</url>';
            }
        }

        $sitemap .= '</urlset>';

        // Save the sitemap to the specified location.
        file_put_contents($file_location, $sitemap);

        // Ensure robots.txt exists and is updated with the sitemap location
        $this->update_robots_txt($robots_file, $baseurl . '/sitemap.xml');
    }

    private function update_robots_txt($robots_file, $sitemap_url)
    {
        $sitemap_line = 'Sitemap: ' . $sitemap_url;

        // Default robots.txt content for a new file
        $default_content = <<<EOT
User-agent: *
Disallow: /admin
Disallow: /user

$sitemap_line
EOT;

        // Check if robots.txt exists, create if not
        if (!file_exists($robots_file)) {
            file_put_contents($robots_file, $default_content);
            return;
        }

        $robots_content = file_get_contents($robots_file);

        // Check if a sitemap line exists
        if (strpos($robots_content, 'Sitemap:') !== false) {
            // Update existing sitemap line if necessary
            $robots_content = preg_replace('/Sitemap:.*/', $sitemap_line, $robots_content);
        } else {
            // Append sitemap line to robots.txt
            $robots_content .= PHP_EOL . $sitemap_line;
        }

        // Write updated content back to robots.txt
        file_put_contents($robots_file, $robots_content);
    }

}
