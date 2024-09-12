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

namespace tool_sitemap\task;

defined('MOODLE_INTERNAL') || die();

class generate_sitemap_task extends \core\task\scheduled_task {

    /**
     * Return the task's name.
     */
    public function get_name() {
        return get_string('generatesitemap', 'tool_sitemap');
    }

    /**
     * Execute the task to generate the sitemap based on the frequency setting.
     */
    public function execute() {
        global $DB;

        // Fetch the frequency setting.
        $change_frequency = get_config('tool_sitemap', 'change_frequency');

        // Get the last time the sitemap was generated.
        $last_generated = get_config('tool_sitemap', 'last_generated');

        // Current time.
        $now = time();

        // Frequency mapping to time intervals (in seconds).
        $frequency_map = [
            'always' => 0,                 // Always generate
            'hourly' => 3600,              // 1 hour
            'daily' => 86400,              // 24 hours
            'weekly' => 604800,            // 1 week
            'monthly' => 2592000,          // 30 days
            'yearly' => 31536000           // 365 days
        ];

        // Check if it's time to generate the sitemap based on frequency.
        if ($change_frequency === 'always' || ($now - $last_generated >= $frequency_map[$change_frequency])) {
            // Generate the sitemap.
            $sitemapgenerator = new \tool_sitemap\sitemap_generator();
            $sitemapgenerator->generate_sitemap();

            // Update the last generated time.
            set_config('last_generated', $now, 'tool_sitemap');
        }
    }
}