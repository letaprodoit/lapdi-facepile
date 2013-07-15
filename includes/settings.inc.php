<?php

// Default settings at install
$TSPFCP_DEFAULTS = array(
        'title'         => 'TSP Facepile',
        'shownames'   	=> 'Y',
        'tspfcp_rows'   	=> 4,
        'tspfcp_cols'     => 4,
        'widththumb'    => 80,
        'heightthumb'   => 80,
        'beforetitle'   => '<h3>',
        'aftertitle'    =>  '</h3>');

// These fields for the settings block which is located at the admin setting TSP Featured Posts page
$TSPFCP_ADMIN_FIELDS = array (
		array( 'title', 'TEXT', __( 'Title', 'tsp-facepile' ), __( 'Title', 'tsp-facepile' ) ),
		array( 'shownames', 'SELECT', __( 'Display user names?', 'tsp-facepile' ), __( 'Display user names?', 'tsp-facepile' ) ),
		array( 'tspfcp_rows', 'TEXT', __( 'Number of Rows', 'tsp-facepile' ), __( 'Number of Rows', 'tsp-facepile' ) ),
		array( 'tspfcp_cols', 'TEXT', __( 'Number of Columns', 'tsp-facepile' ), __( 'Number of Columns', 'tsp-facepile' ) ),
		array( 'widththumb','TEXT',  __( 'Thumbnail Width', 'tsp-facepile' ), __( 'Thumbnail Width', 'tsp-facepile' ) ),
		array( 'heightthumb','TEXT',  __( 'Thumbnail Height', 'tsp-facepile' ), __( 'Thumbnail Height', 'tsp-facepile' ) ),
		array( 'beforetitle','TEXT',  __( 'HTML Before Title', 'tsp-facepile' ), __( 'HTML Before Title', 'tsp-facepile' ) ),
		array( 'aftertitle','TEXT',  __( 'HTML After Title', 'tsp-facepile' ), __( 'HTML After Title', 'tsp-facepile') ),
);


if (! function_exists('fn_tsp_plugins_add_menu_render') ){
	function fn_tsp_plugins_add_menu_render()
	{
		global $title;
		$active_plugins = get_option('active_plugins');
		$all_plugins = get_plugins();
	
		$array_activate = array();
		$array_install	= array();
		$array_recomend = array();
		$count_activate = $count_install = $count_recomend = 0;
		$array_plugins	= array(
			array( 'tsp-featured-categories\/tsp-featured-categories.php', 'Featured Categories', 'http://www.thesoftwarepeople.com/software/plugins/wordpress/featured-categories-for-wordpress.html', 'http://www.thesoftwarepeople.com/software/plugins/wordpress/featured-categories-for-wordpress.html', '/wp-admin/plugin-install.php?tab=search&type=term&s=TSP+Featured+Categories&plugin-search-input=Search+Plugins', 'admin.php?page=tsp-featured-categories.php' ), 
			array( 'tsp-featured-posts\/tsp-featured-posts.php', 'Featured Posts', 'http://www.thesoftwarepeople.com/software/plugins/wordpress/featured-posts-for-wordpress.html', 'http://www.thesoftwarepeople.com/software/plugins/wordpress/featured-posts-for-wordpress.html', '/wp-admin/plugin-install.php?tab=search&type=term&s=TSP+Featured+Posts&plugin-search-input=Search+Plugins', 'admin.php?page=tsp-featured-posts.php' ), 
			array( 'tsp-facepile\/tsp-facepile.php', 'Facepile', 'http://www.thesoftwarepeople.com/software/plugins/wordpress/facepile-for-wordpress.html', 'http://www.thesoftwarepeople.com/software/plugins/wordpress/facepile-for-wordpress.html', '/wp-admin/plugin-install.php?tab=search&type=term&s=TSP+Facepile&plugin-search-input=Search+Plugins', 'admin.php?page=tsp-facepile.php' ), 
			array( 'tsp-disable-auto-save\/tsp-disable-auto-save.php', 'Disable Auto-Save', 'http://www.thesoftwarepeople.com/software/plugins/wordpress/disable-autosave-for-wordpress.html', 'http://www.thesoftwarepeople.com/software/plugins/wordpress/disable-autosave-for-wordpress.html', '/wp-admin/plugin-install.php?tab=search&type=term&s=TSP+Disable+Auto+Save&plugin-search-input=Search+Plugins', '#' ), 
		);
		foreach ( $array_plugins as $plugins ) {
			if( 0 < count( preg_grep( "/".$plugins[0]."/", $active_plugins ) ) ) {
				$array_activate[$count_activate]["title"] = $plugins[1];
				$array_activate[$count_activate]["link"] = $plugins[2];
				$array_activate[$count_activate]["href"] = $plugins[3];
				$array_activate[$count_activate]["url"]	= $plugins[5];
				$count_activate++;
			} else if ( array_key_exists(str_replace( "\\", "", $plugins[0]), $all_plugins ) ) {
				$array_install[$count_install]["title"] = $plugins[1];
				$array_install[$count_install]["link"]	= $plugins[2];
				$array_install[$count_install]["href"]	= $plugins[3];
				$count_install++;
			} else {
				$array_recomend[$count_recomend]["title"] = $plugins[1];
				$array_recomend[$count_recomend]["link"] = $plugins[2];
				$array_recomend[$count_recomend]["href"] = $plugins[3];
				$array_recomend[$count_recomend]["slug"] = $plugins[4];
				$count_recomend++;
			}
		}
		$array_activate_pro = array();
		$array_install_pro	= array();
		$array_recomend_pro = array();
		$count_activate_pro = $count_install_pro = $count_recomend_pro = 0;
		$array_plugins_pro	= array(
		);
		foreach ( $array_plugins_pro as $plugins ) {
			if( 0 < count( preg_grep( "/".$plugins[0]."/", $active_plugins ) ) ) {
				$array_activate_pro[$count_activate_pro]["title"] = $plugins[1];
				$array_activate_pro[$count_activate_pro]["link"] = $plugins[2];
				$array_activate_pro[$count_activate_pro]["href"] = $plugins[3];
				$array_activate_pro[$count_activate_pro]["url"]	= $plugins[4];
				$count_activate_pro++;
			} else if( array_key_exists(str_replace( "\\", "", $plugins[0]), $all_plugins ) ) {
				$array_install_pro[$count_install_pro]["title"] = $plugins[1];
				$array_install_pro[$count_install_pro]["link"]	= $plugins[2];
				$array_install_pro[$count_install_pro]["href"]	= $plugins[3];
				$count_install_pro++;
			} else {
				$array_recomend_pro[$count_recomend_pro]["title"] = $plugins[1];
				$array_recomend_pro[$count_recomend_pro]["link"] = $plugins[2];
				$array_recomend_pro[$count_recomend_pro]["href"] = $plugins[3];
				$count_recomend_pro++;
			}
		} ?>
		<div class="wrap">
			<div class="icon32 icon32-tsp" id="icon-options-general"></div>
			<h2><?php echo $title;?></h2>
			<h3 style="color: #B4100E;"><?php _e( 'Professional WordPress Plugins', 'tsp_plugins' ); ?></h3>
				<?php if( 0 < $count_activate_pro ) { ?>
				<div style="padding-left:15px;">
					<h4><?php _e( 'Activated plugins', 'tsp_plugins' ); ?></h4>
					<?php foreach ( $array_activate_pro as $activate_plugin ) { ?>
					<div style="float:left; width:200px;"><?php echo $activate_plugin["title"]; ?></div> <p><a href="<?php echo $activate_plugin["link"]; ?>" target="_blank"><?php echo __( "Read more", 'tsp_plugins' ); ?></a> <a href="<?php echo $activate_plugin["url"]; ?>"><?php echo __( "Settings", 'tsp_plugins' ); ?></a></p>
					<?php } ?>
				</div>
				<?php } ?>
				<?php if( 0 < $count_install_pro ) { ?>
				<div style="padding-left:15px;">
					<h4><?php _e( 'Installed plugins', 'tsp_plugins' ); ?></h4>
					<?php foreach ( $array_install_pro as $install_plugin) { ?>
					<div style="float:left; width:200px;"><?php echo $install_plugin["title"]; ?></div> <p><a href="<?php echo $install_plugin["link"]; ?>" target="_blank"><?php echo __( "Read more", 'tsp_plugins' ); ?></a></p>
					<?php } ?>
				</div>
				<?php } ?>
				<?php if( 0 < $count_recomend_pro ) { ?>
				<div style="padding-left:15px;">
					<h4><?php _e( 'Recommended plugins', 'tsp_plugins' ); ?></h4>
					<?php foreach ( $array_recomend_pro as $recomend_plugin ) { ?>
					<div style="float:left; width:200px;"><?php echo $recomend_plugin["title"]; ?></div> <p><a href="<?php echo $recomend_plugin["link"]; ?>" target="_blank"><?php echo __( "Read more", 'tsp_plugins' ); ?></a> <a href="<?php echo $recomend_plugin["href"]; ?>" target="_blank"><?php echo __( "Purchase", 'tsp_plugins' ); ?></a></p>
					<?php } ?>
				</div>
				<?php } ?>
			<br />
			<h3 style="color: #1A77B1"><?php _e( 'Free WordPress Plugins', 'tsp_plugins' ); ?></h3>
				<?php if( 0 < $count_activate ) { ?>
				<div style="padding-left:15px;">
					<h4><?php _e( 'Activated plugins', 'tsp_plugins' ); ?></h4>
					<?php foreach( $array_activate as $activate_plugin ) { ?>
					<div style="float:left; width:200px;"><?php echo $activate_plugin["title"]; ?></div> <p><a href="<?php echo $activate_plugin["link"]; ?>" target="_blank"><?php echo __( "Read more", 'tsp_plugins' ); ?></a> <a href="<?php echo $activate_plugin["url"]; ?>"><?php echo __( "Settings", 'tsp_plugins' ); ?></a></p>
					<?php } ?>
				</div>
				<?php } ?>
				<?php if( 0 < $count_install ) { ?>
				<div style="padding-left:15px;">
					<h4><?php _e( 'Installed plugins', 'tsp_plugins' ); ?></h4>
					<?php foreach ( $array_install as $install_plugin ) { ?>
					<div style="float:left; width:200px;"><?php echo $install_plugin["title"]; ?></div> <p><a href="<?php echo $install_plugin["link"]; ?>" target="_blank"><?php echo __( "Read more", 'tsp_plugins' ); ?></a></p>
					<?php } ?>
				</div>
				<?php } ?>
				<?php if( 0 < $count_recomend ) { ?>
				<div style="padding-left:15px;">
					<h4><?php _e( 'Recommended plugins', 'tsp_plugins' ); ?></h4>
					<?php foreach ( $array_recomend as $recomend_plugin ) { ?>
					<div style="float:left; width:200px;"><?php echo $recomend_plugin["title"]; ?></div> <p><a href="<?php echo $recomend_plugin["link"]; ?>" target="_blank"><?php echo __( "Read more", 'tsp_plugins' ); ?></a> <a href="<?php echo $recomend_plugin["href"]; ?>" target="_blank"><?php echo __( "Download", 'tsp_plugins' ); ?></a> <a class="install-now" href="<?php echo get_bloginfo( "url" ) . $recomend_plugin["slug"]; ?>" title="<?php esc_attr( sprintf( __( 'Install %s' ), $recomend_plugin["title"] ) ) ?>" target="_blank"><?php echo __( 'Install now from wordpress.org', 'tsp_plugins' ) ?></a></p>
					<?php } ?>
				</div>
				<?php } ?>	
			<br />		
			<span style="color: rgb(136, 136, 136); font-size: 10px;"><?php _e( 'If you have any questions, please contact us via', 'tsp_plugins' ); ?> <a href="http://www.thesoftwarepeople.com/about-us/contact-us.html">http://www.thesoftwarepeople.com/about-us/contact-us.html</a></span>
		</div>
	<?php } 
}

// Function for display captcha settings page in the admin area
function fn_tspfcp_settings_page() {
	global $TSPFCP_ADMIN_FIELDS;
	global $TSPFCP_OPTIONS;

	$error = "";
	
	// Save data for settings page
	if( isset( $_REQUEST['tspfcp_form_submit'] ) && check_admin_referer( plugin_basename(__FILE__), 'tspfcp_nonce_name' ) ) {
		$tspfcp_request_options = array();
		
		foreach( $TSPFCP_OPTIONS as $key => $val ) 
		{
			$tspfcp_request_options[$key] = $_REQUEST[$key];
		}
		
		// array merge incase this version has added new options
		$TSPFCP_OPTIONS = array_merge( $TSPFCP_OPTIONS , $tspfcp_request_options );

		update_option( 'tspfcp_options', $TSPFCP_OPTIONS );
		$message = __( "Options saved.", 'tsp-facepile' );
	}

	// Display form on the setting page
?>
<div class="tsp_container">
	<div class="icon32 tsp_icon" id="tsp_icon-options-general"></div>
	<h2><?php _e('Facepile Shortcode Settings (The Software People)', 'tsp-facepile' ); ?></h2>
	<div class="mycomment">
		<p><h3>Using Facepile Shortcode <a href="#" class="toggle">(hide/show details)</a>:</h3></p>
		<div class="note-details">
			<ul style="list-style-type:square;">
				<li>Changing the default post options below allows you to place <strong>[tsp-facepile]</strong> shortcode tag into any post or page with these options.</li>
				<li>However, if you wish to add different options to the <strong>[tsp-facepile]</strong> shortcode please use the following settings:
					<ul style="padding-left: 30px;">
						<li>Title: <strong>title="Title of Posts"</strong></li>
						<li>Show Names: <strong>shownames="Y"</strong>(Options: Y, N)</li>
						<li>Number of Rows: <strong>tspfcp_rows="4"</strong></li>
						<li>Number of Columns: <strong>tspfcp_cols="4"</strong></li>
						<li>Thumbnail Width: <strong>widththumb="80"</strong></li>
						<li>Thumbnail Height: <strong>heightthumb="80"</strong></li>
						<li>HTML Tag Before Title: <strong>beforetitle="&lt;h3&gt;"</strong></li>
						<li>HTML Tag After Title: <strong>aftertitle="&lt;/h3&gt;"</strong></li>
					</ul>
				</li>
				<li>Insert your desired shortcode into any page or post.</li>
			</ul>
			<hr>
			A shortcode with all the options will look like the following:<br><br>
			<strong>[tsp-facepile title="Facepile" shownames="Y" tspfcp_rows="4" tspfcp_cols="4" widththumb="80" heightthumb="80" beforetitle="" aftertitle=""]</strong>
		</div>
	
	</div>
	<script>
		jQuery("div.tsp_container a.toggle").click(function () {
			jQuery(".note-details").toggle();
		});
	</script>
	<div class="updated fade" <?php if( ! isset( $_REQUEST['tspfcp_form_submit'] ) || $error != "" ) echo "style=\"display:none\""; ?>><p><strong><?php echo $message; ?></strong></p></div>
	<div class="error" <?php if( "" == $error ) echo "style=\"display:none\""; ?>><p><strong><?php echo $error; ?></strong></p></div>
	<form method="post" action="admin.php?page=tsp-facepile.php">
		<fieldset>
		<?php foreach ($TSPFCP_ADMIN_FIELDS as $fields): ?>
			<div class="tsp_form_element" id="<?php echo $fields[0]; ?>_container_div" style="">
				<label for="<?php echo $fields[0]; ?>"><?php echo __( $fields[2], 'tsp-facepile' ); ?></label>
				
				<?php if ($fields[1] == 'TEXT'): ?>
				   <input id="<?php echo $fields[0]; ?>" name="<?php echo $fields[0]; ?>" value="<?php echo $TSPFCP_OPTIONS[$fields[0]]; ?>" />
				<?php elseif ($fields[1] == 'SELECT'): ?>
					<?php if ($fields[0] == 'shownames'): ?>
					   <select name="<?php echo $fields[0]; ?>" id="<?php echo $fields[0]; ?>" >
					      <option class="level-0" value="Y" <?php
					        if ($TSPFP_OPTIONS[$fields[0]] == "Y") echo " selected='selected'" ?>><?php
					        _e('Yes', 'tsp-featured-posts') ?></option>
					      <option class="level-0" value="N" <?php
					        if ($TSPFP_OPTIONS[$fields[0]] == "N") echo " selected='selected'" ?>><?php
					        _e('No', 'tsp-featured-posts') ?></option>
					   </select>
					<?php endif; ?>
				<?php endif; ?>
				
				<div class="clear"></div>
				<div id="error-message-name"></div>
			</div>
		<?php endforeach; ?>
		</fieldset>
		<input type="hidden" name="tspfcp_form_submit" value="submit" />
		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
		</p>
		<?php wp_nonce_field( plugin_basename(__FILE__), 'tspfcp_nonce_name' ); ?>
	</form>
</div><!-- tsp_container -->
<?php } 

// register settings function
function fn_tspfcp_register_settings() {

	global $TSPFCP_DEFAULTS,$TSPFCP_OPTIONS;
			
	// install the option defaults
	if( !get_option( 'tspfcp_options' ) ) 
	{
		add_option( 'tspfcp_options', $TSPFCP_DEFAULTS, '', 'yes' );
	}

	$TSPFCP_OPTIONS = get_option( 'tspfcp_options' );// get options from the database
	
	// array merge incase this version has added new options
	
	if (empty($TSPFCP_OPTIONS))
	{
		$TSPFCP_OPTIONS = $TSPFCP_DEFAULTS;
	}
	else
	{
		$TSPFCP_OPTIONS = array_merge($TSPFCP_DEFAULTS, $TSPFCP_OPTIONS);
	}//endelse
}

function fn_tspfcp_add_admin_menu() 
{
	$parent_slug 	= 'tsp_plugins';
	$child_slug 	= 'tsp-facepile.php';

	if ( !menu_page_url( $parent_slug, false ) )
	{
		add_menu_page( 'TSP Plugins', 'TSP Plugins', 'manage_options', $parent_slug, 'fn_tsp_plugins_add_menu_render', WP_CONTENT_URL."/plugins/tsp-facepile/images/tsp_icon_16.png", 2617638); 
	}//endif
			
	if ( !menu_page_url( $menu_slug, false ) )
	{				
		add_submenu_page($parent_slug, __( 'Facepile', 'tsp-facepile' ), __( 'Facepile', 'tsp-facepile' ), 'manage_options', $child_slug, 'fn_tspfcp_settings_page');
	}//endif
	
	//call register settings function
	add_action( 'admin_init', 'fn_tspfcp_register_settings' );
}

function fn_tspfcp_plugin_init() 
{
	global $wp_version;
	
	if (version_compare($wp_version, TSPFCP_REQUIRED_WP_VERSION, "<"))
	{
		wp_die("<pre>TSP Facepile Plugin requires WordPress version <strong>" . TSPFCP_REQUIRED_WP_VERSION . " or higher</<strong>.<br>You have version <strong>$wp_version</strong> installed.</pre>");
	}//endif
	
	if( is_plugin_active('tsp_facepile/tsp_facepile.php') ) 
	{
		deactivate_plugins( 'tsp_facepile/tsp_facepile.php' );
	}//endif
}

function fn_tspfcp_delete_options() {
}

function fn_tspfcp_admin_head() 
{
	wp_register_script( 'tspfcp_skel_min', plugins_url( 'js/skel.min.js', __FILE__ ) );
	wp_enqueue_script( 'tspfcp_skel_min' );

	wp_register_style( 'tspfcp-admin_stylesheet', plugins_url( 'css/style.css', __FILE__ ) );
	wp_enqueue_style( 'tspfcp-admin_stylesheet' );
}

/*
function fn_tspfcp_plugin_action_links( $links, $file ) 
{
	//Static so we don't call plugin_basename on every plugin row.
	static $this_plugin;
	if ( ! $this_plugin ) $this_plugin = plugin_basename(__FILE__);

	if ( $file == $this_plugin ){
			 $settings_link = '<a href="admin.php?page=tsp-facepile.php">' . __( 'Settings', 'tsp-facepile' ) . '</a>';
			 array_unshift( $links, $settings_link );
	}
	return $links;
} // end function fn_tspfcp_plugin_action_links

// adds "Settings" link to the plugin action page
add_filter( 'plugin_action_links', 'fn_tspfcp_plugin_action_links', 10, 2 );

function fn_tspfcp_register_plugin_links($links, $file) 
{
	$base = plugin_basename(__FILE__);
	if ($file == $base) {
		$links[] = '<a href="admin.php?page=tsp-facepile.php">' . __( 'Settings', 'tsp-facepile' ) . '</a>';
		$links[] = '<a href="http://wordpress.org/extend/plugins/tsp-facepile/faq/" target="_blank">' . __( 'FAQ', 'tsp-facepile' ) . '</a>';
		$links[] = '<a href="http://lab.thesoftwarepeople.com/tracker/wordpress-fcp" target="_blank">' . __( 'Support', 'tsp-facepile' ) . '</a>';
	}
	return $links;
} // end function fn_tspfcp_register_plugin_links

//Additional links on the plugin page
add_filter( 'plugin_row_meta', 'fn_tspfcp_register_plugin_links', 10, 2 );
*/

// Add global setting for Captcha
$TSPFCP_OPTIONS = get_option( 'tspfcp_options' );// get the options from the database

add_action( 'init', 'fn_tspfcp_plugin_init' );
add_action( 'admin_init', 'fn_tspfcp_plugin_init' );
add_action( 'admin_menu', 'fn_tspfcp_add_admin_menu' );
add_action( 'admin_enqueue_scripts', 'fn_tspfcp_admin_head' );

?>