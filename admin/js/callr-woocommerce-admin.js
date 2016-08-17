(function( $ ) {
	'use strict';
	$( window ).load(function() {

		// Tooltips
	 	$('.tip').tipr();

	 	// Toggle as needed
	 	var elements = [
	 		{ checkbox: '#callr-woocommerce-admin-notification', rows: [1, 2, 3] },
	 		{ checkbox: '#callr-woocommerce-optin-enabled', rows: [1, 2] },
	 		{ checkbox: '#callr-woocommerce-custommer-notification-pending', rows: [3] },
	 		{ checkbox: '#callr-woocommerce-custommer-notification-on-hold', rows: [4] },
	 		{ checkbox: '#callr-woocommerce-custommer-notification-processing', rows: [5] },
	 		{ checkbox: '#callr-woocommerce-custommer-notification-completed', rows: [6] },
	 		{ checkbox: '#callr-woocommerce-custommer-notification-cancelled', rows: [7] },
	 		{ checkbox: '#callr-woocommerce-custommer-notification-refunded', rows: [8] },
	 		{ checkbox: '#callr-woocommerce-custommer-notification-failed', rows: [9] }
	 	];
	 	$.each(elements, function(index, value) {
	 		var checkbox = $(value.checkbox);
	 		toggle(checkbox, value.rows);
	 		checkbox.click(function() {
	 			toggle(checkbox, value.rows);
	 		});
	 	});
	 	function toggle(checkbox, rows) {
			var table = $(checkbox.closest('table'));
	 		$.each(rows, function(index, value) {
	 			var row = table.find('tr').eq(value);
	 			if (checkbox.prop('checked')) {
  				row.show();
  			} else {
  				row.hide();
  			}
			});
			if (table.prop('id') == 'customer-notifications') {
				if (table.find('input:checked').length === 0) {
					table.find('tr').eq(1).hide();
					table.find('tr').eq(2).hide();
				} else {
					table.find('tr').eq(1).show();
					table.find('tr').eq(2).show();
				}
			}
	 	}

	 	// SMS Tester
	 	$('#sms-tester').on('click', function() {
			if ($(this).hasClass('disabled')) return;
			var inputs = $('#form-table-sms-tester input, #form-table-sms-tester textarea');
			var spinner = $('#form-table-sms-tester .spinner');
			var button = $('#sms-tester');
			var result = $('#sms-tester-result');
			button.addClass('disabled');
	 		inputs.prop('disabled', true);
	 		spinner.addClass('is-active');
	 		result.stop(true, true);
	 		result.removeClass('dashicons-no');
	 		result.removeClass('dashicons-yes');
		 	var data = {
				'action': 'sms_tester',
				'number': $('#callr-woocommerce-test-phone').val(),
				'message': $('#callr-woocommerce-test-message').val(),
				'username': $('#callr-woocommerce-callr-username').val(),
				'password': $('#callr-woocommerce-callr-password').val(),
				'sender': $('#callr-woocommerce-callr-sender').val(),
				'debug': $('#callr-woocommerce-callr-debug').prop('checked')
			};
		 	$.post(ajaxurl, data, function(response) {
				if (response == '1') {
					result.addClass('dashicons-yes');
				} else {
					result.addClass('dashicons-no');
				}
				result.show();
			})
			.always(function() {
  			spinner.removeClass('is-active');
  			inputs.prop('disabled', false);
  			button.removeClass('disabled');
  			result.fadeOut(5000);
			});
	 	})

	});
})( jQuery );

