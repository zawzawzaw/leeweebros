<?php
/**
 * Edit account form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<?php wc_print_notices(); ?>

<form action="" id="login-form" method="post">

	<div class="row">
		<div class="col-md-12">
			<label for="account_first_name" class="asterisk">
				<input type="text" name="account_first_name" id="account_first_name" class="input-text medium-input" placeholder="First Name" value="<?php echo esc_attr( $user->first_name ); ?>">
			</label>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<label for="account_last_name" class="asterisk">
				<input type="text" name="account_last_name" id="account_last_name" class="input-text medium-input" placeholder="Last Name" value="<?php echo esc_attr( $user->last_name ); ?>">
			</label>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<label for="account_email" class="asterisk">
				<input type="text" name="account_email" id="account_email" class="input-text medium-input" placeholder="<?php _e( 'Email', 'woocommerce' ); ?>" value="<?php echo esc_attr( $user->user_email ); ?>">
			</label>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<label for="password_1" class="asterisk">
				<input type="password" name="password_1" id="password_1" class="medium-input input-text" placeholder="Password (leave blank to keep unchanged)"><p class="password-desc">(5 character min.)</p>
			</label>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<label for="password_2" class="asterisk">
				<input type="password" name="password_2" id="password_2" class="medium-input input-text" placeholder="Password (leave blank to keep unchanged)"><p class="password-desc">(5 character min.)</p>
			</label>
		</div>
	</div>
	<div class="clear"></div>

	<div class="row">
		<div class="col-md-12">
			<input type="submit" class="button" name="save_account_details" value="<?php _e( 'Save changes', 'woocommerce' ); ?>" />
		</div>
	</div>

	<?php wp_nonce_field( 'save_account_details' ); ?>
	<input type="hidden" name="action" value="save_account_details" />
</form>