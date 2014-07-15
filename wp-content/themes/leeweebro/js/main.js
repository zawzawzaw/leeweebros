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

		$('.payment-mode-next').on('click', function(e){
			e.preventDefault();
			
			var mode = $('input[name="paymentmethod"]:checked').val();

			$('.all-container').hide();
			if(mode=='self') {
				$('.collection-container').show();
			}else {			
				$('.delivery-container').show();
			}
		});

		$('.payment-mode-prev').on('click', function(e){
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

			console.log();
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

		$('.billing_address').on('change', function(e){
			e.preventDefault();
			var billingAddress_json = $(this).val();

			console.log(billingAddress_json);

			if(billingAddress_json) {
				var billingAddress = jQuery.parseJSON( billingAddress_json );

				$('.billing-address').prev('h4').html('BILLING ADDRESS:');
				$('.billing-address').children('.name').html(billingAddress.first_name + ' ' + billingAddress.last_name);
				$('.billing-address').children('.address-1').html(billingAddress.address_1);
				$('.billing-address').children('.address-2').html(billingAddress.address_2);
				$('.billing-address').children('.country').html(billingAddress.country);
				$('.billing-address').children('.postcode').html(billingAddress.postcode);
				$('.billing-address').children('.tel').html(billingAddress.phone);
				$('.billing-address').children('.mobile').html(billingAddress.mobile);
				$('.billing-address').next('.update').html('UPDATE');

				$('input#billing_address_hidden').val(billingAddress_json);
			}else {
				$('.billing-address').prev('h4').html('');
				$('.billing-address').children('span').html('');
				$('.billing-address').next('.update').html('');
			}

			if($('input[name="same"]').prop('checked')) {
				$('.shipping-address').prev('h4').html('DELIVERY ADDRESS:');
				$('.shipping-address').children('.name').html(billingAddress.first_name + ' ' + billingAddress.last_name);
				$('.shipping-address').children('.address-1').html(billingAddress.address_1);
				$('.shipping-address').children('.address-2').html(billingAddress.address_2);
				$('.shipping-address').children('.country').html(billingAddress.country);
				$('.shipping-address').children('.postcode').html(billingAddress.postcode);
				$('.shipping-address').children('.tel').html(billingAddress.phone);
				$('.shipping-address').children('.mobile').html(billingAddress.mobile);
				$('.shipping-address').next('.update').html('UPDATE');

				$('input#shipping_address_hidden').val(billingAddress_json);
			}
		});

		$('.delivery_address').on('change', function(e){
			e.preventDefault();
			var shippingAddress_json = $(this).val();
			if(shippingAddress_json) {
				var shippingAddress = jQuery.parseJSON( shippingAddress_json );

				$('.shipping-address').prev('h4').html('DELIVERY ADDRESS:');
				$('.shipping-address').children('.name').html(shippingAddress.first_name + ' ' + shippingAddress.last_name);
				$('.shipping-address').children('.address-1').html(shippingAddress.address_1);
				$('.shipping-address').children('.address-2').html(shippingAddress.address_2);
				$('.shipping-address').children('.country').html(shippingAddress.country);
				$('.shipping-address').children('.postcode').html(shippingAddress.postcode);
				$('.shipping-address').children('.tel').html(shippingAddress.phone);
				$('.shipping-address').children('.mobile').html(shippingAddress.mobile);
				$('.shipping-address').next('.update').html('UPDATE');

				$('input#shipping_address_hidden').val(shippingAddress_json);
			}else {
				$('.shipping-address').prev('h4').html('');
				$('.shipping-address').children('span').html('');
				$('.shipping-address').next('.update').html('');
			}
		});

		$('.delivery_toggle').hide();

		$('input[name="same"]').on('change', function(e){
			e.preventDefault();
			if($(this).prop('checked')) {
				$('.delivery_toggle').slideUp();
				$('.shipping-address').prev('h4').html('');
				$('.shipping-address').children('span').html('');
				$('.shipping-address').next('.update').html('');
			}
			else {
				$('.delivery_toggle').slideDown();	
				$('.delivery_address').trigger('change');
			}
		});

		$('.add_delivery').on('click', function(e){
			e.preventDefault();

			$('.select-address-container').hide();
			$('.address-container').show();
			$('#shippingaddress-form').show();
		});

		$('.add_billing').on('click', function(e){
			e.preventDefault();
			$('.select-address-container').hide();
			$('.address-container').show();
			$('#billingaddress-form').show();

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

		$('.save_delivery_address').on('click', function(e){
			e.preventDefault();
			$('.select-address-container').show();
			$('.address-container').hide();
			$('#shippingaddress-form').hide();

			var fields = $( this ).closest('form').serializeObject();

			var shipping_fields_json = JSON.stringify(fields);

			$('.shipping-address').prev('h4').html('DELIVERY ADDRESS:');
			$('.shipping-address').children('.name').html(fields.first_name + ' ' + fields.last_name);
			$('.shipping-address').children('.address-1').html(fields.address_1);
			$('.shipping-address').children('.address-2').html(fields.address_2);
			$('.shipping-address').children('.country').html(fields.country);
			$('.shipping-address').children('.postcode').html(fields.postalcode);
			$('.shipping-address').children('.tel').html(fields.phone);
			$('.shipping-address').children('.mobile').html(fields.mobile);
			$('.shipping-address').next('.update').html('');

			console.log(fields);
			$('input#shipping_address_hidden').val(shipping_fields_json);
		});

		$('.save_billing_address').on('click', function(e){
			e.preventDefault();
			$('.select-address-container').show();
			$('.address-container').hide();
			$('#billingaddress-form').hide();

			var fields = $( this ).closest('form').serializeObject();

			var billing_fields_json = JSON.stringify(fields);

			$('.billing-address').prev('h4').html('BILLING ADDRESS:');
			$('.billing-address').children('.name').html(fields.first_name + ' ' + fields.last_name);
			$('.billing-address').children('.address-1').html(fields.address_1);
			$('.billing-address').children('.address-2').html(fields.address_2);
			$('.billing-address').children('.country').html(fields.country);
			$('.billing-address').children('.postcode').html(fields.postalcode);
			$('.billing-address').children('.tel').html(fields.phone);
			$('.billing-address').children('.mobile').html(fields.mobile);
			$('.billing-address').next('.update').html('');

			console.log(fields);
			$('input#billing_address_hidden').val(billing_fields_json);
		});

		$('.submit-to-checkout').on('click', function(e){
			e.preventDefault();

			$('form#submitcheckout').submit();
		});
	});
	
});