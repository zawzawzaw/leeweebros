<?php
/**
 * Login Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<?php wc_print_notices(); ?>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

	<div class="row">
		<div id="sub-title" class="col-md-12">
			<h2><?php _e( 'YOUR PERSONAL INFORMATION', 'woocommerce' ); ?></h2>
			<p>I am a new customer.</p>
		</div>
	</div>
	<div class="space10"></div>
	<form name="login" id="login-form" class="registeration" method="post">

		<?php do_action( 'woocommerce_register_form_start' ); ?>

		<?php apply_filters( 'woocommerce_checkout_fields', array() ); ?>

		<div class="row">
			<div class="col-md-4">
				<label for="first_name" class="asterisk">
					<input type="text" name="first_name" id="first_name" class="input-text medium-input required" placeholder="First Name" value="<?php echo (!empty($_POST['first_name'])) ? esc_attr( $_POST['first_name'] ) : ""; ?>">
				</label>
			</div>
			<div class="col-md-4 col-md-offset-2">
				<label for="email" class="asterisk">
					<input type="text" name="email" id="reg_email" class="input-text medium-input required" placeholder="<?php _e( 'Email', 'woocommerce' ); ?>" value="<?php echo (isset($_POST['email'])) ? esc_attr( $_POST['email'] ) : esc_attr($_GET['email']); ?>">
				</label>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<label for="last_name" class="asterisk">
					<input type="text" name="last_name" id="last_name" class="input-text medium-input" placeholder="Last Name" value="<?php echo (!empty($_POST['last_name'])) ? esc_attr( $_POST['last_name'] ) : ""; ?>">
				</label>
			</div>
			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
				<div class="col-md-5 col-md-offset-2">
					<label for="password" class="asterisk">
						<input type="password" name="password" id="reg_password" class="medium-input input-text" placeholder="Password"><p class="password-desc">(5 character min.)</p>
					</label>
				</div>
			<?php endif; ?>
			
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="title" class="lbl">Title:</label>
				<div class="dropdown">
					<select name="title">
						<option value="Mr">Mr</option>
						<option value="Mrs">Mrs</option>
						<option value="Ms">Ms</option>
						<option value="Miss">Miss</option>
					</select>
				</div>
			</div>
			<div class="col-md-4 col-md-offset-4">
				<label for="title" class="lbl">Date of Birth:</label>
				<div class="dropdown">
					<select name="day">
						<option value="" selected>DD</option>
						<?php for($i=1; $i<=30; $i++): ?>
							<option value="<?php echo $i; ?>" <?php echo ($i==1) ? 'checked' : ''; ?>><?php echo $i; ?></option>
						<?php endfor; ?>
					</select>
				</div>
				<div class="dropdown">
					<select name="month">
						<option value="" selected>MM</option>
						<?php for($i=1; $i<=12; $i++): ?>
							<option value="<?php echo $i; ?>" <?php echo ($i==1) ? 'checked' : ''; ?>><?php echo $i; ?></option>
						<?php endfor; ?>
					</select>
				</div>
				<div class="dropdown">
					<select name="year">
						<option value="" selected>YYYY</option>
						<?php for($i=1920; $i<=2000; $i++): ?>
							<option value="<?php echo $i; ?>" <?php echo ($i==1950) ? 'checked' : ''; ?>><?php echo $i; ?></option>
						<?php endfor; ?>
					</select>
				</div>
			</div>
		</div>
		<div class="space20"></div>

		<div class="row">
			<div class="col-md-12" id="sub-title"><h2>YOUR ADDRESS</h2></div>
		</div>

		<div class="space10"></div>
		<div class="row">
			<div class="col-md-6">
				<label for="address_book_1_country" class="lbl asterisk-2">Country:
					<div class="dropdown">
						<select name="address_book_1_country" class="country">
							<option value="Singapore" selected="selected">Singapore</option>
						</select>
					</div>
				</label>
				<label for="address_book_1_company" class="no-asterisk push-down">
					<input type="text" name="address_book_1_company" class="large-input" placeholder="Company">
				</label>
			</div>
			<div class="col-md-6">
				<label for="address_book_1_addition_info">
					<textarea name="address_book_1_addition_info" id="" cols="15" rows="5" placeholder="Additional Information:"></textarea>
				</label>	
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<label for="address_book_1_address_1" class="asterisk">
					<input type="text" name="address_book_1_address_1" class="large-input" placeholder="Address">
					<p class="desc">Street address, P.O. box, company name, c/o</p>
				</label>
			</div>
			<div class="col-md-6">
				<label for="address_book_1_phone" class="">
					<input type="text" name="address_book_1_phone" class="small-input" placeholder="Telephone">
				</label>
				<label for="address_book_1_mobile" class="asterisk">
					<input type="text" name="address_book_1_mobile" class="small-input" placeholder="Mobile">
				</label>
			</div>
		</div>
		<div class="space10"></div>
		<div class="row">
			<div class="col-md-6">
				<label for="address_book_1_address_2" class="no-asterisk">
					<input type="text" name="address_book_1_address_2" class="large-input" placeholder="Address">
					<p class="desc">Apartment, suite, unit, building, floor, etc.</p>
				</label>
				
				<div class="space10"></div>

				<label for="address_book_1_postcode" class="asterisk">
					<input type="text" name="address_book_1_postcode" class="small-input" placeholder="Zip / Postal Code">
				</label>
				<label for="address_book_1_city" class="">
					<input type="text" name="address_book_1_city" class="small-input" placeholder="Town">
				</label>
			</div>
			<div class="col-md-4">
				<label for="address_book_1_future_ref">
					<textarea name="address_book_1_future_ref" id="" cols="15" rows="5" placeholder="Assign an address title for future reference:"></textarea>
				</label>
				<p class="desc"><span class="asterisk">*</span> Required field</p>
			</div>
		</div>

		<!-- Spam Trap -->
		<div style="left:-999em; position:absolute;">
			<label for="trap"><?php _e( 'Anti-spam', 'woocommerce' ); ?>
			</label><input type="text" name="email_2" id="trap" tabindex="-1" />
		</div>

		<?php do_action( 'woocommerce_register_form' ); ?>
		<?php do_action( 'register_form' ); ?>
		
		<div class="row">
			<div class="col-md-2">
				<?php wp_nonce_field( 'woocommerce-register', 'register' ); ?>
				<input type="submit" name="register" value="Register">
			</div>
		</div>

		<?php do_action( 'woocommerce_register_form_end' ); ?>
	</form>

<?php endif; ?>