<?php
    /*
    Plugin Name: 	LAPDI Facepile
    Plugin URI: 	https://letaprodoit.com/apps/plugins/wordpress/facepile-for-wordpress
    Description: 	Facepile allows you to <strong>add user photo icons to your blog</strong>'s website in grid format. Powered by <strong><a href="http://wordpress.org/plugins/tsp-easy-dev/">LAPDI Easy Dev</a></strong>.
    Author: 		Let A Pro Do IT!
    Author URI: 	https://letaprodoit.com/
    Version: 		1.1.6
    Text Domain: 	tspfcp
    Copyright: 		Copyright � 2021 Let A Pro Do IT!, LLC (www.letaprodoit.com). All rights reserved
    License: 		APACHE v2.0 (http://www.apache.org/licenses/LICENSE-2.0)
    */

    require_once(ABSPATH . 'wp-admin/includes/plugin.php' );

    define('TSPFCP_PLUGIN_FILE', 				__FILE__ );
    define('TSPFCP_PLUGIN_PATH',				plugin_dir_path( __FILE__ ) );
    define('TSPFCP_PLUGIN_URL', 				plugin_dir_url( __FILE__ ) );
    define('TSPFCP_PLUGIN_BASE_NAME', 			plugin_basename( __FILE__ ) );
    define('TSPFCP_PLUGIN_NAME', 				'tsp-facepile');
    define('TSPFCP_PLUGIN_TITLE', 				'Facepile');
    define('TSPFCP_PLUGIN_REQ_VERSION', 		"3.5.1");

    if (file_exists( WP_PLUGIN_DIR . "/tsp-easy-dev/tsp-easy-dev.php" ))
    {
        include_once WP_PLUGIN_DIR . "/tsp-easy-dev/tsp-easy-dev.php";
    }//end else
    else
        return;

    global $easy_dev_settings;

    require( TSPFCP_PLUGIN_PATH . 'TSP_Easy_Dev.config.php');
    require( TSPFCP_PLUGIN_PATH . 'TSP_Easy_Dev.extend.php');
    //--------------------------------------------------------
    // initialize the plugin
    //--------------------------------------------------------
    $facepile 								= new TSP_Easy_Dev( TSPFCP_PLUGIN_FILE, TSPFCP_PLUGIN_REQ_VERSION );

    $facepile->set_options_handler( new TSP_Easy_Dev_Options_Facepile( $easy_dev_settings ) );

    $facepile->set_widget_handler( 'TSP_Easy_Dev_Widget_Facepile' );

    $facepile->add_link ( 'FAQ',          preg_replace("/\%PLUGIN\%/", TSPFCP_PLUGIN_NAME, TSP_WORDPRESS_FAQ_URL ));
    $facepile->add_link ( 'Rate Me',      preg_replace("/\%PLUGIN\%/", TSPFCP_PLUGIN_NAME, TSP_WORDPRESS_RATE_URL ) );
    $facepile->add_link ( 'Support',      preg_replace("/\%PLUGIN\%/", 'wordpress-fcp', TSP_LAB_BUG_URL ));

    $facepile->uses_shortcodes 				= true;

    // Queue User styles
    $facepile->add_css( TSPFCP_PLUGIN_URL . TSPFCP_PLUGIN_NAME . '.css' );

    $facepile->set_plugin_icon( TSP_EASY_DEV_ASSETS_IMAGES_URL . 'icon_16.png' );

    $facepile->add_shortcode ( TSPFCP_PLUGIN_NAME );
    $facepile->add_shortcode ( 'tsp_facepile' ); //backwards compatibility

    $facepile->run( TSPFCP_PLUGIN_FILE );

    // Initialize widget - Required by WordPress
    add_action('widgets_init', function () {
        global $facepile;

        register_widget ( $facepile->get_widget_handler() );
        apply_filters( $facepile->get_widget_handler().'-init', $facepile->get_options_handler() );
    });