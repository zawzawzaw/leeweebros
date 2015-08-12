<?php 
	function add_post_type($name, $args = array()){
		add_action('init', function() use($name, $args) {
			$upper = ucwords($name);
			$name = strtolower($name);

			$category = array();


			$args = array_merge(array(
				'public' => true,
				'label' => "$upper",
				'labels' => array('add_new_item' => "Add New $upper"), #learn more at codex
				'hierarchical' => false,
				'supports' => array('title','editor','comments', 'page-attributes'), #learn more about thumbnail
				'taxonomies' => $category
			), $args);

			register_post_type($name, $args);
		});
	}

	# create new taxonomy #
	function add_taxonomy($name, $post_type, $args = array()){
		$name = strtolower(str_replace(' ', '_', $name));

		add_action('init', function() use($name, $post_type, $args) {# name of taxonomy, associated post type, options
			$args = array_merge(array(
				'label' => ucwords($name)
			), $args);

			register_taxonomy($name, $post_type, $args);
		});
	}

	# create new meta box #
	function add_my_meta_box($title, $post_type, $args = array()	) {
		$id = strtolower(str_replace(' ', '_', $post_type));
		$callback = 'render_my_metabox';
		
		add_action('add_meta_boxes', function() use($id, $title, $post_type, $callback, $args) {	
			add_meta_box(
				$id,
				$title,
				$callback,
				$post_type,
				'normal',
				'high',
				array($post_type)
			);
		});
	}

	function render_my_metabox() {
		global $post;
		
		$post_type = $post->post_type;
		$meta_values = get_existing_meta($post_type);
		$delivery_date_count = 0;
		$blackout_date_count = 0;

		if(isset($meta_values)) {
			foreach ($meta_values as $values) {
				unset($values['_edit_last']);
				unset($values['_edit_lock']);

				$keys = array_keys($values);
			}

			foreach ($keys as $key){
				$data[$key] = get_post_meta($post->ID, $key, true);

				if(strpos($key, 'specific_delivery_date') !== false) {
					$delivery_date_count++;
				}

				if(strpos($key, 'specific_blackout_date') !== false) {
					$blackout_date_count++;
				}
			}
		}

		# validation field #
		wp_nonce_field(__FILE__,'jw_nonce');
	?>

	<?php if($post_type=='slider'): ?>
		<label for="sort">Sort:</label>
		<input type="text" name="sort" id="sort" class="widefat" value="<?php echo $data['sort']; ?>" />
		<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
		<script>
		  $(function() {
			$( ".datepicker" ).datepicker();
		  });
		</script>

		<label for="discount_type">Type of Discount:</label>
		<select name="discount_type" id="discount_type" class="widefat">
			<option value="fixed_cart">Fixed Amount</option>
			<option value="percent">Percentage</option>
		</select>
		<br>
		<label for="amount">Amount:</label>
		<input type="text" name="amount" id="amount" class="widefat" value="<?php echo $data['amount']; ?>" />
		<br>
		<label for="usage_limit">Number of Usage Limit:</label>
		<input type="text" name="usage_limit" id="usage_limit" class="widefat" value="<?php echo $data['usage_limit']; ?>" />
		<br>
		<label for="expiry_date">Expiry Date:</label>
		<input type="text" name="expiry_date" id="expiry_date" class="datepicker widefat" value="<?php echo $data['expiry_date']; ?>" />
		<br> -->
	<?php elseif($post_type=='s_delivery_date'): ?>
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<script>
	  	$(document).ready(function(){

	  		$( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
		  	
			$('.add_more').on('click', function(e){
				e.preventDefault();

				var specificDeliveryCount = $('.specific_delivery_date').length;
				var id = specificDeliveryCount + 1;

				var newdeliverydate = $('.specific_delivery_date_to_clone').children().clone();

				newdeliverydate.show().addClass('specific_delivery_date');
				newdeliverydate.find('input').attr('disabled', false);

				$('.all_delivery_date').append(newdeliverydate);

				// $('.datepicker').not('.hasDatepicker').datepicker({ dateFormat: 'yy-mm-dd' });

				newdeliverydate.attr('id', '');
				newdeliverydate.find('label').attr('for', 'specific_delivery_date_'+id).text('Holiday Date '+id);
				newdeliverydate.find('input').attr('name', 'specific_delivery_date_'+id).attr('id', 'specific_delivery_date_'+id).val('');
				// $('#specific_delivery_date_'+id).datepicker({ dateFormat: 'yy-mm-dd' });

				$('#specific_delivery_count').val(id);
			});

			

	  	});
		</script>
		<div class="all_delivery_date">
			<div class="specific_delivery_date_to_clone">
				<div style="display:none">
					<label for="specific_delivery_date">Holiday Date</label>
					<input type="text" name="specific_delivery_date" id="specific_delivery_date" class="datepicker widefat" value="" placeholder="yyyy-mm-dd" />
				</div>
			</div>
			<?php 
			if($delivery_date_count==0) $delivery_date_count = 1;
			for($i=1;$i<=$delivery_date_count;$i++): ?>
				<?php if($i==1): ?>
				 	<div id="first" class="specific_delivery_date">
						<label for="specific_delivery_date">Holiday Date</label>
						<input type="text" name="specific_delivery_date" id="specific_delivery_date" class="datepicker widefat" value="<?php echo $data['specific_delivery_date']; ?>" />
					</div>
				<?php else: ?>
					<div class="specific_delivery_date">
						<label for="specific_delivery_date_<?php echo $i; ?>">Holiday Date <?php echo $i; ?></label>
						<input type="text" name="specific_delivery_date_<?php echo $i; ?>" id="specific_delivery_date_<?php echo $i; ?>" class="datepicker widefat" value="<?php echo $data['specific_delivery_date_'.$i]; ?>" />
					</div>
				<?php endif; ?>
			<?php endfor; ?>
			<input type="hidden" name="specific_delivery_count" id="specific_delivery_count" value="<?php echo $delivery_date_count; ?>">
		</div>
		

		<button class="add_more">Add More Dates+</button>
		<div class="delivery_surcharge">
			<label for="specific_delivery_surcharge">Delivery Surcharge</label>
			<input type="text" name="specific_delivery_surcharge" id="specific_delivery_surcharge" class="widefat" value="<?php echo $data['specific_delivery_surcharge']; ?>">
		</div>
	<?php elseif($post_type=='s_blackout_date'): ?>
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<script>
	  	$(document).ready(function(){

	  		$( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd', minDate: 0 });
		  	
			$('.add_more').on('click', function(e){
				e.preventDefault();

				var specificBlackoutCount = $('.specific_blackout_date').length;
				console.log(specificBlackoutCount)

				var id = specificBlackoutCount + 1;

				var newblackoutdate = $('.specific_blackout_date_to_clone').children().clone();

				newblackoutdate.show().addClass('specific_blackout_date');
				newblackoutdate.find('input').attr('disabled', false);

				$('.all_blackout_date').append(newblackoutdate);

				// newblackoutdate.find('input[type="text"]').mask("9999-99-99",{placeholder:"yyyy-mm-dd"});

				newblackoutdate.attr('id', '');
				newblackoutdate.find('label').first().attr('for', 'specific_blackout_date_'+id).text('Blackout Date '+id);
				newblackoutdate.find('input[type="text"]').attr('name', 'specific_blackout_date_'+id).attr('id', 'specific_blackout_date_'+id).val('');
				newblackoutdate.find('.blackout_receiving_mode').children('div').children('input[type="radio"]').attr('name', 'blackout_receiving_mode_'+id);
				newblackoutdate.find('.blackout_timeframe').children('div').children('input[type="radio"]').attr('name', 'blackout_timeframe_'+id);

				$('#specific_blackout_count').val(id);
			});
	  	});
		</script>
		<div class="all_blackout_date">
			<div class="specific_blackout_date_to_clone">
				<div style="display:none">
					<label class="lbl_specific_blackout_date" for="specific_blackout_date">Blackout Date</label>
					<input type="text" disabled name="specific_blackout_date" id="specific_blackout_date" class="widefat" value="" placeholder="yyyy-mm-dd" />

					<div class="blackout_receiving_mode">
						<label class="lbl_blackout_receiving_mode" for="blackout_receiving_mode">Apply this date on receiving modes:</label>
						<div>
							<input type="radio" disabled name="blackout_receiving_mode" value="delivery"><span>Delivery Only</span>&nbsp;&nbsp;&nbsp;
							<input type="radio" disabled name="blackout_receiving_mode" value="collection"><span>Self Collection Only</span>&nbsp;&nbsp;
							<input type="radio" disabled name="blackout_receiving_mode" value="both"><span>Both Delivery & Self Collection</span>
						</div>
					</div>
					<div class="blackout_timeframe">
						<label class="lbl_blackout_timeframe" for="blackout_timeframe">Choose blackout timeframe:</label>
						<div>
							<input type="radio" name="blackout_timeframe" value="morning"><span>Half Day Morning (6am to 1pm)</span>&nbsp;&nbsp;&nbsp;
							<input type="radio" name="blackout_timeframe" value="evening"><span>Half Day Evening (1pm to 5pm)</span>&nbsp;&nbsp;&nbsp;
							<input type="radio" name="blackout_timeframe" value="full"><span>Full Day</span>&nbsp;&nbsp;&nbsp;
						</div>
					</div>
					<br>
				</div>
			</div>
			<?php 
			$all_time_slots = ['06:00 am - 07:30 am',"06:30 am - 08:00 am","08:00 am - 09:30 am","08:30 am - 10:00 am","09:00 am - 10:30 am","09:30 am - 11:00 am","10:00 am - 11:30 am","10:30 am - 12:00 pm","11:00 am - 12:30 pm","11:30 am - 01:00 pm","12:00 pm - 01:30 pm","12:30 pm - 02:00 pm","01:00 pm - 02:30 pm","01:30 pm - 03:00 pm","02:00 pm - 03:30 pm","02:30 pm - 04:00 pm","03:00 pm - 04:30 pm","03:30 pm - 05:00 pm"];
			if($blackout_date_count==0) $blackout_date_count = 1;
			for($i=1;$i<=$blackout_date_count;$i++): ?>
				<?php if($i==1): ?>
				 	<div id="first" class="specific_blackout_date">
						<label class="lbl_specific_blackout_date" for="specific_blackout_date">Blackout Date</label>
						<input type="text" name="specific_blackout_date" id="specific_blackout_date" class="datepicker widefat" value="<?php echo $data['specific_blackout_date']; ?>" />

						<div class="blackout_receiving_mode">
							<label class="lbl_blackout_receiving_mode" for="blackout_receiving_mode">Apply this date on receiving modes:</label>
							<div>
								<input type="radio" name="blackout_receiving_mode" value="delivery" <?php echo ($data['blackout_receiving_mode']=='delivery') ? 'checked' : ''; ?>><span>Delivery Only</span>&nbsp;&nbsp;&nbsp;
								<input type="radio" name="blackout_receiving_mode" value="collection" <?php echo ($data['blackout_receiving_mode']=='collection') ? 'checked' : ''; ?>><span>Self Collection Only</span>&nbsp;&nbsp;
								<input type="radio" name="blackout_receiving_mode" value="both" <?php echo ($data['blackout_receiving_mode']=='both') ? 'checked' : ''; ?>><span>Both Delivery & Self Collection</span>
							</div>
						</div>
						<div class="blackout_timeframe">
							<label class="lbl_blackout_timeframe" for="blackout_timeframe">Choose blackout timeframe: </label>
							<div>
								<input type="radio" name="blackout_timeframe" value="morning" <?php echo ($data['blackout_timeframe']=='morning') ? 'checked' : ''; ?>><span>Half Day Morning (6am to 1pm)</span>&nbsp;&nbsp;&nbsp;
								<input type="radio" name="blackout_timeframe" value="evening" <?php echo ($data['blackout_timeframe']=='evening') ? 'checked' : ''; ?>><span>Half Day Evening (1pm to 5pm)</span>&nbsp;&nbsp;&nbsp;
								<input type="radio" name="blackout_timeframe" value="full" <?php echo ($data['blackout_timeframe']=='full') ? 'checked' : ''; ?>><span>Full Day</span>&nbsp;&nbsp;&nbsp;
							</div>
						</div>
						<br>
					</div>
				<?php else: ?>
					<div class="specific_blackout_date">
						<label class="lbl_specific_blackout_date_<?php echo $i; ?>" for="specific_blackout_date_<?php echo $i; ?>">Blackout Date <?php echo $i; ?></label>
						<input type="text" name="specific_blackout_date_<?php echo $i; ?>" id="specific_blackout_date_<?php echo $i; ?>" class="datepicker widefat" value="<?php echo $data['specific_blackout_date_'.$i]; ?>" />

						<div class="blackout_receiving_mode">
							<label class="lbl_blackout_receiving_mode_<?php echo $i; ?>" for="blackout_receiving_mode_<?php echo $i; ?>">Apply this date on receiving modes:</label>
							<div>
								<input type="radio" name="blackout_receiving_mode_<?php echo $i; ?>" value="delivery" <?php echo ($data['blackout_receiving_mode_'.$i]=='delivery') ? 'checked' : ''; ?>><span>Delivery Only</span>&nbsp;&nbsp;&nbsp;
								<input type="radio" name="blackout_receiving_mode_<?php echo $i; ?>" value="collection" <?php echo ($data['blackout_receiving_mode_'.$i]=='collection') ? 'checked' : ''; ?>><span>Self Collection Only</span>&nbsp;&nbsp;
								<input type="radio" name="blackout_receiving_mode_<?php echo $i; ?>" value="both" <?php echo ($data['blackout_receiving_mode_'.$i]=='both') ? 'checked' : ''; ?>><span>Both Delivery & Self Collection</span>
							</div>
						</div>
						<div class="blackout_timeframe">
							<label class="lbl_blackout_timeframe_<?php echo $i; ?>" for="blackout_timeframe_<?php echo $i; ?>">Choose blackout timeframe:</label>
							<div>
								<input type="radio" name="blackout_timeframe_<?php echo $i; ?>" value="morning" <?php echo ($data['blackout_timeframe_'.$i]=='morning') ? 'checked' : ''; ?>><span>Half Day Morning (6am to 1pm)</span>&nbsp;&nbsp;&nbsp;
								<input type="radio" name="blackout_timeframe_<?php echo $i; ?>" value="evening" <?php echo ($data['blackout_timeframe_'.$i]=='evening') ? 'checked' : ''; ?>><span>Half Day Evening (1pm to 5pm)</span>&nbsp;&nbsp;&nbsp;
								<input type="radio" name="blackout_timeframe_<?php echo $i; ?>" value="full" <?php echo ($data['blackout_timeframe_'.$i]=='full') ? 'checked' : ''; ?>><span>Full Day</span>&nbsp;&nbsp;&nbsp;
							</div>
						</div>
						<br>
					</div>
				<?php endif; ?>
			<?php endfor; ?>
			<input type="hidden" name="specific_blackout_count" id="specific_blackout_count" value="<?php echo $blackout_date_count; ?>">
		</div>
		
		<button class="add_more">Add More Dates+</button><br>
	<?php endif; ?>

	<?php
	}

	function get_existing_meta($post_type) {
		global $wpdb;

		$sql = "SELECT `ID` FROM ".$wpdb->posts." WHERE post_type = '".$post_type."' AND post_status != 'auto-draft' AND post_status != 'trash' AND post_status = 'publish'";	

		# existing inputs #
		$all_post_id = $wpdb->get_results($sql,ARRAY_A);

		foreach($all_post_id as $each_post) {
			$meta_values[] = get_post_meta($each_post['ID']);
		}

		return $meta_values;
	}

	function saveCouponPost($values) {
		$new_coupon_id = wp_insert_post( $values );

		echo $new_coupon_id;

		// update_post_meta( $new_coupon_id, 'discount_type', $discount_type );
		// update_post_meta( $new_coupon_id, 'coupon_amount', $amount );
		// update_post_meta( $new_coupon_id, 'individual_use', 'yes' );
		// update_post_meta( $new_coupon_id, 'product_ids', '' );
		// update_post_meta( $new_coupon_id, 'exclude_product_ids', '' );
		// update_post_meta( $new_coupon_id, 'usage_limit', '1' );
		// update_post_meta( $new_coupon_id, 'expiry_date', '' );
		// update_post_meta( $new_coupon_id, 'apply_before_tax', 'yes' );
		// update_post_meta( $new_coupon_id, 'free_shipping', 'no' );

	}

	add_action('publish_post', function(){

		echo 'hi';

	});

	// add_action('edit_post', function(){

	// 	$testcoupon = array(
	// 	    'post_title' => 'abc',
	// 	    'post_content' => '',
	// 	    'post_status' => 'publish',
	// 	    'post_author' => 1,
	// 	    'post_type'     => 'shop_coupon'
	// 	); 

	// 	$new_coupon_id = wp_insert_post( $testcoupon );
	// });

	add_action('save_post', function(){
	    global $post;

	    if(isset($_POST) && !empty($_POST))
	      $post_type = $_POST['post_type'];

	    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

	    if(!empty($_POST) && wp_verify_nonce($_POST['jw_nonce'], __FILE__)) {

	      if($post_type=='coupons') {

	        $coupon_code = sanitize_text_field($_POST['post_title']);
	        $amount = sanitize_text_field($_POST['amount']); // Amount
	        $discount_type = sanitize_text_field($_POST['discount_type']); // Type: fixed_cart, percent, fixed_product, percent_product
	        $usage_limit = sanitize_text_field($_POST['usage_limit']);
	        $expiry_date = sanitize_text_field($_POST['expiry_date']);

	        update_post_meta($post->ID, 'coupon_code', $coupon_code);
	        update_post_meta($post->ID, 'amount', $amount);
	        update_post_meta($post->ID, 'discount_type', $discount_type);
	        update_post_meta($post->ID, 'usage_limit', $usage_limit);
	        update_post_meta($post->ID, 'expiry_date', $expiry_date);

	      }else if($post_type=='slider') {
	      	$sort = sanitize_text_field($_POST['sort']);
			update_post_meta($post->ID, 'sort', $sort);

	      }else if($post_type=='s_delivery_date') {
	      	$specific_delivery_count = sanitize_text_field($_POST['specific_delivery_count']);

	      	for($i=1;$i<=$specific_delivery_count;$i++) {
	      		if($i==1) {
	      			$specific_delivery_date = sanitize_text_field($_POST['specific_delivery_date']);
      				update_post_meta($post->ID, 'specific_delivery_date', $specific_delivery_date);
	      		}else {
	      			${'specific_delivery_date'.$i} = sanitize_text_field($_POST['specific_delivery_date_'.$i]);

      				if(!empty(${'specific_delivery_date'.$i})) {
      					update_post_meta($post->ID, 'specific_delivery_date_'.$i, ${'specific_delivery_date'.$i});
      				}
	      		}
	      	}

	      	$specific_delivery_surcharge = sanitize_text_field($_POST['specific_delivery_surcharge']);
	      	update_post_meta($post->ID, 'specific_delivery_surcharge', $specific_delivery_surcharge);

	      }else if($post_type=='s_blackout_date') {
	      	$specific_blackout_count = sanitize_text_field($_POST['specific_blackout_count']);

	      	for($i=1;$i<=$specific_blackout_count;$i++) {
	      		if($i==1) {
	      			$specific_blackout_date = sanitize_text_field($_POST['specific_blackout_date']);
      				update_post_meta($post->ID, 'specific_blackout_date', $specific_blackout_date);

      				$blackoutreceiving_mode = sanitize_text_field($_POST['blackout_receiving_mode']);
	      			update_post_meta($post->ID, 'blackout_receiving_mode', $blackoutreceiving_mode);

	      			$blackout_timeframe = sanitize_text_field($_POST['blackout_timeframe']);
	      			update_post_meta($post->ID, 'blackout_timeframe', $blackout_timeframe);
	      		}else {
	      			${'specific_blackout_date'.$i} = sanitize_text_field($_POST['specific_blackout_date_'.$i]);
	      			${'blackout_receiving_mode'.$i} = sanitize_text_field($_POST['blackout_receiving_mode_'.$i]);
	      			${'blackout_timeframe'.$i} = sanitize_text_field($_POST['blackout_timeframe_'.$i]);

      				if(!empty(${'specific_blackout_date'.$i})) {
      					update_post_meta($post->ID, 'specific_blackout_date_'.$i, ${'specific_blackout_date'.$i});
      					update_post_meta($post->ID, 'blackout_receiving_mode_'.$i, ${'blackout_receiving_mode'.$i});
      					update_post_meta($post->ID, 'blackout_timeframe_'.$i, ${'blackout_timeframe'.$i});
      				}
      				
	      		}

	      	}

	      	

	      }

	    }

	});
?>