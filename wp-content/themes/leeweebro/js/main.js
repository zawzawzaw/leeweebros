// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

jQuery( function( $ ) {

	$(document).ready(function(){

		var $accountLoginContainer = $('#account-login'),
			$sideBarMenu = $('.side-menu'),
			$mainSlider = $('.carousel'),
			$secondSlider = $('.jcarousel-wrapper'),
			$singleEntry = $('.entry-summary'),
			$receivingModeContainer = $('.receiving-mode-container'),
			$allReceivingModeContainer = $('.all-container'),
			$receivingModeCollection = $('.collection-container'),
			$receivingModeDelivery = $('.delivery-container'),
			$addressContainer = $('.address-container'),
			$billingDropdown = $('.billing_address'),
			$shippingDropdown = $('.delivery_address'),
			$billingInfoList = $('.billing-address'),
			$shippingInfoList = $('.shipping-address'),
			$sameasbillingCheckbox = $('input[name="same"]'),
			$billinginputHidden = $('input#billing_address_hidden'),
			$shippinginputHidden = $('input#shipping_address_hidden'),
			$shippingDropdownDiv = $('.delivery_toggle'),
			$addNewShippingBtn = $('.add_delivery'),
			$addNewBillingBtn = $('.add_billing');
			$newBillingAddressForm = $('#billingaddress-form'),
			$newShippingAddressForm = $('#shippingaddress-form'),
			$newFormContainer = $('.address-container'),
			$selectAddressContainer = $('.select-address-container'),
			$saveDeliveryAddressBtn = $('.save_delivery_address'),
			$saveBillingAddressBtn = $('.save_billing_address'),
			$cancelBillingAddressBtn = $('.cancel_billing_address'),
			$cancelDeliveryAddressBtn = $('.cancel_delivery_address'),
			$checkoutBtn = $('.submit-to-checkout'),
			$checkoutForm = $('form#submitcheckout'),
			$backToReceivingModeBtn = $('.select-address-prev-btn'),
			$backToReceivingModeForm = $('#backtoreceivingmode'),
			$backToSelectAddressBtn = $('.payment-mode-prev-btn'),
			$backToSelectAddressForm = $('#backtoselectaddress'),
			$checkOutPaymentModeNextBtn = $('.payment-mode-next'),
			$paymentModeContainer = $('.payment-mode');
			$personalPaymentModeContainer = $('.personal-payment'),
			$corporatePaymentModeContainer = $('.corporate-payment'),
			$orderSummaryContainer = $('.summary-container'),
			$orderDetailContainer = $('.order-details-container'),
			$personalPaymentBtn = $('.personal-payment-save'),
			$corporatePaymentBtn = $('.corporate-payment-save'),
			$personalPaymentCancelBtn = $('.personal-payment-cancel'),
			$corporatePaymentCancelBtn = $('.corporate-payment-cancel'),
			$checkOutTermContainer = $('.terms-container'),
			$progressIndicator = $('.progress-indicator-container'),
			$submissionPrevBtn = $('.submission-prev-btn'),
			$confirmOrderBtn = $('#confirm-order'),
			$cartContainer = $('.cart-container'),
			$contactContainer = $('#contact'),
			$allProductContainer = $('#content-wrapper #all'),
			$mobileMenu = $('.mobile-menu'),
			$mobileMenuBtn = $('.mobile-menu-btn');

		// $mobileMenu.jScrollPane();

		$mainSlider.swiperight(function() {  
	      $mainSlider.carousel('prev');
	    });  
	    $mainSlider.swipeleft(function() {  
	      $mainSlider.carousel('next');
	    });

		$mobileMenuBtn.on('click', function(e){
			$mobileMenu.slideToggle( "slow" );
		});

		$('.mobile-menu li > a').on('click', function(e){
			if($(this).html()=="Our Food") {
				e.preventDefault();
			}

			$('.open').slideToggle("slow").removeClass('open');
			$(this).parent().find('.sub-menu').slideToggle("slow").addClass('open');
		});

		$.validator.addMethod("alphanumeric", function(value, element) {
	        return this.optional(element) || /^[a-z0-9\-\s]+$/i.test(value);
	    }, "Letter and number only please");

		$accountLoginContainer.find('form.register').validate({
			messages: {
				email: {
					required: "Please fill in your email address",
					email: "Invalid email address"
				}
  			}
		});
		$accountLoginContainer.find('form.login').validate({
			rules: {
				username : {
					required: true
				},
				password : {
					required: true
				}
			},
			messages: {
				username: {
					required: "Please fill in your email address"
				},
				password: {
				  required: "Please fill in your password"
				}
  			}
		});
		$accountLoginContainer.find('form.registeration').validate({
			rules: {
				first_name: {
					required: true,
					alphanumeric: true
				},
				last_name : {
					required: true,
					alphanumeric: true
				},
				email: {
					required : true,
					email: true
				},
				address_book_1_first_name: {
					required: true,
					alphanumeric: true
				},
				address_book_1_last_name: {
					required: true,
					alphanumeric: true
				},
				address_book_1_address_1: "required",
				address_book_1_address_2: "required",
				address_book_1_postcode: {
					required : true,
					number: true
				},
				address_book_1_country: {
					required: true,
					alphanumeric: true
				},
				address_book_1_phone: {
					required: true,
					number: true
				},
				address_book_1_mobile: {
					required: true,
					number: true
				}
			},
			messages: {
				first_name: {
					required: "Please fill in your first name",
					alphanumeric: "Letter and number only please"
				},
				last_name : {
					required: "Please fill in your last name",
					alphanumeric: "Letter and number only please"
				},
				email: {
					required : "Please fill in your email address",
					email: "Invalid email address"
				},
				address_book_1_first_name: {
					required: "Please fill in your first name",
					alphanumeric: "Letter and number only please"
				},
				address_book_1_last_name: {
					required: "Please fill in your last name",
					alphanumeric: "Letter and number only please"
				},
				address_book_1_address_1: "Please fill in your address",
				address_book_1_address_2: "Please fill in your address",
				address_book_1_postcode: {
					required : "Please fill in your post code",
					number: "Invalid postal code"
				},
				address_book_1_country: {
					required: "Please fill in your country",
					alphanumeric: "Letter and number only please"
				},
				address_book_1_phone: {
					required: "Please fill in your phone no",
					number: "Invalid phone no."
				},
				address_book_1_mobile: {
					required: "Please fill in your mobile no",
					number: "Invalid mobile no."
				}
			}
		});

		$accountLoginContainer.find('form.lost_reset_password').validate({
			rules: {
				user_login: {
					required: true
				}
			},
			messages: {
				user_login: {
					required: "Please fill in your email address"
				}
			}
		});

		$accountLoginContainer.find('form.editaccount').validate({
			rules: {
				account_first_name: {
					required: true,
					alphanumeric: true
				},
				account_last_name : {
					required: true,
					alphanumeric: true
				},
				account_email: {
					required : true,
					email: true
				},
			},
			messages: {
				account_first_name: {
					required: "Please fill in your first name",
					alphanumeric: "Letter and number only please"
				},
				account_last_name : {
					required: "Please fill in your last name",
					alphanumeric: "Letter and number only please"
				},
				account_email: {
					required : "Please fill in your email address",
					email: "Invalid email address"
				},
			}
		});

		$addressContainer.find('form#billingaddress-form').validate({
			rules: {
				first_name: {
					required: true,
					alphanumeric: true
				},
				last_name : {
					required: true,
					alphanumeric: true
				},
				address_1: "required",
				address_2: "required",
				postcode: {
					required : true,
					number: true
				},
				country: {
					required: true,
					alphanumeric: true
				},
				phone: {
					required: true,
					number: true
				},
				mobile: {
					required: true,
					number: true
				}
			},
			messages: {
				first_name: {
					required: "Please fill in your first name",
					alphanumeric: "Letter and number only please"
				},
				last_name : {
					required: "Please fill in your last name",
					alphanumeric: "Letter and number only please"
				},
				address_1: "Please fill in your address",
				address_2: "Please fill in your address",
				postcode: {
					required : "Please fill in your post code",
					number: "Invalid postal code"
				},
				country: {
					required: "Please fill in your country",
					alphanumeric: "Letter and number only please"
				},
				phone: {
					required: "Please fill in your phone no",
					number: "Invalid phone no."
				},
				mobile: {
					required: "Please fill in your mobile no",
					number: "Invalid mobile no."
				}
			}
		});

		$addressContainer.find('form#shippingaddress-form').validate({
			rules: {
				first_name: {
					required: true,
					alphanumeric: true
				},
				last_name : {
					required: true,
					alphanumeric: true
				},
				address_1: "required",
				address_2: "required",
				postcode: {
					required : true,
					number: true
				},
				country: {
					required: true,
					alphanumeric: true
				},
				phone: {
					required: true,
					number: true
				},
				mobile: {
					required: true,
					number: true
				}
			},
			messages: {
				first_name: {
					required: "Please fill in your first name",
					alphanumeric: "Letter and number only please"
				},
				last_name : {
					required: "Please fill in your last name",
					alphanumeric: "Letter and number only please"
				},
				address_1: "Please fill in your address",
				address_2: "Please fill in your address",
				postcode: {
					required : "Please fill in your post code",
					number: "Invalid postal code"
				},
				country: {
					required: "Please fill in your country",
					alphanumeric: "Letter and number only please"
				},
				phone: {
					required: "Please fill in your phone no",
					number: "Invalid phone no."
				},
				mobile: {
					required: "Please fill in your mobile no",
					number: "Invalid mobile no."
				}
			}
		});

		$selectAddressContainer.find('form#submitcheckout').validate({
			ignore: [],
			rules: {
				billing_address: "required",
				shipping_address: "required"
			},
			messages: {
				billing_address: "Please select existing or add new billing address",
				shipping_address: "Please select existing or add new delivery address"
			},
			errorPlacement: function(error, element) {
			    if (element.attr("name") == "billing_address" || element.attr("name") == "shipping_address") {
			      	$('.error-select-address').html(error);
			    }else {
			      	error.insertAfter(element);
			    }
		  	}
		});

		function setAddressFormValue(Address, addressBookIndex){
			$accountLoginContainer.find('input[name="first_name"]').val(Address.first_name);
			$accountLoginContainer.find('input[name="last_name"]').val(Address.last_name);
			$accountLoginContainer.find('input[name="company"]').val(Address.company);
			$accountLoginContainer.find('input[name="address_1"]').val(Address.address_1);
			$accountLoginContainer.find('input[name="address_2"]').val(Address.address_2);
			$accountLoginContainer.find('input[name="postcode"]').val(Address.postcode);
			$accountLoginContainer.find('input[name="city"]').val(Address.city);
			$accountLoginContainer.find('select[name="country"]').val(Address.country);
			$accountLoginContainer.find('textarea[name="addition_info"]').val(Address.addition_info);
			$accountLoginContainer.find('input[name="phone"]').val(Address.phone);
			$accountLoginContainer.find('input[name="mobile"]').val(Address.mobile);
			$accountLoginContainer.find('input[name="address_book_id"]').val(addressBookIndex);
		}

		$accountLoginContainer.find('.update').on('click', function(e){
			e.preventDefault();

			var address_json = $(this).prev('input').val();
			var addressBookIndex = $(this).parent('li').find('p').data('book');
			
			var Address = jQuery.parseJSON( address_json );

			$accountLoginContainer.find('.address-title').html('UPDATE NEW ADDRESS:')
			$accountLoginContainer.find('.myaddress-container').hide();
			$accountLoginContainer.find('.address-container').show();

			setAddressFormValue(Address, addressBookIndex);
		});

		$accountLoginContainer.find('#address-form').validate({
			rules: {
				first_name: {
					required: true,
					alphanumeric: true
				},
				last_name : {
					required: true,
					alphanumeric: true
				},
				address_1: "required",
				address_2: "required",
				postcode: {
					required : true,
					number: true
				},
				country: {
					required: true,
					alphanumeric: true
				},
				phone: {
					required: true,
					number: true
				},
				mobile: {
					required: true,
					number: true
				}
			},
			messages: {
				first_name: {
					required: "Please fill in your first name",
					alphanumeric: "Letter and number only please"
				},
				last_name : {
					required: "Please fill in your last name",
					alphanumeric: "Letter and number only please"
				},
				address_1: "Please fill in your address",
				address_2: "Please fill in your address",
				postcode: {
					required : "Please fill in your post code",
					number: "Invalid postal code"
				},
				country: {
					required: "Please fill in your country",
					alphanumeric: "Letter and number only please"
				},
				phone: {
					required: "Please fill in your phone no",
					number: "Invalid phone no."
				},
				mobile: {
					required: "Please fill in your mobile no",
					number: "Invalid mobile no."
				}
			}
		});

		$accountLoginContainer.find('.save_address').click(function(e) {
			e.preventDefault();

			console.log($(this).closest('form').valid())

			if($(this).closest('form').valid()) {

				var fields = $(this).closest('form').serializeObject();
				var address_fields_json = JSON.stringify(fields);

				$.ajax({
			       type: "POST",
			       url: ajaxurl,
			       data: "action=saveaddress&postdata="+address_fields_json,
			       success: function(msg){
			            $accountLoginContainer.find('.myaddress-container').show();
						$accountLoginContainer.find('.address-container').hide();

						var addressIndex = fields.address_book_id;
							addressSelector = 'p.my-address-'+addressIndex;

						$(addressSelector).children('span.name').html(fields.first_name + ' ' +fields.last_name);
						$(addressSelector).children('span.address-1').html(fields.address_1);
						$(addressSelector).children('span.address-2').html(fields.address_2);
						$(addressSelector).children('span.country').html(fields.country);
						$(addressSelector).children('span.postcode').html(fields.postcode);
						$(addressSelector).children('span.mobile').html(fields.mobile);
			       }
			   	});

			}
		});

		$accountLoginContainer.find('.delete_address').click(function(e) {
			e.preventDefault();

			var address_json = $(this).prev().prev('input').val();

			var Address = jQuery.parseJSON( address_json );
			Address.address_book_id = $(this).parent('li').find('p').data('book');

			var address_fields_json = JSON.stringify(Address);

			$.ajax({
		       	type: "POST",
		       	url: ajaxurl,
		       	data: "action=deleteaddress&postdata="+address_fields_json,
		       	success: function(msg){
	        		var addressIndex = Address.address_book_id;
						addressSelector = 'p.my-address-'+addressIndex;

					$(addressSelector).parent('li').remove();
		       	}
		   });

		});

		$sideBarMenu.children('li').children('.collapse').on('shown.bs.collapse', function (e) {
		  	$('.side-menu li').removeClass('active');
		  	$(e.currentTarget).parent('li').addClass('active');
		});

		$sideBarMenu.children('li').children('a').on('click',function(e){
		    if($(this).next('.collapse').hasClass('in')){
		        e.stopPropagation();
		    }else {
		    	$('.collapse').collapse('hide');
		    }
		});

		$mainSlider.carousel('pause');

		$secondSlider.children('.jcarousel').jcarousel();

	    $secondSlider.children('.jcarousel-control-prev').jcarouselControl({
	        target: '-=1'
	    });

	    $secondSlider.children('.jcarousel-control-next').jcarouselControl({
		    target: '+=1'
		});

		$singleEntry.children('div').children('.full-size').on('click', function(e){

			e.preventDefault();

			$(this).parent('div').children('div').children('a').trigger('click');
		});

		$receivingModeContainer.find('.receiving-mode-next').on('click', function(e){

			e.preventDefault();
			
			var mode = $receivingModeContainer.find('input[name="receivingmethod"]:checked').val();
			var cartAmount = $('.cart-amount').val();
			cartAmount = parseFloat(cartAmount);

			if(cartAmount<100 && mode=='delivery') {
				$('.error-deliver').html('Minimum purchase of S$100 required for free delivery.');
			}else if(cartAmount>=100 && mode=='delivery') {
				$allReceivingModeContainer.hide();
				$receivingModeDelivery.show();
			}else if(mode=='self') {
				$allReceivingModeContainer.hide();
				$receivingModeCollection.show(); 
			}

			
			// if(mode=='self') $receivingModeCollection.show(); 
			// else $receivingModeDelivery.show();
			
		});

		$allReceivingModeContainer.find('.receiving-mode-prev').on('click', function(e){

			e.preventDefault();

			$allReceivingModeContainer.hide();
			$receivingModeContainer.show();
		});

		function addDays(theDate, days) {
		    return new Date(theDate.getTime() + days*24*60*60*1000);
		}

		function convertAMPM(hr, min, ampm){

			hr = parseInt(hr, 10);
			min = parseInt(min, 10);

			if(ampm == "PM" && hr<12) hr = hr+12;
			if(ampm == "AM" && hr==12) hr = hr-12;

			var sHours = hr.toString();
			var sMinutes = min.toString();


			if(hr<10) sHours = "0" + sHours;
			if(min<10) sMinutes = "0" + sMinutes;

			sSecs = "00";

			return sHours + ':' + sMinutes + ':' + sSecs;
		}

		$receivingModeCollection.find('input[type="submit"]').on('click', function(e){
			e.preventDefault();

			var day = $(this).parent('div').parent('div').parent('form').find('select[name="collection_date_day"]').val();
			var month = $(this).parent('div').parent('div').parent('form').find('select[name="collection_date_month"]').val();
			var year = $(this).parent('div').parent('div').parent('form').find('select[name="collection_date_year"]').val();
			var hr = $(this).parent('div').parent('div').parent('form').find('select[name="consumption_time_hr"]').val();
			var min = $(this).parent('div').parent('div').parent('form').find('select[name="consumption_time_mm"]').val();
			var ampm = $(this).parent('div').parent('div').parent('form').find('select[name="consumption_time_am_pm"]').val();			

			var selected_collection_times = $('select[name="collection_time"]').val();
			var selected_collection_time_str = selected_collection_times.split('-');

			var selected_collection_time = $.trim(selected_collection_time_str[0])

			//
			var selected_collection_time_arr = selected_collection_time.split(' ');

			var collection_time_hrmin = selected_collection_time_arr[0];
			var collection_time_ampm = selected_collection_time_arr[1];

			collection_time_arr = collection_time_hrmin.split(':');
			var collection_time_hr = collection_time_arr[0];
			var collection_time_min = collection_time_arr[1];

			var hours = Number(collection_time_hr);
			var minutes = Number(collection_time_min);
			var AMPM = collection_time_ampm;
			if(AMPM == "pm" && hours<12) hours = hours+12;
			if(AMPM == "am" && hours==12) hours = hours-12;
			var sHours = hours.toString();
			var sMinutes = minutes.toString();
			if(hours<10) sHours = "0" + sHours;
			if(minutes<10) sMinutes = "0" + sMinutes;

			var formattedConsumptionTime = new Date(year, month, day, sHours, sMinutes, 00);

			console.log(formattedConsumptionTime);

			Date.prototype.addHours= function(h){
			    this.setHours(this.getHours()+h);
			    return this;
			}

			Date.prototype.minusHours= function(h){
			    this.setHours(this.getHours()-h);
			    return this;
			}

			Date.prototype.minusMins= function(h){
			    this.setMinutes(this.getMinutes()-h);
			    return this;
			}

			// set required time
			// var validTimes = ['06:00:00', '23:59:00'];
			// var validTimes2 = ['06:00:00', '22:00:00'];

			// var validTime2 = formattedConsumptionTime.minusHours(5);
			// var validTime2 = validTime2.minusMins(30);
			var validTime = formattedConsumptionTime.addHours(4);
			var formattedTime = convertAMPM(hr, min, ampm);

			// set required date
			// var collection_date = month + ' ' + day + ' ' + year;
			var collection_date = year + '-' + month + '-' + day + 'T00:00:00Z';
			// var formattedDate = new Date(collection_date);
			var formattedDate = new Date(year, month-1, day, sHours, sMinutes, 00);
			console.log(formattedDate);

			var twoDayInAdvance = addDays(new Date(), 2);

			var validTime_arr = validTime.toString().split(' ');
			var formattedValidTime = $.trim(validTime_arr[4]);

			// var validTime_arr2 = validTime2.toString().split(' ');
			// var formattedValidTime2 = $.trim(validTime_arr2[4]);

			console.log(formattedTime);
			// console.log(formattedValidTime);
			// console.log(validTime2);

			var error = false;

			var chosen_date = year + '-' + month + '-' + day;
			var chosen_timeslot = $('#collection_time')[0].selectedIndex;
			var blackout_dates = $('#collection_blackout_date').val().split(',');
			var blackout_receiving_modes = $('#collection_blackout_receiving_mode').val().split(',');
			var blackout_timeframes = $('#collection_blackout_timeframe').val().split(',');
			var blackout_date_index = blackout_dates.indexOf(chosen_date);

			var i = -1,
			    indizes = [];

			while((i = blackout_dates.indexOf(chosen_date, i + 1)) !== -1) {
			    indizes.push(i);
			}

			if(indizes.length>1) {
				for(var j=0;j<indizes.length;j++) {
					var blackout_date_index = indizes[j];

					var blackout_receiving_mode = blackout_receiving_modes[blackout_date_index];
					var blackout_timeframe = blackout_timeframes[blackout_date_index];

					console.log(chosen_date)
					console.log(blackout_dates)
					console.log(blackout_date_index)
					console.log(blackout_receiving_mode)
					console.log(blackout_timeframe)

					if(blackout_timeframe=='full') {
						var allowtimeslots = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19];
					}else if(blackout_timeframe=='morning') {
						var allowtimeslots = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
					}else if(blackout_timeframe=='evening') {
						var allowtimeslots = [10, 11, 12, 13, 14, 15, 16, 17];
					}else {
						var allowtimeslots = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19];
					}

					console.log(allowtimeslots)

					// collection date
					if(day == "" || month == "" || year == "") {

						$('.error-collection-date').html('Please select collection date.');
						error = true;

					}else if(twoDayInAdvance > formattedDate) {

						$('.error-collection-date').html('Orders must be made at least 2 days in advance.');
						error = true;

					}else if((blackout_receiving_mode=='collection' || blackout_receiving_mode=='both') && jQuery.inArray(chosen_date,blackout_dates) > -1 && jQuery.inArray(chosen_timeslot, allowtimeslots) > -1){

						$('.error-collection-date').html('Self collection service is not available for selected date and time.');
						error = true;

					}
				}
			}else {
				var blackout_receiving_mode = blackout_receiving_modes[blackout_date_index];
				var blackout_timeframe = blackout_timeframes[blackout_date_index];

				// console.log(chosen_date)
				// console.log(blackout_dates)
				// console.log(blackout_date_index)
				// console.log(blackout_receiving_mode)
				// console.log(blackout_timeframe)

				if(blackout_timeframe=='full') {
					var allowtimeslots = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19];
				}else if(blackout_timeframe=='morning') {
					var allowtimeslots = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
				}else if(blackout_timeframe=='evening') {
					var allowtimeslots = [10, 11, 12, 13, 14, 15, 16, 17];
				}else {
					var allowtimeslots = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19];
				}

				// console.log(allowtimeslots)

				// collection date
				if(day == "" || month == "" || year == "") {

					$('.error-collection-date').html('Please select collection date.');
					error = true;

				}else if(twoDayInAdvance > formattedDate) {

					$('.error-collection-date').html('Orders must be made at least 2 days in advance.');
					error = true;

				}else if((blackout_receiving_mode=='collection' || blackout_receiving_mode=='both') && jQuery.inArray(chosen_date,blackout_dates) > -1 && jQuery.inArray(chosen_timeslot, allowtimeslots) > -1){

					$('.error-collection-date').html('Self collection service is not available for selected date and time.');
					error = true;

				}
			}
			

			if(error==false) $('.error-collection-date').html('');

			// consumption time
			if(hr == "" || min == "" || ampm == "") {

				$('.error-consumption-time').html('Please select consumption time.');
				error = true;

			}else if(formattedTime > formattedValidTime) {

				$('.error-consumption-time').html('We recommend to consume the food within 4 hrs after collection.');
				error = true;

			}else $('.error-consumption-time').html('');

			if(error==false) $receivingModeCollection.find('form').submit();

		});

		$receivingModeDelivery.find('input[type="submit"]').on('click', function(e){

			e.preventDefault();
			var cartAmount = $('.cart-amount').val();
			var location = $receivingModeDelivery.find('input[name="delivery"]:checked').val();

			var day = $(this).parent('div').parent('div').parent('form').find('select[name="delivery_date_day"]').val();
			var month = $(this).parent('div').parent('div').parent('form').find('select[name="delivery_date_month"]').val();
			var year = $(this).parent('div').parent('div').parent('form').find('select[name="delivery_date_year"]').val();
			var hr = $(this).parent('div').parent('div').parent('form').find('select[name="consumption_time_hr"]').val();
			var min = $(this).parent('div').parent('div').parent('form').find('select[name="consumption_time_mm"]').val();
			var ampm = $(this).parent('div').parent('div').parent('form').find('select[name="consumption_time_am_pm"]').val();

			var selected_delivery_times = $('select[name="delivery_time"]').val();
			var selected_delivery_time_str = selected_delivery_times.split('-');

			var selected_delivery_time = $.trim(selected_delivery_time_str[0]);

			//
			var selected_delivery_time_arr = selected_delivery_time.split(' ');

			var delivery_time_hrmin = selected_delivery_time_arr[0];
			var delivery_time_ampm = selected_delivery_time_arr[1];

			delivery_time_arr = delivery_time_hrmin.split(':');
			var delivery_time_hr = delivery_time_arr[0];
			var delivery_time_min = delivery_time_arr[1];

			var hours = Number(delivery_time_hr);
			var minutes = Number(delivery_time_min);
			var AMPM = delivery_time_ampm;
			if(AMPM == "pm" && hours<12) hours = hours+12;
			if(AMPM == "am" && hours==12) hours = hours-12;
			var sHours = hours.toString();
			var sMinutes = minutes.toString();
			if(hours<10) sHours = "0" + sHours;
			if(minutes<10) sMinutes = "0" + sMinutes;

			var formattedConsumptionTime = new Date(year, month, day, sHours, sMinutes, 00);

			// console.log(formattedConsumptionTime);

			Date.prototype.addHours= function(h){
			    this.setHours(this.getHours()+h);
			    return this;
			}

			// set required time
			// var validTimes = ['06:00:00', '18:00:00'];
			// var validTimes2 = ['06:00:00', '22:00:00'];
			var validTime = formattedConsumptionTime.addHours(4);

			var formattedTime = convertAMPM(hr, min, ampm);

			// set required date
			// console.log(hours + '-' + minutes);			
			// console.log(sHours + '-' + sMinutes);			
			// var delivery_date = year + '-' + month + '-' + day + '-' + ;
			var delivery_date = year + '-' + month + '-' + day + 'T'+sHours+':'+sMinutes+':00Z';
			console.log(delivery_date);
			var formattedDate = new Date(year, month-1, day, sHours, sMinutes, 00);
			console.log(formattedDate);
			var twoDayInAdvance = addDays(new Date(), 2);

			var validTime_arr = validTime.toString().split(' ');
			var formattedValidTime = $.trim(validTime_arr[4]);

			// console.log(formattedTime);
			// console.log(formattedValidTime);

			var error = false;

			// delivery area
			if(parseFloat(cartAmount) < 100 && location == 'allotherarea') {

				$('.error-deliver-sentosa').html('');
				$('.error-deliver-otherarea').html('Minimum purchase of S$100 required for delivery to this area.');
				error = true;

			}else if(parseFloat(cartAmount) < 120 && location == 'jurongsentoaarea') {

				$('.error-deliver-otherarea').html('');
				$('.error-deliver-sentosa').html('Minimum purchase of S$120 required for delivery to this area.');
				error = true;

			}else {
				$('.error-deliver-otherarea').html('');
				$('.error-deliver-sentosa').html('');
			}

			var chosen_date = year + '-' + month + '-' + day;
			var chosen_timeslot = $('#delivery_time')[0].selectedIndex;
			var blackout_dates = $('#delivery_blackout_date').val().split(',');
			var blackout_receiving_modes = $('#delivery_blackout_receiving_mode').val().split(',');
			var blackout_timeframes = $('#delivery_blackout_timeframe').val().split(',');
			var blackout_date_index = blackout_dates.indexOf(chosen_date);

			var i = -1,
			    indizes = [];

		    // if there are same multiple blackout date but different time and collection type!
			while((i = blackout_dates.indexOf(chosen_date, i + 1)) !== -1) {
			    indizes.push(i);
			}

			// console.log(indizes);

			if(indizes.length>1) {
				for(var j=0;j<indizes.length;j++) {
					var blackout_date_index = indizes[j];

					var blackout_receiving_mode = blackout_receiving_modes[blackout_date_index];
					var blackout_timeframe = blackout_timeframes[blackout_date_index];

					// console.log(chosen_date)
					// console.log(chosen_timeslot)
					// console.log(blackout_dates)
					// console.log(blackout_receiving_modes)
					// console.log(blackout_date_index)
					// console.log(blackout_receiving_mode)
					// console.log(blackout_timeframe)

					if(blackout_timeframe=='full') {
						var allowtimeslots = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19];
					}else if(blackout_timeframe=='morning') {
						var allowtimeslots = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
					}else if(blackout_timeframe=='evening') {
						var allowtimeslots = [10, 11, 12, 13, 14, 15, 16, 17, 18, 19];
					}else {
						var allowtimeslots = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19];
					}

					// console.log(allowtimeslots)

					console.log(twoDayInAdvance);
					console.log(formattedDate);
					
					// delivery date
					if(day == "" || month == "" || year == "") {

						$('.error-delivery-date').html('Please select delivery date.');
						error = true;

					}else if(twoDayInAdvance > formattedDate) {

						$('.error-delivery-date').html('Orders must be made at least 2 days in advance.');
						error = true;

					}else if((blackout_receiving_mode=='delivery' || blackout_receiving_mode=='both') && jQuery.inArray(chosen_date,blackout_dates) > -1 && jQuery.inArray(chosen_timeslot, allowtimeslots) > -1){

						$('.error-delivery-date').html('Delivery service is not available for selected date and time.');
						error = true;

					}
				}
			}else {
				var blackout_receiving_mode = blackout_receiving_modes[blackout_date_index];
				var blackout_timeframe = blackout_timeframes[blackout_date_index];

				// console.log(chosen_date)
				// console.log(chosen_timeslot)
				// console.log(blackout_dates)
				// console.log(blackout_receiving_modes)
				// // console.log(blackout_date_index)
				// console.log(blackout_receiving_mode)
				// console.log(blackout_timeframes)
				// console.log(blackout_timeframe)

				if(blackout_timeframe=='full') {
					var allowtimeslots = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19];
				}else if(blackout_timeframe=='morning') {
					var allowtimeslots = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
				}else if(blackout_timeframe=='evening') {
					var allowtimeslots = [10, 11, 12, 13, 14, 15, 16, 17, 18, 19];
				}else {
					var allowtimeslots = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19];
				}

				// console.log(allowtimeslots)
				console.log('twoDayInAdvance: '+twoDayInAdvance)
				console.log('formattedDate: '+formattedDate)
				
				// delivery date
				if(day == "" || month == "" || year == "") {

					$('.error-delivery-date').html('Please select delivery date.');
					error = true;

				}else if(twoDayInAdvance > formattedDate) {

					$('.error-delivery-date').html('Orders must be made at least 2 days in advance.');
					error = true;

				}else if((blackout_receiving_mode=='delivery' || blackout_receiving_mode=='both') && jQuery.inArray(chosen_date,blackout_dates) > -1 && jQuery.inArray(chosen_timeslot, allowtimeslots) > -1){

					$('.error-delivery-date').html('Delivery service is not available for selected date and time.');
					error = true;

				}
			}

			if(error==false) $('.error-delivery-date').html('');

			// consumption time
			if(hr == "" || min == "" || ampm == "") {

				$('.error-consumption-time').html('Please select consumption time.');
				error = true;
			}else if(formattedTime > formattedValidTime) {

				$('.error-consumption-time').html('We recommend to consume the food within 4 hrs after collection.');
				error = true;
			}else $('.error-consumption-time').html('');

			if(error==false) $receivingModeDelivery.find('form').submit();

		});

		function appendDeliveryTime(key) {
			var delivery_time = ['<option value="06:00 am - 07:30 am">06:00 am - 07:30 am *</option><option value="06:30 am - 08:00 am">06:30 am - 08:00 am *</option><option value="08:00 am - 09:30 am">08:00 am - 09:30 am ^</option><option value="08:30 am - 10:00 am">08:30 am - 10:00 am ^</option><option value="09:00 am - 10:30 am">09:00 am - 10:30 am</option><option value="09:30 am - 11:00 am">09:30 am - 11:00 am</option><option value="10:00 am - 11:30 am">10:00 am - 11:30 am</option><option value="10:30 am - 12:00 pm">10:30 am - 12:00 pm</option><option value="11:00 am - 12:30 pm">11:00 am - 12:30 pm</option><option value="11:30 am - 01:00 pm">11:30 am - 01:00 pm</option><option value="12:00 pm - 01:30 pm">12:00 pm - 01:30 pm</option><option value="12:30 pm - 02:00 pm">12:30 pm - 02:00 pm</option><option value="01:00 pm - 02:30 pm">01:00 pm - 02:30 pm</option><option value="01:30 pm - 03:00 pm">01:30 pm - 03:00 pm</option><option value="02:00 pm - 03:30 pm">02:00 pm - 03:30 pm</option><option value="02:30 pm - 04:00 pm">02:30 pm - 04:00 pm</option><option value="03:00 pm - 04:30 pm">03:00 pm - 04:30 pm</option><option value="03:30 pm - 05:00 pm">03:30 pm - 05:00 pm</option>', 
			'<option value="06:00 am - 07:30 am">06:00 am - 07:30 am *</option><option value="06:30 am - 08:00 am">06:30 am - 08:00 am *</option><option value="08:00 am - 09:30 am">08:00 am - 09:30 am ^</option><option value="08:30 am - 10:00 am">08:30 am - 10:00 am ^</option><option value="09:00 am - 10:30 am">09:00 am - 10:30 am</option><option value="09:30 am - 11:00 am">09:30 am - 11:00 am</option><option value="10:00 am - 11:30 am">10:00 am - 11:30 am</option><option value="10:30 am - 12:00 pm">10:30 am - 12:00 pm</option><option value="11:00 am - 12:30 pm">11:00 am - 12:30 pm</option><option value="11:30 am - 01:00 pm">11:30 am - 01:00 pm</option><option value="12:00 pm - 01:30 pm">12:00 pm - 01:30 pm</option><option value="12:30 pm - 02:00 pm">12:30 pm - 02:00 pm</option><option value="01:00 pm - 02:30 pm">01:00 pm - 02:30 pm</option><option value="01:30 pm - 03:00 pm">01:30 pm - 03:00 pm</option><option value="02:00 pm - 03:30 pm">02:00 pm - 03:30 pm</option><option value="02:30 pm - 04:00 pm">02:30 pm - 04:00 pm</option><option value="03:00 pm - 04:30 pm">03:00 pm - 04:30 pm</option><option value="03:30 pm - 05:00 pm">03:30 pm - 05:00 pm</option><option value="04:00 pm - 05:30 pm (Sat/PH only)">04:00 pm - 05:30 pm (Sat/PH only)</option><option value="04:30 pm - 06:00 pm (Sat/PH only)">04:30 pm - 06:00 pm (Sat/PH only)</option>'];

			var certain_delivery_time_additional_30 = ['06:00 am - 07:30 am','06:30 am - 08:00 am'];
			var certain_delivery_time_additional_22 = [];

			$receivingModeDelivery.find('select[name="delivery_time"]').html('').append(delivery_time[key]).off('change').on('change', function(e){
				
				var selectedDeliveryTime = $(this).val();
				if($.inArray(selectedDeliveryTime, certain_delivery_time_additional_30) != -1){

					$receivingModeDelivery.find('input[name="surcharge"]').val(30);

				}else if($.inArray(selectedDeliveryTime, certain_delivery_time_additional_22) != -1) {

					$receivingModeDelivery.find('input[name="surcharge"]').val(22);

				}else {

					$receivingModeDelivery.find('input[name="surcharge"]').val(0);

				}

			}).trigger('change');
		}

		function appendCollectionTime(key) {
			var collection_time = ['<option value="06:00 am - 07:30 am">06:00 am - 07:30 am</option><option value="06:30 am - 08:00 am">06:30 am - 08:00 am</option><option value="08:00 am - 09:30 am">08:00 am - 09:30 am</option><option value="08:30 am - 10:00 am">08:30 am - 10:00 am</option><option value="09:00 am - 10:30 am">09:00 am - 10:30 am</option><option value="09:30 am - 11:00 am">09:30 am - 11:00 am</option><option value="10:00 am - 11:30 am">10:00 am - 11:30 am</option><option value="10:30 am - 12:00 pm">10:30 am - 12:00 pm</option><option value="11:00 am - 12:30 pm">11:00 am - 12:30 pm</option><option value="11:30 am - 01:00 pm">11:30 am - 01:00 pm</option><option value="12:00 pm - 01:30 pm">12:00 pm - 01:30 pm</option><option value="12:30 pm - 02:00 pm">12:30 pm - 02:00 pm</option><option value="01:00 pm - 02:30 pm">01:00 pm - 02:30 pm</option><option value="01:30 pm - 03:00 pm">01:30 pm - 03:00 pm</option><option value="02:00 pm - 03:30 pm">02:00 pm - 03:30 pm</option><option value="02:30 pm - 04:00 pm">02:30 pm - 04:00 pm</option><option value="03:00 pm - 04:30 pm">03:00 pm - 04:30 pm</option><option value="03:30 pm - 05:00 pm">03:30 pm - 05:00 pm</option>', 
			'<option value="06:00 am - 07:30 am">06:00 am - 07:30 am</option><option value="06:30 am - 08:00 am">06:30 am - 08:00 am</option><option value="08:00 am - 09:30 am">08:00 am - 09:30 am</option><option value="08:30 am - 10:00 am">08:30 am - 10:00 am</option><option value="09:00 am - 10:30 am">09:00 am - 10:30 am</option><option value="09:30 am - 11:00 am">09:30 am - 11:00 am</option><option value="10:00 am - 11:30 am">10:00 am - 11:30 am</option><option value="10:30 am - 12:00 pm">10:30 am - 12:00 pm</option><option value="11:00 am - 12:30 pm">11:00 am - 12:30 pm</option><option value="11:30 am - 01:00 pm">11:30 am - 01:00 pm</option><option value="12:00 pm - 01:30 pm">12:00 pm - 01:30 pm</option><option value="12:30 pm - 02:00 pm">12:30 pm - 02:00 pm</option><option value="01:00 pm - 02:30 pm">01:00 pm - 02:30 pm</option><option value="01:30 pm - 03:00 pm">01:30 pm - 03:00 pm</option><option value="02:00 pm - 03:30 pm">02:00 pm - 03:30 pm</option><option value="02:30 pm - 04:00 pm">02:30 pm - 04:00 pm</option><option value="03:00 pm - 04:30 pm">03:00 pm - 04:30 pm</option><option value="03:30 pm - 05:00 pm">03:30 pm - 05:00 pm</option><option value="04:00 pm - 05:30 pm (Sat/PH only)">04:00 pm - 05:30 pm (Sat/PH only)</option><option value="04:30 pm - 06:00 pm (Sat/PH only)">04:30 pm - 06:00 pm (Sat/PH only)</option>'];

			var certain_collection_time_additional_30 = ['06:00 am - 07:30 am','06:30 am - 08:00 am'];
			var certain_collection_time_additional_22 = [];

			$receivingModeCollection.find('select[name="collection_time"]').html('').append(collection_time[key]).off('change').on('change', function(e){
				
				var selectedDeliveryTime = $(this).val();
				if($.inArray(selectedDeliveryTime, certain_collection_time_additional_30) != -1){

					$receivingModeCollection.find('input[name="surcharge"]').val(30);

				}else if($.inArray(selectedDeliveryTime, certain_collection_time_additional_22) != -1) {

					$receivingModeCollection.find('input[name="surcharge"]').val(22);

				}else {

					$receivingModeCollection.find('input[name="surcharge"]').val(0);

				}

			}).trigger('change');
		}

		// by default;
		appendDeliveryTime(0);
		appendCollectionTime(0);

		$receivingModeDelivery.find('input[name="delivery"]').on('change', function(e){

			e.preventDefault();

			if($(this).val()=="allotherarea") {
				appendDeliveryTime(0);
				$('.error-deliver-sentosa').html('');
			}else {
				// appendDeliveryTime(1);
				appendDeliveryTime(0);
				$('.error-deliver-sentosa').html('Delivery surcharge of $8 will be applied for this area.');
			}

		});

		$('#delivery_date_year').on('change', function(e){
			var month = $("#delivery_date_month").val();
			var day = $("#delivery_date_day").val();
			var year = $(this).val();

			if(year && month && day) {
				var selectedDate = new Date(year,month-1,day);
				var selectedDateString = year+'-'+month+'-'+day;
				var holiday_dates = $('#delivery_holiday_date').val().split(',');
				
		        if(selectedDate.getDay() === 6 || selectedDate.getDay() === 0 || $.inArray(selectedDateString, holiday_dates) != -1) {
		        	appendDeliveryTime(1);
		        }else {
		        	appendDeliveryTime(0);
		        }	
			}
		});

		$('#delivery_date_month').on('change', function(e){
			var month = $(this).val();
			var day = $("#delivery_date_day").val();
			var year = $("#delivery_date_year").val();

			if((day == 25 && month == 12) || (day == 24 && month == 12) || (day == 01 && month == 01) || (day == 31 && month == 12)) {

				$('.error-delivery-date').html('Delivery surcharge of $20.00 will be applied for this date.');

			}else {
				$('.error-delivery-date').html('');				
			}

			if(year && month && day) {
				var selectedDate = new Date(year,month-1,day);
				var selectedDateString = year+'-'+month+'-'+day;
				var holiday_dates = $('#delivery_holiday_date').val().split(',');

		        if(selectedDate.getDay() === 6 || selectedDate.getDay() === 0 || $.inArray(selectedDateString, holiday_dates) != -1) {
		        	appendDeliveryTime(1);
		        }else {
		        	appendDeliveryTime(0);
		        }	
			}
		});

		$('#delivery_date_day').on('change', function(e){
			var month = $("#delivery_date_month").val();
			var day = $(this).val();
			var year = $("#delivery_date_year").val();

			if((day == 25 && month == 12) || (day == 24 && month == 12) || (day == 01 && month == 01) || (day == 31 && month == 12)) {

				$('.error-delivery-date').html('Delivery surcharge of $20.00 will be applied for this date.');

			}else {
				$('.error-delivery-date').html('');				
			}

			if(year && month && day) {
				var selectedDate = new Date(year,month-1,day);
				var selectedDateString = year+'-'+month+'-'+day;
				var holiday_dates = $('#delivery_holiday_date').val().split(',');

		        if(selectedDate.getDay() === 6 || selectedDate.getDay() === 0 || $.inArray(selectedDateString, holiday_dates) != -1) {
		        	appendDeliveryTime(1);
		        }else {
		        	appendDeliveryTime(0);
		        }	
			}
		});

		$('#delivery_date').datepicker({
			minDate: 2,
			onSelect: function(dateText) {
				var pieces = dateText.split("/");

				if((pieces[1] == 25 && pieces[0] == 12) || (pieces[1] == 24 && pieces[0] == 12) || (pieces[1] == 01 && pieces[0] == 01) || (pieces[1] == 31 && pieces[0] == 12)) {
					$('.error-delivery-date').html('Delivery surcharge of $20.00 will be applied for this date.');
				}else {
					$('.error-delivery-date').html('');				
				}

		        $("#delivery_date_month").val(pieces[0]);
		        $("#delivery_date_day").val(pieces[1]);
		        $("#delivery_date_year").val(pieces[2]);
		        $('#delivery_date').val(dateText);

		        // month must be 1 less super weird
		        var selectedDate = new Date(pieces[2],pieces[0]-1,pieces[1]);
		        var selectedDateString = pieces[2]+'-'+pieces[0]+'-'+pieces[1];
				var holiday_dates = $('#delivery_holiday_date').val().split(',');
		       
		        if(selectedDate.getDay() === 6 || selectedDate.getDay() === 0 || $.inArray(selectedDateString, holiday_dates) != -1) {
		        	appendDeliveryTime(1);
		        }else {
		        	appendDeliveryTime(0);
		        }
		    }
		});
		$("#delivery_datepicker").click(function(e) {
			e.preventDefault();
			$('#delivery_date').show().focus().hide();
		});

		$('#collection_date_year').on('change', function(e){
			var month = $("#delivery_date_month").val();
			var day = $("#delivery_date_day").val();
			var year = $(this).val();

			if(year && month && day) {
				var selectedDate = new Date(year,month-1,day);
				var selectedDateString = year+'-'+month+'-'+day;
				var holiday_dates = $('#collection_holiday_date').val().split(',');

		        if(selectedDate.getDay() === 6 || selectedDate.getDay() === 0 || $.inArray(selectedDateString, holiday_dates) != -1) {
		        	appendCollectionTime(1);
		        }else {
		        	appendCollectionTime(0);
		        }	
			}
		});
		$('#collection_date_month').on('change', function(e){
			var month = $(this).val();
			var day = $("#delivery_date_day").val();
			var year = $("#delivery_date_year").val();

			if(year && month && day) {
				var selectedDate = new Date(year,month-1,day);
				var selectedDateString = year+'-'+month+'-'+day;
				var holiday_dates = $('#collection_holiday_date').val().split(',');

		        if(selectedDate.getDay() === 6 || selectedDate.getDay() === 0 || $.inArray(selectedDateString, holiday_dates) != -1) {
		        	appendCollectionTime(1);
		        }else {
		        	appendCollectionTime(0);
		        }	
			}
		});
		$('#collection_date_day').on('change', function(e){
			var month = $("#delivery_date_month").val();
			var day = $(this).val();
			var year = $("#delivery_date_year").val();

			if(year && month && day) {
				var selectedDate = new Date(year,month-1,day);
				var selectedDateString = year+'-'+month+'-'+day;
				var holiday_dates = $('#collection_holiday_date').val().split(',');

		        if(selectedDate.getDay() === 6 || selectedDate.getDay() === 0 || $.inArray(selectedDateString, holiday_dates) != -1) {
		        	appendCollectionTime(1);
		        }else {
		        	appendCollectionTime(0);
		        }	
			}
		});

		$('#collection_date').datepicker({
			minDate: 2,
			onSelect: function(dateText) {
				var pieces = dateText.split("/");
		        $("#collection_date_month").val(pieces[0]);
		        $("#collection_date_day").val(pieces[1]);
		        $("#collection_date_year").val(pieces[2]);
		        $('#collection_date').val(dateText);

		         // month must be 1 less super weird
		        var selectedDate = new Date(pieces[2],pieces[0]-1,pieces[1]);
		        var selectedDateString = pieces[2]+'-'+pieces[0]+'-'+pieces[1];
				var holiday_dates = $('#collection_holiday_date').val().split(',');
		       
		        if(selectedDate.getDay() === 6 || selectedDate.getDay() === 0 || $.inArray(selectedDateString, holiday_dates) != -1) {
		        	appendCollectionTime(1);
		        }else {
		        	appendCollectionTime(0);
		        }
		    }
		});
		$("#collection_datepicker").click(function(e) {
			e.preventDefault();
			$('#collection_date').show().focus().hide();
		});

		$shippingDropdownDiv.hide();

		function hide_shipping_address_data() {
			$shippingInfoList.prev('h4').html('');
			$shippingInfoList.children('span').html('');
			$shippingInfoList.next('.update').html('');
		}

		function show_shipping_address_data(shippingAddress) {
			$shippingInfoList.prev('h4').html('DELIVERY ADDRESS:');
			$shippingInfoList.children('.name').html(shippingAddress.first_name + ' ' + shippingAddress.last_name);
			$shippingInfoList.children('.address-1').html(shippingAddress.address_1);
			$shippingInfoList.children('.address-2').html(shippingAddress.address_2);
			$shippingInfoList.children('.country').html(shippingAddress.country);
			$shippingInfoList.children('.postcode').html(shippingAddress.postcode);
			$billingInfoList.children('.city').html(shippingAddress.city);
			$shippingInfoList.children('.tel').html(shippingAddress.phone);
			$shippingInfoList.children('.mobile').html(shippingAddress.mobile);
			$shippingInfoList.next('.update').html('UPDATE');
		}

		function hide_billing_address_data() {
			$billingInfoList.prev('h4').html('');
			$billingInfoList.children('span').html('');
			$billingInfoList.next('.update').html('');
		}

		function show_billing_address_data(billingAddress) {
			$billingInfoList.prev('h4').html('BILLING ADDRESS:');
			$billingInfoList.children('.name').html(billingAddress.first_name + ' ' + billingAddress.last_name);
			$billingInfoList.children('.address-1').html(billingAddress.address_1);
			$billingInfoList.children('.address-2').html(billingAddress.address_2);
			$billingInfoList.children('.country').html(billingAddress.country);
			$billingInfoList.children('.postcode').html(billingAddress.postcode);
			$billingInfoList.children('.city').html(billingAddress.city);
			$billingInfoList.children('.tel').html(billingAddress.phone);
			$billingInfoList.children('.mobile').html(billingAddress.mobile);
			$billingInfoList.next('.update').html('UPDATE');
		}

		$billingDropdown.on('change', function(e){
			e.preventDefault();

			var billingAddress_json = $(this).val();

			// if user select address
			if(billingAddress_json!='') {

				var billingAddress = jQuery.parseJSON( billingAddress_json );

				show_billing_address_data(billingAddress);
				$billinginputHidden.val(billingAddress_json);

				// if shipping is the same
				if( $sameasbillingCheckbox.prop('checked') ) {

					show_shipping_address_data(billingAddress);
					$shippinginputHidden.val(billingAddress_json);

					$shippingDropdownDiv.slideUp();
				}else {

					$shippingDropdownDiv.slideDown();

				}

			}else {

				hide_billing_address_data();
				$billinginputHidden.val('');

				// if shipping is the same
				if( $sameasbillingCheckbox.prop('checked') ) {

					hide_shipping_address_data();
					$shippinginputHidden.val('');
				}
			}
		});

		$sameasbillingCheckbox.on('change', function(e){
			e.preventDefault();

			// if shipping is the same
			if($(this).prop('checked')) {
				var fields = $('form#billingaddress-form').serializeObject();
				var billing_fields_json = JSON.stringify(fields);

				if($billingDropdown.val()){

					var billingAddress_json = $billingDropdown.val();
					var billingAddress = jQuery.parseJSON( billingAddress_json );

					show_shipping_address_data(billingAddress);
					$shippinginputHidden.val(billingAddress_json);

				}else if(fields) {
					show_shipping_address_data(fields);
					$shippingInfoList.next('.update').html('');
					$shippinginputHidden.val(billing_fields_json);					
				}

				$shippingDropdownDiv.slideUp();

			}else {
				if($billingDropdown.val()!='') {
					hide_shipping_address_data();
					$shippinginputHidden.val('');
				}

				$shippingDropdownDiv.slideDown();
				
				if($shippingDropdown.val())
					$shippingDropdown.trigger('change');
			}
		});

		function setAddressInTheForm(Address, dropDownIndex) {
			$newFormContainer.find('input[name="first_name"]').val(Address.first_name);
			$newFormContainer.find('input[name="last_name"]').val(Address.last_name);
			$newFormContainer.find('input[name="company"]').val(Address.company);
			$newFormContainer.find('input[name="address_1"]').val(Address.address_1);
			$newFormContainer.find('input[name="address_2"]').val(Address.address_2);
			$newFormContainer.find('input[name="postcode"]').val(Address.postcode);
			$newFormContainer.find('input[name="city"]').val(Address.city);
			$newFormContainer.find('select[name="country"]').val(Address.country);
			$newFormContainer.find('textarea[name="addition_info"]').val(Address.addition_info);
			$newFormContainer.find('input[name="phone"]').val(Address.phone);
			$newFormContainer.find('input[name="mobile"]').val(Address.mobile);
			$newFormContainer.find('input[name="existing_or_new"]').val('existing');
			$newFormContainer.find('input[name="address_book_id"]').val(dropDownIndex);
		}

		function clearAddressIntheForm(dropDownLastIndex) {
			$newFormContainer.find('input[name="first_name"]').val('');
			$newFormContainer.find('input[name="last_name"]').val('');
			$newFormContainer.find('input[name="company"]').val('');
			$newFormContainer.find('input[name="address_1"]').val('');
			$newFormContainer.find('input[name="address_2"]').val('');
			$newFormContainer.find('input[name="postcode"]').val('');
			$newFormContainer.find('input[name="city"]').val('');
			$newFormContainer.find('textarea[name="addition_info"]').val('');
			$newFormContainer.find('input[name="phone"]').val('');
			$newFormContainer.find('input[name="mobile"]').val('');
			$newFormContainer.find('input[name="existing_or_new"]').val('new');
			$newFormContainer.find('input[name="address_book_id"]').val(dropDownLastIndex);

			console.log($sameasbillingCheckbox.prop('checked'));
			if($sameasbillingCheckbox.prop('checked')) {
				$newFormContainer.find('input[name="same_as_billing"]').val('yes');
			}else {
				$newFormContainer.find('input[name="same_as_billing"]').val('no');
			}
		}

		$billingInfoList.next('.update').on('click', function(e){
			
			e.preventDefault();

			if($billingDropdown.val()){

				var billingAddress_json = $billingDropdown.val();
				var billingAddress = jQuery.parseJSON( billingAddress_json );

				var billingDropdownIndex = $billingDropdown.prop("selectedIndex");

				console.log(billingDropdownIndex);

				setAddressInTheForm(billingAddress, billingDropdownIndex);

				$newFormContainer.find('.billing-location-title').html('UPDATE BILLING LOCATION TYPE:')
				$newFormContainer.find('.billing-address-title').html('UPDATE ADDRESS:')
			}

			$selectAddressContainer.hide();
			$newFormContainer.show();
			$newBillingAddressForm.show();

		});

		$shippingInfoList.next('.update').on('click', function(e){
			
			e.preventDefault();

			if($shippingDropdown.val()){

				var shippingAddress_json = $shippingDropdown.val();
				var shippingAddress = jQuery.parseJSON( shippingAddress_json );

				var shippingDropdownIndex = $shippingDropdown.prop("selectedIndex");

				setAddressInTheForm(shippingAddress, shippingDropdownIndex);

				$newFormContainer.find('.delivery-location-title').html('UPDATE DELIVERY LOCATION TYPE:')
				$newFormContainer.find('.delivery-address-title').html('UPDATE ADDRESS:')

			}else if($billingDropdown.val()){

				var billingAddress_json = $billingDropdown.val();
				var billingAddress = jQuery.parseJSON( billingAddress_json );

				var billingDropdownIndex = $billingDropdown.prop("selectedIndex");

				setAddressInTheForm(billingAddress, billingDropdownIndex);
			}

			$selectAddressContainer.hide();
			$newFormContainer.show();
			$newShippingAddressForm.show();

		});

		$shippingDropdown.on('change', function(e){

			e.preventDefault();
			var shippingAddress_json = $(this).val();

			if(shippingAddress_json) {

				var shippingAddress = jQuery.parseJSON( shippingAddress_json );
				
				show_shipping_address_data(shippingAddress);
				$shippinginputHidden.val(shippingAddress_json);

			}else {

				hide_shipping_address_data();
				$shippinginputHidden.val('');

			}

		});

		$addNewBillingBtn.on('click', function(e){

			e.preventDefault();
			var billingDropdownIndex = $('.billing_address option:last-child').index();

			console.log(billingDropdownIndex)

			$selectAddressContainer.hide();
			$newFormContainer.show();
			clearAddressIntheForm(billingDropdownIndex);
			$newFormContainer.find('.billing-location-title').html('ADD BILLING LOCATION TYPE:')
			$newFormContainer.find('.billing-address-title').html('ADD NEW ADDRESS:')

			$newBillingAddressForm.show();
		});

		$addNewShippingBtn.on('click', function(e){

			e.preventDefault();
			var shippingDropdownIndex = $('.delivery_address option:last-child').index();

			console.log(shippingDropdownIndex)

			if($sameasbillingCheckbox.prop('checked')) $sameasbillingCheckbox.trigger('click');

			$selectAddressContainer.hide();
			$newFormContainer.show();
			clearAddressIntheForm(shippingDropdownIndex);
			$newFormContainer.find('.delivery-location-title').html('ADD DELIVERY LOCATION TYPE:')
			$newFormContainer.find('.delivery-address-title').html('ADD NEW ADDRESS:')

			$newShippingAddressForm.show();
		});

		/* SERIALIZING OBJ */
	    $.fn.serializeObject = function()
		{
		    var o = {};
		    var a = this.serializeArray();
		    $.each(a, function() {
		        if (o[this.name] !== undefined) {
		            if (!o[this.name].push) {
		                o[this.name] = [o[this.name]];
		            }
		            o[this.name].push(this.value || '');
		        } else {
		            o[this.name] = this.value || '';
		        }
		    });
		    return o;
		};

		$saveBillingAddressBtn.on('click', function(e){

			e.preventDefault();

			if($('form#billingaddress-form').valid()) {
				$selectAddressContainer.show();
				$newFormContainer.hide();
				$newBillingAddressForm.hide();

				var fields = $( this ).closest('form').serializeObject();
				var billing_fields_json = JSON.stringify(fields);

				show_billing_address_data(fields);
				$billingInfoList.next('.update').html('');
				$billinginputHidden.val(billing_fields_json);

				if($sameasbillingCheckbox.prop('checked')){
					show_shipping_address_data(fields);
					$shippingInfoList.next('.update').html('');
					$shippinginputHidden.val(billing_fields_json);
				}
			}
		});

		$cancelBillingAddressBtn.on('click', function(e){

			e.preventDefault();
			$selectAddressContainer.show();
			$newFormContainer.hide();
			$newBillingAddressForm.hide();

		});

		$saveDeliveryAddressBtn.on('click', function(e){

			e.preventDefault();

			if($('form#shippingaddress-form').valid()) {
				$selectAddressContainer.show();
				$newFormContainer.hide();
				$newShippingAddressForm.hide();

				var fields = $( this ).closest('form').serializeObject();
				var shipping_fields_json = JSON.stringify(fields);

				show_shipping_address_data(fields);
				$shippingInfoList.next('.update').html('');
				$shippinginputHidden.val(shipping_fields_json);
			}
		});

		$cancelDeliveryAddressBtn.on('click', function(e){

			e.preventDefault();
			$selectAddressContainer.show();
			$newFormContainer.hide();
			$newShippingAddressForm.hide();

		});

		$checkoutBtn.on('click', function(e){
			e.preventDefault();

			if($('form#submitcheckout').valid()){
				$checkoutForm.submit();
			}
		});

		$backToReceivingModeBtn.on('click', function(e){
			e.preventDefault();

			$backToReceivingModeForm.submit();
		});

		$checkOutPaymentModeNextBtn.on('click', function(e){
			e.preventDefault();

			$paymentModeContainer.hide();
			var paymentmethod = $('input[name=paymentmethod]:checked').val();

			if(paymentmethod == 'Personal Payment') {

				$personalPaymentModeContainer.show();
			}else {
				$corporatePaymentModeContainer.show();
			}

		});

		$backToSelectAddressBtn.on('click', function(e) {
			e.preventDefault();

			$backToSelectAddressForm.submit();
		});

		function clearPaymentInputs() {
			$('input#pay_by_cash_outlet').attr('value', '');
			$('input#interbank_giro_order_no').attr('value', '');
			$('input#agd_event_code_name').attr('value', '');
		}

		$personalPaymentBtn.on('click', function(e){
			e.preventDefault();

			$personalPaymentModeContainer.hide();
			$orderSummaryContainer.show();

			var choosedPersonalPaymentMethod = $personalPaymentModeContainer.find('input[name="personal_payment_method"]:checked').val();

			if(choosedPersonalPaymentMethod=='Advance payment by internet funds transfer/ATM') {
				$('#payment_method_advance_payment_by_internet_banking_atm').trigger('click');
				clearPaymentInputs();
			}
			else if(choosedPersonalPaymentMethod=='Advance payment by cash at outlets') {
				$('#payment_method_advance_payment_by_cash_at_outlets').trigger('click');
				var chosenOutlet = $('.personal-payment').find('select[name="outlets"]').val();
				$('input#pay_by_cash_outlet').attr('value', chosenOutlet);
				$('input#interbank_giro_order_no').attr('value', '');
				$('input#agd_event_code_name').attr('value', '');
			}
			else {
				$('#payment_method_cod').trigger('click');
				clearPaymentInputs();
			}
				
			$orderDetailContainer.show();
			$orderDetailContainer.find('.paymentby-value').html(choosedPersonalPaymentMethod);

			$progressIndicator.find('.sixth').children('.circle-holder').children('.circle-text').addClass('active');
			$progressIndicator.find('.sixth').children('.circle-holder').children('.circle').addClass('done');
		});

		$personalPaymentCancelBtn.on('click', function(e){
			$paymentModeContainer.show();
			$personalPaymentModeContainer.hide();
		});

		$corporatePaymentBtn.on('click', function(e){
			e.preventDefault();

			$corporatePaymentModeContainer.hide();
			$orderSummaryContainer.show();

			var choosedCorporatePaymentMethod = $corporatePaymentModeContainer.find('input[name="corporate_payment_method"]:checked').val();
			console.log(choosedCorporatePaymentMethod)

			if(choosedCorporatePaymentMethod=="Advance payment by internet funds transfer/ATM") {
				$('#payment_method_advance_payment_by_internet_banking_atm').trigger('click');
				clearPaymentInputs();
			}
			else if(choosedCorporatePaymentMethod=="Advance payment by cash at outlets") {
				$('#payment_method_advance_payment_by_cash_at_outlets').trigger('click');
				var chosenOutlet = $('.corporate-payment').find('select[name="outlets"]').val();
				$('input#pay_by_cash_outlet').attr('value', chosenOutlet);
			}
			else if(choosedCorporatePaymentMethod=="Corporate cheque") {
				$('#payment_method_cheque').trigger('click');
				clearPaymentInputs();
			}else if(choosedCorporatePaymentMethod=="Credit Terms") {
				$('#payment_method_credit_terms').trigger('click');
				clearPaymentInputs();
			}else if(choosedCorporatePaymentMethod=="GeBiz") {
				$('#payment_method_gebiz').trigger('click');
				clearPaymentInputs();
			}else if(choosedCorporatePaymentMethod=="AGD E-Invoice") {
				$('#payment_method_agd_e_invoice').trigger('click');
				var invoiceCode = $('.corporate-payment').find('input[name="einvoice"]').val();
				$('input#agd_event_code_name').attr('value', invoiceCode);
				$('input#pay_by_cash_outlet').attr('value', '');
				$('input#interbank_giro_order_no').attr('value', '');
			}else if(choosedCorporatePaymentMethod=="Interbank Giro") {
				$('#payment_method_interbank_giro').trigger('click');
				var giroCode = $('.corporate-payment').find('input[name="interbankgiro"]').val();
				$('input#interbank_giro_order_no').attr('value', giroCode);
				$('input#pay_by_cash_outlet').attr('value', '');
				$('input#agd_event_code_name').attr('value', '');
			}else {
				$('#payment_method_cod').trigger('click');
				clearPaymentInputs();
			}

			$orderDetailContainer.show();
			$orderDetailContainer.find('.paymentby-value').html(choosedCorporatePaymentMethod);

			$progressIndicator.find('.sixth').children('.circle-holder').children('.circle-text').addClass('active');
			$progressIndicator.find('.sixth').children('.circle-holder').children('.circle').addClass('done');
		});

		$corporatePaymentCancelBtn.on('click', function(e){
			$paymentModeContainer.show();
			$corporatePaymentModeContainer.hide();
		});

		$submissionPrevBtn.on('click', function(e){
			e.preventDefault();

			$paymentModeContainer.show();
			$orderSummaryContainer.hide();
			$orderDetailContainer.hide();
		});
		
		$confirmOrderBtn.one('click', function(e){
			e.preventDefault();

			$('#place_order').trigger('click');

			$(this).attr("disabled", true);
		});

		$checkOutTermContainer.find('input[name="tnc"]').on('click', function(){
			$('#terms').trigger('click');
		});	

		// general trigger click event

		$('.radio-label').on('click', function(e){
			$(this).prev('input[type="radio"]').trigger('click');
		});

		$('.checkbox-label').on('click', function(e){
			$(this).prev('input[type="checkbox"]').trigger('click');
		});

		$('select[name="outlets"]').on('change', function(e){
			e.preventDefault();
			$(this).parent('div').parent('li').find('input[type="radio"]').trigger('click');
		});

		function isInt(value) {
		   return !isNaN(value) && parseInt(Number(value)) == value;
		}

		var makeRequest = function(Data, URL, Method) {

	    	var request = $.ajax({
			    url: URL,
			    type: Method,
			    data: Data,
			    success: function(response) {
			        // if success remove current item
			        // console.log(response);
			    },
	            error: function( error ){
	                // Log any error.
	                // console.log( "ERROR:", error );
	            }
			});

			return request;
		};

		// min order validation // add to cart btn // just that they wanted it ajax way :S

		$('.single_add_to_cart_button, .add_to_cart_button').on('click', function(e){

			e.preventDefault();

			var minOrder = parseInt($(this).parent('form').find('#min-order').html()),
				currentQty = $(this).parent('form').find('#qty').val(),
				$self = $(this),
				$addToCartForm = $(this).closest('form'),
				data = $addToCartForm.serialize(),
				current_url = $(location).attr('href'),
				postRequest,
				result;

			// if there is different min order for each variation
			var minOrderRaw = $(this).parent('form').find('#min-order').html();
			var exploded;

			if (minOrderRaw.indexOf("|") >= 0) {
				exploded = minOrderRaw.split(' | ');

				var SelectedIndex = $(this).parent('form').find('.dropdown').children('select')[0].selectedIndex;

				minOrder = exploded[SelectedIndex];
			}


			var product_id = $(this).parent('form').find('input[name="add-to-cart"]').val();
			var variation_id = $(this).parent('form').find('input[name="variation_id"]').val();
			var multipleof;

			if((product_id==99 && variation_id==273) || (product_id==83 && variation_id==276) || (product_id==277 && variation_id==278)) {
				if (currentQty % 50 == 0) {
					valid_qty = true;
				}else {
					valid_qty = false;
					multipleof = 50;
				}
			}else if((product_id==422) || (product_id==425) || (product_id==427) || (product_id==429) || (product_id==880)) {
				if (currentQty % 10 == 0) {
					valid_qty = true;
				}else {
					valid_qty = false;
					multipleof = 10;
				}
			}else {
				valid_qty = true;
			}

			console.log(valid_qty)

			if (isInt(currentQty)) {

					var minOrder = parseInt(minOrder)
					var currentQty = parseInt(currentQty)

					if($.isNumeric(minOrder) && minOrder > currentQty ) {
						console.log($(this).parent('form').find('#qty').val());
						$(this).parent('form').children('.error-msg').html('Min order of '+minOrder+' is required.');
					}else {

						if(valid_qty) {

							if(postRequest) {
								request.abort();
							}

							postRequest = makeRequest(data, current_url, 'POST');				

							postRequest.done(function(data, textStatus, jqXHR){
					        	
					        	if(jqXHR.status==200) {
					        		$self.next('span').html('Added To Cart! <a href="'+templateUrl+'/cart">View Cart</a>').show().delay(5000).fadeOut();

					        		// item count
					        		var label = $('.cart-items-count-label').text(),
					        			labelArr = label.split('ITEMS -'),
					        			cartItemCount = $.trim(labelArr[0]),
					        			newCartItemCount = parseInt(cartItemCount) + parseInt(currentQty);

					        		$('.cart-items-count-label').text(newCartItemCount + ' ITEMS -');

					        		// total amount
					        		var currentAmount = $('.cart-price .amount').text(),
					        			currentAmountArr = currentAmount.split('$'),
					        			intCurrentAmount = $.trim(currentAmountArr[1]),
					        			itemPrice = $self.closest('form').parent().parent().find('.amount').text(),
					        			itemPriceArr = itemPrice.split('$'),
					        			ItemPriceNumber = $.trim(itemPriceArr[1]),
					        			unitPrice = parseFloat(ItemPriceNumber) * parseFloat(currentQty),
					        			newAmount = parseFloat(intCurrentAmount) + parseFloat(unitPrice);

					        			console.log(intCurrentAmount);
					        			console.log(itemPrice);

					        		$('.cart-price .amount').text('$' + newAmount.toFixed(2));

					        	}
					        });

					        postRequest.fail(function(jqXHR, textStatus, errorThrown){

					        	console.log(errorThrown);
					        });

							return false;

						}else {
							$(this).parent('form').children('.error-msg').html('Quantity must be multiple of '+multipleof+'!');
						}			
					}

			}else {
				$(this).parent('form').children('.error-msg').html('Quantity is not a valid number!');
			}

		});

		$( '.variations_form .variations select' ).on('change', function(e){

			e.preventDefault();
			var selectedAttr = $(this).val();

			// for single
			$(this).closest('form').parent('div').find('.variable-price').hide();
			$(this).closest('form').parent('div').find('.'+selectedAttr).show();

			// for loop
			$(this).closest('form').parent('div').next('div').find('.variable-price').hide();
			$(this).closest('form').parent('div').next('div').find('.'+selectedAttr).show();

		});
		$( '.variations_form .variations select' ).trigger('change');

		$cartContainer.find('input[name="update_cart"]').on('click', function(e){
			var minOrder = parseInt($(this).prev('span#min-order').html());
			var currentQty = $(this).parent().prev('#qty').val();

			if (isInt(currentQty)) {
				if($.isNumeric(minOrder) && minOrder > currentQty ) {
					$(this).parent('span.update').next('.error-msg').html('Min Order of '+minOrder+' is required.').css({
						display: "block",
						width: "150px",
						"margin-left": "0px"
					});

					return false;

				}else {
					return true;
				}

			}else {
				$(this).parent('span.update').next('.error-msg').html('Quantity is not a valid number!').css({
						display: "block",
						width: "150px",
						"margin-left": "0px"
					});

				return false;
			}
		});

		$contactContainer.find('#contact-form').validate({
			rules: {
				subject: {
					required: true
				},
				email : {
					required: true,
					email: true
				},
				message: "required"
			},
			messages: {
				subject: {
					required: "Please choose subject",
				},
				email : {
					required: "Please fill in your email",
					email: "Invalid email"
				},
				message: "Please fill in your message"
			},
			errorPlacement: function(error, element) {
			    if (element.attr("name") == "subject") {
			      	error.insertAfter(element.parent());
			    }else {
			      	error.insertAfter(element);
			    }
		  	}
		});

		function toggleView(){
			$allProductContainer.find('.product').toggleClass('grid').children('div').toggleClass('row').children('div').toggleClass();
			$allProductContainer.find('.product').children('div').children('div:last-child').toggleClass('price-wrapper');
			$allProductContainer.find('.product').next('div').toggleClass();
			$allProductContainer.find('.product').next('div:last-child').toggleClass('space30');
			$allProductContainer.find('.product').children('div').find('.desc').toggleClass('grid-desc').prev('a').children('h2').toggleClass('grid-title');
			$allProductContainer.find('.product').children('div').find('.selectors').children('.select-type').toggleClass('grid-select-type').parent('div').toggleClass('grid-selectors');
			$allProductContainer.find('.product').children('div').find('.selectors').find('.dropdown label').toggleClass('grid-label');
			$allProductContainer.find('.product').children('div').find('.desc').children('em').toggleClass('grid-desc');
			$allProductContainer.find('.product').children('div').find('.error-msg').toggleClass('grid-msg');

			// console.log($('.desc').height())
			// console.log($('.desc-2').height())
			// console.log($('.desc-2').height())

			$('.product-content').css('min-height', '0');
			
			// if($allProductContainer.find('.select-type').length != 0) {
			// 	$allProductContainer.find('.product').toggleClass('grid-height');
			// }else {
			// 	$allProductContainer.find('.product').toggleClass('grid-height-2');
			// }

			gridHeightSetting();
		}

		var view = $.cookie("view");
		// console.log(view)

		if( !/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
		 // 	if(view=='listview') {
			// 	$('#viewby li#listview').trigger('click');
			// }
			// else {
				$('#viewby li#listview').trigger('click');
				toggleView();
			// }
		}

		$('#viewby li').on('click', function(e){
			e.preventDefault();
			var selectedId = $(this).attr('id');
			view = $.cookie("view");

			console.log(selectedId)
			console.log(view)

			if(view==selectedId) return false;
			else {
				$.cookie("view", selectedId, { expires : 10 });
				toggleView();
			}
		});

		$('a[rel*="prettyPhoto"]').attr('title','').find('img').bind('contextmenu', function(e) {
		    return false;
		});

		/* two sliders's image lazy loading */
		$('.slider-lazy').lazyload({
	    	event : "sporty",
	    	effect : "fadeIn"
	    });

	    $mainSlider.on('slid.bs.carousel', function () {
		  	$("img.slider-lazy").trigger("sporty");
		});

	    $('.sub-slider-lazy').lazyload({
	    	event : "subsporty",
	    	effect : "fadeIn"
	    });

	    $secondSlider.children('.jcarousel').on('jcarousel:scroll', function(event, carousel, target, animate) {
		    $("img.sub-slider-lazy").trigger("subsporty");
		});    

	 	$('.lazy').lazyload({
	    	effect : "fadeIn"
	    });

	   	/* solving spacing issue for product grid */

	   	function gridHeightSetting() {
	   		var a = 3,
	 		row = 1,
	 		rowsHighestHeight = 0,
	 		rowHighestHeightArr = [];
		    $('.grid').each(function(i, obj) {
		    	var titleHeight = 55;
			    var descHeight = $(this).children().children('div#product-content').children('.desc').height();
			    var descHeight2 = $(this).children().children('div#product-content').children('.desc-2').height();
			    var cartHeight = $(this).children().children('div#product-content').children('.cart').height();
			    var extra = 40;
			    if(!descHeight2) descHeight2 = 0;

			    // calculate height
			   	var currentHeight = descHeight + cartHeight + titleHeight + descHeight2 + extra;

				// reset height row by row	    
			   	if(i+1>a) {
			   		a += 3;
			   		row += 1;
			   		rowsHighestHeight = 0;
			   	}

			   	// $(this).children().children('div#product-content').addClass('row-'+row);
			   	$(this).addClass('row-'+row);

			   	// get common height in each row
			   	if(i+1<=a) {
			   		if(currentHeight > rowsHighestHeight) {
				    	rowsHighestHeight = currentHeight;
				    }

				    rowHighestHeightArr[row-1] = rowsHighestHeight;

				    console.log((i+1)+'`s'+rowsHighestHeight+' row '+row);	    

				    // kept as back up, setting height of its own
				    // $(this).children().children('div#product-content').css('min-height', rowsHighestHeight);
			   	}
			    
			});


			function setRowHeight(row, height) {
				// console.log('row '+ row + ' setting height of ' +height);

	   			$('.row-'+row).children().children('div#product-content').css('min-height', height);
		   	}

		   	for(i=0;i<row;i++) {
		   		// debug
		   		// console.log(i+1 + ':' + rowHighestHeightArr[i])
		   		setRowHeight(i+1, rowHighestHeightArr[i]);

		   	}

		   	// debug
			// console.log(rowHighestHeightArr);
			// console.log(row)
	   	}

	   	gridHeightSetting();

	});	

	var map;
	function initialize() {
		var styles = [
		    {
		        "stylers": [
		            {
		                "hue": "#dd0d0d"
		            }
		        ]
		    },
		    {
		        "featureType": "road",
		        "elementType": "labels",
		        "stylers": [
		            {
		                "visibility": "off"
		            }
		        ]
		    },
		    {
		        "featureType": "road",
		        "elementType": "geometry",
		        "stylers": [
		            {
		                "lightness": 100
		            },
		            {
		                "visibility": "simplified"
		            }
		        ]
		    }
		];

		// ,
		//     {
		//         "featureType": "poi.business",
		//         "elementType": "labels",
		//         "stylers": [
		// 	      { visibility: "off" }
		// 	    ] 
		//     }

		var myLatlng = new google.maps.LatLng(1.367607,103.890236);
		var mapOptions = {
			mapTypeControlOptions: {  
		    	mapTypeIds: ['Styled']  
			},  
			zoom: 16,
			center: myLatlng,
			disableDefaultUI: true,   
			mapTypeId: 'Styled'
		};
		map = new google.maps.Map(document.getElementById('google-map-canvas'),
		  mapOptions);
		var styledMapType = new google.maps.StyledMapType(styles, { name: 'Styled' });  
		map.mapTypes.set('Styled', styledMapType);

		var marker = new google.maps.Marker({
			position: myLatlng,
			map: map,
			title: 'Lee Wee Bros'
		});
	}

	//Add onload to body
	$(window).load(function(){
	    $("img.slider-lazy").trigger("sporty");
	    $("img.sub-slider-lazy").trigger("subsporty");

	    initialize();
	    
	});
});