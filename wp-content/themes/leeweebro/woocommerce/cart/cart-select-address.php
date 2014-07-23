<?php 
global $woocommerce;
?>
<div class="progress-indicator-container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="row">
				<div class="col-md-12">
					<ul class="progress-indicator">
						<li class="first">
							<div class="circle-holder">
								<div class="circle-text">LOGIN</div>
								<div class="circle done"></div>
							</div>
						</li>
						<li class="second">
							<div class="circle-holder">
								<div class="circle-text">SUMMARY</div>
								<div class="circle done"></div>
							</div>
						</li>
						<li class="third">
							<div class="circle-holder">
								<div class="circle-text">RECEVING MODE</div>
								<div class="circle done"></div>
							</div>
						</li>
						<li class="fourth">
							<div class="circle-holder">
								<div class="circle-text active">ADDRESS</div>
								<div class="circle done"></div>
							</div>
						</li>
						<li class="fifth">
							<div class="circle-holder">
								<div class="circle-text">PAYMENT</div>
								<div class="circle"></div>
							</div>
						</li>
						<!-- <li class="sixth">
							<div class="circle-holder">
								<div class="circle-text">TERMS OF SERVICE</div>
								<div class="circle"></div>
							</div>
						</li> -->
						<li class="sixth">
							<div class="circle-holder">
								<div class="circle-text">SUBMISSION</div>
								<div class="circle"></div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="space50"></div>
<div class="select-address-container">
	<div id="selectaddress-form">
		<div class="row">
			<div class="col-md-12">
				<label for="billing_address">Choose a billing address:</label>
				<div class="dropdown">
					<?php
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

					for($i=0;$i<=$address_count-1;$i++) {

						foreach ($address_keys as $key => $address_key) {
							$j = $i + 1;
							$address_book_key = 'address_book_' . $j . '_' . $address_key;
							$address_book[$i][$address_key] = get_user_meta( get_current_user_id(), $address_book_key, true );	
						}
					}
					?>
					<select name="billing_address" class="billing_address">
						<option value="">SELECT EXISTING ADDRESS</option>
						<?php if(isset($address_book) && !empty($address_book)): ?>
							<?php foreach ($address_book as $key => $address): ?>
								<?php if(!empty($address['first_name'])): ?>
									<option value="<?php echo htmlspecialchars(json_encode($address)); ?>"><?php echo (!empty($address['future_ref'])) ? $address['future_ref'] : $address['address_1']; ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						<?php endif; ?>
					</select>
				</div>

				<div class="space10"></div>

				<input type="checkbox" name="same" checked="checked">
				<label class="lbl"><span></span>Use the same address for delivery</label>

				<div class="space10"></div>

				<div class="delivery_toggle">
					<label for="delivery_address">Choose a delivery address:</label>
					<div class="dropdown">
						<select name="delivery_address" class="delivery_address">
							<option value="">SELECT EXISTING ADDRESS</option>
							<?php if(isset($address_book) && !empty($address_book)): ?>
								<?php foreach ($address_book as $key => $address): ?>
									<?php if(!empty($address['first_name'])): ?>
										<option value="<?php echo htmlspecialchars(json_encode($address)); ?>"><?php echo (!empty($address['future_ref'])) ? $address['future_ref'] : $address['address_1']; ?></option>
									<?php endif; ?>
								<?php endforeach; ?>
							<?php endif; ?>
						</select>
					</div>
				</div>

				<div class="space20"></div>

				<button class="add_billing secondary-btn">ADD BILLING ADDRESS</button>
				<button class="add_delivery secondary-btn">ADD DELIVERY ADDRESS</button>

				<div class="space20"></div>

				<div class="row">
					<div class="col-md-2">
						<h4></h4>
						<p class="billing-address">
							<span class="name"></span><br>
							<span class="address-1"></span><br>
							<span class="address-2"></span><br>
							<span class="country"></span><span class="postcode"></span><br>
							<span class="tel"></span><br>
							<span class="mobile"></span>
						</p>
						<a href="#" class="update"></a>
					</div>
					<div class="col-md-2 col-md-offset-1">
						<h4></h4>
						<p class="shipping-address">
							<span class="name"></span><br>
							<span class="address-1"></span><br>
							<span class="address-2"></span><br>
							<span class="country"></span><span class="postcode"></span><br>
							<span class="tel"></span><br>
							<span class="mobile"></span>
						</p>
						<a href="#" class="update"></a>
					</div>
				</div>

				<div class="row"><div class="col-md-5"><div class="error-select-address"></div></div></div>

				<div class="space20"></div>
				
				<form id="submitcheckout" action="<?php echo esc_url( $woocommerce->cart->get_checkout_url() ); ?>" method="post">
					<input type="hidden" name="billing_address" id="billing_address_hidden" class="required" />
					<input type="hidden" name="shipping_address" id="shipping_address_hidden" class="required" />
					<input type="hidden" name="receiving_mode" value="<?php echo htmlspecialchars(json_encode($_POST)); ?>" class="required" />
					<textarea name="special_instruction" id="special_instruction" cols="80" rows="10" placeholder="Special Delivery Instruction"></textarea>

					<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>

					<?php wp_nonce_field( 'woocommerce-cart' ); ?>
				</form>
			</div>
		</div>
	</div>
	<div class="space50"></div>
	<div class="row">
		<form id="backtoreceivingmode" action="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" method="post">
			<input type="hidden" name="receiving">
		</form>
		<div class="col-md-2"><button type="submit" class="button select-address-prev-btn">PREVIOUS</button></div>
		<div class="col-md-2 col-md-offset-8"><button type="submit" class="button submit-to-checkout">NEXT</button></div>
	</div>
</div>
<div class="address-container" style="display:none;">
	<form name="login" id="shippingaddress-form" method="post" action="" style="display:none;">
		<div class="row">
			<div class="col-md-6"><h2 class="delivery-location-title">SELECT DELIVERY LOCATION TYPE:</h2></div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<ul class="location">
					<li>
						<input type="radio" name="delivery_location" value="Residential" checked>
						<label for="online" class="radio-label"><span class="radiobtn"></span>Residential</label>
					</li>
					<li>
						<input type="radio" name="delivery_location" value="Company" >
						<label for="atm" class="radio-label"><span class="radiobtn"></span>Company</label>
					</li>
					<li>
						<input type="radio" name="delivery_location" value="Chalet" >
						<label for="atm" class="radio-label"><span class="radiobtn"></span>Chalet</label>
					</li>
					<li>
						<input type="radio" name="delivery_location" value="Public Attractions" >
						<label for="atm" class="radio-label"><span class="radiobtn"></span>Public Attractions <span class="regular">(Sentosa, Gardens By the Bay, etc.)</span></label>
					</li>
					<li>
						<input type="radio" name="delivery_location" value="Public Spaces" >
						<label for="atm" class="radio-label"><span class="radiobtn"></span>Public Spaces <span class="regular">(Beaches, Parks, etc.)</span></label>
					</li>
				</ul>

				<div class="space20"></div>

				<h2 class="delivery-address-title">ADD NEW ADDRESS:</h2>
				<div class="space10"></div>

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
				<input type="hidden" name="existing_or_new" />
				<input type="hidden" name="address_book_id" />
				<input type="hidden" name="same_as_billing" />
				<p class="desc"><span class="asterisk">*</span> Required field</p>
			</div>
		</div>
		<div class="space50"></div>
		<div class="row">
			<div class="col-md-2"><button type="submit" class="button save_delivery_address">SAVE ADDRESS</button></div>
		</div>		
	</form>
	<form name="login" id="billingaddress-form" method="post" action="" style="display:none;">
		<div class="row">
			<div class="col-md-6"><h2 class="billing-location-title">ADD BILLING LOCATION:</h2></div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<ul class="location">
					<li>
						<input type="radio" name="billing_location" value="Residential" checked>
						<label for="online" class="radio-label"><span class="radiobtn"></span>Residential</label>
					</li>
					<li>
						<input type="radio" name="billing_location" value="Company" >
						<label for="atm" class="radio-label"><span class="radiobtn"></span>Company</label>
					</li>
					<li>
						<input type="radio" name="billing_location" value="Chalet" >
						<label for="atm" class="radio-label"><span class="radiobtn"></span>Chalet</label>
					</li>
					<li>
						<input type="radio" name="billing_location" value="Public Attractions" >
						<label for="atm" class="radio-label"><span class="radiobtn"></span>Public Attractions <span class="regular">(Sentosa, Gardens By the Bay, etc.)</span></label>
					</li>
					<li>
						<input type="radio" name="billing_location" value="Public Spaces" >
						<label for="atm" class="radio-label"><span class="radiobtn"></span>Public Spaces <span class="regular">(Beaches, Parks, etc.)</span></label>
					</li>
				</ul>

				<div class="space20"></div>

				<h2 class="billing-address-title">ADD NEW ADDRESS:</h2>
				<div class="space10"></div>

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
				<input type="hidden" name="existing_or_new" />
				<input type="hidden" name="address_book_id" />
				<p class="desc"><span class="asterisk">*</span> Required field</p>
			</div>
		</div>
		<div class="space50"></div>
		<div class="row">
			<div class="col-md-2"><button type="submit" class="button save_billing_address">SAVE ADDRESS</button></div>
		</div>		
	</form>	
</div>