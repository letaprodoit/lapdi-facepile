<?php
/*
Plugin Name: 	TSP Facepile
Plugin URI: 	http://www.thesoftwarepeople.com/software/plugins/wordpress/facepile-for-wordpress.html
Description: 	Facepile allows you to add wordpress users photo icons to your blog's website in grid format.
Author: 		The Software People
Author URI: 	http://www.thesoftwarepeople.com/
Version: 		1.1.0
Text Domain: 	tspfcp
Copyright: 		Copyright © 2013 The Software People, LLC (www.thesoftwarepeople.com). All rights reserved
License: 		APACHE v2.0 (http://www.apache.org/licenses/LICENSE-2.0)
*/

require_once(ABSPATH . 'wp-admin/includes/plugin.php' );

define('TSPFCP_PLUGIN_FILE', 				__FILE__ );
define('TSPFCP_PLUGIN_PATH',				plugin_dir_path( __FILE__ ) );
define('TSPFCP_PLUGIN_URL', 				plugin_dir_url( __FILE__ ) );
define('TSPFCP_PLUGIN_NAME', 				'tsp-facepile');
define('TSPFCP_PLUGIN_TITLE', 				'TSP Facepile');

if (!class_exists('TSP_Easy_Plugin'))
{
	wp_die ('<pre>TSP Facepile plugin was not installed, plugin requires the installation and activation of The <a target="_blank" href="/wp-admin/plugin-install.php?tab=search&type=term&s=TSP+Easy+Plugin">TSP Easy Plugin</a>.<br><br><strong>To return to the dashboard</strong>, click the back button on your browser and fix this issue.</pre>');
}//endif

require_once( TSPFCP_PLUGIN_PATH . 'tsp-easy-plugin.config.php');
require_once( TSPFCP_PLUGIN_PATH . 'tsp-easy-plugin.extend.php');

//--------------------------------------------------------
// initialize the Facepile plugin
//--------------------------------------------------------
$my_settings 							= fn_tsp_facepile_get_globals();

$facepile 								= new TSP_Easy_Plugin( $my_settings );

$facepile->uses_smarty 					= true;

$facepile->uses_shortcodes 				= false;

$facepile->required_wordpress_version 	= "3.5.1";

$facepile->settings						= new TSP_Easy_Plugin_Settings_Facepile();

$facepile->add_link ( 'FAQ', 			'http://wordpress.org/extend/plugins/' . TSPFCP_PLUGIN_NAME . '/faq/' );
$facepile->add_link ( 'Rate Me', 		'http://wordpress.org/support/view/plugin-reviews/' . TSPFCP_PLUGIN_NAME );
$facepile->add_link ( 'Support', 		'http://wordpress.org/support/plugin/' . TSPFCP_PLUGIN_NAME );

$facepile->add_css( TSPFCP_PLUGIN_URL . 'tsp-facepile.css' );
$facepile->add_css( TSP_EASY_PLUGIN_ASSETS_CSS_URL . 'style.css', true );
$facepile->add_css( TSP_EASY_PLUGIN_ASSETS_CSS_URL . 'font-awesome.css', true );
$facepile->add_script( TSP_EASY_PLUGIN_ASSETS_JS_URL . 'skel.min.js', true );

$facepile->set_plugin_icon( TSP_EASY_PLUGIN_ASSETS_IMAGES_URL . 'tsp_icon_16.png' );

$facepile->add_shortcode ( TSPFCP_PLUGIN_NAME );
$facepile->add_shortcode ( 'tsp_facepile' ); //backwards compatibility

$facepile->deactivate_incompatible_plugins( array('tsp_facepile') ); //backwards compatibility

$facepile->run( __FILE__ );

?>