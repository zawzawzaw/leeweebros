	<?php get_header(); ?>
<div id="content-wrapper">
	<div id="main-slider" class="container">
		<div class="row">
			<div id="carousel-example-generic" class="col-md-12 carousel slide" data-ride="carousel">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
					<li data-target="#carousel-example-generic" data-slide-to="1"></li>
					<li data-target="#carousel-example-generic" data-slide-to="2"></li>
					<li data-target="#carousel-example-generic" data-slide-to="3"></li>
				</ol>

				<!-- Wrapper for slides -->
				<div class="carousel-inner">
					<div class="item active">
					  <img src="<?php echo IMAGES ?>/home_slider/slider-1.jpg" alt="Main Slider">
					  <div class="carousel-caption"></div>
					</div>
					<div class="item">
					  <img src="<?php echo IMAGES ?>/home_slider/slider-2.jpg" alt="FISH OTAH">
					  <div class="carousel-caption">
					   <h1>FISH OTAH</h1>
					   <p>﻿﻿A local style recipe for steamed parcels of minced seasoned fish, wrapped in coconut leaves and flame grilled to fragrance.﻿</p>
					  </div>
					</div>
					<div class="item">
					  <img src="<?php echo IMAGES ?>/home_slider/slider-3.jpg" alt="NASI LEMAK">
					  <div class="carousel-caption">
					   <h1>NASI LEMAK</h1>
					   <p>﻿﻿﻿﻿A local style recipe for steamed parcels of minced seasoned fish, wrapped in coconut leaves and flame grilled to fragrance.﻿</p>
					  </div>
					</div>
					<div class="item">
					  <img src="<?php echo IMAGES ?>/home_slider/slider-4.jpg" alt="CURRY CHICKEN & BAGUETTE">
					  <div class="carousel-caption">
					   <h1>CURRY CHICKEN & BAGUETTE</h1>
					   <p>﻿﻿﻿﻿A local style recipe for steamed parcels of minced seasoned fish, wrapped in coconut leaves and flame grilled to fragrance.﻿</p>
					  </div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="space50"></div>
	<div class="space20"></div>

	<div id="special-deal" class="container">
		<div class="row">
			<div class="col-md-12" id="header-text">
				<h3>SPECIAL DEAL FOR YOU</h3>
				<h1>DEAL OF THE DAY</h1>
			</div>
		</div>
		<div class="space20"></div>
		<div class="row">
			<div class="col-md-12">
				<div class="jcarousel-wrapper">
					<div class="jcarousel" data-jcarousel="true">
					    <ul>
					        <li>
								<img src="<?php echo IMAGES ?>/home_slider/special-deal-slider-1.jpg" alt="CHICKEN SATAY">
								<div class="caption">
									<h3>CHICKEN SATAY</h3>
									<p>$0.50</p>
								</div>
					        </li>
					        <li>
								<img src="<?php echo IMAGES ?>/home_slider/special-deal-slider-2.jpg" alt="CURRY CHICKEN WITH BAGUETTE">
								<div class="caption">
									<h3>CURRY CHICKEN WITH BAGUETTE</h3>
									<p>$4.20</p>
								</div>
					        </li>
					        <li>
								<img src="<?php echo IMAGES ?>/home_slider/special-deal-slider-3.jpg" alt="ASSAM PRAWN">
								<div class="caption">
									<h3>ASSAM PRAWN</h3>
									<p>$2.60</p>
								</div>
					        </li>
					        <li>
								<img src="<?php echo IMAGES ?>/home_slider/special-deal-slider-3.jpg" alt="ASSAM PRAWN">
								<div class="caption">
									<h3>ASSAM PRAWN</h3>
									<p>$2.60</p>
								</div>
					        </li>
					        <li>
								<img src="<?php echo IMAGES ?>/home_slider/special-deal-slider-2.jpg" alt="CURRY CHICKEN WITH BAGUETTE">
								<div class="caption">
									<h3>CURRY CHICKEN WITH BAGUETTE</h3>
									<p>$4.20</p>
								</div>
					        </li>
					        <li>
								<img src="<?php echo IMAGES ?>/home_slider/special-deal-slider-1.jpg" alt="CHICKEN SATAY">
								<div class="caption">
									<h3>CHICKEN SATAY</h3>
									<p>$0.50</p>
								</div>
					        </li>
					    </ul>
					</div>
					<a href="#" class="jcarousel-control-prev" data-jcarouselcontrol="true"></a>
					<a href="#" class="jcarousel-control-next" data-jcarouselcontrol="true"></a>
					<hr class="separator">
				</div>
			</div>			
		</div>
	</div>

	<div class="space50"></div>
	<div class="space20"></div>

	<div id="feature-product" class="container">
		<div class="row">
			<div class="col-md-12" id="header-text">
				<h3>SOME SPECIAL PRODUCTS FOR YOU</h3>
				<h1>FEATURED PRODUCTS</h1>
			</div>
		</div>
		<div class="space20"></div>
		<div class="row feature-product-content">
			<div class="col-md-12">
				<div class="feature-product-wrapper">
					<ul>
						<?php 
						$args = array(
						    'post_type' => 'product',  
						    'meta_key' => '_featured',  
						    'meta_value' => 'yes',  
						    'posts_per_page' => -1  
						);  
						  
						$featured_query = new WP_Query( $args );  
						      
						if ($featured_query->have_posts()) :   
						  
						    while ($featured_query->have_posts()) :   
						      
						        $featured_query->the_post();  
						          
						        $product = get_product( $featured_query->post->ID );
						        $price = get_post_meta( get_the_ID(), '_regular_price', true);
						        $sale = get_post_meta( get_the_ID(), '_sale_price', true);
						?>
								<li>
									<a href="#"><img src="<?php echo IMAGES ?>/content/feature-product-1.jpg" alt="<?php the_title(); ?>"></a>
									<div class="feature-product-description">
										<h3><?php the_title(); ?></h3>
										<?php the_excerpt(); ?>
										<p class="feature-price">$<?php echo (isset($sale) && !empty($sale)) ? number_format((float)$sale, 2, '.', '') : number_format((float)$price, 2, '.', '');  ?></p>
									</div>
								</li>
						<?php        
						    endwhile;
						      
						endif;
						  
						wp_reset_query(); // Remember to reset  
						?>
						<!-- <li>
							<a href="#"><img src="<?php echo IMAGES ?>/content/feature-product-1.jpg" alt="PRAWN OTAH"></a>
							<div class="feature-product-description">
								<h3>PRAWN OTAH</h3>
								<p class="feature-text">A local style recipe for steamed parcels of minced seasoned fish and prawn, wrapped in coconut leaves & flame grilled to fragrance.</p>
								<p class="feature-price">$0.90</p>
							</div>
						</li>
						<li>
							<a href="#"><img src="<?php echo IMAGES ?>/content/feature-product-2.jpg" alt="MUTTON SATAY"></a>
							<div class="feature-product-description">
								<h3>MUTTON SATAY</h3>
								<p class="feature-text">Cooked juicy bite-sized meat skewers marinated with special herbs & spices grilled to perfection.</p>
								<p class="feature-price">$0.55</p>
							</div>
						</li>
						<li>
							<a href="#"><img src="<?php echo IMAGES ?>/content/feature-product-3.jpg" alt="CRISPY CHICKEN & NASI LEMAK"></a>
							<div class="feature-product-description">
								<h3>CRISPY CHICKEN & NASI LEMAK</h3>
								<p class="feature-text">Fish Fillet fried to golden brown, made into a burger with fresh lettuce and tartar sauce. Delight to the burger-lovers.</p>
								<p class="feature-price">$3.50</p>
							</div>
						</li>
						<li>
							<a href="#"><img src="<?php echo IMAGES ?>/content/feature-product-4.jpg" alt="ASSAM PRAWN"></a>
							<div class="feature-product-description">
								<h3>ASSAM PRAWN</h3>
								<p class="feature-text">Prawn seasoned with our popular paste made from an aromatic blend of home-made chilli, vinegar, garlic, lemon grass and</p>
								<p class="feature-price">$2.60</p>
							</div>
						</li>
						<li>
							<a href="#"><img src="<?php echo IMAGES ?>/content/feature-product-5.jpg" alt="CURRY CHICKEN & BAGUETTE"></a>
							<div class="feature-product-description">
								<h3>CURRY CHICKEN & BAGUETTE</h3>
								<p class="feature-text">Tuck yourself into our mouth watering homemade Curry Chicken along with oven baked baguette.</p>
								<p class="feature-price">$4.20</p>
							</div>
						</li>
						<li>
							<a href="#"><img src="<?php echo IMAGES ?>/content/feature-product-6.jpg" alt="SAMBAL CHILLI"></a>
							<div class="feature-product-description">
								<h3>SAMBAL CHILLI</h3>
								<p class="feature-text">Enjoy it with our Nasi Lemak/Beehoon sets or just by itself! (Min. 5 portion)</p>
								<p class="feature-price">$2.20</p>
							</div>
						</li> -->
					</ul>			
				</div>
			</div>
		</div>
	</div>
</div>
<div class="space50"></div>
<script type="text/javascript" src="<?php echo LIB ?>/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo LIB ?>/jquery.jcarousel.min.js"></script>
<script type="text/javascript">

	$(document).ready(function(){
		$('.carousel').carousel('pause');

		$('.jcarousel').jcarousel({
	        // Configuration goes here
	    });

	    $('.jcarousel-control-prev')
            .jcarouselControl({
                target: '-=1'
            });

        $('.jcarousel-control-next')
            .jcarouselControl({
                target: '+=1'
            });
	});

</script>

<?php get_footer(); ?>