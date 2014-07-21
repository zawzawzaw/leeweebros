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
			$checkOutTermContainer = $('.terms-container'),
			$progressIndicator = $('.progress-indicator-container'),
			$submissionPrevBtn = $('.submission-prev-btn'),
			$confirmOrderBtn = $('#confirm-order');

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
				username : "required",
				password : {
					required: true,
					minlength: 5
				}
			},
			messages: {
				username: "Please fill in your user name",
				password: {
				  required: "Please fill in your password"
				}
  			}
		});
		$accountLoginContainer.find('form.registeration').validate({
			rules: {
				first_name: "required",
				last_name : "required",
				email: {
					required : true,
					email: true
				},
				address_book_1_first_name: "required",
				address_book_1_last_name: "required",
				address_book_1_address_1: "required",
				address_book_1_postcode: {
					required : true
				},
				address_book_1_city : "required",
				address_book_1_country: "required",
				address_book_1_mobile: "required"
			},
			messages: {
				first_name: "Please fill in your first name",
				last_name : "Please fill in your last name",
				email: {
					required : "Please fill in your email address",
					email: "Invalid email address"
				},
				address_book_1_first_name: "Please fill in your first name",
				address_book_1_last_name: "Please fill in your last name",
				address_book_1_address_1: "Please fill in your address",
				address_book_1_postcode: {
					required : "Please fill in your post code"
				},
				address_book_1_city : "Please fill in your town/city name",
				address_book_1_country: "Please fill in your country",
				address_book_1_mobile: "Please fill in your mobile"
			}
		});

		$accountLoginContainer.find('form.lost_reset_password').validate({
			messages: {
				user_login: "Please fill in your login name or email"
			}
		});

		$accountLoginContainer.find('form.editaccount').validate({
			rules: {
				account_first_name: "required",
				account_last_name : "required",
				account_email: {
					required : true,
					email: true
				},
			},
			messages: {
				account_first_name: "Please fill in your first name",
				account_last_name : "Please fill in your last name",
				account_email: {
					required : "Please fill in your email address",
					email: "Invalid email address"
				},
			}
		});

		$addressContainer.find('form#billingaddress-form').validate({
			rules: {
				first_name: "required",
				last_name : "required",
				address_1: "required",
				postcode: {
					required : true
				},
				city : "required",
				country: "required",
				mobile: "required"
			},
			messages: {
				first_name: "Please fill in your first name",
				last_name : "Please fill in your last name",
				address_1: "Please fill in your address",
				postcode: {
					required : "Please fill in your post code"
				},
				city : "Please fill in your town / city name",
				country: "Please fill in your country",
				mobile: "Please fill in your mobile"
			}
		});

		$addressContainer.find('form#shippingaddress-form').validate({
			rules: {
				first_name: "required",
				last_name : "required",
				address_1: "required",
				postcode: {
					required : true
				},
				city : "required",
				country: "required",
				mobile: "required"
			},
			messages: {
				first_name: "Please fill in your first name",
				last_name : "Please fill in your last name",
				address_1: "Please fill in your address",
				postcode: {
					required : "Please fill in your post code"
				},
				city : "Please fill in your town / city name",
				country: "Please fill in your country",
				mobile: "Please fill in your mobile"
			}
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

			$allReceivingModeContainer.hide();

			if(mode=='self') $receivingModeCollection.show(); 
			else $receivingModeDelivery.show();
			
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

			// set required time
			var validTimes = ['06:00:00', '18:00:00'];
			var formattedTime = convertAMPM(hr, min, ampm);

			// set required date
			var collection_date = month + ' ' + day + ' ' + year;
			var formattedDate = new Date(collection_date);

			var twoDayInAdvance = addDays(new Date(), 1);

			var error = false;

			// collection date
			if(day == "" || month == "" || year == "") {

				$('.error-collection-date').html('Please select collection date.');
				error = true;

			}else if(twoDayInAdvance > formattedDate) {

				$('.error-collection-date').html('Orders must be made at least 2 days in advance.');
				error = true;

			}else $('.error-collection-date').html('');

			// consumption time
			if(hr == "" || min == "" || ampm == "") {

				$('.error-consumption-time').html('Please select consumption time.');
				error = true;

			}else if(validTimes[0] > formattedTime || formattedTime > validTimes[1]) {

				$('.error-consumption-time').html('Please choose within collection time constraint.');
				error = true;

			}else $('.error-consumption-time').html('');

			if(error==false) $receivingModeDelivery.find('form').submit();

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

			// set required time
			var validTimes = ['06:00:00', '18:00:00'];
			var formattedTime = convertAMPM(hr, min, ampm);

			// set required date
			var delivery_date = month + ' ' + day + ' ' + year;
			var formattedDate = new Date(delivery_date);

			var twoDayInAdvance = addDays(new Date(), 1);

			var error = false;

			// delivery area
			if(parseFloat(cartAmount) <= 100 && location == 'allotherarea') {

				$('.error-deliver-sentosa').html('');
				$('.error-deliver-otherarea').html('Minimum purchase of 100S$ require for free delivery to this area.');
				error = true;

			}else if(parseFloat(cartAmount) <= 120 && location == 'jurongsentoaarea') {

				$('.error-deliver-otherarea').html('');
				$('.error-deliver-sentosa').html('Minimum purchase of 120S$ require for free delivery to this area.');
				error = true;

			}else {
				$('.error-deliver-otherarea').html('');
				$('.error-deliver-sentosa').html('');
			}

			// delivery date
			if(day == "" || month == "" || year == "") {

				$('.error-delivery-date').html('Please select delivery date.');
				error = true;

			}else if(twoDayInAdvance > formattedDate) {

				$('.error-delivery-date').html('Orders must be made at least 2 days in advance.');
				error = true;

			}else $('.error-delivery-date').html('');


			// consumption time
			if(hr == "" || min == "" || ampm == "") {

				$('.error-consumption-time').html('Please select consumption time.');
				error = true;
			}else if(validTimes[0] > formattedTime || formattedTime > validTimes[1]) {

				$('.error-consumption-time').html('Please choose within delivery time constraint.');
				error = true;
			}else $('.error-consumption-time').html('');

			if(error==false) $receivingModeDelivery.find('form').submit();

		});

		function appendDeliveryTime(key) {
			var delivery_time = ['<option value="06:00 am - 07:30 am">06:00 am - 07:30 am *</option><option value="06:30 am - 08:00 am">06:30 am - 08:00 am ^</option><option value="07:00 am - 08:30 am">07:00 am - 08:30 am ^</option><option value="07:30 am - 09:00 am">07:30 am - 09:00 am ^</option><option value="08:00 am - 09:30 am">08:00 am - 09:30 am</option><option value="08:30 am - 10:00 am">08:30 am - 10:00 am</option><option value="09:00 am - 10:30 am">09:00 am - 10:30 am</option><option value="09:30 am - 11:00 am">09:30 am - 11:00 am</option><option value="10:00 am - 11:30 am">10:00 am - 11:30 am</option><option value="10:30 am - 12:00 am">10:30 am - 12:00 am</option><option value="11:00 am - 12:30 am">11:00 am - 12:30 am</option><option value="11:30 am - 01:00 pm">11:30 am - 01:00 pm</option><option value="12:00 pm - 01:30 pm">12:00 pm - 01:30 pm</option><option value="12:30 pm - 02:00 pm">12:30 pm - 02:00 pm</option><option value="01:00 pm - 02:30 pm">01:00 pm - 02:30 pm</option><option value="01:30 pm - 03:00 pm">01:30 pm - 03:00 pm</option><option value="02:00 pm - 03:30 pm">02:00 pm - 03:30 pm</option><option value="02:30 pm - 04:00 pm">02:30 pm - 04:00 pm</option><option value="03:00 pm - 04:30 pm">03:00 pm - 04:30 pm</option><option value="03:30 pm - 05:00 pm">03:30 pm - 05:00 pm</option>', 
			'<option value="06:00 am - 07:30 am">06:00 am - 07:30 am *</option><option value="06:30 am - 08:00 am">06:30 am - 08:00 am ^</option><option value="07:00 am - 08:30 am">07:00 am - 08:30 am ^</option><option value="07:30 am - 09:00 am">07:30 am - 09:00 am ^</option><option value="08:00 am - 09:30 am">08:00 am - 09:30 am</option><option value="08:30 am - 10:00 am">08:30 am - 10:00 am</option><option value="09:00 am - 10:30 am">09:00 am - 10:30 am</option><option value="09:30 am - 11:00 am">09:30 am - 11:00 am</option><option value="10:00 am - 11:30 am">10:00 am - 11:30 am</option><option value="10:30 am - 12:00 pm">10:30 am - 12:00 pm</option><option value="11:00 am - 12:30 pm">11:00 am - 12:30 pm</option><option value="11:30 am - 01:00 pm">11:30 am - 01:00 pm</option><option value="12:00 pm - 01:30 pm">12:00 pm - 01:30 pm</option><option value="12:30 pm - 02:00 pm">12:30 pm - 02:00 pm</option><option value="01:00 pm - 02:30 pm">01:00 pm - 02:30 pm</option><option value="01:30 pm - 03:00 pm">01:30 pm - 03:00 pm</option><option value="02:00 pm - 03:30 pm">02:00 pm - 03:30 pm</option><option value="02:30 pm - 04:00 pm">02:30 pm - 04:00 pm</option><option value="03:00 pm - 04:30 pm">03:00 pm - 04:30 pm</option><option value="03:30 pm - 05:00 pm">03:30 pm - 05:00 pm</option><option value="04:00 pm - 05:30 pm (Sat/PH only)">04:00 pm - 05:30 pm (Sat/PH only)</option><option value="04:30 pm - 06:00 pm (Sat/PH only)">04:30 pm - 06:00 pm (Sat/PH only)</option>'];

			var certain_delivery_time_additional_30 = ['06:00 am - 07:30 am'];
			var certain_delivery_time_additional_22 = ['06:30 am - 08:00 am','07:00 am - 08:30 am','07:30 am - 09:00 am','04:00 pm - 05:30 pm','04:30 pm to 06:00 pm'];

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

		// by default;
		appendDeliveryTime(0);

		$receivingModeDelivery.find('input[name="delivery"]').on('change', function(e){

			e.preventDefault();

			if($(this).val()=="allotherarea") {
				appendDeliveryTime(0);
			}else {
				appendDeliveryTime(1);
			}

		});

		$('#delivery_date').datepicker({
			minDate: 2,
			onSelect: function(dateText) {
				var pieces = dateText.split("/");
		        $("#delivery_date_month").val(pieces[0]);
		        $("#delivery_date_day").val(pieces[1]);
		        $("#delivery_date_year").val(pieces[2]);
		        $('#delivery_date').val(dateText);
		    }
		});
		$("#delivery_datepicker").click(function(e) {
			e.preventDefault();
			$('#delivery_date').show().focus().hide();
		});

		$('#collection_date').datepicker({
			minDate: 2,
			onSelect: function(dateText) {
				var pieces = dateText.split("/");
		        $("#collection_date_month").val(pieces[0]);
		        $("#collection_date_day").val(pieces[1]);
		        $("#collection_date_year").val(pieces[2]);
		        $('#collection_date').val(dateText);
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

					$shippingInfoList.next('.update').html('');

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
				if($billingDropdown.val()){

					var billingAddress_json = $billingDropdown.val();
					var billingAddress = jQuery.parseJSON( billingAddress_json );

					show_shipping_address_data(billingAddress);
					$shippinginputHidden.val(billingAddress_json);

				}

				$shippingDropdownDiv.slideUp();

			}else {
				hide_shipping_address_data();
				$shippinginputHidden.val('');

				$shippingDropdownDiv.slideDown();
				$shippingDropdown.trigger('change');
			}
		});

		function setAddressInTheForm(billingAddress) {
			$newFormContainer.find('input[name="first_name"]').val(billingAddress.first_name);
			$newFormContainer.find('input[name="last_name"]').val(billingAddress.last_name);
			$newFormContainer.find('input[name="company"]').val(billingAddress.company);
			$newFormContainer.find('input[name="address_1"]').val(billingAddress.address_1);
			$newFormContainer.find('input[name="address_2"]').val(billingAddress.address_2);
			$newFormContainer.find('input[name="postcode"]').val(billingAddress.postcode);
			$newFormContainer.find('select[name="country"]').val(billingAddress.country);
			$newFormContainer.find('textarea[name="addition_info"]').val(billingAddress.addition_info);
			$newFormContainer.find('input[name="phone"]').val(billingAddress.phone);
			$newFormContainer.find('input[name="mobile"]').val(billingAddress.mobile);
		}

		$billingInfoList.next('.update').on('click', function(e){
			
			e.preventDefault();

			if($billingDropdown.val()){

				var billingAddress_json = $billingDropdown.val();
				var billingAddress = jQuery.parseJSON( billingAddress_json );

				setAddressInTheForm(billingAddress);
			}

			$selectAddressContainer.hide();
			$newFormContainer.show();
			$newBillingAddressForm.show();

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

			$selectAddressContainer.hide();
			$newFormContainer.show();
			$newBillingAddressForm.show();
		});

		$addNewShippingBtn.on('click', function(e){

			e.preventDefault();

			$selectAddressContainer.hide();
			$newFormContainer.show();
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

		$checkoutBtn.on('click', function(e){
			e.preventDefault();

			$checkoutForm.submit();
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

		$personalPaymentBtn.on('click', function(e){
			e.preventDefault();

			$personalPaymentModeContainer.hide();
			$orderSummaryContainer.show();

			var choosedPersonalPaymentMethod = $personalPaymentModeContainer.find('input[name="personal_payment_method"]:checked').val();

			$('#payment_method_cod').trigger('click');

			$orderDetailContainer.show();
			$orderDetailContainer.find('.paymentby-value').html(choosedPersonalPaymentMethod);

			$progressIndicator.find('.sixth').children('.circle-holder').children('.circle-text').addClass('active');
			$progressIndicator.find('.sixth').children('.circle-holder').children('.circle').addClass('done');
		});

		$corporatePaymentBtn.on('click', function(e){
			e.preventDefault();

			$corporatePaymentModeContainer.hide();
			$orderSummaryContainer.show();

			var choosedPersonalPaymentMethod = $corporatePaymentModeContainer.find('input[name="corporate_payment_method"]:checked').val();

			if(choosedPersonalPaymentMethod=="Corporate cheque") {
				$('#payment_method_cheque').trigger('click');
			}else {
				$('#payment_method_cod').trigger('click');
			}

			$orderDetailContainer.show();
			$orderDetailContainer.find('.paymentby-value').html(choosedPersonalPaymentMethod);

			$progressIndicator.find('.sixth').children('.circle-holder').children('.circle-text').addClass('active');
			$progressIndicator.find('.sixth').children('.circle-holder').children('.circle').addClass('done');
		});

		$submissionPrevBtn.on('click', function(e){
			e.preventDefault();

			$paymentModeContainer.show();
			$orderSummaryContainer.hide();
			$orderDetailContainer.hide();
		});
		
		$confirmOrderBtn.on('click', function(e){
			e.preventDefault();

			$('#place_order').trigger('click');
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

		// min order validation

		$('.single_add_to_cart_button').on('click', function(e){
			e.preventDefault();

			var minOrder = $(this).parent('form').find('#min-order').html();

			console.log(minOrder);

			if($.isNumeric(minOrder) && minOrder > $(this).parent('form').find('#qty').val() ) {
				$(this).parent('form').children('.error-msg').html('Min Order of '+minOrder+' is required.');

			}else {
				$(this).parent('form').submit();
			}
		});

	});
	
});