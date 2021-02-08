=== LAPDI Facepile ===
Contributors: letaprodoit,sharrondenice
Donate link: https://letaprodoit.com/apps/plugins/wordpress/facepile-for-wordpress
Tags: display, faces, tiles, members, list, grid, the software people
Requires at least: 3.5.1
Tested up to: 5.6.1
Stable tag: 1.1.6
License: Apache v2.0
License URI: http://www.apache.org/licenses/LICENSE-2.0

Facepile allows you to add WordPress users photo icons to your blog's website in grid format.

== Description ==

Let A Pro Do IT!'s (LAPDI) Facepile plugin allows you to add WordPress users photo icons to your blog's website in grid format.

= Shortcodes =

Add a `Facepile` to posts and pages by using a shortcode inside your text or evaluated from within your theme. You may override page/post `Facepile` options with shortcode attributes defined on the plugin's settings page.

* `[tsp-facepile]` - Will display a facepile with the default options defined in the plugin's settings page.
* `[tsp-facepile title="Facepile" show_names="Y" show_count="Y" num_rows="4" num_cols="4" thumb_width="80" thumb_height="80" before_title="" after_title=""]` - Will override all attributes defined on the plugin's settings page.

== Installation ==

BEFORE YOU BEGIN: Requires the installation and activation of [LAPDI Easy Dev Latest Version](http://wordpress.org/plugins/tsp-easy-dev)

1. Upload `tsp-facepile` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. After installation, refer to the `LAPDI Facepile` settings page for more detailed instructions on setting up your shortcodes.
4. Facepile widgets can be added to the sidemenu bar by visiting `Appearance > Widgets` and dragging the `LAPDI Facepile` widget to your sidebar menu.
5. Add some widgets to the sidemenu bar, Add shortcodes to pages and posts (see Instructions)
6. View your site
7. Adjust your CSS for your theme , if necessary, by visiting `Appearance > Edit CSS`

== Frequently asked questions ==

= How do I add spaces between the face icons? =

In CSS the attribute to add settings for is `tspfcp_wp_user_table_cell`. Sample settings may appear as follows:

`.tspfcp_wp_user_table_cell{
	padding: 10px;
}`

= I've installed the plugin but no faces are displaying? =

1. Make sure the folder `/wp-content/uploads/` has recursive, 777 permissions
2. Make sure you have at least one non-admin user in your database

== Screenshots ==

1. Admin area widget settings.
2. Facepile displayed on the front-end.
3. Admin area shortcode settings area.

== Changelog ==
= 1.1.6 =
* Maintenance

= 1.1.5 =
* Enhancement. Requires v2.0.0 of LAPDI Easy Dev

= 1.1.4 =
* Enhancement: Improved settings UI

= 1.1.3 =
* Enhancement: Updated support link

= 1.1.2 =
* Updated admin_notices hooks to not use inline functions.

= 1.1.1 =
* No longer required to set the id and name in display_form (See LAPDI Easy Dev Change Log Version 1.2)

= 1.1.0 =
* Now uses Easy Dev for easy plugin development, <a href="https://twitter.com/#bringbackOOD">#bringbackOOD</a>
* Handled all PHP notices
* Added new attribute show_count (hide/show the member count)
* Renamed attributes to prevent red spell checks when editing (old attributes still supported)
* Decreased plugin size by using Easy Dev

= 1.0.1 =
* Checks for existence of parent settings menu before overwriting it

= 1.0 =
* Launch

== Upgrade notice ==

= 1.1.6 =
* Maintenance

= 1.1.5 =
Enhancement. Requires v2.0.0 of LAPDI Easy Dev

= 1.1.4 =
Enhancement: Improved settings UI

= 1.1.3 =
Enhancement: Updated support link

= 1.1.2 =
Maintenance fix.

= 1.1.1 =
Maintenance fix: Requires update to LAPDI Easy Dev 1.2

= 1.1.0 =
Plugin now requires LAPDI Easy Dev. New features.

= 1.0.1 =
Menu fix.