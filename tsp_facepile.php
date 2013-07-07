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

// Get the plugin path
if (!defined('WP_CONTENT_DIR')) define('WP_CONTENT_DIR', ABSPATH . 'wp-content');
if (!defined('DIRECTORY_SEPARATOR')) {
    if (strpos(php_uname('s') , 'Win') !== false) define('DIRECTORY_SEPARATOR', '\\');
    else define('DIRECTORY_SEPARATOR', '/');
}

// Set the abs plugin path
define('PLUGIN_ABS_PATH', ABSPATH . PLUGINDIR );
$plugin_abs_path = ABSPATH . PLUGINDIR . DIRECTORY_SEPARATOR . "tsp_facepile";
define('TSPF_ABS_PATH', $plugin_abs_path);
$plugin_url = WP_CONTENT_URL . '/plugins/' . plugin_basename(dirname(__FILE__)) . '/';
define('TSPF_URL_PATH', $plugin_url);

// Set the file path
$file_path    = $plugin_abs_path . DIRECTORY_SEPARATOR . basename(__FILE__);

// Set the absolute path
$asolute_path = dirname(__FILE__) . DIRECTORY_SEPARATOR;
define('TSPF_ABSPATH', $asolute_path);

include_once(TSPF_ABS_PATH . '/includes/settings.inc.php');

//--------------------------------------------------------
// Process shortcodes
//--------------------------------------------------------
function fn_tsp_facepile_process_shortcodes($att)
{
	global $TSPF_OPTIONS;
	
	if ( is_feed() )
		return '[tsp_facepile]';

	$options = $TSPF_OPTIONS;
	
	if (!empty($att))
		$options = array_merge( $TSPF_OPTIONS, $att );
		     	
	$output = fn_tsp_facepile_display($options,false);
	
	return $output;
}

add_shortcode('tsp_facepile', 'fn_tsp_facepile_process_shortcodes');

//--------------------------------------------------------
// Queue the stylesheet
//--------------------------------------------------------
function fn_tsp_facepile_enqueue_styles()
{
    wp_enqueue_style('tsp_facepile.css', TSPF_URL_PATH . 'tsp_facepile.css');
}

add_action('wp_print_styles', 'fn_tsp_facepile_enqueue_styles');
//--------------------------------------------------------

//--------------------------------------------------------
// Show simple featured links
//--------------------------------------------------------
function fn_tsp_facepile_display ($args = null)
{
    global $TSPF_OPTIONS;

	$fp = $TSPF_OPTIONS;
	
	if (!empty($args))
		$fp = array_merge( $TSPF_OPTIONS, $args );
    
    // User settings
    $title        = $fp['title'];
    $shownames     = $fp['shownames'];
    $tspf_rows    = $fp['tspf_rows'];
    $tspf_cols    = $fp['tspf_cols'];
    $widththumb   = $fp['widththumb'];
    $heightthumb  = $fp['heightthumb'];
    $before_title = $fp['beforetitle'];
    $after_title  = $fp['aftertitle'];
    
    // If there is a title insert before/after title tags
    if (!empty($title)) {
        echo $before_title . $title . $after_title;
    }
    
    global $wpdb;
    
    // Query all subscribers
	$user_count = $tspf_rows * $tspf_cols;
	
	// Display subscribers only  
	$total_users = $wpdb->get_var("SELECT COUNT($wpdb->users.ID) FROM $wpdb->users INNER JOIN $wpdb->usermeta ON $wpdb->users.ID = $wpdb->usermeta.user_id WHERE $wpdb->usermeta.meta_key = 'wp_user_level' AND $wpdb->usermeta.meta_value = '0'");
	
	$query = "SELECT $wpdb->users.ID FROM $wpdb->users INNER JOIN $wpdb->usermeta ON $wpdb->users.ID = $wpdb->usermeta.user_id WHERE $wpdb->usermeta.meta_key = 'wp_user_level' AND $wpdb->usermeta.meta_value = '0' ORDER BY RAND() LIMIT 0, $user_count";
	$users = $wpdb->get_results($query);
	
	if ($users)
	{
	?>	
		<div class="tspf_wp_user_grid">
		  <table class="tspf_wp_user_table">
		    <?php
		      for ($i=0; $i < $tspf_rows; $i++) { 
		        ?>
		          <tr>
		            <?php
			            for ($j=0; $j < $tspf_cols; $j++) { 
							$user_index = ($i * $tspf_cols) + $j;
							
							if($user_index >= $user_count)
								break;
		
			              	$user = $users[$user_index];
			              	$curauth = get_userdata($user->ID);
			              	
							//$gravatar_size = get_option('wpu_gravatar_size');
							$gravatar_type = get_option('wpu_gravatar_type');
							$display_gravatar = get_avatar($curauth->user_email, $widththumb, $gravatar_type);
		              ?>
			                <td>
		                		<div class="tspf_wp_user_table_cell">
		                			<?php echo $display_gravatar; ?>
		                		</div>
			                </td>
		              <?php
		            } //end for cols
		            ?>
		          </tr>
		        <?php
		      } // end for rows
		    ?>
		  </table>
		</div><br>
		<span class="tspf_wp_user_grid_text">Total Members: <?php echo $total_users; ?></span>
		
<?php
	}// end if
}

//--------------------------------------------------------
// Widget Section
//--------------------------------------------------------

//--------------------------------------------------------
// Register widget
//--------------------------------------------------------
function fn_tsp_facepile_widget_init()
{
    register_widget('TSP_Facepile_Widget');
}

// Add functions to init
add_action('widgets_init', 'fn_tsp_facepile_widget_init');
//--------------------------------------------------------

class TSP_Facepile_Widget extends WP_Widget
{
    //--------------------------------------------------------
    // Constructor
	//--------------------------------------------------------
	function __construct()
    {
        // Get widget options
        $widget_options  = array(
            'classname'                 => 'widget_tsp_facepile',
            'description'               => __('This widget allows you to add in your sites users in grid format.', 'tsp_facepile')
        );
        
        // Get control options
        $control_options = array(
            'width' => 300,
            'height' => 350,
            'id_base' => 'widget_tsp_facepile'
        );
        
        // Create the widget
		parent::__construct('widget_tsp_facepile', __('TSP Facepile', 'tsp_facepile') , $widget_options, $control_options);
    }
    
    //--------------------------------------------------------
    // initialize the widget
	//--------------------------------------------------------
    function widget($args, $instance)
    {
        extract($args);
        
        $arguments = array(
            'title' 		=> $instance['title'],
            'shownames' 		=> $instance['shownames'],
            'tspf_rows' 	=> $instance['tspf_rows'],
            'tspf_cols' 	=> $instance['tspf_cols'],
            'widththumb' 	=> $instance['widththumb'],
            'heightthumb'	=> $instance['heightthumb'],
            'beforetitle' 	=> $before_title,
            'aftertitle' 	=> $after_title
        );
        
        // Display the widget
        echo $before_widget;
        fn_tsp_facepile_display($arguments);
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
        $instance['shownames']      = $new_instance['shownames'];
        $instance['tspf_rows']     = $new_instance['tspf_rows'];
        $instance['tspf_cols']     = $new_instance['tspf_cols'];
        $instance['widththumb']    = $new_instance['widththumb'];
        $instance['heightthumb']   = $new_instance['heightthumb'];
        return $instance;
    }
    
    //--------------------------------------------------------
    // display the form
	//--------------------------------------------------------
    function form($instance)
    {
		global $TSPF_DEFAULTS;
		        
        $instance = wp_parse_args((array)$instance, $TSPF_DEFAULTS); ?>
      
<!-- Display the title -->
<p>
   <label for="<?php
        echo $this->get_field_id('title'); ?>"><?php
        _e('Title:', 'tsp_facepile') ?></label>
   <input id="<?php
        echo $this->get_field_id('title'); ?>" name="<?php
        echo $this->get_field_name('title'); ?>" value="<?php
        echo $instance['title']; ?>" style="width:100%;" />
</p>


<!-- Display user names -->
<p>
   <label for="<?php
        echo $this->get_field_id('shownames'); ?>"><?php
        _e('Display user names?', 'tsp_facepile') ?></label>
   <select name="<?php
        echo $this->get_field_name('shownames'); ?>" id="<?php
        echo $this->get_field_id('shownames'); ?>" >
      <option class="level-0" value="Y" <?php
        if ($instance['shownames'] == "Y") echo " selected='selected'" ?>><?php
        _e('Yes', 'tsp_facepile') ?></option>
      <option class="level-0" value="N" <?php
        if ($instance['shownames'] == "N") echo " selected='selected'" ?>><?php
        _e('No', 'tsp_facepile') ?></option>
   </select>
</p>

<!-- Choose the number of tspf_rows -->
<p>
   <input id="<?php
        echo $this->get_field_id('tspf_rows'); ?>" name="<?php
        echo $this->get_field_name('tspf_rows'); ?>" value="<?php
        echo $instance['tspf_rows']; ?>" style="width:20%;" />
   <label for="<?php
        echo $this->get_field_id('tspf_rows'); ?>"><?php
        _e('Number of Rows', 'tsp_facepile') ?></label>
</p>


<!-- Choose the number of tspf_cols -->
<p>
   <input id="<?php
        echo $this->get_field_id('tspf_cols'); ?>" name="<?php
        echo $this->get_field_name('tspf_cols'); ?>" value="<?php
        echo $instance['tspf_cols']; ?>" style="width:20%;" />
   <label for="<?php
        echo $this->get_field_id('tspf_cols'); ?>"><?php
        _e('Number of Columns', 'tsp_facepile') ?></label>
</p>

<!-- Choose the thumbnail width -->
<p>
   <input id="<?php
        echo $this->get_field_id('widththumb'); ?>" name="<?php
        echo $this->get_field_name('widththumb'); ?>" value="<?php
        echo $instance['widththumb']; ?>" style="width:20%;" />
   <label for="<?php
        echo $this->get_field_id('widththumb'); ?>"><?php
        _e('Thumbnail Width', 'tsp_facepile') ?></label>
</p>

<!-- Choose the thumbnail height -->
<p>
   <input id="<?php
        echo $this->get_field_id('heightthumb'); ?>" name="<?php
        echo $this->get_field_name('heightthumb'); ?>" value="<?php
        echo $instance['heightthumb']; ?>" style="width:20%;" />
   <label for="<?php
        echo $this->get_field_id('heightthumb'); ?>"><?php
        _e('Thumbnail Height', 'tsp_facepile') ?></label>
</p>
   <?php
    }
} //end class TSP_Facepile_Widget
?>
