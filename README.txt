=== TSP Facepile ===
Contributors: thesoftwarepeople,sharrondenice
Donate link: http://www.thesoftwarepeople.com/software/plugins/wordpress/facepile-for-wordpress.html
Tags: display faces tiles members list grid the software people
Requires at least: 3.5.1
Tested up to: 3.5.2
Stable tag: 1.0.1
License: Apache v2.0
License URI: http://www.apache.org/licenses/LICENSE-2.0

Facepile allows you to add wordpress users photo icons to your blog's website in grid format.

== Description ==

The Software People's (TSP) Facepile plugin allows you to add wordpress users photo icons to your blog's website in grid format.

= Shortcodes =

Add a `Facepile` to posts and pages by using a shortcode inside your text or evaluated from within your theme. You may override page/post `Facepile` options with shortcode attributes defined on the plugin's settings page.

* `[tsp-facepile]` - Will display a facepile with the default options defined in the plugin's settings page.
* `[tsp-facepile title="Facepile" shownames="Y" tspfcp_rows="4" tspfcp_cols="4" widththumb="80" heightthumb="80" beforetitle="" aftertitle=""]` - Will override all attributes defined on the plugin's settings page.

== Installation ==

1. Upload `tsp-facepile` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. After installation, refer to the `TSP Facepile` settings page for more detailed instructions on setting up your shortcodes.
4. Facepile widgets can be added to the sidemenu bar by visiting `Appearance > Widgets` and dragging the `TSP Facepile` widget to your sidebar menu.
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

= 1.0.1 =
* Checks for existence of parent settings menu before overwriting it

== Upgrade notice ==

= 1.0.1 =
Menu fix.