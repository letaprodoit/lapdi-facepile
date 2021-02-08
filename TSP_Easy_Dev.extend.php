<?php				
    /**
     * TSP_Easy_Dev_Options_Facepile - Extends the TSP_Easy_Dev_Options Class
     * @package TSP_Easy_Dev
     * @author sharrondenice, letaprodoit
     * @author Sharron Denice, Let A Pro Do IT!
     * @copyright 2021 Let A Pro Do IT!
     * @license APACHE v2.0 (http://www.apache.org/licenses/LICENSE-2.0)
     * @version $Id: [FILE] [] [DATE] [TIME] [USER] $
     */

    class TSP_Easy_Dev_Options_Facepile extends TSP_Easy_Dev_Options
    {
        /**
         * Implements the settings_page to display settings specific to this plugin
         *
         * @since 1.1.0
         *
         * @param void
         *
         * @return void - output to screen
         *
         * @throws SmartyException
         */
        function display_plugin_options_page()
        {
            $message = "";

            $error = "";

            // get settings from database
            $shortcode_fields = get_option( $this->get_value('shortcode-fields-option-name') );

            $defaults = new TSP_Easy_Dev_Data ( $shortcode_fields, 'shortcode' );

            $form = null;
            if ( array_key_exists( $this->get_value('name') . '_form_submit', $_REQUEST ))
            {
                $form = $_REQUEST[ $this->get_value('name') . '_form_submit'];
            }//endif

            // Save data for settings page
            if( isset( $form ) && check_admin_referer( $this->get_value('name'), $this->get_value('name') . '_nonce_name' ) )
            {
                $defaults->set_values( $_POST );
                $shortcode_fields = $defaults->get();

                update_option( $this->get_value('shortcode-fields-option-name'), $shortcode_fields );

                $message = __( "Options saved.", $this->get_value('name') );
            }

            $form_fields = $defaults->get_values( true );

            // Display settings to screen
            $smarty = new TSP_Easy_Dev_Smarty( $this->get_value('smarty_template_dirs'),
                $this->get_value('smarty_cache_dir'),
                $this->get_value('smarty_compiled_dir'), true );

            global $facepile;

            $smarty->assign( 'plugin_title',			TSPFCP_PLUGIN_TITLE);
            $smarty->assign( 'plugin_links',			implode(' | ', $facepile->get_meta_links()));
            $smarty->assign( 'EASY_DEV_SETTINGS_UI',	$this->get_value('name') . '_child-page-instructions.tpl');

            $smarty->assign( 'form_fields',				$form_fields);
            $smarty->assign( 'message',					$message);
            $smarty->assign( 'error',					$error);
            $smarty->assign( 'form',					$form);
            $smarty->assign( 'plugin_name',				$this->get_value('name'));
            $smarty->assign( 'nonce_name',				wp_nonce_field( $this->get_value('name'), $this->get_value('name').'_nonce_name' ));

            $smarty->display( 'easy-dev-child-page-default.tpl');

        }//end settings_page

    }//end TSP_Easy_Dev_Options_View


    /**
     * TSP_Easy_Dev_Widget_Facepile - Extends the TSP_Easy_Dev_Widget Class
     * @package TSPEasyPlugin
     * @author sharrondenice, letaprodoit
     * @author Sharron Denice, Let A Pro Do IT!
     * @copyright 2021 Let A Pro Do IT!
     * @license APACHE v2.0 (http://www.apache.org/licenses/LICENSE-2.0)
     * @version $Id: [FILE] [] [DATE] [TIME] [USER] $
     */

    /**
     * Extends the TSP_Easy_Dev_Widget_Facepile Class
     *
     * original author: Sharron Denice
     */
    class TSP_Easy_Dev_Widget_Facepile extends TSP_Easy_Dev_Widget
    {
        /**
         * Constructor
         */
        public function __construct()
        {
            add_filter( get_class()  .'-init', array($this, 'init'), 10, 1 );
        }//end __construct

        /**
         * Function added to filter to allow initialization of widget
         *
         * @since 1.1.0
         *
         * @param object $options Required - pass in reference to options class
         *
         * @return void
         */
        public function init( $options )
        {
            // Create the widget
            parent::__construct( $options );
        }//end init

        /**
         * Override required of form function to display widget information
         *
         * @since 1.1.0
         *
         * @param array $fields Required - array of current values
         *
         * @return void - display to widget box
         *
         * @throws SmartyException
         */
        public function display_form( $fields )
        {
            $smarty = new TSP_Easy_Dev_Smarty( $this->options->get_value('smarty_template_dirs'),
                $this->options->get_value('smarty_cache_dir'),
                $this->options->get_value('smarty_compiled_dir'), true );

            $smarty->assign( 'shortcode_fields', $fields );
            $smarty->assign( 'class', 'widefat' );
            $smarty->display( 'easy-dev-shortcode-form.tpl' );
        }//end form

        /**
         * Implementation (required) to print widget & shortcode information to screen
         *
         * @since 1.1.0
         *
         * @param array $fields  - the settings to display
         * @param boolean $echo Optional - if false returns output instead of displaying to screen
         * @param string $tag Optional - the name of the shortcode being processed
         *
         * @return string $output if echo is true displays to screen else returns string
         *
         * @throws SmartyException
         */
        public function display_widget( $fields, $echo = true, $tag = null )
        {
            extract ( $fields );

            $return_HTML = "";

            // If there is a title insert before/after title tags
            if (!empty($fields['title'])) {
                $return_HTML .= $fields['before_title'] . $fields['title'] . $fields['after_title'];
            }

            global $wpdb;

            // Query all subscribers
            $user_count = $fields['num_rows'] * $fields['num_cols'];

            // Display subscribers only
            $total_users = $wpdb->get_var("SELECT COUNT($wpdb->users.ID) FROM $wpdb->users INNER JOIN $wpdb->usermeta ON $wpdb->users.ID = $wpdb->usermeta.user_id WHERE $wpdb->usermeta.meta_key = 'wp_user_level' AND $wpdb->usermeta.meta_value = '0'");

            $query = "SELECT $wpdb->users.ID FROM $wpdb->users INNER JOIN $wpdb->usermeta ON $wpdb->users.ID = $wpdb->usermeta.user_id WHERE $wpdb->usermeta.meta_key = 'wp_user_level' AND $wpdb->usermeta.meta_value = '0' ORDER BY RAND() LIMIT 0, $user_count";
            $users = $wpdb->get_results($query);

            $entry_cnt = 0;
            $num_entries = $user_count;

            if (!empty($users))
            {
                $smarty = new TSP_Easy_Dev_Smarty( $this->options->get_value('smarty_template_dirs'),
                    $this->options->get_value('smarty_cache_dir'),
                    $this->options->get_value('smarty_compiled_dir'), true );

                // Store values into Smarty
                foreach ($fields as $key => $val)
                {
                    $smarty->assign($key, $val, true);
                }//end foreach

                for ($i=0; $i < $fields['num_rows']; $i++)
                {
                    $start_row = true;
                    $end_row = false;

                    for ($j=0; $j < $fields['num_cols']; $j++)
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
                        $user_index = ($i * $fields['num_cols']) + $j;

                        // If we are done processing users then break
                        if($user_index >= $user_count)
                        {
                            break;
                        }//endif
                        // If we are on the last row display the ending tr tag
                        elseif ($user_index == ($user_count - 1))
                        {
                            $end_row = true;
                        }//endelseif

                        $email = "";
                        $name = "";

                        if ( array_key_exists( $user_index, $users ))
                        {
                            $user = $users[$user_index]; // current user
                            $curauth = get_userdata($user->ID); //user data

                            if ($fields['show_names'] == 'Y')
                                $name = $curauth->display_name;

                            $email = $curauth->user_email;
                        }//end if

                        $gravatar_type = get_option('wpu_gravatar_type');
                        $display_gravatar = get_avatar($email, $fields['thumb_size'], $gravatar_type, $name); //get avatar

                        $smarty->assign("key", $this->options->get_value('key'), true);
                        $smarty->assign("start_row", $start_row, true);
                        $smarty->assign("end_row", $end_row, true);
                        $smarty->assign("total_users", $total_users, true);
                        $smarty->assign("display_gravatar", $display_gravatar, true);

                        $return_HTML .= $smarty->fetch( $this->options->get_value('name') . '_widget.tpl');

                        $start_row = false;

                    }//endfor
                }//endfor

            }// end if

            if ($echo)
                echo $return_HTML;

            return $return_HTML;
        }//end display
    }//end TSP_Easy_Dev_Widget_Facepile