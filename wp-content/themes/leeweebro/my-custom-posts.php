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
				'supports' => array('title','editor','comments'), #learn more about thumbnail
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

		if(isset($meta_values)) {
			foreach ($meta_values as $values) {
				unset($values['_edit_last']);
				unset($values['_edit_lock']);

				$keys = array_keys($values);
			}

			foreach ($keys as $key){
				$data[$key] = get_post_meta($post->ID, $key, true);
			}
		}

		# validation field #
		wp_nonce_field(__FILE__,'jw_nonce');
	?>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
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
		<br>
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

	add_action('save_post', function(){
		global $post;

		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

		if(!empty($_POST) && wp_verify_nonce($_POST['jw_nonce'], __FILE__)) {

			/**
			 * create coupon code
			 */

			// print_r($_POST); exit();

			$coupon_code = $_POST['post_title'];
			$amount = $_POST['amount']; // Amount
			$discount_type = $_POST['discount_type']; // Type: fixed_cart, percent, fixed_product, percent_product
			$usage_limit = $_POST['usage_limit'];
			$expiry_date = $_POST['expiry_date'];

			$coupon = array(
			    'post_title' => 'test',
			    'post_content' => '',
			    'post_status' => 'publish',
			    'post_author' => 1,
			    'post_type'     => 'shop_coupon'
			);

			// print_r($coupon);
			// print_r($amount);
			// print_r($discount_type);
			// print_r($usage_limit);
			// print_r($expiry_date); exit();

			$new_coupon_id = wp_insert_post( $coupon, $wp_error );

			print_r($wp_error);
			print_r($new_coupon_id); exit();

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

	});
?>