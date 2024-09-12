![License](https://img.shields.io/badge/license-GPLv3-blue) ![status](https://img.shields.io/badge/status-alpha-red)



# Sitemap Generator

The **Sitemap Generator** automatically creates and updates `sitemap.xml` and `robots.txt` files for [Moodle](https://moodle.org/) sites. It enhances the visibility of your Moodle site on search engines by generating a complete sitemap with courses and categories.

## Features

- Automatically generates `sitemap.xml` for search engines.
- Appends or updates the `robots.txt` file with the sitemap location.
- Customizable settings for what to include in the sitemap.
- Runs on a scheduled basis via cron and [Scheduled Tasks](https://docs.moodle.org/404/en/Scheduled_tasks).

## Manual Installation

1. Download the plugin and extract it to `/admin/tool/sitemap` in your Moodle directory.
2. Log in to Moodle as an administrator and navigate to the *Site administration* > *Notifications* page.
3. Follow the prompts to complete the plugin installation.
4. Configure the plugin settings under *Site administration* > *Plugins* > *Sitemap Generator*.

## Configuration

The plugin provides options to include/exclude:

- Courses
- Categories
- Static pages (e.g., home page)

## Requirements

- Moodle 4.0 or later
- PHP 7.4 or later

## Support

If you encounter any issues or have feature requests, please report them via the [GitHub Issues](https://github.com/harrislineage/moodle-tool_sitemap/issues) page.

## License

This plugin is licensed under the [GNU GPL v3 or later](http://www.gnu.org/copyleft/gpl.html).
