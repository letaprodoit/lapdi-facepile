<?php
/*
Plugin Name: 	TSP Facepile
Plugin URI: 	http://www.thesoftwarepeople.com/software/plugins/wordpress/facepile-for-wordpress.html
Description: 	Facepile allows you to <strong>add user photo icons to your blog</strong>'s website in grid format. Powered by <strong><a href="http://wordpress.org/plugins/tsp-easy-dev/">TSP Easy Dev</a></strong>.
Author: 		The Software People
Author URI: 	http://www.thesoftwarepeople.com/
Version: 		1.1.2
Text Domain: 	tspfcp
Copyright: 		Copyright © 2013 The Software People, LLC (www.thesoftwarepeople.com). All rights reserved
License: 		APACHE v2.0 (http://www.apache.org/licenses/LICENSE-2.0)
*/

require_once(ABSPATH . 'wp-admin/includes/plugin.php' );

define('TSPFCP_PLUGIN_FILE', 				__FILE__ );
define('TSPFCP_PLUGIN_PATH',				plugin_dir_path( __FILE__ ) );
define('TSPFCP_PLUGIN_URL', 				plugin_dir_url( __FILE__ ) );
define('TSPFCP_PLUGIN_BASE_NAME', 			plugin_basename( __FILE__ ) );
define('TSPFCP_PLUGIN_NAME', 				'tsp-facepile');
define('TSPFCP_PLUGIN_TITLE', 				'TSP Facepile');
define('TSPFCP_PLUGIN_REQ_VERSION', 		"3.5.1");

// The recommended option would be to require the installation of the standard version and
// bundle the Pro classes into your plugin if needed
if ( !file_exists ( WP_PLUGIN_DIR . "/tsp-easy-dev/TSP_Easy_Dev.register.php" ) )
{
	function display_tspfcp_notice()
	{
		$message = TSPFCP_PLUGIN_TITLE . ' <strong>was not installed</strong>, plugin requires the installation of <strong><a href="plugin-install.php?tab=search&type=term&s=TSP+Easy+Dev">TSP Easy Dev</a></strong>.';
	    ?>
	    <div class="error">
	        <p><?php echo $message; ?></p>
	    </div>
	    <?php
	}//end display_tspfcp_notice

	add_action( 'admin_notices', 'display_tspfcp_notice' );
	deactivate_plugins( TSPFCP_PLUGIN_BASE_NAME );
	return;
}//endif
else
{
    if (file_exists( WP_PLUGIN_DIR . "/tsp-easy-dev/TSP_Easy_Dev.register.php" ))
    {
    	include_once WP_PLUGIN_DIR . "/tsp-easy-dev/TSP_Easy_Dev.register.php";
    }//end else
}//end else

global $easy_dev_settings;

require( TSPFCP_PLUGIN_PATH . 'TSP_Easy_Dev.config.php');
require( TSPFCP_PLUGIN_PATH . 'TSP_Easy_Dev.extend.php');
//--------------------------------------------------------
// initialize the plugin
//--------------------------------------------------------
$facepile 								= new TSP_Easy_Dev( TSPFCP_PLUGIN_FILE, TSPFCP_PLUGIN_REQ_VERSION );

$facepile->set_options_handler( new TSP_Easy_Dev_Options_Facepile( $easy_dev_settings ) );

$facepile->set_widget_handler( 'TSP_Easy_Dev_Widget_Facepile' );

$facepile->add_link ( 'FAQ', 			'http://wordpress.org/extend/plugins/tsp-facepile/faq/' );
$facepile->add_link ( 'Rate Me', 		'http://wordpress.org/support/view/plugin-reviews/tsp-facepile' );
$facepile->add_link ( 'Support', 		'http://wordpress.org/support/plugin/tsp-facepile' );

$facepile->uses_smarty 					= true;

$facepile->uses_shortcodes 				= true;

$facepile->add_css( TSPFCP_PLUGIN_URL . TSPFCP_PLUGIN_NAME . '.css' );
$facepile->add_css( TSPFCP_PLUGIN_URL . 'css' . DS. 'admin-style.css', true );
$facepile->add_css( TSP_EASY_DEV_ASSETS_CSS_URL . 'style.css', true );

$facepile->set_plugin_icon( TSPFCP_PLUGIN_URL . 'images' . DS . 'tsp_icon_16.png' );

$facepile->add_shortcode ( TSPFCP_PLUGIN_NAME );
$facepile->add_shortcode ( 'tsp_facepile' ); //backwards compatibility

$facepile->run( TSPFCP_PLUGIN_FILE );

// Initialize widget - Required by WordPress
add_action('widgets_init', function () {
	global $facepile;
	
	register_widget ( $facepile->get_widget_handler() ); 
	apply_filters( $facepile->get_widget_handler().'-init', $facepile->get_options_handler() );
});
?>