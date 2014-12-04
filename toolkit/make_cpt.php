<?php 

/**
 * A class for creating custom post types
 *
 * @package   Slushman Toolkit
 * @version   8-12-2014
 * @since     8-12-2014
 * @author    Slushman <chris@slushman.com>
 * @copyright Copyright (c) 2014, Slushman
 * @link      http://slushman.com/plugins/slushman-toolkit
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) { die; }

require_once( plugin_dir_path( __FILE__ ) . '../toolkit/slushman_toolkit.php' );

if ( !class_exists( 'Slushman_Make_Custom_Post_Type' ) ) {

	class Slushman_Make_Custom_Post_Type {

/**
 * The capacity type
 *
 * @access 	private
 * @since 	0.1
 * @var 	string
 */
		private $cap_type = '';

/**
 * Arguments for the custom post type
 *
 * @access 	private
 * @since 	0.1
 * @var 	array
 */
		private $args = array();

/**
 * The internationalization domain
 *
 * @access 	private
 * @since 	0.1
 * @var 	string
 */
		private $i18n = '';

/**
 * The name of this CPT
 *
 * @access 	private
 * @since 	0.1
 * @var 	string
 */
		private $post_type = '';

/**
 * The plural version of a CPT item
 *
 * @access 	private
 * @since 	0.1
 * @var 	string
 */
		private $plural = '';

/**
 * The singular version of a CPT item
 *
 * @access 	private
 * @since 	0.1
 * @var 	string
 */
		private $single = '';

/**
 * Taxonomies related to this CPT
 *
 * @access 	private
 * @since 	0.1
 * @var 	array
 */
		private $taxes = array();	

/**
 * Class constructor, define in extension
 * 
 * @access 	public
 * @since 	0.1
 *
 * @return 	void
 */
		public function __construct() {

			// Define in extension
			
		} // End of __construct()

/**
 * Add all the actions and filters to the WordPress actions
 *
 * @uses 	add_action()
 * 
 * @return 	void
 */
		protected function add_actions() {

			add_action( 'init', array( $this, 'create_cpt' ) );

		} // End of add_actions()

/**
 * Registers a new custom post type
 *
 * @link 	http://codex.wordpress.org/Function_Reference/register_post_type
 * @access 	public
 * @since 	0.1
 * 
 * @param 	An array of parameters for constructing a custom post type
 *
 * @uses 	register_post_type()
 *
 * @return 	void
 */
		public function create_cpt() {

			register_post_type( $this->post_type, $this->args );

		} // End of create_cpt()

/**
 * Runs all the set functions
 *
 * @access 	protected
 * @since  	0.1
 *
 * @uses 	set_args()
 * @uses 	set_boxes()
 * @uses 	set_help()
 * @uses 	set_taxes()
 * 
 * @return 	void
 */
		protected function setup( $reqs, $args = array() ) {

			foreach ( $reqs as $key => $value ) {

				$this->set_class_var( $key, $value, 'required' );

			}

			$this->set_args( $args );
			$this->add_actions();

		} // End of setup()



/* ==========================================================================
   Check Methods
   ========================================================================== */	

/**
 * [check_value description]
 * @param  [type] $value  [description]
 * @param  [type] $method [description]
 * @return [type]         [description]
 */
	   	protected function check_value( $value, $method ) {

	   		$check = '';

	   		if ( empty( $value ) ) {

				$check = new WP_Error( "forgot_value", __( "Add the value to the {$method} call.", $this->i18n ) );

			}

			if ( is_wp_error( $check ) ) {

				wp_die( $check->get_error_message(), __( 'Forgot value', $this->i18n ) );

			}

	   	} // End of check_value()	


/* ==========================================================================
   Get Methods
   ========================================================================== */

/**
 * Returns my default custom post type settings
 *
 * @access 	private
 * @since 	0.1
 *
 * @param  	string 		$cap_type 		The capability type for working with this CPT, default: post
 * 
 * @return 	array 		An array of custom post type defaults
 */
		protected function get_defaults( $cap_type = 'post' ) {

			$opts['can_export']								= TRUE;
			$opts['capability_type']						= $cap_type;
			$opts['description']							= '';
			$opts['exclude_from_search']					= FALSE;
			$opts['has_archive']							= FALSE;
			$opts['hierarchical']							= FALSE;
			$opts['map_meta_cap']							= TRUE;
			$opts['menu_icon']								= '';
			$opts['menu_position']							= 25;
			$opts['public']									= TRUE;
			$opts['publicly_querable']						= TRUE;
			$opts['query_var']								= TRUE;
			$opts['register_meta_box_cb']					= '';
			$opts['rewrite']								= FALSE;
			$opts['show_in_admin_bar']						= TRUE;
			$opts['show_in_menu']							= TRUE;
			$opts['show_in_nav_menu']						= TRUE;
			$opts['show_ui']								= TRUE;
			$opts['supports']								= array( 'title', 'editor', 'thumbnail' );
			$opts['taxonomies']								= array();

			$opts['capabilities']['delete_others_posts']	= "delete_others_{$cap_type}s";
			$opts['capabilities']['delete_post']			= "delete_{$cap_type}";
			$opts['capabilities']['delete_posts']			= "delete_{$cap_type}s";
			$opts['capabilities']['delete_private_posts']	= "delete_private_{$cap_type}s";
			$opts['capabilities']['delete_published_posts']	= "delete_published_{$cap_type}s";
			$opts['capabilities']['edit_others_posts']		= "edit_others_{$cap_type}s";
			$opts['capabilities']['edit_post']				= "edit_{$cap_type}";
			$opts['capabilities']['edit_posts']				= "edit_{$cap_type}s";
			$opts['capabilities']['edit_private_posts']		= "edit_private_{$cap_type}s";
			$opts['capabilities']['edit_published_posts']	= "edit_published_{$cap_type}s";
			$opts['capabilities']['publish_posts']			= "publish_{$cap_type}s";
			$opts['capabilities']['read_post']				= "read_{$cap_type}";
			$opts['capabilities']['read_private_posts']		= "read_private_{$cap_type}s";

			$opts['labels']['add_new']						= __( "Add New {$this->single}", $this->i18n );
			$opts['labels']['add_new_item']					= __( "Add New {$this->single}", $this->i18n );
			$opts['labels']['all_items']					= __( $this->plural, $this->i18n );
			$opts['labels']['edit_item']					= __( "Edit {$this->single}" , $this->i18n);
			$opts['labels']['menu_name']					= __( $this->plural, $this->i18n );
			$opts['labels']['name']							= __( $this->plural, $this->i18n );
			$opts['labels']['name_admin_bar']				= __( $this->single, $this->i18n );
			$opts['labels']['new_item']						= __( "New {$this->single}", $this->i18n );
			$opts['labels']['not_found']					= __( "No {$this->plural} Found", $this->i18n );
			$opts['labels']['not_found_in_trash']			= __( "No {$this->plural} Found in Trash", $this->i18n );
			$opts['labels']['parent_item_colon']			= __( "Parent {$this->plural} :", $this->i18n );
			$opts['labels']['search_items']					= __( "Search {$this->plural}", $this->i18n );
			$opts['labels']['singular_name']				= __( $this->single, $this->i18n );
			$opts['labels']['view_item']					= __( "View {$this->single}", $this->i18n );

			$opts['rewrite']['ep_mask']						= EP_PERMALINK;
			$opts['rewrite']['feeds']						= FALSE;
			$opts['rewrite']['pages']						= TRUE;
			$opts['rewrite']['slug']						= __( strtolower( $this->plural ), $this->i18n );
			$opts['rewrite']['with_front']					= FALSE;

			return $opts;

		} // End of get_defaults()



/* ==========================================================================
   Set Methods
   ========================================================================== */   

/**
 * Sets the args class variable
 *
 * @access 	protected
 * @since 	8-12-2014
 * 
 * @param 	string 		$args 		
 *
 * @return 	void
 */
   	protected function set_args( $args ) {

   		$toolkit	= new Slushman_Toolkit();
		$this->args	= $toolkit->parse_args_recursive( $args, $this->get_defaults() );

   	} // End of set_plural()

/**
 * Sets the args class variable
 *
 * @access 	protected
 * @since 	0.1
 * 
 * @param 	string  	$var_name  		The name of the class variable
 * @param 	mixed  		$value  		The potential value for the class variable
 * @param 	string  	$priority  		Is this class variable required or not?
 *
 * @return 	void
 */
		protected function set_class_var( $var_name, $value, $priority = 'default' ) {

			if ( 'required' == $priority ) {

				$this->check_value( $value, __METHOD__ );

			} else {

				if ( empty( $value ) ) { return; }

			} // End of priority check

			$this->{$var_name} = $value;

		} // End of set_class_var()  	



/* ==========================================================================
   Injection Containers

   These remove any dependency and coupling of the public functions from the
   other classes needed by this class.
   ========================================================================== */




	} // End of class

} // End of class check

?>