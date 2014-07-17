jQuery( function( $ ) {

	$(document).ready(function(){

		var $sideBarMenu = $('.side-menu'),
			$mainSlider = $('.carousel'),
			$secondSlider = $('.jcarousel-wrapper'),
			$singleEntry = $('.entry-summary'),
			$receivingModeContainer = $('.receiving-mode-container'),
			$allReceivingModeContainer = $('.all-container'),
			$receivingModeCollection = $('.collection-container'),
			$receivingModeDelivery = $('.delivery-container'),
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
			$checkOutPaymentModeNextBtn = $('.payment-mode-next'),
			$paymentModeContainer = $('.payment-mode');
			$personalPaymentModeContainer = $('.personal-payment'),
			$corporatePaymentModeContainer = $('.corporate-payment'),
			$orderSummaryContainer = $('.summary-container'),
			$orderDetailContainer = $('.order-details-container'),
			$personalPaymentBtn = $('.personal-payment-save'),
			$corporatePaymentBtn = $('.corporate-payment-save'),
			$checkOutTermContainer = $('.terms-container');

		$sideBarMenu.children('li').children('collapse').on('shown.bs.collapse', function (e) {
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

		$receivingModeDelivery.find('input[type="submit"]').on('click', function(e){

			e.preventDefault();
			var cartAmount = $('.cart-amount').val();
			var location = $receivingModeDelivery.find('input[name="delivery"]:checked').val();

			console.log(cartAmount);
			console.log(location);

			if(parseFloat(cartAmount) <= 100 && location == 'allotherarea') {

				alert('Minimum purchase of 100S$ require for free delivery to this area.');

			}else if(parseFloat(cartAmount) <= 100 && location == 'jurongsentoaarea') {

				alert('Minimum purchase of 120S$ require for free delivery to this area.');

			}
			else if(parseFloat(cartAmount) <= 120 && location == 'jurongsentoaarea') {

				alert('Minimum purchase of 120S$ require for free delivery to this area.');

			}else {

				$receivingModeDelivery.find('form').submit();

			}
		});

		function appendDeliveryTime(key) {
			var delivery_time = ['<option value="6:00 am - 7:30 am">6:00 am - 7:30 am *</option><option value="6:30 am - 8:00 am">6:30 am - 8:00 am ^</option><option value="7:00 am - 8:30 am">7:00 am - 8:30 am ^</option><option value="7:30 am - 9:00 am">7:30 am - 9:00 am ^</option><option value="8:00 am - 9:30 am">8:00 am - 9:30 am</option><option value="9:00 am - 10:30 am">9:00 am - 10:30 am</option><option value="9:30 am - 11:00 am">9:30 am - 11:00 am</option><option value="10:00 am - 11:30 am">10:00 am - 11:30 am</option><option value="11:30 am - 1:00 pm">11:30 am - 1:00 pm</option><option value="12:00 pm - 1:30 pm">12:00 pm - 1:30 pm</option><option value="12:30 pm - 2:00 pm">12:30 pm - 2:00 pm</option><option value="1:00 pm - 2:30 pm">1:00 pm - 2:30 pm</option><option value="1:30 pm - 3:00 pm">1:30 pm - 3:00 pm</option><option value="2:00 pm - 3:30 pm">2:00 pm - 3:30 pm</option><option value="2:30 pm - 4:00 pm">2:30 pm - 4:00 pm</option><option value="3:00 pm - 4:30 pm">3:00 pm - 4:30 pm</option><option value="3:30 pm - 5:00 pm">3:30 pm - 5:00 pm</option>', 
			'<option value="6:00 am - 7:30 am">6:00 am - 7:30 am *</option><option value="6:30 am - 8:00 am">6:30 am - 8:00 am ^</option><option value="7:00 am - 8:30 am">7:00 am - 8:30 am ^</option><option value="7:30 am - 9:00 am">7:30 am - 9:00 am ^</option><option value="8:00 am - 9:30 am">8:00 am - 9:30 am</option><option value="8:30 am - 10:00 am">8:30 am - 10:00 am</option><option value="9:00 am - 10:30 am">9:00 am - 10:30 am</option><option value="9:30 am - 11:00 am">9:30 am - 11:00 am</option><option value="10:00 am - 11:30 am">10:00 am - 11:30 am</option><option value="10:30 am - 12:00 pm">10:30 am - 12:00 pm</option><option value="11:00 am - 12:30 pm">11:00 am - 12:30 pm</option><option value="11:30 am - 1:00 pm">11:30 am - 1:00 pm</option><option value="12:00 pm - 1:30 pm">12:00 pm - 1:30 pm</option><option value="12:30 pm - 2:00 pm">12:30 pm - 2:00 pm</option><option value="1:00 pm - 2:30 pm">1:00 pm - 2:30 pm</option><option value="1:30 pm - 3:00 pm">1:30 pm - 3:00 pm</option><option value="2:00 pm - 3:30 pm">2:00 pm - 3:30 pm</option><option value="2:30 pm - 4:00 pm">2:30 pm - 4:00 pm</option><option value="3:00 pm - 4:30 pm">3:00 pm - 4:30 pm</option><option value="3:30 pm - 5:00 pm">3:30 pm - 5:00 pm</option><option value="4:00 pm - 5:30 pm">4:00 pm - 5:30 pm ^</option><option value="4:30 pm - 6:00 pm">4:30 pm - 6:00 pm ^</option><option value="4:00 pm - 5:30 pm (Sat/PH only)">4:00 pm - 5:30 pm (Sat/PH only)</option><option value="4:30 pm - 6:00 pm (Sat/PH only)">4:30 pm - 6:00 pm (Sat/PH only)</option>'];

			var certain_delivery_time_additional_30 = ['6:00 am - 7:30 am'];
			var certain_delivery_time_additional_22 = ['6:30 am - 8:00 am','7:00 am - 8:30 am','7:30 am - 9:00 am','4:00 pm - 5:30 pm','4:30 pm to 6:00 pm'];

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

		});

		$saveDeliveryAddressBtn.on('click', function(e){

			e.preventDefault();

			$selectAddressContainer.show();
			$newFormContainer.hide();
			$newShippingAddressForm.hide();

			var fields = $( this ).closest('form').serializeObject();
			var shipping_fields_json = JSON.stringify(fields);

			show_shipping_address_data(fields);
			$shippingInfoList.next('.update').html('');
			$shippinginputHidden.val(shipping_fields_json);
		});

		$checkoutBtn.on('click', function(e){
			e.preventDefault();

			$checkoutForm.submit();
		});

		$checkOutPaymentModeNextBtn.on('click', function(e){
			e.preventDefault();

			$paymentModeContainer.hide();
			var paymentmethod = $('input[name=paymentmethod]:checked').val();

			console.log(paymentmethod);

			if(paymentmethod == 'Personal Payment') {

				$personalPaymentModeContainer.show();
			}else {
				$corporatePaymentModeContainer.show();
			}

		});

		$personalPaymentBtn.on('click', function(e){
			e.preventDefault();

			$personalPaymentModeContainer.hide();
			$orderSummaryContainer.show();

			var choosedPersonalPaymentMethod = $personalPaymentModeContainer.find('input[name="personal_payment_method"]:checked').val();

			$('#payment_method_cod').trigger('click');

			$orderDetailContainer.show();
			$orderDetailContainer.find('.paymentby-value').html(choosedPersonalPaymentMethod);
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
		});
		
		$('#confirm-order').on('click', function(e){
			e.preventDefault();

			$('#place_order').trigger('click');
		});

		$checkOutTermContainer.find('input[name="tnc"]').on('click', function(){
			$('#terms').trigger('click');
		});	

	});
	
});