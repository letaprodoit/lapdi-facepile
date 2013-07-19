<?php									
/* @group Easy Plugins Package settings, all plugins use the same settings, DO NOT EDIT */
if ( !defined( 'TSP_PARENT_NAME' )) define('TSP_PARENT_NAME', 			'tsp_plugins');
if ( !defined( 'TSP_PARENT_TITLE' )) define('TSP_PARENT_TITLE', 		'TSP Plugins');
if ( !defined( 'TSP_PARENT_MENU_POS' )) define('TSP_PARENT_MENU_POS', 	2617638);
/* @end */

// Get the plugin path
if (!defined('WP_CONTENT_DIR')) define('WP_CONTENT_DIR', ABSPATH . 'wp-content');

if (!defined('DS')) {
    if (strpos(php_uname('s') , 'Win') !== false) define('DS', '\\');
    else define('DS', '/');
}//endif

$plugin_globals = get_plugin_data( TSPFCP_PLUGIN_FILE, false, false );
$plugin_globals['parent_name']			= TSP_PARENT_NAME;
$plugin_globals['parent_title']			= TSP_PARENT_TITLE;
$plugin_globals['parent_menu'] 			= TSP_PARENT_MENU_POS;

$plugin_globals['name'] 				= TSPFCP_PLUGIN_NAME;
$plugin_globals['key'] 					= $plugin_globals['TextDomain'];
$plugin_globals['title']				= $plugin_globals['Name'];
$plugin_globals['title_short']			= $plugin_globals['Name'];

$plugin_globals['option_name']			= TSPFCP_PLUGIN_NAME . "-option";
$plugin_globals['option_name_old']		= $plugin_globals['TextDomain']."_options";

$plugin_globals['file']	 				= TSPFCP_PLUGIN_FILE;

$plugin_globals['widget_width']	 		= 300;
$plugin_globals['widget_height'] 		= 350;

$plugin_globals['smarty_template_dirs']	= array( TSPFCP_PLUGIN_PATH . 'templates', TSP_EASY_PLUGINS_ASSETS_TEMPLATES_PATH );
$plugin_globals['smarty_compiled_dir']  = TSP_EASY_PLUGINS_TMP_PATH . TSPFCP_PLUGIN_NAME . DS . 'compiled';
$plugin_globals['smarty_cache_dir'] 	= TSP_EASY_PLUGINS_TMP_PATH . TSPFCP_PLUGIN_NAME . DS . 'cache';

//* Custom globals *//
$plugin_globals['title_short']			= preg_replace("/TSP/","",$plugin_globals['Name']);
$plugin_globals['store_url']	 		= 'http://www.thesoftwarepeople.com/software/plugins/wordpress';
$plugin_globals['wp_query'] 			= '/wp-admin/plugin-install.php?tab=search&type=term&s';
$plugin_globals['contact_url'] 			= 'http://www.thesoftwarepeople.com/about-us/contact-us.html';
$plugin_globals['plugin_list']			= 'http://www.thesoftwarepeople.com/plugins/wordpress/plugin_list.txt';
//* Custom globals *//

$plugin_globals['plugin_data']			= array(
	'widget_fields'						=> array(
		'title' 		=> array( 
			'type' 			=> 'INPUT', 
			'label' 		=> 'Title', 
			'value' 		=> 'TSP Facepile',
		),		
		'show_names' 	=> array( 
			'type' 			=> 'SELECT', 
			'label' 		=> 'Display user names?', 
			'value' 		=> 'Y',
			'options'		=> array ('Yes' => 'Y', 'No' => 'N'),
			'old_labels'	=> array ('shownames'),
		),		
		'show_count' 	=> array( 
			'type' 			=> 'SELECT', 
			'label' 		=> 'Display the number of members?', 
			'value' 		=> 'Y',
			'options'		=> array ('Yes' => 'Y', 'No' => 'N'),
		),		
		'num_rows' 		=> array( 
			'type' 			=> 'INPUT', 
			'label' 		=> 'Number of Rows', 
			'value' 		=> 4,
			'old_labels'	=> array ('tspfcp_rows'),
		),		
		'num_cols' 		=> array( 
			'type' 			=> 'INPUT', 
			'label' 		=> 'Number of Columns', 
			'value' 		=> 4,
			'old_labels'	=> array ('tspfcp_cols'),
		),		
		'thumb_size' 	=> array( 
			'type' 			=> 'INPUT', 
			'label' 		=> 'Thumbnail Size', 
			'value' 		=> 80,
			'old_labels'	=> array ('widththumb'),
		),		
		'before_title' 	=> array( 
			'type' 			=> 'INPUT', 
			'label' 		=> 'HTML Before Title', 
			'value' 		=> '<h3 class="widget-title">',
			'html'			=> true,
			'old_labels'	=> array ('beforetitle'),
		),		
		'after_title' 	=> array( 
			'type' 			=> 'INPUT', 
			'label' 		=> 'HTML After Title', 
			'value' 		=> '</h3>',
			'html'			=> true,
			'old_labels'	=> array ('aftertitle'),
		)
	),		
);
?>