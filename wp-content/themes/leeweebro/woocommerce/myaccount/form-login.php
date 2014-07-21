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

<?php 
if(isset($_GET['action'])=='register'):
    woocommerce_get_template( 'myaccount/form-registration.php' );
else:
?>

	<div class="row" id="customer_login">

		<div class="col-md-5">
			<div class="row">
				<div id="sub-title" class="col-md-12">
					<h2><?php _e( 'CREATE YOUR ACCOUNT', 'woocommerce' ); ?></h2>
					<p>Enter your email address to create an account.</p>
				</div>
			</div>
			<div class="space10"></div>

			<form method="get" action="" name="login" id="login-form" class="register">

				<?php do_action( 'woocommerce_register_form_start' ); ?>

				<div class="row">
					<div class="col-md-10">
						<p class="create-account-desc">By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
					</div>
				</div>
				<div class="space20"></div>
				<div class="row">
					<div class="col-md-12">
						<label for="reg_email">
							<input type="text" name="email" id="reg_email" class="input-text medium-input required email" placeholder="<?php _e( 'Email Address', 'woocommerce' ); ?>" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" />
						</label>
					</div>
				</div>

				<?php do_action( 'woocommerce_register_form' ); ?>
				<?php do_action( 'register_form' ); ?>

				<div class="space10"></div>

				<div class="row">
					<div class="col-md-12">
						<input type="submit" class="button" name="action" value="<?php _e( 'Create', 'woocommerce' ); ?>">
					</div>
				</div>

				<?php do_action( 'woocommerce_register_form_end' ); ?>

			</form>
		</div>

		<div class="col-md-2">
			<div class="vertical-line"></div>
		</div>	

		<div class="col-md-5">
			<?php //do_action( 'woocommerce_before_customer_login_form' ); ?>

			<div class="row">
				<div id="sub-title" class="col-md-12">
					<h2><?php _e( 'RETURNING CUSTOMER', 'woocommerce' ); ?></h2>
					<p>I am a returning customer.</p>
				</div>
			</div>
			
			
			<div class="space20"></div>

			<form method="post" id="login-form" class="login">
				<?php wc_print_notices(); ?>
				<?php do_action( 'woocommerce_login_form_start' ); ?>
				<div class="row">
					<div class="col-md-12">
						<label for="username">
							<input type="text" name="username" id="username" class="medium-input input-text required" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" placeholder="<?php _e( 'User Name or Email Address', 'woocommerce' ); ?>">
						</label>
						<label for="password">
							<input type="password" name="password" id="password" class="medium-input input-text required" placeholder="<?php _e( 'Password', 'woocommerce' ); ?>">
						</label>
					</div>
				</div>

				<div class="space10"></div>

				<div class="row">
					<div class="col-md-12">
						<a href="<?php echo esc_url( wc_lostpassword_url() ); ?>" class="password-reminder"><?php _e( 'Forgotten Password', 'woocommerce' ); ?></a>
					</div>
				</div>

				<div class="space10"></div>

				<?php do_action( 'woocommerce_login_form' ); ?>

				<div class="row">
					<div class="col-md-12">
					<?php wp_nonce_field( 'woocommerce-login' ); ?>
					<input type="submit" class="button" name="login" value="<?php _e( 'Login', 'woocommerce' ); ?>" /> 
					</div>
				</div>

				<?php do_action( 'woocommerce_login_form_end' ); ?>

			</form>

			<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
		</div>

	</div>

<?php endif; ?>