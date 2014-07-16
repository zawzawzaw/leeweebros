<?php 
global $woocommerce;
$total_amount = $woocommerce->cart->total;
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
								<div class="circle-text active">RECEVING MODE</div>
								<div class="circle done"></div>
							</div>
						</li>
						<li class="fourth">
							<div class="circle-holder">
								<div class="circle-text">ADDRESS</div>
								<div class="circle"></div>
							</div>
						</li>
						<li class="fifth">
							<div class="circle-holder">
								<div class="circle-text">PAYMENT</div>
								<div class="circle"></div>
							</div>
						</li>
						<li class="sixth">
							<div class="circle-holder">
								<div class="circle-text">TERMS OF SERVICE</div>
								<div class="circle"></div>
							</div>
						</li>
						<li class="seventh">
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

<div class="receiving-mode-container all-container">
	<div class="row">
		<div class="col-md-12">
			<h2>RECEVING MODE:</h2>
			<p>Please kindly select the choice of collections below.</p>
			<ul class="receiving-method">
				<li>
					<input type="radio" name="receivingmethod" value="delivery" >
					<label for="atm" class="radio-label">
						<span class="radiobtn"></span>
						Delivery
					</label>
				</li>
				<li>
					<input type="radio" name="receivingmethod" value="self" checked>
					<label for="online" class="radio-label">
						<span class="radiobtn"></span>
						Self–Collection
					</label>
				</li>
			</ul>
		</div>
	</div>
	<div class="space50"></div>
	<div class="row">
		<?php 
		global $woocommerce;
		$cart_url = $woocommerce->cart->get_cart_url(); ?>
		<div class="col-md-2"><a href="<?php echo $cart_url; ?>" class="button back-to-cart">PREVIOUS</a></div>
		<div class="col-md-2 col-md-offset-8"><button class="button receiving-mode-next">NEXT</button></div>
	</div>			
</div>

<!-- COLLECTION -->
<div class="collection-container all-container" style="display:none;">
	<form action="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" method="post">
	<div class="row">
		<div class="col-md-6">
			<h2>SELF COLLECTION:</h2>
			<p class="sub-head-desc">Kindly select the appropriate delivery/collection location below.</p>
			<ul class="collection-places">
				<li>
					<input type="radio" name="collection_area" value="allotherarea" checked>
					<label for="online" class="radio-label"><span class="radiobtn"></span>Central Kitchen</label> 
					<span class="address">42 Lorong 1 Realty Park 536959</span>
				</li>
				<li>
					<input type="radio" name="collection_area" value="jurongsentoaarea" >
					<label for="atm" class="radio-label"><span class="radiobtn"></span>Raffles City Shopping Centre</label><span class="address">#B1-57, 252 North Bridge Road 179103</span>
				</li>
				<li>
					<input type="radio" name="collection_area" value="jurongsentoaarea" >
					<label for="atm" class="radio-label"><span class="radiobtn"></span>Tampines Mall</label> 
					<span class="address">#B1-K6, 4 Tampines Central 5 529510</span>
				</li>
				<li>
					<input type="radio" name="collection_area" value="jurongsentoaarea" >
					<label for="atm" class="radio-label"><span class="radiobtn"></span>NEX Serangoon</label> 
					<span class="address">#B1-K6, 23 Serangoon Central 556083</span>
				</li>
				<li>
					<input type="radio" name="collection_area" value="jurongsentoaarea" >
					<label for="atm" class="radio-label"><span class="radiobtn"></span>Other Selected Locations</label><span class="address">Our Customer Service Personnel will advise you</span>
				</li>
			</ul>
		</div>
		<div class="col-md-1">
			<div class="vertical-line"></div>
		</div>
		<div class="col-md-4">
			<h2>DELIVERY:</h2>
			<p>Delivery is not available for orders below $100.</p>
		</div>
	</div>
	<div class="space30"></div>
	<div class="row">
		<div class="col-md-12">
			<h3>SELECT COLLECTION DATE:</h3>
			<div class="space10"></div>
			<div class="delivery_date_container">
				<label for="collection_date_day">Collection Date:</label>
				<div class="dropdown">
					<select name="collection_date_day" id="collection_date_day">
						<option value="">DD</option>
						<?php for($i=1;$i<=31;$i++){ ?>
							<option value="<?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?>"><?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?></option>
						<?php } ?>
					</select>
				</div>
				<div class="dropdown">
					<select name="collection_date_month" id="collection_date_month">
						<option value="">MM</option>
						<?php for($i=1;$i<=12;$i++){ ?>
							<option value="<?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?>"><?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?></option>
						<?php } ?>
					</select>
				</div>
				<div class="dropdown">
					<select name="collection_date_year" id="collection_date_year">
						<option value="">YYYY</option>
						<?php for($i=2014;$i<=2024;$i++){ ?>
							<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						<?php } ?>
					</select>
				</div>
				<a href="#" id="collection_datepicker" class="calendar"></a>
				<input type="text" id="collection_date" style="display:none;" />
			</div>
			<div class="space10"></div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<h3>PLEASE INDICATE TIME OF COLLECTION:</h3>
			<div class="space10"></div>
			<div class="collection_time_container">
				<label for="collection_time">Collection Time:</label>
				<div class="dropdown">
					<select name="collection_time" id="collection_time">
						<option value="5:30 pm – 6:00 pm (Sat/PH only)">5:30 pm – 6:00 pm (Sat/PH only)</option>
					</select>
				</div>
			</div>
		</div>
	</div>
	<div class="space10"></div>
	<div class="row">
		<div class="col-md-12">
			<div class="consumption_time_container">
				<label for="consumption_time">Consumption Time:</label>
				<div class="dropdown">
					<select name="consumption_time_hr" id="consumption_time_hr">
						<option value="">HH</option>
						<?php for($i=1;$i<=12;$i++){ ?>
							<option value="<?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?>"><?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?></option>
						<?php } ?>
					</select>
				</div>
				<div class="dropdown">
					<select name="consumption_time_mm" id="consumption_time_mm">
						<option value="">MM</option>
						<?php for($i=0;$i<=59;$i++){ ?>
							<option value="<?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?>"><?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?></option>
						<?php } ?>
					</select>
				</div>
				<div class="dropdown">
					<select name="consumption_time_am_pm" id="consumption_time_am_pm">
						<option value="">AM/PM</option>
						<option value="AM">AM</option>
						<option value="PM">PM</option>
					</select>
				</div>
				<div class="space10"></div>
				<p class="note">* Please note that orders must be made at least 2 days in advance. Subject to availability on a first come first serve basis</p>
			</div>
		</div>
	</div>
	<div class="space50"></div>
	<div class="row">
		<div class="col-md-2"><button class="button receiving-mode-prev">PREVIOUS</button></div>
		<div class="col-md-2 col-md-offset-8">
			<!-- <input type="submit" class="checkout-button button alt wc-forward" name="proceed" value="<?php _e( 'NEXT', 'woocommerce' ); ?>" /> -->
			<input type="submit" class="button" value="NEXT">
		</div>
		<?php //do_action( 'woocommerce_proceed_to_checkout' ); ?>

		<?php //wp_nonce_field( 'woocommerce-cart' ); ?>
	</div>	
	</form>		
</div>

<!-- DELIVERY -->
<div class="delivery-container all-container" style="display:none;">
	<form action="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" method="post">
		<div class="row">
			<div class="col-md-12">
				<h2>DELIVERY:</h2>
				<ul class="payment-method">
					<input type="hidden" name="cart-amount" class="cart-amount" value="<?php echo $total_amount; ?>">
					<li>
						<input type="radio" name="delivery" value="allotherarea" checked>
						<label for="online" class="radio-label"><span class="radiobtn"></span>All areas excluding Jurong Island & Sentosa</label>
					</li>
					<li>
						<input type="radio" name="delivery" value="jurongsentoaarea" >
						<label for="atm" class="radio-label"><span class="radiobtn"></span>Jurong Island and Sentosa</label>
					</li>
				</ul>
			</div>
		</div>
		<div class="space30"></div>
		<div class="row">
			<div class="col-md-12">
				<h3>SELECT DELIVERY DATE:</h3>
				<div class="space10"></div>
				<div class="delivery_date_container">
					<label for="delivery_date_day">Delivery Date:</label>
					<div class="dropdown">
						<select name="delivery_date_day" id="delivery_date_day">
							<option value="">DD</option>
							<?php for($i=1;$i<=31;$i++){ ?>
								<option value="<?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?>"><?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?></option>
							<?php } ?>
						</select>
					</div>
					<div class="dropdown">
						<select name="delivery_date_month" id="delivery_date_month">
							<option value="">MM</option>
							<?php for($i=1;$i<=12;$i++){ ?>
								<option value="<?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?>"><?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?></option>
							<?php } ?>
						</select>
					</div>
					<div class="dropdown">
						<select name="delivery_date_year" id="delivery_date_year">
							<option value="">YYYY</option>
							<?php for($i=2014;$i<=2024;$i++){ ?>
								<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
							<?php } ?>
						</select>
					</div>
					<a href="#" id="delivery_datepicker" class="calendar"></a>
					<input type="text" id="delivery_date" style="display:none;" />
					<div class="space10"></div>
					<p class="note">* Please note that orders must be made at least 2 days in advance. Subject to availability</p>
				</div>
				<div class="space10"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h3>SELECT TIME OF DELIVERY:</h3>
				<div class="space10"></div>
				<div class="delivery_time_container">
					<label for="delivery_time">Delivery Time:</label>
					<div class="dropdown">
						<select name="delivery_time" id="delivery_time">
							<option value="5:30 pm – 6:00 pm (Sat/PH only)">5:30 pm – 6:00 pm (Sat/PH only)</option>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="space10"></div>
		<div class="row">
			<div class="col-md-12">
				<div class="consumption_time_container">
					<label for="consumption_time">Consumption Time:</label>
					<div class="dropdown">
						<select name="consumption_time_hr" id="consumption_time_hr">
							<option value="">HH</option>
							<?php for($i=1;$i<=12;$i++){ ?>
								<option value="<?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?>"><?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?></option>
							<?php } ?>
						</select>
					</div>
					<div class="dropdown">
						<select name="consumption_time_mm" id="consumption_time_mm">
							<option value="">MM</option>
							<?php for($i=0;$i<=59;$i++){ ?>
								<option value="<?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?>"><?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?></option>
							<?php } ?>
						</select>
					</div>
					<div class="dropdown">
						<select name="consumption_time_am_pm" id="consumption_time_am_pm">
							<option value="">AM/PM</option>
							<option value="AM">AM</option>
							<option value="PM">PM</option>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="space10"></div>
		<div class="row">
			<div class="col-md-12">
				<p class="charges-info">Note: Surcharge is applicable for delivery at selected time range.</p>
				<ul class="charges-info">
					<li><p><span class="red">*</span> Additional S$30 surcharge applies.</p></li>
					<li><p>* Additional S$22 surcharge applies.</p></li>
					<li><p>* Additional S$20 surcharge applies.</p></li>
				</ul>
			</div>
		</div>
		<div class="space50"></div>
		<div class="row">
			<div class="col-md-2"><button class="button receiving-mode-prev">PREVIOUS</button></div>
			<div class="col-md-2 col-md-offset-8"><input type="submit" class="button" value="NEXT"></div>

			<?php //do_action( 'woocommerce_proceed_to_checkout' ); ?>

			<?php //wp_nonce_field( 'woocommerce-cart' ); ?>
		</div>			
	</form>
</div>