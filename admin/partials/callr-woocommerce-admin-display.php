<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://callr.com
 * @since      1.0.0
 *
 * @package    Callr_Woocommerce
 * @subpackage Callr_Woocommerce/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap callr">
	<h1><?php print esc_html(get_admin_page_title()); ?></h1>
	<form method="post" name="callr_woocommerce_options" action="options.php">
		<?php
			$options = array(
				'admin-notification' => 0,
				'admin-phone' => '',
				'admin-message' => 'New order #%order_id% on %shop_name% for %store_currency%%order_amount%.',
				'optin-enabled' => 1,
				'optin-checked' => 1,
				'optin-text' => 'Send me status updates by SMS',
				'customer-notification-pending' => 0,
				'customer-notification-on-hold' => 0,
				'customer-notification-processing' => 0,
				'customer-notification-completed' => 0,
				'customer-notification-cancelled' => 0,
				'customer-notification-refunded' => 0,
				'customer-notification-failed' => 0,
				'customer-message' => 'Dear %first_name%, your order #%order_id% on %shop_name% is now: %order_status%.',
				'customer-message-pending' => '',
				'customer-message-on-hold' => '',
				'customer-message-processing' => '',
				'customer-message-completed' => '',
				'customer-message-cancelled' => '',
				'customer-message-refunded' => '',
				'customer-message-failed' => '',
				'callr-username' => '',
				'callr-password' => '',
				'callr-sender' => '',
				'callr-debug' => 0
			);
			$options = array_merge($options, get_option($this->plugin_name));
			settings_fields($this->plugin_name);
			do_settings_sections($this->plugin_name);
		?>

		<h2><?php _e('Admin notifications', $this->plugin_name); ?></h2>
		<table class="form-table" id="admin-notifications">
			<tbody>
				<tr valign="top">
					<th>
						<?php _e('Notifications', $this->plugin_name); ?>
						<span class="tip dashicons dashicons-editor-help" data-tip="<?php _e('Check this box if you want to be notified when a new order is made.', $this->plugin_name); ?>"></span>
					</th>
					<td>
						<fieldset>
							<input type="checkbox" id="<?php echo $this->plugin_name; ?>-admin-notification" name="<?php echo $this->plugin_name; ?>[admin-notification]" value="1" <?php checked($options['admin-notification'], 1); ?>/>
							<label for="<?php echo $this->plugin_name; ?>-admin-notification"><?php _e('New order', $this->plugin_name); ?></label>
						</fieldset>
					</td>
				</tr>
				<tr valign="top">
					<th>
						<label for="<?php echo $this->plugin_name; ?>-admin-phone"><?php _e('Admin phone number', $this->plugin_name); ?></label>
						<span class="tip dashicons dashicons-editor-help" data-tip="<?php _e('Your mobile phone number in E.164 format. Example: +3384140055.', $this->plugin_name); ?>"></span>
					</th>
					<td>
						<input id="<?php echo $this->plugin_name; ?>-admin-phone" name="<?php echo $this->plugin_name; ?>[admin-phone]" type="text" value="<?php print $options['admin-phone']; ?>" class="regular-text" />
					</td>
				</tr>
				<tr id="admin-tags">
					<th></th>
						<td>
						<p><?php _e('Use the tags below to customize the SMS message:', $this->plugin_name); ?></p>
						<code>%first_name%</code> &ndash; <?php _e('Customer first name', $this->plugin_name); ?><br />
						<code>%last_name%</code> &ndash; <?php _e('Customer last name', $this->plugin_name); ?><br />
						<code>%shop_name%</code> &ndash; <?php _e('Shop name', $this->plugin_name); ?><br />
						<code>%order_id%</code> &ndash; <?php _e('Order number', $this->plugin_name); ?><br />
						<code>%order_amount%</code> &ndash; <?php _e('Order amount', $this->plugin_name); ?><br />
						<code>%store_currency%</code> &ndash; <?php _e('Store currency', $this->plugin_name); ?><br />
						<code>%order_status%</code> &ndash; <?php _e('Order status', $this->plugin_name); ?>
					</td>
				</tr>
				<tr valign="top">
					<th>
						<label for="<?php echo $this->plugin_name; ?>-admin-message"><?php _e('Admin message', $this->plugin_name); ?></label>
						<span class="tip dashicons dashicons-editor-help" data-tip="<?php _e('The message you will receive when an new order is made.', $this->plugin_name); ?>"></span>
					</th>
					<td>
						<textarea id="<?php echo $this->plugin_name; ?>-admin-message" name="<?php echo $this->plugin_name; ?>[admin-message]" cols="60" rows="3"><?php print $options['admin-message']; ?></textarea><br>
					</td>
				</tr>
			</tbody>
		</table>

		<hr />

		<h2><?php _e('Optin', $this->plugin_name); ?></h2>
		<table class="form-table" id="optin-notifications">
			<tbody>
				<tr valign="top">
					<th>
						<?php _e('Optin checkbox', $this->plugin_name); ?>
						<span class="tip dashicons dashicons-editor-help" data-tip="<?php _e('Display an optin checkbox on the checkout page.', $this->plugin_name); ?>"></span>
					</th>
					<td>
						<fieldset>
							<input type="checkbox" id="<?php echo $this->plugin_name; ?>-optin-enabled" name="<?php echo $this->plugin_name; ?>[optin-enabled]" value="1" <?php checked($options['optin-enabled'], 1); ?>/>
							<label for="<?php echo $this->plugin_name; ?>-optin-enabled">
							<?php _e('Enabled', $this->plugin_name); ?></label>
						</fieldset>
					</td>
				</tr>
				<tr valign="top">
					<th>
						<?php _e('Default', $this->plugin_name); ?>
						<span class="tip dashicons dashicons-editor-help" data-tip="<?php _e('Indicate if the checkbox will be checked by default (optout) or not (optin).', $this->plugin_name); ?>"></span>
					</th>
					<td>
						<fieldset>
							<input type="checkbox" id="<?php echo $this->plugin_name; ?>-optin-checked" name="<?php echo $this->plugin_name; ?>[optin-checked]" value="1" <?php checked($options['optin-checked'], 1); ?>/>
							<label for="<?php echo $this->plugin_name; ?>-optin-checked">
							<?php _e('Checked', $this->plugin_name); ?></label>
						</fieldset>
					</td>
				</tr>
				<tr valign="top">
					<th>
						<label for="<?php echo $this->plugin_name; ?>-optin-text"><?php _e('Text', $this->plugin_name); ?></label>
						<span class="tip dashicons dashicons-editor-help" data-tip="<?php _e('The short text that will be shown next to the optin checkboox.', $this->plugin_name); ?>"></span>
					</th>
					<td>
						<input id="<?php echo $this->plugin_name; ?>-optin-text" name="<?php echo $this->plugin_name; ?>[optin-text]" type="text" value="<?php print $options['optin-text']; ?>" class="regular-text" />
					</td>
				</tr>
			</tbody>
		</table>

		<hr />

		<h2><?php _e('Customer notifications', $this->plugin_name); ?></h2>
		<table class="form-table" id="customer-notifications">
			<tbody>
				<tr valign="top">
					<th>
						<?php _e('Notifications', $this->plugin_name); ?>
						<span class="tip dashicons dashicons-editor-help" data-tip="<?php _e('Check the statuses for which you want the customer to receive a message.', $this->plugin_name); ?>"></span>
					</th>
					<td>
						<fieldset>
							<input type="checkbox" id="<?php echo $this->plugin_name; ?>-custommer-notification-pending" name="<?php echo $this->plugin_name; ?>[customer-notification-pending]" value="1" <?php checked($options['customer-notification-pending'], 1); ?>/>
							<label for="<?php echo $this->plugin_name; ?>-customer-notification-pending">
							<?php _e('Pending', $this->plugin_name); ?></label>
						</fieldset>
						<fieldset>
							<input type="checkbox" id="<?php echo $this->plugin_name; ?>-custommer-notification-on-hold" name="<?php echo $this->plugin_name; ?>[customer-notification-on-hold]" value="1" <?php checked($options['customer-notification-on-hold'], 1); ?>/>
							<label for="<?php echo $this->plugin_name; ?>-customer-notification-on-hold"><?php _e('On-Hold', $this->plugin_name); ?></label>
						</fieldset>
						<fieldset>
							<input type="checkbox" id="<?php echo $this->plugin_name; ?>-custommer-notification-processing" name="<?php echo $this->plugin_name; ?>[customer-notification-processing]" value="1" <?php checked($options['customer-notification-processing'], 1); ?>/>
							<label for="<?php echo $this->plugin_name; ?>-customer-notification-processing"><?php _e('Processing', $this->plugin_name); ?></label>
						</fieldset>
						<fieldset>
							<input type="checkbox" id="<?php echo $this->plugin_name; ?>-custommer-notification-completed" name="<?php echo $this->plugin_name; ?>[customer-notification-completed]" value="1" <?php checked($options['customer-notification-completed'], 1); ?>/>
							<label for="<?php echo $this->plugin_name; ?>-customer-notification-completed"><?php _e('Completed', $this->plugin_name); ?></label>
						</fieldset>
						<fieldset>
							<input type="checkbox" id="<?php echo $this->plugin_name; ?>-custommer-notification-cancelled" name="<?php echo $this->plugin_name; ?>[customer-notification-cancelled]" value="1" <?php checked($options['customer-notification-cancelled'], 1); ?>/>
							<label for="<?php echo $this->plugin_name; ?>-customer-notification-cancelled"><?php _e('Cancelled', $this->plugin_name); ?></label>
						</fieldset>
						<fieldset>
							<input type="checkbox" id="<?php echo $this->plugin_name; ?>-custommer-notification-refunded" name="<?php echo $this->plugin_name; ?>[customer-notification-refunded]" value="1" <?php checked($options['customer-notification-refunded'], 1); ?>/>
							<label for="<?php echo $this->plugin_name; ?>-customer-notification-refunded"><?php _e('Refunded', $this->plugin_name); ?></label>
						</fieldset>
						<fieldset>
							<input type="checkbox" id="<?php echo $this->plugin_name; ?>-custommer-notification-failed" name="<?php echo $this->plugin_name; ?>[customer-notification-failed]" value="1" <?php checked($options['customer-notification-failed'], 1); ?>/>
							<label for="<?php echo $this->plugin_name; ?>-customer-notification-failed"><?php _e('Failed', $this->plugin_name); ?></label>
						</fieldset>
					</td>
				</tr>
				<tr id="customer-tags">
					<th></th>
					<td>
						<p><?php _e('Use the tags below to customize the SMS message:', $this->plugin_name); ?></p>
						<code>%first_name%</code> &ndash; <?php _e('Customer first name', $this->plugin_name); ?><br />
						<code>%last_name%</code> &ndash; <?php _e('Customer last name', $this->plugin_name); ?><br />
						<code>%shop_name%</code> &ndash; <?php _e('Shop name', $this->plugin_name); ?><br />
						<code>%order_id%</code> &ndash; <?php _e('Order number', $this->plugin_name); ?><br />
						<code>%order_amount%</code> &ndash; <?php _e('Order amount', $this->plugin_name); ?><br />
						<code>%store_currency%</code> &ndash; <?php _e('Store currency', $this->plugin_name); ?><br />
						<code>%order_status%</code> &ndash; <?php _e('Order status', $this->plugin_name); ?>
					</td>
				</tr>
				<tr valign="top">
					<th>
						<label for="<?php echo $this->plugin_name; ?>-customer-message"><?php _e('Default message', $this->plugin_name); ?></label>
						<span class="tip dashicons dashicons-editor-help" data-tip="<?php _e('This message will be used for all status updates, unless overridden by a custom message (see below).', $this->plugin_name); ?>"></span>
					</th>
					<td>
						<textarea id="<?php echo $this->plugin_name; ?>-customer-message" name="<?php echo $this->plugin_name; ?>[customer-message]" cols="60" rows="3"><?php print $options['customer-message']; ?></textarea><br>
					</td>
				</tr>
				<tr valign="top">
					<th>
						<label for="<?php echo $this->plugin_name; ?>-customer-message-pending"><?php _e('Pending message', $this->plugin_name); ?></label>
						<span class="tip dashicons dashicons-editor-help" data-tip="<?php _e('The message for the <i>pending</i> status. This overrides the default message.', $this->plugin_name); ?>"></span>
					</th>
					<td>
						<textarea id="<?php echo $this->plugin_name; ?>-customer-message-pending" name="<?php echo $this->plugin_name; ?>[customer-message-pending]" cols="60" rows="3"><?php print $options['customer-message-pending']; ?></textarea><br>
					</td>
				</tr>
				<tr valign="top">
					<th>
						<label for="<?php echo $this->plugin_name; ?>-customer-message-on-hold"><?php _e('On-Hold message', $this->plugin_name); ?></label>
						<span class="tip dashicons dashicons-editor-help" data-tip="<?php _e('The message for the <i>on-hold</i> status. This overrides the default message.', $this->plugin_name); ?>"></span>
					</th>
					<td>
						<textarea id="<?php echo $this->plugin_name; ?>-customer-message-on-hold" name="<?php echo $this->plugin_name; ?>[customer-message-on-hold]" cols="60" rows="3"><?php print $options['customer-message-on-hold']; ?></textarea><br>
					</td>
				</tr>
				<tr valign="top">
					<th>
						<label for="<?php echo $this->plugin_name; ?>-customer-message-processing"><?php _e('Processing message', $this->plugin_name); ?></label>
						<span class="tip dashicons dashicons-editor-help" data-tip="<?php _e('The message for the <i>processing</i> status. This overrides the default message.', $this->plugin_name); ?>"></span>
					</th>
					<td>
						<textarea id="<?php echo $this->plugin_name; ?>-customer-message-processing" name="<?php echo $this->plugin_name; ?>[customer-message-processing]" cols="60" rows="3"><?php print $options['customer-message-processing']; ?></textarea><br>
					</td>
				</tr>
				<tr valign="top">
					<th>
						<label for="<?php echo $this->plugin_name; ?>-customer-message-completed"><?php _e('Completed message', $this->plugin_name); ?></label>
						<span class="tip dashicons dashicons-editor-help" data-tip="<?php _e('The message for the <i>completed</i> status. This overrides the default message.', $this->plugin_name); ?>"></span>
					</th>
					<td>
						<textarea id="<?php echo $this->plugin_name; ?>-customer-message-completed" name="<?php echo $this->plugin_name; ?>[customer-message-completed]" cols="60" rows="3"><?php print $options['customer-message-completed']; ?></textarea><br>
					</td>
				</tr>
				<tr valign="top">
					<th>
						<label for="<?php echo $this->plugin_name; ?>-customer-message-cancelled"><?php _e('Cancelled message', $this->plugin_name); ?></label>
						<span class="tip dashicons dashicons-editor-help" data-tip="<?php _e('The message for the <i>cancelled</i> status. This overrides the default message.', $this->plugin_name); ?>"></span>
					</th>
					<td>
						<textarea id="<?php echo $this->plugin_name; ?>-customer-message-cancelled" name="<?php echo $this->plugin_name; ?>[customer-message-cancelled]" cols="60" rows="3"><?php print $options['customer-message-cancelled']; ?></textarea><br>
					</td>
				</tr>
				<tr valign="top">
					<th>
						<label for="<?php echo $this->plugin_name; ?>-customer-message-refunded"><?php _e('Refunded message', $this->plugin_name); ?></label>
						<span class="tip dashicons dashicons-editor-help" data-tip="<?php _e('The message for the <i>refunded</i> status. This overrides the default message.', $this->plugin_name); ?>"></span>
					</th>
					<td>
						<textarea id="<?php echo $this->plugin_name; ?>-customer-message-refunded" name="<?php echo $this->plugin_name; ?>[customer-message-refunded]" cols="60" rows="3"><?php print $options['customer-message-refunded']; ?></textarea><br>
					</td>
				</tr>
				<tr valign="top">
					<th>
						<label for="<?php echo $this->plugin_name; ?>-customer-message-failed"><?php _e('Failed message', $this->plugin_name); ?></label>
						<span class="tip dashicons dashicons-editor-help" data-tip="<?php _e('The message for the <i>failed</i> status. This overrides the default message.', $this->plugin_name); ?>"></span>
					</th>
					<td>
						<textarea id="<?php echo $this->plugin_name; ?>-customer-message-failed" name="<?php echo $this->plugin_name; ?>[customer-message-failed]" cols="60" rows="3"><?php print $options['customer-message-failed']; ?></textarea><br>
					</td>
				</tr>
			</tbody>
		</table>

		<hr />

		<h2><?php _e('Callr settings', $this->plugin_name); ?></h2>
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th>
						<label for="<?php echo $this->plugin_name; ?>-callr-username"><?php _e('Username', $this->plugin_name); ?></label>
						<span class="tip dashicons dashicons-editor-help" data-tip="<?php _e('Your Callr username. You can register an account at http://callr.com.', $this->plugin_name); ?>"></span>
					</th>
					<td>
						<input id="<?php echo $this->plugin_name; ?>-callr-username" name="<?php echo $this->plugin_name; ?>[callr-username]" type="text" value="<?php print $options['callr-username']; ?>" class="regular-text" />
					</td>
				</tr>
				<tr valign="top">
					<th>
						<label for="<?php echo $this->plugin_name; ?>-callr-password"><?php _e('Password', $this->plugin_name); ?></label>
						<span class="tip dashicons dashicons-editor-help" data-tip="<?php _e('Your Callr password. You can register an account at http://callr.com.', $this->plugin_name); ?>"></span>
					</th>
					<td>
						<input id="<?php echo $this->plugin_name; ?>-callr-password" name="<?php echo $this->plugin_name; ?>[callr-password]" type="password" value="<?php print $options['callr-password']; ?>" class="regular-text" />
					</td>
				</tr>
				<tr valign="top">
					<th>
						<label for="<?php echo $this->plugin_name; ?>-callr-sender"><?php _e('Sender ID', $this->plugin_name); ?></label>
						<span class="tip dashicons dashicons-editor-help" data-tip="<?php _e('The SMS sender. If empty, a shared shortcode will be automatically selected depending on the destination carrier. Otherwise, it must be either a dedicated shortcode, or alphanumeric (at least one character - cannot be digits only). Max length: 11 characters. Depending on your account configuration, you may have to ask Callr support team to authorize custom Sender IDs. <i>SMS</i> is always authorized.', $this->plugin_name); ?>"></span>
					</th>
					<td>
						<input id="<?php echo $this->plugin_name; ?>-callr-sender" name="<?php echo $this->plugin_name; ?>[callr-sender]" type="text" value="<?php print $options['callr-sender']; ?>" class="regular-text" />
					</td>
				</tr>
				<tr valign="top">
					<th>
						<?php _e('Debug', $this->plugin_name); ?>
						<span class="tip dashicons dashicons-editor-help" data-tip="<?php _e('Check this box if you are having issues sending SMS. This will append error messages to the log.', $this->plugin_name); ?>"></span>
					</th>
					<td>
						<fieldset>
							<input type="checkbox" id="<?php echo $this->plugin_name; ?>-callr-debug" name="<?php echo $this->plugin_name; ?>[callr-debug]" value="1" <?php checked($options['callr-debug'], 1); ?>/>
							<label for="<?php echo $this->plugin_name; ?>-callr-debug"><?php _e('Log errors', $this->plugin_name); ?></label>
						</fieldset>
					</td>
				</tr>
			</tbody>
		</table>

		<hr />

		<h2><?php _e('Send test SMS', $this->plugin_name); ?></h2>
		<table class="form-table" id="form-table-sms-tester">
			<tbody>
				<tr valign="top">
					<th>
						<label for="<?php echo $this->plugin_name; ?>-test-phone"><?php _e('Test phone number', $this->plugin_name); ?></label>
						<span class="tip dashicons dashicons-editor-help" data-tip="<?php _e('A mobile phone number in E.164 format. Example: +3384140055.', $this->plugin_name); ?>"></span>
					</th>
					<td>
						<input id="<?php echo $this->plugin_name; ?>-test-phone" name="<?php echo $this->plugin_name; ?>[test-phone]" type="text" value="" class="regular-text" />
					</td>
				</tr>
				<tr valign="top">
					<th>
						<label for="<?php echo $this->plugin_name; ?>-test-message"><?php _e('Test message', $this->plugin_name); ?></label>
						<span class="tip dashicons dashicons-editor-help" data-tip="<?php _e('A test message.', $this->plugin_name); ?>"></span>
					</th>
					<td>
						<textarea id="<?php echo $this->plugin_name; ?>-test-message" name="<?php echo $this->plugin_name; ?>[test-message]" cols="60" rows="3"></textarea><br>
					</td>
				</tr>
				<tr valign="top">
					<th></th>
					<td>
						<a class="button-secondary" id="sms-tester"><?php _e('Send'); ?></a>
						<span class="dashicons dashicons-no" id="sms-tester-result"></span>
						<div class="spinner"></div>
					</td>
				</tr>
			</tbody>
		</table>

		<?php submit_button(__('Save changes', $this->plugin_name), 'primary','submit', TRUE); ?>
	</form>
</div>