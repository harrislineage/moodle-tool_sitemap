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

if ($hassiteconfig) {
    $settings = new admin_settingpage('tool_sitemap', get_string('sitemapsettings', 'tool_sitemap'));

    // Content selection settings
    $settings->add(new admin_setting_configcheckbox(
        'tool_sitemap/include_courses',
        get_string('includecourses', 'tool_sitemap'),
        get_string('includecourses_desc', 'tool_sitemap'),
        1  // Default: enabled
    ));

    $settings->add(new admin_setting_configcheckbox(
        'tool_sitemap/include_categories',
        get_string('includecategories', 'tool_sitemap'),
        get_string('includecategories_desc', 'tool_sitemap'),
        1  // Default: enabled
    ));

    $settings->add(new admin_setting_configcheckbox(
        'tool_sitemap/include_static_pages',
        get_string('includestaticpages', 'tool_sitemap'),
        get_string('includestaticpages_desc', 'tool_sitemap'),
        1  // Default: enabled
    ));

    // Change frequency settings
    $settings->add(new admin_setting_configselect(
        'tool_sitemap/change_frequency',
        get_string('changefrequency', 'tool_sitemap'),
        get_string('changefrequency_desc', 'tool_sitemap'),
        'weekly',
        array(
            'daily' => get_string('daily', 'tool_sitemap'),
            'weekly' => get_string('weekly', 'tool_sitemap'),
            'monthly' => get_string('monthly', 'tool_sitemap'),
            'yearly' => get_string('yearly', 'tool_sitemap')
        )
    ));

    // Priority settings for different content types
    $settings->add(new admin_setting_configselect(
        'tool_sitemap/course_priority',
        get_string('coursepriority', 'tool_sitemap'),
        get_string('coursepriority_desc', 'tool_sitemap'),
        '0.8',  // SEO advice: Important content, higher priority
        array(
            '1.0' => '1.0 - Highest priority',
            '0.9' => '0.9',
            '0.8' => '0.8',
            '0.7' => '0.7',
            '0.6' => '0.6',
            '0.5' => '0.5 - Default priority',
            '0.4' => '0.4',
            '0.3' => '0.3',
            '0.2' => '0.2',
            '0.1' => '0.1 - Lowest priority'
        )
    ));

    $settings->add(new admin_setting_configselect(
        'tool_sitemap/category_priority',
        get_string('categorypriority', 'tool_sitemap'),
        get_string('categorypriority_desc', 'tool_sitemap'),
        '0.6',  // SEO advice: Slightly lower priority for categories
        array(
            '1.0' => '1.0 - Highest priority',
            '0.9' => '0.9',
            '0.8' => '0.8',
            '0.7' => '0.7',
            '0.6' => '0.6',
            '0.5' => '0.5 - Default priority',
            '0.4' => '0.4',
            '0.3' => '0.3',
            '0.2' => '0.2',
            '0.1' => '0.1 - Lowest priority'
        )
    ));

    // Add the settings page to the admin panel
    $ADMIN->add('tools', $settings);
}