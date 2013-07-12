<?php
/*
Plugin Name: 	TSP Facepile
Plugin URI: 	http://www.thesoftwarepeople.com/software/plugins/wordpress/featured-users-for-wordpress.html
Description: 	Facepile allows you to add wordpress users photo icons to your blog's website in grid format.
Author: 		The Software People
Author URI: 	http://www.thesoftwarepeople.com/
Version: 		1.0
Copyright: 		Copyright © 2013 The Software People, LLC (www.thesoftwarepeople.com). All rights reserved
License: 		APACHE v2.0 (http://www.apache.org/licenses/LICENSE-2.0)
*/

define( 'TSPFCP_REQUIRED_WP_VERSION', '3.5.1' );
define( 'TSPFCP_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

require_once(ABSPATH . 'wp-admin/includes/plugin.php' );

// Get the plugin path
if (!defined('WP_CONTENT_DIR')) define('WP_CONTENT_DIR', ABSPATH . 'wp-content');
if (!defined('DIRECTORY_SEPARATOR')) {
    if (strpos(php_uname('s') , 'Win') !== false) define('DIRECTORY_SEPARATOR', '\\');
    else define('DIRECTORY_SEPARATOR', '/');
}

// Set the abs plugin path
define('PLUGIN_ABS_PATH', ABSPATH . PLUGINDIR );
$plugin_abs_path = PLUGIN_ABS_PATH . DIRECTORY_SEPARATOR . "tsp-facepile";
define('TSPFCP_ABS_PATH', $plugin_abs_path);
$plugin_url = WP_CONTENT_URL . '/plugins/' . plugin_basename(dirname(__FILE__)) . '/';
define('TSPFCP_URL_PATH', $plugin_url);

$upload_dir = wp_upload_dir();

define('TSPFCP_TEMPLATE_PATH', TSPFCP_ABS_PATH . '/templates');
define('TSPFCP_TEMPLATE_CACHE_PATH', $upload_dir['basedir'] . '/tsp-plugins/tsp-facepile/cache');
define('TSPFCP_TEMPLATE_COMPILE_PATH', $upload_dir['basedir'] . '/tsp-plugins/tsp-facepile/compiled');

// Set the file path
$file_path    = $plugin_abs_path . DIRECTORY_SEPARATOR . basename(__FILE__);

// Set the absolute path
$asolute_path = dirname(__FILE__) . DIRECTORY_SEPARATOR;
define('TSPFCP_ABSPATH', $asolute_path);


include_once(TSPFCP_ABS_PATH . '/includes/settings.inc.php');


if (!class_exists('Smarty'))
{
    if (file_exists(TSPFCP_ABS_PATH . '/libs/Smarty.class.php'))
        require_once TSPFCP_ABS_PATH . '/libs/Smarty.class.php';
}

register_activation_hook( __FILE__, 'fn_tspfcp_install' );
register_uninstall_hook( __FILE__, 'fn_tspfcp_uninstall' );
//--------------------------------------------------------
// install plugin
//--------------------------------------------------------
function fn_tspfcp_install()
{
	$message = "";
	
	if (!wp_mkdir_p( TSPFCP_TEMPLATE_CACHE_PATH ))
		$message .= "<br>Unable to create " . TSPFCP_TEMPLATE_CACHE_PATH . " directory. Please create this directory manually via FTP or cPanel.";
	else
		@chmod( TSPFCP_TEMPLATE_CACHE_PATH, 0777 );
	
	
	if (!wp_mkdir_p( TSPFCP_TEMPLATE_COMPILE_PATH ))
		$message .= "<br>Unable to create " . TSPFCP_TEMPLATE_COMPILE_PATH . " directory. Please create this directory manually via FTP or cPanel.";
	else
		@chmod( TSPFCP_TEMPLATE_COMPILE_PATH, 0777 );
	
	return $message;
}
//--------------------------------------------------------
// uninstall plugin
//--------------------------------------------------------
function fn_tspfcp_uninstall()
{
	delete_option( 'tspfcp_options' );
}
//--------------------------------------------------------
// Process shortcodes
//--------------------------------------------------------
function fn_tspfcp_process_shortcodes($att)
{
	global $TSPFCP_OPTIONS;
	
	if ( is_feed() )
		return '[tsp-facepile]';

	$options = $TSPFCP_OPTIONS;
	
	if (!empty($att))
		$options = array_merge( $TSPFCP_OPTIONS, $att );
		     	
	$output = fn_tspfcp_display($options,false);
	
	return $output;
}

add_shortcode('tsp-facepile', 'fn_tspfcp_process_shortcodes');
add_shortcode('tsp_facepile', 'fn_tspfcp_process_shortcodes');

//--------------------------------------------------------
// Queue the stylesheet
//--------------------------------------------------------
function fn_tspfcp_enqueue_styles()
{
	wp_register_style( 'tspfcp-stylesheet', plugins_url( 'tsp-facepile.css', __FILE__ ) );
	wp_enqueue_style( 'tspfcp-stylesheet' );
}

add_action('wp_print_styles', 'fn_tspfcp_enqueue_styles');
//--------------------------------------------------------

//--------------------------------------------------------
// Show simple featured links
//--------------------------------------------------------
function fn_tspfcp_display ($args = null, $echo = true)
{
    global $TSPFCP_OPTIONS;

	$smarty = new Smarty;
	$smarty->setTemplateDir(TSPFCP_TEMPLATE_PATH);
	$smarty->setCompileDir(TSPFCP_TEMPLATE_CACHE_PATH);
	$smarty->setCacheDir(TSPFCP_TEMPLATE_COMPILE_PATH);

	$return_HTML = "";

	$fp = $TSPFCP_OPTIONS;
	
	if (!empty($args))
		$fp = array_merge( $TSPFCP_OPTIONS, $args );
    
    // User settings
    $title        	= $fp['title'];
    $shownames     	= $fp['shownames'];
    $tspfcp_rows    = $fp['tspfcp_rows'];
    $tspfcp_cols    = $fp['tspfcp_cols'];
    $widththumb   	= $fp['widththumb'];
    $heightthumb  	= $fp['heightthumb'];
    $beforetitle 	= html_entity_decode($fp['beforetitle']);
    $aftertitle  	= html_entity_decode($fp['aftertitle']);
    
    // If there is a title insert before/after title tags
    if (!empty($title)) {
        $return_HTML .= $beforetitle . $title . $aftertitle;
    }
    
    global $wpdb;
    
    // Query all subscribers
	$user_count = $tspfcp_rows * $tspfcp_cols;
	
	// Display subscribers only  
	$total_users = $wpdb->get_var("SELECT COUNT($wpdb->users.ID) FROM $wpdb->users INNER JOIN $wpdb->usermeta ON $wpdb->users.ID = $wpdb->usermeta.user_id WHERE $wpdb->usermeta.meta_key = 'wp_user_level' AND $wpdb->usermeta.meta_value = '0'");
	
	$query = "SELECT $wpdb->users.ID FROM $wpdb->users INNER JOIN $wpdb->usermeta ON $wpdb->users.ID = $wpdb->usermeta.user_id WHERE $wpdb->usermeta.meta_key = 'wp_user_level' AND $wpdb->usermeta.meta_value = '0' ORDER BY RAND() LIMIT 0, $user_count";
	$users = $wpdb->get_results($query);
	
	$entry_cnt = 0;
	$num_entries = $user_count;

	if (!empty($users))
	{
	    // Store values into Smarty
	    foreach ($fp as $key => $val)
	    {
	    	$smarty->assign("$key", $val, true);
	    }
		

       	for ($i=0; $i < $tspfcp_rows; $i++) 
       	{ 
			$start_row = true;
			$end_row = false;
			
			for ($j=0; $j < $tspfcp_cols; $j++) 
			{ 		        
		        $entry_cnt++;
		
				if ($entry_cnt == 1)
					$smarty->assign("first_entry", true, true);
				else
					$smarty->assign("first_entry", null, true);
									
				if ($entry_cnt == $num_entries)
					$smarty->assign("last_entry", true, true);
				else
					$smarty->assign("last_entry", null, true);

				// get the current user index
				$user_index = ($i * $tspfcp_cols) + $j;
				
				// If we are done processing users then break
				if($user_index >= $user_count)
					break;
				// If we are on the last row display the ending tr tag
				elseif ($user_index == ($user_count - 1))
					$end_row = true;
					
				$user = $users[$user_index]; // current user
				$curauth = get_userdata($user->ID); //user data
				
				$name = "";
				if ($shownames == 'Y')
					$name = $curauth->display_name;
					
				$gravatar_type = get_option('wpu_gravatar_type');
				$display_gravatar = get_avatar($curauth->user_email, $widththumb, $gravatar_type, $name); //get avatar

				$smarty->assign("start_row", $start_row, true);
				$smarty->assign("end_row", $end_row, true);
				$smarty->assign("total_users", $total_users, true);
				$smarty->assign("display_gravatar", $display_gravatar, true);
				
				$return_HTML .= $smarty->fetch('facepile.tpl');
				
				$start_row = false;

			}//endfor
		}//endfor

	}// end if
	
	if ($echo)
		echo $return_HTML;
	else
		return $return_HTML;
}

//--------------------------------------------------------
// Widget Section
//--------------------------------------------------------

//--------------------------------------------------------
// Register widget
//--------------------------------------------------------
function fn_tspfcp_widget_init()
{
    register_widget('TSPFCP_Widget');
}

// Add functions to init
add_action('widgets_init', 'fn_tspfcp_widget_init');
//--------------------------------------------------------

class TSPFCP_Widget extends WP_Widget
{
    //--------------------------------------------------------
    // Constructor
	//--------------------------------------------------------
	function __construct()
    {
        // Get widget options
        $widget_options  = array(
            'classname'                 => 'widget-tsp-facepile',
            'description'               => __('This widget allows you to add in your sites users in grid format.', 'tsp-facepile')
        );
        
        // Get control options
        $control_options = array(
            'width' => 300,
            'height' => 350,
            'id_base' => 'widget-tsp-facepile'
        );
        
        // Create the widget
		parent::__construct('widget-tsp-facepile', __('TSP Facepile', 'tsp-facepile') , $widget_options, $control_options);
    }
    
    //--------------------------------------------------------
    // initialize the widget
	//--------------------------------------------------------
    function widget($args, $instance)
    {
        extract($args);
        
        $arguments = array(
            'title' 		=> $instance['title'],
            'shownames' 	=> $instance['shownames'],
            'tspfcp_rows' 	=> $instance['tspfcp_rows'],
            'tspfcp_cols' 	=> $instance['tspfcp_cols'],
            'widththumb' 	=> $instance['widththumb'],
            'heightthumb'	=> $instance['heightthumb'],
            'beforetitle' 	=> $instance['beforetitle'],
            'aftertitle' 	=> $instance['aftertitle']
        );
        
        // Display the widget
        echo $before_widget;
        fn_tspfcp_display($arguments);
        echo $after_widget;
    }
    
    //--------------------------------------------------------
    // update the widget
	//--------------------------------------------------------
    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        
        // Update the widget data
        $instance['title']         = strip_tags($new_instance['title']);
        $instance['shownames']     = $new_instance['shownames'];
        $instance['tspfcp_rows']   = $new_instance['tspfcp_rows'];
        $instance['tspfcp_cols']   = $new_instance['tspfcp_cols'];
        $instance['widththumb']    = $new_instance['widththumb'];
        $instance['heightthumb']   = $new_instance['heightthumb'];
        $instance['beforetitle']   = htmlentities($new_instance['beforetitle']);
        $instance['aftertitle']    = htmlentities($new_instance['aftertitle']);
        
        return $instance;
    }
    
    //--------------------------------------------------------
    // display the form
	//--------------------------------------------------------
    function form($instance)
    {
		global $TSPFCP_DEFAULTS;
		        
        $instance = wp_parse_args((array)$instance, $TSPFCP_DEFAULTS); ?>
      
<!-- Display the title -->
<p>
   <label for="<?php
        echo $this->get_field_id('title'); ?>"><?php
        _e('Title:', 'tsp-facepile') ?></label>
   <input id="<?php
        echo $this->get_field_id('title'); ?>" name="<?php
        echo $this->get_field_name('title'); ?>" value="<?php
        echo $instance['title']; ?>" style="width:100%;" />
</p>


<!-- Display user names -->
<p>
   <label for="<?php
        echo $this->get_field_id('shownames'); ?>"><?php
        _e('Display user names?', 'tsp-facepile') ?></label>
   <select name="<?php
        echo $this->get_field_name('shownames'); ?>" id="<?php
        echo $this->get_field_id('shownames'); ?>" >
      <option class="level-0" value="Y" <?php
        if ($instance['shownames'] == "Y") echo " selected='selected'" ?>><?php
        _e('Yes', 'tsp-facepile') ?></option>
      <option class="level-0" value="N" <?php
        if ($instance['shownames'] == "N") echo " selected='selected'" ?>><?php
        _e('No', 'tsp-facepile') ?></option>
   </select>
</p>

<!-- Choose the number of tspfcp_rows -->
<p>
   <input id="<?php
        echo $this->get_field_id('tspfcp_rows'); ?>" name="<?php
        echo $this->get_field_name('tspfcp_rows'); ?>" value="<?php
        echo $instance['tspfcp_rows']; ?>" style="width:20%;" />
   <label for="<?php
        echo $this->get_field_id('tspfcp_rows'); ?>"><?php
        _e('Number of Rows', 'tsp-facepile') ?></label>
</p>


<!-- Choose the number of tspfcp_cols -->
<p>
   <input id="<?php
        echo $this->get_field_id('tspfcp_cols'); ?>" name="<?php
        echo $this->get_field_name('tspfcp_cols'); ?>" value="<?php
        echo $instance['tspfcp_cols']; ?>" style="width:20%;" />
   <label for="<?php
        echo $this->get_field_id('tspfcp_cols'); ?>"><?php
        _e('Number of Columns', 'tsp-facepile') ?></label>
</p>

<!-- Choose the thumbnail width -->
<p>
   <input id="<?php
        echo $this->get_field_id('widththumb'); ?>" name="<?php
        echo $this->get_field_name('widththumb'); ?>" value="<?php
        echo $instance['widththumb']; ?>" style="width:20%;" />
   <label for="<?php
        echo $this->get_field_id('widththumb'); ?>"><?php
        _e('Thumbnail Width', 'tsp-facepile') ?></label>
</p>

<!-- Choose the thumbnail height -->
<p>
   <input id="<?php
        echo $this->get_field_id('heightthumb'); ?>" name="<?php
        echo $this->get_field_name('heightthumb'); ?>" value="<?php
        echo $instance['heightthumb']; ?>" style="width:20%;" />
   <label for="<?php
        echo $this->get_field_id('heightthumb'); ?>"><?php
        _e('Thumbnail Height', 'tsp-facepile') ?></label>
</p>

<!-- Before title -->
<p>
   <label for="<?php
        echo $this->get_field_id('beforetitle'); ?>"><?php
        _e('HTML Before Title', 'tsp-featured-categories') ?></label>
   <input id="<?php
        echo $this->get_field_id('beforetitle'); ?>" name="<?php
        echo $this->get_field_name('beforetitle'); ?>" value="<?php
        echo $instance['beforetitle']; ?>" style="width:20%;" />
</p>

<!-- After title -->
<p>
   <label for="<?php
        echo $this->get_field_id('aftertitle'); ?>"><?php
        _e('HTML After Title', 'tsp-featured-categories') ?></label>
   <input id="<?php
        echo $this->get_field_id('aftertitle'); ?>" name="<?php
        echo $this->get_field_name('aftertitle'); ?>" value="<?php
        echo $instance['aftertitle']; ?>" style="width:20%;" />
</p>
   <?php
    }
} //end class TSPFCP_Widget
?>
