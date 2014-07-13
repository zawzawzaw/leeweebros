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
	})
});