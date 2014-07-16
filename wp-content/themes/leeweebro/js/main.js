jQuery( function( $ ) {

	$(document).ready(function(){
		// category & product sidebar menu
		$('.collapse').on('shown.bs.collapse', function (e) {
		  	$('.side-menu li').removeClass('active');
		  	$(e.currentTarget).parent('li').addClass('active');
		});

		$('.side-menu li a').on('click',function(e){
		    if($(this).next('.collapse').hasClass('in')){
		        e.stopPropagation();
		    }else {
		    	$('.collapse').collapse('hide');
		    }
		});


		// main slider
		$('.carousel').carousel('pause');

		$('.jcarousel').jcarousel({
	        // Configuration goes here
	    });

	    $('.jcarousel-control-prev').jcarouselControl({
	        target: '-=1'
	    });

	    $('.jcarousel-control-next').jcarouselControl({
		    target: '+=1'
		});

		$('.full-size').on('click', function(e){
			e.preventDefault();
			$('.zoom').trigger('click');
		});

		$('.receiving-mode-next').on('click', function(e){
			e.preventDefault();
			
			var mode = $('input[name="receivingmethod"]:checked').val();

			$('.all-container').hide();
			if(mode=='self') {
				$('.collection-container').show();
			}else {			
				$('.delivery-container').show();
			}
		});

		$('.receiving-mode-prev').on('click', function(e){
			e.preventDefault();
			$('.all-container').hide();
			$('.receiving-mode-container').show();
		});

		$('input[name="delivery"]').on('change', function(e){
			var cartAmount = $('.cart-amount').val();
			var location = $(this).val();

			if(parseFloat(cartAmount) <= 100 && location == 'allotherarea') {
				alert('Minimum purchase of 100S$ require for free delivery to this area.');
				$('.submit').attr("disabled", true);
			}else if(parseFloat(cartAmount) <= 100 && location == 'jurongsentoaarea') {
				alert('Minimum purchase of 120S$ require for free delivery to this area.');
				$('.submit').attr("disabled", true);
			}
			else if(parseFloat(cartAmount) <= 120 && location == 'jurongsentoaarea') {
				alert('Minimum purchase of 120S$ require for free delivery to this area.');
				$('.submit').attr("disabled", true);
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

		var $billingDropdown = $('.billing_address'),
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
			$paymentMethodRadioBox = $('input[name=paymentmethod]:checked'),
			$paymentModeContainer = $('.payment-mode');
			$personalPaymentModeContainer = $('.personal-payment'),
			$corporatePaymentModeContainer = $('.corporate-payment'),
			$orderSummaryContainer = $('.summary-container'),
			$orderDetailContainer = $('.order-details-container'),
			$personalPaymentBtn = $('.personal-payment-save');
			$coporatePaymentBtn = $('.coporate-payment-save');

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

					$shippingDropdownDiv.slideUp();

				}
			}else {
				hide_shipping_address_data();
				$shippinginputHidden.val('');

				$shippingDropdownDiv.slideDown();
				$shippingDropdown.trigger('change');
			}
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

		$addNewShippingBtn.on('click', function(e){

			e.preventDefault();

			$selectAddressContainer.hide();
			$newFormContainer.show();
			$newShippingAddressForm.show();
		});

		$addNewBillingBtn.on('click', function(e){

			e.preventDefault();

			$selectAddressContainer.hide();
			$newFormContainer.show();
			$newBillingAddressForm.show();
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

		$saveDeliveryAddressBtn.on('click', function(e){

			e.preventDefault();

			$selectAddressContainer.show();
			$newFormContainer.hide();
			$newShippingAddressForm.hide();

			var fields = $( this ).closest('form').serializeObject();
			var shipping_fields_json = JSON.stringify(fields);

			show_shipping_address_data(fields);
			$shippinginputHidden.val(shipping_fields_json);
		});

		$saveBillingAddressBtn.on('click', function(e){

			e.preventDefault();

			$selectAddressContainer.show();
			$newFormContainer.hide();
			$newBillingAddressForm.hide();

			var fields = $( this ).closest('form').serializeObject();
			var billing_fields_json = JSON.stringify(fields);

			show_billing_address_data(fields);
			$billinginputHidden.val(billing_fields_json);

		});

		$checkoutBtn.on('click', function(e){
			e.preventDefault();

			$checkoutForm.submit();
		});

		$checkOutPaymentModeNextBtn.on('click', function(e){
			e.preventDefault();

			$paymentModeContainer.hide();
			var paymentmethod = $paymentMethodRadioBox.val();

			console.log(paymentmethod);

			if(paymentmethod == 'Personal Payment') {

				$personalPaymentModeContainer.show();
			}else {
				$corporatePaymentModeContainer.show();
			}

		});

		$personalPaymentBtn.on('click', function(e){
			$personalPaymentModeContainer.hide();
			$orderSummaryContainer.show();
			$orderDetailContainer.show();
		});

		$coporatePaymentBtn.on('click', function(e){
			$corporatePaymentModeContainer.hide();
			$orderSummaryContainer.show();
			$orderDetailContainer.show();
		});
		


	});
	
});