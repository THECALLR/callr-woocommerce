<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://callr.com
 * @since      1.0.0
 *
 * @package    Callr_WooCommerce
 * @subpackage Callr_WooCommerce/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Callr_WooCommerce
 * @subpackage Callr_WooCommerce/admin
 * @author     Callr <contact@callr.com>
 */
class Callr_Woocommerce_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name . '-tipr', plugin_dir_url( __FILE__ ) . 'css/tipr.css', array(), $this->version, 'all' );

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/callr-woocommerce-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name . '-tipr', plugin_dir_url( __FILE__ ) . 'js/tipr.min.js', array( 'jquery' ), $this->version, false );

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/callr-woocommerce-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
 	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
 	 *
 	 * @since    1.0.0
 	 */
 	public function add_plugin_admin_menu() {
    /*
     * Add a settings page for this plugin to the Settings menu.
     *
     * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
     *
     *        Administration Menus: http://codex.wordpress.org/Administration_Menus
     *
     */
    add_options_page( 'SMS notifications setup', 'SMS notifications', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page')
    );
}

	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
 	public function add_action_links( $links ) {
    /*
    *  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
    */
   $settings_link = array(
    '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
   );
   return array_merge(  $settings_link, $links );
	}

	/**
 	 * Render the settings page for this plugin.
 	 *
 	 * @since    1.0.0
 	 */
 	public function display_plugin_setup_page() {
		include_once( 'partials/callr-woocommerce-admin-display.php' );
	}

	/**
 	 * Save or update the settings.
 	 *
 	 * @since    1.0.0
 	 */
	public function options_update() {
		register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
	}

	/**
 	 * Validate the settings.
 	 *
 	 * @since    1.0.0
 	 */
	public function validate($input) {
		$expected = array(
			'admin-notification' => 'checkbox',
			'admin-phone' => 'number',
			'admin-message' => 'string',
			'optin-enabled' => 'checkbox',
			'optin-checked' => 'checkbox',
			'optin-text' => 'string',
			'customer-notification-pending' => 'checkbox',
			'customer-notification-on-hold' => 'checkbox',
			'customer-notification-processing' => 'checkbox',
			'customer-notification-completed' => 'checkbox',
			'customer-notification-cancelled' => 'checkbox',
			'customer-notification-refunded' => 'checkbox',
			'customer-notification-failed' => 'checkbox',
			'customer-message' => 'string',
			'customer-message-pending' => 'string',
			'customer-message-on-hold' => 'string',
			'customer-message-processing' => 'string',
			'customer-message-completed' => 'string',
			'customer-message-cancelled' => 'string',
			'customer-message-refunded' => 'string',
			'customer-message-failed' => 'string',
			'callr-username' => 'string',
			'callr-password' => 'string',
			'callr-sender' => 'sender',
			'callr-debug' => 'checkbox'
		);
		$output = array();
		foreach ($expected as $key => $type) {
			switch ($type) {
				case 'checkbox':
					$output[$key] = (isset($input[$key]) && !empty($input[$key])) ? 1 : 0;
					break;
				case 'number':
					$output[$key] = array();
					if ($output['admin-notification'] == 1) {
						if (is_array($input[$key])) {
							$numbers = $input[$key];
						} else {
							$numbers = explode(',', $input[$key]);
						}
						foreach ($numbers as $number) {
							$number = trim($number);
							if (preg_match('/^\+[1-9][0-9]{5,14}$/', $number)) {
								$output[$key][] = $number;
							} else {
								add_settings_error($key, $key . '-error', __('Invalid phone number.'), 'error');
							}
						}
					}
					break;
				case 'sender':
					if (preg_match('/^[ a-zA-Z0-9_-]+$/', $input[$key])) {
						$output[$key] = $input[$key];
					} else {
						$output[$key] = '';
						if ($input[$key] != '') add_settings_error($key, $key . '-error', __('Invalid sender ID.'), 'error');
					}
					break;
				case 'string':
					$output[$key] = sanitize_text_field($input[$key]);
					break;
			}
		}
		if ($output['callr-username'] == '' || $output['callr-password'] == '') {
			add_settings_error('callr-credentials', 'callr-credentials-warning', __('Don\'t forget to set your Callr credentials!'), 'notice-warning');
		}
		return $output;
	}

	/**
 	 * Send a customer notification.
 	 *
 	 * @since    1.0.0
 	 */
	public function send_customer_notification($order_id) {
		if (get_post_meta($order_id, 'notifications_optin', TRUE) == 1) {
			$settings = get_option($this->plugin_name);
			if ($settings) {
				$order = wc_get_order($order_id);
				$status = $order->get_status();
				if ($settings['customer-notification-'.$status] == 1) {
					$message = FALSE;
					if ($settings['customer-message-'.$status] != '') {
						$message = $settings['customer-message-'.$status];
					} elseif ($settings['customer-message'] != '') {
						$message = $settings['customer-message'];
					}
					if ($message) {
						$message = $this->token_replace($message, $order);
						$phoneformat = \libphonenumber\PhoneNumberUtil::getInstance();
						try {
	    				$proto = $phoneformat->parse($order->billing_phone, $order->billing_country);
	    				$e164 = $phoneformat->format($proto, \libphonenumber\PhoneNumberFormat::E164);
						} catch (Exception $e) {
							if ($settings['callr-debug']) error_log('Invalid phone number: ' . $order->billing_phone . ' (' . $order->billing_country .') :' . $e->getMessage());
	    				return FALSE;
						}
						return $this->send_sms(
							$e164,
							$message,
							$settings['callr-username'],
							$settings['callr-password'],
							$settings['callr-sender'],
							$settings['callr-debug']
						);
					}
				}
			}
		}
		return FALSE;
	}

	/**
 	 * Send an admin notification.
 	 *
 	 * @since    1.0.0
 	 */
	public function send_admin_notification($order_id) {
		$settings = get_option($this->plugin_name);
		if ($settings) {
			if ($settings['admin-notification'] == 1 && !empty($settings['admin-phone'])) {
				$order = wc_get_order($order_id);
				$message = $this->token_replace($settings['admin-message'], $order);
				foreach ($settings['admin-phone'] as $number) {
					$this->send_sms(
						$number,
						$message,
						$settings['callr-username'],
						$settings['callr-password'],
						$settings['callr-sender'],
						$settings['callr-debug']
					);
				}
			}
		}
	}

	/**
 	 * Replace tokens in SMS message.
 	 *
 	 * @since    1.0.0
 	 */
	private function token_replace($message, $order) {
		$replacements = array(
			'%first_name%'    	=> $order->billing_first_name,
			'%last_name%'    		=> $order->billing_last_name,
			'%shop_name%'    		=> get_bloginfo('name'),
			'%order_id%'     		=> $order->get_order_number(),
			'%order_amount%' 		=> $order->get_total(),
			'%order_status%' 		=> $order->get_status(),
			'%store_currency%'	=> get_woocommerce_currency(),
		);
		$message = str_replace(array_keys($replacements), $replacements, $message);
		return $message;
	}

	/**
	 * Send SMS
	 *
 	 * @since    1.0.0
 	 */
	private function send_sms($number, $message, $username, $password, $sender, $debug = FALSE) {
		$api = new \CALLR\API\Client;
		$api->setAuthCredentials($username, $password);
		try {
			$api->call('sms.send', array($sender, $number, $message, NULL));
		} catch(Exception $e) {
			if ($debug) error_log('Could not send SMS: ' . $e->getMessage());
			return FALSE;
		}
		return TRUE;
	}

	/**
	 * Ajax SMS Tester
	 *
	 * @since    1.0.0
	 */
	public function sms_tester() {
		if ($this->send_sms(
			$_POST['number'],
			$_POST['message'],
			$_POST['username'],
			$_POST['password'],
			$_POST['sender'],
			$_POST['debug']
		)) {
			print '1';
		}	else {
			print '0';
		}
		wp_die();
	}


}


