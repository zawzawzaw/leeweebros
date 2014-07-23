<?php
/**
 * My Addresses
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$customer_id = get_current_user_id();

$address_count = 0;
for($i=1;$i<=1000;$i++) {
	$key = 'address_book_'.$i.'_address_1';
	$address_1 = get_user_meta( get_current_user_id(), $key, true );
	// if(empty($address_1)) {
	// 	break;
	// }else {
		$address_count++;
	// }
}

$address_keys = array('future_ref', 'address_1', 'address_2', 'country', 'postcode', 'phone', 'mobile', 'first_name', 'last_name', 'company', 'city', 'town');

$address_book = array();

for($i=0;$i<=$address_count-1;$i++) {

	foreach ($address_keys as $key => $address_key) {
		$j = $i + 1;
		$address_book_key = 'address_book_' . $j . '_' . $address_key;
		$address_book[$i][$address_key] = get_user_meta( get_current_user_id(), $address_book_key, true );	
	}
}

// if ( get_option( 'woocommerce_ship_to_billing_address_only' ) === 'no' && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) {
// 	$page_title = apply_filters( 'woocommerce_my_account_my_address_title', __( 'My Addresses', 'woocommerce' ) );
// 	$get_addresses    = apply_filters( 'woocommerce_my_account_get_addresses', array(
// 		'billing' => __( 'Billing Address', 'woocommerce' ),
// 		'shipping' => __( 'Shipping Address', 'woocommerce' )
// 	), $customer_id );
// } else {
// 	$page_title = apply_filters( 'woocommerce_my_account_my_address_title', __( 'My Address', 'woocommerce' ) );
// 	$get_addresses    = apply_filters( 'woocommerce_my_account_get_addresses', array(
// 		'billing' =>  __( 'Billing Address', 'woocommerce' )
// 	), $customer_id );
// }

// $col = 1;

if ( $address_book ) : ?>

<div class="myaddress-container">
	<div class="row">
		<div class="col-md-10">
			<h2><?php echo apply_filters( 'woocommerce_my_account_my_orders_title', __( 'My Addresses', 'woocommerce' ) ); ?></h2>
		</div>
	</div>
	<div class="space10"></div>
	<div class="row">
		<div class="col-md-10">
			<ul>
				<?php foreach ($address_book as $key => $address): ?>
					<?php if(!empty($address['first_name'])): ?>
					<li>
						<p class="my-address-<?php echo $key+1; ?>" data-book="<?php echo $key+1; ?>">
							<span class="name"><?php echo $address['first_name'] . ' ' . $address['last_name']; ?></span><br>
							<span class="address-1"><?php echo $address['address_1']; ?></span><br>							
							<span class="address-2"><?php echo $address['address_2']; ?></span><br>
							<span class="country"><?php echo $address['country'] . ' '; ?></span><span class="postcode"><?php echo $address['postcode']; ?></span><br>
							<span class="mobile"><?php echo $address['mobile'] . ' '; ?></span>
						</p>
						<input type="hidden" name="addressbookindex" value="<?php echo $key+1; ?>" />
						<input type="hidden" name="address" value="<?php echo htmlspecialchars(json_encode($address)); ?>" />
						<a href="#" class="update">Update</a>
						<a href="#" class="delete_address">Delete</a>
					</li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>				
</div>


<div class="address-container" style="display:none;">
	
	<div class="row">
		<div class="col-md-10">
			<h2 class="address-title">ADD NEW ADDRESS:</h2>
		</div>
	</div>
	<div class="space10"></div>
	<form name="newaddress" id="address-form" method="post" action="">
		<div class="row">
			<div class="col-md-6">
				<div class="space20"></div>

				<label for="first_name" class="asterisk">
					<input type="text" name="first_name" class="small-input" placeholder="First Name">
				</label>
				<label for="last_name" class="asterisk">
					<input type="text" name="last_name" class="small-input" placeholder="Last Name">
				</label>

				<label for="company" class="no-asterisk">
					<input type="text" name="company" class="large-input" placeholder="Company">
				</label>

				<label for="address_1" class="asterisk">
					<input type="text" name="address_1" class="large-input" placeholder="Address">
					<p class="desc">Street address, P.O. box, company name, c/o</p>
				</label>
			</div>
			<div class="col-md-6">
				<div class="space20"></div>

				<label for="address_2" class="no-asterisk">
					<input type="text" name="address_2" class="large-input" placeholder="Address">
					<p class="desc">Apartment, suite, unit, building, floor, etc.</p>
				</label>
				
				<div class="space10"></div>

				<label for="postcode" class="asterisk">
					<input type="text" name="postcode" class="small-input" placeholder="Zip / Postal Code">
				</label>
				<label for="city" class="">
					<input type="text" name="city" class="small-input" placeholder="Town">
				</label>

				<!-- <div class="space10"></div> -->

				<label for="country" class="lbl asterisk-2">Country:
					<div class="dropdown">
						<select name="country" class="country">
							<option value="Singapore" selected>Singapore</option>
						</select>
					</div>
				</label>

				<div class="space10"></div>

				<label for="addition_info">
					<textarea name="addition_info" class="push-down" id="" cols="15" rows="5" placeholder="Additional Information:"></textarea>
				</label>

				<div class="space10"></div>

				<label for="telephone" class="">
					<input type="text" name="phone" class="small-input" placeholder="Telephone">
				</label>
				<label for="mobile" class="asterisk">
					<input type="text" name="mobile" class="small-input" placeholder="Mobile">
				</label>
				<input type="hidden" name="address_book_id" />
				<p class="desc"><span class="asterisk">*</span> Required field</p>
			</div>
		</div>
		<div class="space50"></div>
		<div class="row">
			<div class="col-md-2"><button type="submit" class="button save_address">SAVE ADDRESS</button></div>
		</div>		
	</form>

<?php endif; ?>