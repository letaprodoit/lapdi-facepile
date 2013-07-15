<?php				

//--------------------------------------------------------
// Classes
//--------------------------------------------------------
/**
 * TSP_Easy_Plugin_Settings_Facepile - Extends the TSP_Plugin_Settings Class
 * @package TSP_Easy_Plugin
 * @author sharrondenice, thesoftwarepeople
 * @author Sharron Denice, The Software People
 * @copyright 2013 The Software People
 * @license APACHE v2.0 (http://www.apache.org/licenses/LICENSE-2.0)
 * @version $Id: [FILE] [] [DATE] [TIME] [USER] $
 */

/**
 * Extends the TSP_Easy_Plugin_Settings_Facepile Class
 *
 * original author: Sharron Denice
 */
class TSP_Easy_Plugin_Settings_Facepile extends TSP_Easy_Plugin_Settings
{
	/**
	 * Display all the plugins that The Software People has released
	 *
	 * @since 1.0.0
	 *
	 * @param none
	 *
	 * @return output to stdout - TODO: This needs to use Smarty, hopefully WordPress makes it standard soon
	 */
	public function display_parent_page()
	{
		$active_plugins		= get_option('active_plugins');
		$all_plugins 		= get_plugins();
	
		$store_url 			= $this->plugin_globals['store_url'];
		$wp_query 			= $this->plugin_globals['wp_query'];
		$contact_url 		= $this->plugin_globals['contact_url'];
		
		$blog_url			= get_bloginfo( "url" );
		
		$title 				= $this->plugin_globals['parent_title'];

		$array_activate 	= array();
		$array_install		= array();
		$array_recomend 	= array();
		$count_activate 	= $count_install = $count_recomend = 0;
		$array_plugins	= array(
			array( 'tsp-easy-plugin\/tsp-easy-plugin.php', 					'Easy Plugin', 			"$store_url/easy-plugin-for-wordpress.html#description",		"$store_url/easy-plugin-for-wordpress.html",		"$wp_query=TSP+Easy+Plugin",		'#' ), 
			array( 'tsp-featured-categories\/tsp-featured-categories.php', 	'Featured Categories', 	"$store_url/featured-categories-for-wordpress.html#description","$store_url/featured-categories-for-wordpress.html","$wp_query=TSP+Featured+Categories",'admin.php?page=tsp-featured-categories.php' ), 
			array( 'tsp-featured-posts\/tsp-featured-posts.php', 			'Featured Posts', 		"$store_url/featured-posts-for-wordpress.html#description", 	"$store_url/featured-posts-for-wordpress.html", 	"$wp_query=TSP+Featured+Posts", 	'admin.php?page=tsp-featured-posts.php' ), 
			array( 'tsp-facepile\/tsp-facepile.php', 						'Facepile', 			"$store_url/facepile-for-wordpress.html#description", 			"$store_url/facepile-for-wordpress.html", 			"$wp_query=TSP+Facepile", 			'admin.php?page=tsp-facepile.php' ), 
			array( 'tsp-disable-auto-save\/tsp-disable-auto-save.php', 		'Disable Auto-Save', 	"$store_url/disable-autosave-for-wordpress.html#description", 	"$store_url/disable-autosave-for-wordpress.html",	"$wp_query=TSP+Disable+Auto+Save", 	'#' ), 
		);
		
		foreach ( $array_plugins as $plugins ) 
		{
			if( 0 < count( preg_grep( "/".$plugins[0]."/", $active_plugins ) ) ) 
			{
				$array_activate[$count_activate]["title"] 	= $plugins[1];
				$array_activate[$count_activate]["link"] 	= $plugins[2];
				$array_activate[$count_activate]["href"]	= $plugins[3];
				$array_activate[$count_activate]["url"]		= $plugins[5];
				$count_activate++;
			} //endif
			elseif ( array_key_exists(str_replace( "\\", "", $plugins[0]), $all_plugins ) ) 
			{
				$array_install[$count_install]["title"] 	= $plugins[1];
				$array_install[$count_install]["link"]		= $plugins[2];
				$array_install[$count_install]["href"]		= $plugins[3];
				$count_install++;
			}//endelseif 
			else 
			{
				$array_recomend[$count_recomend]["title"] 	= $plugins[1];
				$array_recomend[$count_recomend]["link"] 	= $plugins[2];
				$array_recomend[$count_recomend]["href"] 	= $plugins[3];
				$array_recomend[$count_recomend]["slug"] 	= $plugins[4];
				$count_recomend++;
			}//endelse
		}//endforeach
		
		$array_activate_pro = array();
		$array_install_pro	= array();
		$array_recomend_pro = array();
		$count_activate_pro = $count_install_pro = $count_recomend_pro = 0;
		$array_plugins_pro	= array(
			array( 'tsp-easy-plugin-pro\/tsp-easy-plugin-pro.php', 			'Easy Plugin (Pro)', 	"$store_url/easy-plugin-for-wordpress.html#description",	"$store_url/easy-plugin-for-wordpress.html",		"$store_url/easy-plugin-for-wordpress.html",		'#' ), 
		);
		
		foreach ( $array_plugins_pro as $plugins ) 
		{
			if( 0 < count( preg_grep( "/".$plugins[0]."/", $active_plugins ) ) ) 
			{
				$array_activate_pro[$count_activate_pro]["title"] 	= $plugins[1];
				$array_activate_pro[$count_activate_pro]["link"] 	= $plugins[2];
				$array_activate_pro[$count_activate_pro]["href"] 	= $plugins[3];
				$array_activate_pro[$count_activate_pro]["url"]		= $plugins[4];
				$count_activate_pro++;
			} 
			else if( array_key_exists(str_replace( "\\", "", $plugins[0]), $all_plugins ) ) 
			{
				$array_install_pro[$count_install_pro]["title"] 	= $plugins[1];
				$array_install_pro[$count_install_pro]["link"]		= $plugins[2];
				$array_install_pro[$count_install_pro]["href"]		= $plugins[3];
				$count_install_pro++;
			} 
			else 
			{
				$array_recomend_pro[$count_recomend_pro]["title"] 	= $plugins[1];
				$array_recomend_pro[$count_recomend_pro]["link"] 	= $plugins[2];
				$array_recomend_pro[$count_recomend_pro]["href"] 	= $plugins[3];
				$count_recomend_pro++;
			}
		}//endforeach
		
		// Display settings to screen
		$smarty = new Smarty();
		$smarty->setTemplateDir( $this->plugin_globals['templates'] );
		$smarty->setCompileDir( $this->plugin_globals['smarty_compiled'] );
		$smarty->setCacheDir( $this->plugin_globals['smarty_cache'] );
		
		$smarty->assign( 'count_activate_pro',		$count_activate_pro);
		$smarty->assign( 'array_activate_pro',		$array_activate_pro);
		$smarty->assign( 'count_install_pro',		$count_install_pro);
		$smarty->assign( 'array_install_pro',		$array_install_pro);
		$smarty->assign( 'count_recomend_pro',		$count_recomend_pro);
		$smarty->assign( 'array_recomend_pro',		$array_recomend_pro);
		$smarty->assign( 'count_activate',			$count_activate);
		$smarty->assign( 'array_activate',			$array_activate);
		$smarty->assign( 'count_recomend',			$count_recomend);
		$smarty->assign( 'array_recomend',			$array_recomend);

		$smarty->assign( 'title',					$title);
		$smarty->assign( 'contact_url',				$contact_url);

		
		$smarty->display( $this->plugin_globals['name'] . '_admin_menu.tpl');
	}//end ad_menu
	
	/**
	 * Implements the settings_page to display settings specific to this plugin
	 *
	 * @since 1.0.0
	 *
	 * @param none
	 *
	 * @return output to screen
	 */
	function display_plugin_settings_page() 
	{
		$message = "";
		
		$error = "";
		
		// get settings from database
		$defaults = new TSP_Easy_Plugin_Globals ( get_option( $this->plugin_globals['option'] ) );
		
		$form = $_REQUEST[ $this->plugin_globals['TextDomain'] . '_form_submit'];
		
		// Save data for settings page
		if( isset( $form ) && check_admin_referer( $this->plugin_globals['name'], $this->plugin_globals['TextDomain'] . '_nonce_name' ) ) {
			
			$defaults->set_settings_values( $_REQUEST );
			
			update_option( $this->plugin_globals['option'], $defaults->get() );
			
			$message = __( "Options saved.", $this->plugin_globals['name'] );
		}
		
		$settings = $defaults->get_settings_values( true );

		// Display settings to screen
		$smarty = new Smarty();
		$smarty->setTemplateDir( array( $this->plugin_globals['templates'], $this->plugin_globals['easy_templates'] ) );
		$smarty->setCompileDir( $this->plugin_globals['smarty_compiled'] );
		$smarty->setCacheDir( $this->plugin_globals['smarty_cache'] );
		
		$smarty->assign( 'EASY_PLUGIN_FORM_FIELDS',	'easy-plugin-field.tpl' );
		
		$smarty->assign( 'settings',				$settings);
		$smarty->assign( 'message',					$message);
		$smarty->assign( 'error',					$error);
		$smarty->assign( 'form',					$form);
		$smarty->assign( 'plugin_name',				$this->plugin_globals['name']);
		$smarty->assign( 'plugin_key',				$this->plugin_globals['TextDomain']);
		$smarty->assign( 'nonce_name',				wp_nonce_field( $this->plugin_globals['name'], $this->plugin_globals['TextDomain'].'_nonce_name' ));
		
		$smarty->display( $this->plugin_globals['name'] . '_shortcode_settings.tpl');
				
	}//end settings_page
	
}//end TSP_Easy_Plugin_Settings_View


/**
 * TSP_Easy_Plugin_Widget_Facepile - Extends the TSP_Easy_Plugin_Widget Class
 * @package TSPEasyPlugin
 * @author sharrondenice, thesoftwarepeople
 * @author Sharron Denice, The Software People
 * @copyright 2013 The Software People
 * @license APACHE v2.0 (http://www.apache.org/licenses/LICENSE-2.0)
 * @version $Id: [FILE] [] [DATE] [TIME] [USER] $
 */

/**
 * Extends the TSP_Easy_Plugin_Widget_Facepile Class
 *
 * original author: Sharron Denice
 */
class TSP_Easy_Plugin_Widget_Facepile extends TSP_Easy_Plugin_Widget
{
	/**
	 * PHP4 constructor
	 */
	public function TSP_Easy_Plugin_Widget_Facepile() 
	{
		TSP_Easy_Plugin_Widget_Facepile::__construct();
	}//end TSP_Plugin_Widget

	/**
	 * PHP5 constructor
	 */
	public function __construct() 
	{
		// TODO: figure out a way to set globals without doing it directly
		$this->plugin_globals 		= fn_tsp_facepile_get_globals();
		
        // Get widget options
        $widget_options  = array(
            'classname'  			=> 'widget-'.$this->plugin_globals['name'],
            'description'   		=> __( $this->plugin_globals['Description'], $this->plugin_globals['name'] )
        );
        
        // Get control options
        $control_options = array(
            'width' 				=> $this->plugin_globals['widget_width'],
            'height'				=> $this->plugin_globals['widget_height'],
            'id_base' 				=> 'widget-'.$this->plugin_globals['name'],
        );

        // Create the widget
		parent::__construct( $this->plugin_globals, $this->plugin_globals['name'], 'widget-'.$this->plugin_globals['name'], __( $this->plugin_globals['title'], $this->plugin_globals['name'] ) , $widget_options, $control_options);
	}//end __construct

	
	/**
	 * Override required of form function to display widget information
	 *
	 * @since 1.0.0
	 *
	 * @param array $instance Required - array of current values
	 *
	 * @return display to widget box
	 */
	public function form( $instance )
	{
        parent::form( $instance );
		
		$settings = $this->plugin_globals['settings'];
		
		// since there are multiple widgets on a page it is important
		// to make sure the id and name are unique to this particular
		// instance of the plugin so override the id and name
		$settings[$key]['id'] 			= $this->get_field_id($key);
		$settings[$key]['name'] 		= $this->get_field_name($key);

		$smarty = new Smarty();
		$smarty->setTemplateDir( $this->plugin_data['templates'] );
		$smarty->setCompileDir( $this->plugin_globals['smarty_compiled'] );
		$smarty->setCacheDir( $this->plugin_globals['smarty_cache'] );
		
		$smarty->assign( 'EASY_PLUGIN_FORM_FIELDS',	$this->plugin_globals['easy_templates'] . 'easy-plugin-field.tpl' );
		
    	$smarty->assign('settings',					$settings);
		
		$smarty->display( $this->plugin_globals['name'] . '_widget.tpl');
	}//end form

	/**
	 * Implementation required to process short codes for the widget
	 *
	 * @since 1.0.0
	 *
	 * @param string $tag Required - the tag of the shortcode
	 *
	 * @return string $output Required - return the output generated by the shortcode
	 */
	public function process_shortcode()
	{
		if ( is_feed() )
			return '[' . $this->plugin_globals['name'] . ']';
	
		$defaults = new TSP_Easy_Plugin_Globals ( get_option( $this->plugin_globals['option'] ) );
		$defaults->set_settings_values( $args );
		
		$options = $defaults->get_settings_values();
			
		$output = $this->display( $options, false );
		
		return $output;
	}//end process_shortcode
	
	/**
	 * Implementation (required) to print widget & shortcode information to screen
	 *
	 * @since 1.0.0
	 *
	 * @param array $options Optional - the settings to display (will display defaults if empty)
	 * @param boolean $echo Optional - if false returns output instead of displaying to screen
	 *
	 * @return string $output if echo is true displays to screen else returns string
	 */
	public function display( $options = null, $echo = true )
	{
		$return_HTML = "";
	
		$defaults = new TSP_Easy_Plugin_Globals ( get_option( $this->plugin_globals['option'] ) );
		$defaults->set_settings_values( $options );
		
		$options = $defaults->get_settings_values();
	    
	    extract ( $options );
	    
	    // If there is a title insert before/after title tags
	    if (!empty($title)) {
	        $return_HTML .= $beforetitle . $title . $aftertitle;
	    }
	    
	    global $wpdb;
	    
	    // Query all subscribers
		$user_count = $num_rows * $num_cols;
		
		// Display subscribers only  
		$total_users = $wpdb->get_var("SELECT COUNT($wpdb->users.ID) FROM $wpdb->users INNER JOIN $wpdb->usermeta ON $wpdb->users.ID = $wpdb->usermeta.user_id WHERE $wpdb->usermeta.meta_key = 'wp_user_level' AND $wpdb->usermeta.meta_value = '0'");
		
		$query = "SELECT $wpdb->users.ID FROM $wpdb->users INNER JOIN $wpdb->usermeta ON $wpdb->users.ID = $wpdb->usermeta.user_id WHERE $wpdb->usermeta.meta_key = 'wp_user_level' AND $wpdb->usermeta.meta_value = '0' ORDER BY RAND() LIMIT 0, $user_count";
		$users = $wpdb->get_results($query);
		
		$entry_cnt = 0;
		$num_entries = $user_count;
	
		if (!empty($users))
		{
			$smarty = new Smarty;
			$smarty->setTemplateDir( $this->plugin_data['templates'] );
			$smarty->setCompileDir( $this->plugin_globals['smarty_compiled'] );
			$smarty->setCacheDir( $this->plugin_globals['smarty_cache'] );

			$smarty->assign( 'EASY_PLUGIN_FORM_FIELDS',	$this->plugin_globals['easy_templates'] . 'easy-plugin-field.tpl' );

		    // Store values into Smarty
		    foreach ($options as $key => $val)
		    {
		    	$smarty->assign($key, $val, true);
	   		}//end foreach
	
	       	for ($i=0; $i < $num_rows; $i++) 
	       	{ 
				$start_row = true;
				$end_row = false;
				
				for ($j=0; $j < $num_cols; $j++) 
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
					$user_index = ($i * $num_cols['value']) + $j;
					
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
					
					$return_HTML .= $smarty->fetch( $this->plugin_globals['name'] . '.tpl');
					
					$start_row = false;
	
				}//endfor
			}//endfor
	
		}// end if
		
		if ($echo)
			echo $return_HTML;
		else
			return $return_HTML;
	}//end display
}//end TSP_Easy_Plugin_Widget_Facepile

// Initialize widget - Required by WordPress
add_action('widgets_init', function () { 
	register_widget ( 'TSP_Easy_Plugin_Widget_Facepile' ); 
});
?>