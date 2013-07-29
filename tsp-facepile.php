<?php
/*
Plugin Name: 	TSP Facepile
Plugin URI: 	http://www.thesoftwarepeople.com/software/plugins/wordpress/facepile-for-wordpress.html
Description: 	Facepile allows you to add WordPress users photo icons to your blog's website in grid format.
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

if (!class_exists('TSP_Easy_Dev'))
{
	add_action( 'admin_notices', function (){
		
		$message = TSPFCP_PLUGIN_TITLE . ' <strong>was not installed</strong>, plugin requires the installation and activation of <a href="plugin-install.php?tab=search&type=term&s=TSP+Easy+Plugins">TSP Easy Dev</a> or <a href="plugin-install.php?tab=search&type=term&s=TSP+Easy+Plugins+Pro">TSP Easy Dev Pro</a>.';
	    ?>
	    <div class="error">
	        <p><?php echo $message; ?></p>
	    </div>
	    <?php
	} );
	
	deactivate_plugins( TSPFCP_PLUGIN_NAME . '/'. TSPFCP_PLUGIN_NAME . '.php');
	
	return;
}//endif

global $easy_dev_settings;

require( TSPFCP_PLUGIN_PATH . 'tsp-easy-dev.config.php');
require( TSPFCP_PLUGIN_PATH . 'tsp-easy-dev.extend.php');
//--------------------------------------------------------
// initialize the Facepile plugin
//--------------------------------------------------------
$facepile 								= new TSP_Easy_Dev( $easy_dev_settings );

$facepile->uses_smarty 					= true;

$facepile->uses_shortcodes 				= true;

$facepile->required_wordpress_version 	= "3.5.1";

$facepile->set_settings_handler( new TSP_Easy_Dev_Settings_Facepile() );

$facepile->set_widget_handler( 'TSP_Easy_Dev_Widget_Facepile' );

$facepile->add_css( TSPFCP_PLUGIN_URL . TSPFCP_PLUGIN_NAME . '.css' );
$facepile->add_css( TSPFCP_PLUGIN_URL . 'css' . DS. 'admin-style.css', true );
$facepile->add_css( TSP_EASY_DEV_ASSETS_CSS_URL . 'style.css', true );

$facepile->set_plugin_icon( TSPFCP_PLUGIN_URL . 'images' . DS . 'tsp_icon_16.png' );

$facepile->add_shortcode ( TSPFCP_PLUGIN_NAME );
$facepile->add_shortcode ( 'tsp_facepile' ); //backwards compatibility

$facepile->run( __FILE__ );

// Initialize widget - Required by WordPress
add_action('widgets_init', function () {
	global $facepile;
	
	register_widget ( $facepile->get_widget_handler() ); 
	apply_filters( $facepile->get_widget_handler().'-init', $facepile->get_settings() );
});
?>