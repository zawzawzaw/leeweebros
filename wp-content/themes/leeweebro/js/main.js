jQuery( function( $ ) {
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
});