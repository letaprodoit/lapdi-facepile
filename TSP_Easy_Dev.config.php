<?php									
/* @group Easy Dev Package settings, all plugins use the same settings, DO NOT EDIT */
if ( !defined( 'TSP_PARENT_NAME' )) define('TSP_PARENT_NAME', 			'tsp_plugins');
if ( !defined( 'TSP_PARENT_TITLE' )) define('TSP_PARENT_TITLE', 		'TSP Plugins');
if ( !defined( 'TSP_PARENT_MENU_POS' )) define('TSP_PARENT_MENU_POS', 	2617638.180);
/* @end */

/**
* Every plugin that uses Easy Dev must define the DS variable that sets the path deliminter
*
* @var string
*/
if (!defined('DS')) {
    if (strpos(php_uname('s') , 'Win') !== false) define('DS', '\\');
    else define('DS', '/');
}//endif

$easy_dev_settings = get_plugin_data( TSPFCP_PLUGIN_FILE, false, false );
$easy_dev_settings['parent_name']			= TSP_PARENT_NAME;
$easy_dev_settings['parent_title']			= TSP_PARENT_TITLE;
$easy_dev_settings['menu_pos'] 				= TSP_PARENT_MENU_POS;

$easy_dev_settings['name'] 					= TSPFCP_PLUGIN_NAME;
$easy_dev_settings['key'] 					= $easy_dev_settings['TextDomain'];
$easy_dev_settings['title']					= $easy_dev_settings['Name'];
$easy_dev_settings['title_short']			= $easy_dev_settings['Name'];

$easy_dev_settings['option_prefix']			= TSPFCP_PLUGIN_NAME . "-option";
$easy_dev_settings['option_prefix_old']		= $easy_dev_settings['TextDomain']."_options";

$easy_dev_settings['file']	 				= TSPFCP_PLUGIN_FILE;
$easy_dev_settings['base_name']	 			= TSPFCP_PLUGIN_BASE_NAME;

$easy_dev_settings['widget_width']	 		= 300;
$easy_dev_settings['widget_height'] 		= 350;

$easy_dev_settings['smarty_template_dirs']	= array( TSPFCP_PLUGIN_PATH . 'templates', TSP_EASY_DEV_ASSETS_TEMPLATES_PATH );
$easy_dev_settings['smarty_compiled_dir']  	= TSP_EASY_DEV_TMP_PATH . TSPFCP_PLUGIN_NAME . DS . 'compiled';
$easy_dev_settings['smarty_cache_dir'] 		= TSP_EASY_DEV_TMP_PATH . TSPFCP_PLUGIN_NAME . DS . 'cache';

//* Custom globals *//
$easy_dev_settings['title_short']			= preg_replace("/TSP/","",$easy_dev_settings['Name']);
$easy_dev_settings['store_url']	 			= 'http://www.thesoftwarepeople.com/software/plugins/wordpress';
$easy_dev_settings['wp_query'] 				= '/wp-admin/plugin-install.php?tab=search&type=term&s';
$easy_dev_settings['contact_url'] 			= 'http://www.thesoftwarepeople.com/about-us/contact-us.html';
$easy_dev_settings['plugin_list']			= 'http://www.thesoftwarepeople.com/plugins/wordpress/plugins.json';
//* Custom globals *//

$easy_dev_settings['plugin_options']		= array(
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

$easy_dev_settings['plugin_options']['shortcode_fields'] = $easy_dev_settings['plugin_options']['widget_fields'];		
?>