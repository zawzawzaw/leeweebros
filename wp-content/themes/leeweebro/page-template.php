<?php 
/*
Template Name: Page Template
*/
?>

<?php 
get_header(); 
?>

<?php remove_filter ('the_content', 'wpautop'); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<div id="content-wrapper" class="<?php echo ($post->post_name=='terms-conditions' || $post->post_name=='our-outlets' || $post->post_name=='promotions' || $post->post_name=='careers' || $post->post_name=='contact') ? 'align-left' : ''; ?>">
	<div id="breadcrumb" class="container">
		<?php if($post->post_name!=='terms-conditions' && $post->post_name!=='our-outlets' && $post->post_name!=='promotions' && $post->post_name!=='careers' && $post->post_name!=='contact' && $post->post_name!=='faqs'): ?>
		<div class="align-left-2">
		<?php endif; ?>
			<div class="row">
				<div class="col-md-12">
					<?php get_template_part( 'content', 'breadcrumb' ); ?>
				</div>
			</div>
		<?php if($post->post_name!=='terms-conditions' && $post->post_name!=='our-outlets' && $post->post_name!=='promotions' && $post->post_name!=='careers' && $post->post_name!=='contact' && $post->post_name!=='faqs'): ?>
		</div>
		<?php endif; ?>
	</div>

	<?php 
	if($post->post_parent != 0) {
	  $post_data = get_post($post->post_parent);
	  if(!isset($post_data->post_name)) {
	  	$name = $post->post_name;
	  }else {
	  	$name = $post_data->post_name;
	  }
	}
	?>

	<div id="<?php echo ($post->post_name=='terms-conditions' || $post->post_name=='faqs') ? 'terms-conditions' : $name; ?>" class="container">
		<?php if($post->post_name!=='terms-conditions' && $post->post_name!=='our-outlets' && $post->post_name!=='promotions' && $post->post_name!=='careers' && $post->post_name!=='contact' && $post->post_name!=='faqs'): ?>
		<div class="align-left-2">
		<?php endif; ?>
			<div class="space30"></div>
			<div class="row">
				<div class="col-md-12" id="page-title">
					<?php $custom_fields = get_post_custom(); 
						if(isset($custom_fields['Sub Title'])): ?>
							<h2><?php echo $custom_fields['Sub Title'][0]; ?></h2>
						<?php endif; ?>
					<h1><?php the_title(); ?></h1>
				</div>
			</div>
		<?php if($post->post_name!=='terms-conditions' && $post->post_name!=='our-outlets' && $post->post_name!=='promotions' && $post->post_name!=='careers' && $post->post_name!=='contact' && $post->post_name!=='faqs'): ?>			
		</div>
		<div class="space40"></div>
		<div class="row">
			<div class="col-md-12" id="banner-img">
				<!-- <img src="images/content/banner-2.jpg" alt="banner"> -->
				<?php 
				if ( has_post_thumbnail() ) {
				  //the_post_thumbnail();
				$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
					<img class="lazy" data-original="<?php echo $url; ?>" alt="feature image">
				<?php
				} 
				?>
			</div>
		</div>
		<div class="space30"></div>
		<?php endif; ?>
		
		<?php if($post->post_name=='promotions'): ?>
			<div class="space40"></div>
			<div class="row promo-product-content">
				<div class="col-md-12">
					<div class="promo-product-wrapper">
						<ul>
							<?php 
							$args = array( 
								'post_type' 	 => 'product', 
								'posts_per_page' => -1, 
								'product_tag' 	 => 'Special Deal' 
							);
							  
							$featured_query = new WP_Query( $args );
							      
							if ($featured_query->have_posts()) :   
							  
							    while ($featured_query->have_posts()) :   
							      
							        $featured_query->the_post();  
							          
							        $product = get_product( $featured_query->post->ID );
							        
							        if($product->product_type=='variable') {
							        	$product = new WC_Product_Variable( $featured_query->post->ID );
							        	$available_variations = $product->get_available_variations();
							        	$variation_id=$available_variations[0]['variation_id'];
							        	$variable_product1= new WC_Product_Variation( $variation_id );
							        	$price = $variable_product1 ->regular_price;
										$sale = $variable_product1 ->sale_price;

							        }else {
								        $price = get_post_meta( get_the_ID(), '_regular_price', true);
								        $sale = get_post_meta( get_the_ID(), '_sale_price', true);
							        }

							        $attributes = $product->get_attributes();
							?>
								<li>
									<a href="<?php echo get_permalink(get_the_ID()); ?>">
										<?php the_post_thumbnail(); ?>
									</a>
									<div class="promo-product-description">
										<h3><?php the_title(); ?></h3>
										<?php 
										$my_excerpt = get_the_excerpt();
										if ( $my_excerpt != '' ) {
											$custom_excerpt = explode('<br>',$my_excerpt);

										} ?>
										<p class="promo-text"><?php echo $custom_excerpt[0]; ?></p>
										<p class="promo-price">$<?php echo (isset($sale) && !empty($sale)) ? number_format((float)$sale, 2, '.', '') : number_format((float)$price, 2, '.', '');  ?></p>
										<p class="promo-price-2"><?php echo (isset($attributes['per']['value'])) ? $attributes['per']['value'] : ''; ?></p>
									</div>
								</li>
							<?php        
							    endwhile;
							else: 
							?>
								<li><p class="no-promo">There are currently no promotions, please check back later!</p></li>
							<?php
							endif;
							  
							wp_reset_query(); // Remember to reset  
							?>
						</ul>			
					</div>
				</div>
			</div>
		<?php elseif($post->post_name=='contact'): ?>
			<div class="space20"></div>
			<div class="row">
				<div class="col-md-12">
					<div id="google-map-canvas"></div>
				</div>
			</div>
			<div class="space50"></div>
			<div class="row">

				<?php the_content(); ?>

				<div class="col-md-6 col-md-offset-1">
					<h2>GET IN TOUCH</h2>
					For enquiries about your orders, feedback or if you want more information about our products.
					<div class="space20"></div>
					<?php 
					if(isset($_POST['subject'])) {
						$subject = htmlspecialchars($_POST['subject'], ENT_QUOTES, 'UTF-8');
						$user_email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
						$message = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');
						$admin_email = get_option( 'admin_email' ); 

						$headers[] = 'From: '.$user_email.' <'.$user_email.'>';
						$attachments = '';
					}
					?>
					<form id="contact-form" action="" method="post" name="login">
						<?php if(isset($_POST['subject'])): ?>
						<div class="row">
							<div class="col-md-12">
								<p class="msg">
									<?php
									if( wp_mail( $admin_email, $subject, $message, $headers, $attachments ) ) {
									    // the message was sent...
									    echo 'Your message was sent successfully!';
									    $new_subject = "We have received your message from Lee Wee Brothers web site.";
									    $new_message = "Hi there,<br><br> thanks for your comment regarding ".$subject.". We will reply to you as soon as possible. <br><br>Regards,<br>Lee Wee Brothers";
									    $new_headers[] = 'From: '.$admin_email.' <'.$admin_email.'>';
									    wp_mail( $user_email, $new_subject, $new_message, $new_headers, $attachments);

									} else {
									    // the message was not sent...
									    echo 'Sorry, your message was not sent! Please try again later.';
									}
									?>
								</p>
								<div class="space20"></div>
							</div>
						</div>
						<?php endif; ?>
						<div class="row">
							<div class="col-md-12">

								<label class="lbl asterisk-2" for="subject">Subject Heading:</label>
								<div class="dropdown">
									<select name="subject">
										<option value="">Choose</option>
										<option value="enquiries">Enquiries</option>
										<option value="feedback">Feedback</option>
										<option value="technical">Technical Issues</option>
									</select>
								</div>
								<span class="desc"></span><!-- For any question about a product, an order -->

							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label class="asterisk" for="email">
									<input class="medium-input" name="email" type="text" placeholder="Email Address" />
								</label>
							</div>
						</div>
						<!-- <div class="row">
							<div class="col-md-12">
								<label class="right-arrow" for="attachment">
									<button class="attachment">Choose Attach File</button>
								</label>
							</div>
						</div> -->
						<div class="row">
							<div class="col-md-12">
								<label class="asterisk" for="message">
									<textarea id="" cols="15" name="message" rows="5" placeholder="Message"></textarea>
								</label>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2 col-md-offset-8"><input name="submit" type="submit" value="Send" /></div>
						</div>
					</form>
				</div>
			</div>
		<?php else: ?>
			<?php the_content(); ?>
		<?php endif; ?>

	</div>
</div>
<div class="space50"></div>
<div class="space50"></div>
<?php endwhile; ?>

<?php get_footer(); ?>