<?php									
/* @group Easy Plugin Package settings, all plugins use the same settings, DO NOT EDIT */
define('TSP_PARENT_NAME', 					'tsp_plugins');
define('TSP_PARENT_TITLE', 					'TSP Plugins');
define('TSP_PARENT_MENU_POS', 				2617638);
/* @end */

// Get the plugin path
if (!defined('WP_CONTENT_DIR')) define('WP_CONTENT_DIR', ABSPATH . 'wp-content');

if (!defined('DS')) {
    if (strpos(php_uname('s') , 'Win') !== false) define('DS', '\\');
    else define('DS', '/');
}//endif

/**
 * Plugin default user settings for the widget
 *
 * @since 1.0.0
 *
 * @param none
 *
 * @return array array of widget default user settings
 */
function fn_tsp_facepile_get_settings()
{
	return array(		
		'title' 		=> array( 
			'type' 		=> 'INPUT', 
			'label' 	=> 'Title', 
			'value' 	=> '',
			'strip'		=> true,
		),		
		'shownames' 	=> array( 
			'type' 		=> 'SELECT', 
			'label' 	=> 'Display user names?', 
			'value' 	=> 'Y',
			'options'	=> array ('Yes' => 'Y', 'No' => 'N'),
		),		
		'num_rows' 		=> array( 
			'type' 		=> 'INPUT', 
			'label' 	=> 'Number of Rows', 
			'value' 	=> 4,
		),		
		'num_cols' 		=> array( 
			'type' 		=> 'INPUT', 
			'label' 	=> 'Number of Columns', 
			'value' 	=> 4,
		),		
		'widththumb' 	=> array( 
			'type' 		=> 'INPUT', 
			'label' 	=> 'Thumbnail Width', 
			'value' 	=> 80,
		),		
		'heightthumb' 	=> array( 
			'type' 		=> 'INPUT', 
			'label' 	=> 'Thumbnail Height', 
			'value' 	=> 80,
		),		
		'beforetitle' 	=> array( 
			'type' 		=> 'INPUT', 
			'label' 	=> 'HTML Before Title', 
			'value' 	=> '<h3 class="widget-title">',
			'html'		=> true,
		),		
		'aftertitle' 	=> array( 
			'type' 		=> 'INPUT', 
			'label' 	=> 'HTML After Title', 
			'value' 	=> '</h3>',
			'html'		=> true,
		),		
	);
}//end fn_plugin_settings

/**
 * Plugin settings for the widget
 *
 * @since 1.0.0
 *
 * @param none
 *
 * @return array array of plugin settings
 */
function fn_tsp_facepile_get_globals()
{
	$plugin_globals = get_plugin_data( TSPFCP_PLUGIN_FILE, false, false );
	
	$plugin_globals['parent_name']		= TSP_PARENT_NAME;
	$plugin_globals['parent_title']		= TSP_PARENT_TITLE;
	$plugin_globals['parent_menu'] 		= TSP_PARENT_MENU_POS;

	$plugin_globals['name'] 			= TSPFCP_PLUGIN_NAME;
	$plugin_globals['title']			= $plugin_globals['Name'];
	$plugin_globals['title_settings']	= $plugin_globals['Name'];

	$plugin_globals['option']			= TSPFCP_PLUGIN_NAME . "-option";
	
	$plugin_globals['file']	 			= TSPFCP_PLUGIN_FILE;
	
	$plugin_globals['widget_width']	 	= 300;
	$plugin_globals['widget_height'] 	= 350;
	
	$plugin_globals['easy_templates'] 	= TSP_EASY_PLUGIN_ASSETS_TEMPLATES_PATH;

	$plugin_globals['smarty_compiled']  = TSP_EASY_PLUGIN_TMP_PATH . TSPFCP_PLUGIN_NAME . DS . 'compiled';
	$plugin_globals['smarty_cache'] 	= TSP_EASY_PLUGIN_TMP_PATH . TSPFCP_PLUGIN_NAME . DS . 'cache';

	$plugin_globals['settings']			= fn_tsp_facepile_get_settings();

	//* Custom globals *//
	$plugin_globals['templates'] 		= TSPFCP_PLUGIN_PATH . 'templates';
	$plugin_globals['title_settings']	= preg_replace("/TSP/","",$plugin_globals['Name']);
	$plugin_globals['store_url']	 	= 'http://www.thesoftwarepeople.com/software/plugins/wordpress';
	$plugin_globals['wp_query'] 		= '/wp-admin/plugin-install.php?tab=search&type=term&s';
	$plugin_globals['contact_url'] 		= 'http://www.thesoftwarepeople.com/about-us/contact-us.html';

	return $plugin_globals;
}// fn_tsp_easy_plugin_get_globals
?>