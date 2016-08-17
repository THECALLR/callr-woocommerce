<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://callr.com
 * @since      1.0.0
 *
 * @package    Callr_Woocommerce
 * @subpackage Callr_Woocommerce/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Callr_Woocommerce
 * @subpackage Callr_Woocommerce/public
 * @author     Callr <contact@callr.com>
 */
class Callr_Woocommerce_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_filter('woocommerce_checkout_fields', array($this, 'add_notifications_optin'));
		add_action('woocommerce_checkout_update_order_meta', array($this, 'save_notifications_optin'));

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Callr_Woocommerce_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Callr_Woocommerce_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/callr-woocommerce-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Callr_Woocommerce_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Callr_Woocommerce_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/callr-woocommerce-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Add an optin checkbox to the checkout page.
	 *
	 * @since    1.0.0
	 */
	public function add_notifications_optin($fields) {
		$settings = get_option($this->plugin_name);
		if ($settings) {
			if ($settings['optin-enabled']) {
				$fields['order']['notifications_optin'] = array(
					'type'			=> 'checkbox',
					'class'			=> array('input-checkbox'),
					'id'				=> 'notifications-optin',
					'label'			=> $settings['optin-text'],
					'required'	=> FALSE,
					'default'		=> $settings['optin-checked']
				);
			}
		}
		return $fields;
	}

	/**
	 * Update the order meta with field value.
	 *
	 * @since    1.0.0
	 */
	public function save_notifications_optin($order_id) {
		$optin = (isset($_POST['notifications_optin']) && !empty($_POST['notifications_optin'])) ? 1 : 0;
		update_post_meta($order_id, 'notifications_optin', $optin);
	}

}
