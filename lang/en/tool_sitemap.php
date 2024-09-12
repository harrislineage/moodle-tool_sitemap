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

$string['pluginname'] = 'Sitemap Generator';
$string['sitemapsettings'] = 'Sitemap Settings';
$string['includecourses'] = 'Include Courses';
$string['includecourses_desc'] = 'Include course pages in the generated sitemap.';
$string['includecategories'] = 'Include Course Categories';
$string['includecategories_desc'] = 'Include course categories in the generated sitemap.';
$string['includestaticpages'] = 'Include Static Pages';
$string['includestaticpages_desc'] = 'Include static pages like the homepage, about page, etc., in the sitemap.';
$string['changefrequency'] = 'Change Frequency';
$string['changefrequency_desc'] = 'Specify how often the sitemap should be updated (default Weekly).';
$string['coursepriority'] = 'Course Priority';
$string['coursepriority_desc'] = 'Set the priority of course pages in the sitemap. SEO advice: Higher priority for courses (default 0.8).';
$string['categorypriority'] = 'Course Category Priority';
$string['categorypriority_desc'] = 'Set the priority of course categories in the sitemap. SEO advice: Lower priority than courses (default 0.6).';
$string['filelocation'] = 'Sitemap File Location';
$string['filelocation_desc'] = 'Sitemap location relative to your Moodle installation. For example, if Moodle is installed at https://mymoodlesite.com, the sitemap will be available at https://mymoodlesite.com/sitemap.xml.';
$string['customstaticpages'] = 'Custom Static Pages';
$string['customstaticpages_desc'] = 'Enter paths for custom static pages relative to your Moodle site URL (e.g., enter "about.html" for https://mymoodlesite.com/about.html). One path per line.';
$string['generatesitemap'] = 'Generate Sitemap Task';
$string['daily'] = 'Daily';
$string['weekly'] = 'Weekly';
$string['monthly'] = 'Monthly';
$string['yearly'] = 'Yearly';