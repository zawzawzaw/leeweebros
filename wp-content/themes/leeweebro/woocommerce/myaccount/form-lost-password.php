<?php
/**
 * Lost password form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<?php wc_print_notices(); ?>

<form method="post" id="login-form" class="lost_reset_password">

	<?php if( 'lost_password' == $args['form'] ) : ?>

        <p><?php echo apply_filters( 'woocommerce_lost_password_message', __( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce' ) ); ?></p>
        <div class="space10"></div>
        <div class="row">
            <div class="col-md-12">
                <label for="user_login" class="asterisk">
                    <input type="text" name="user_login" id="user_login" class="input-text medium-input required" placeholder="Username or email" />
                </label>
            </div>
        </div>

	<?php else : ?>

        <p><?php echo apply_filters( 'woocommerce_reset_password_message', __( 'Enter a new password below.', 'woocommerce') ); ?></p>
        <div class="space10"></div>
        <div class="row">
            <div class="col-md-12">
                <label for="password_1" class="asterisk">
                    <input type="password" name="password_1" id="password_1" class="medium-input input-text" placeholder="New password"><p class="password-desc">(5 character min.)</p>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="password_2" class="asterisk">
                    <input type="password" name="password_2" id="password_2" class="medium-input input-text" placeholder="Re-enter new password"><p class="password-desc">(5 character min.)</p>
                </label>
            </div>
        </div>

        <input type="hidden" name="reset_key" value="<?php echo isset( $args['key'] ) ? $args['key'] : ''; ?>" />
        <input type="hidden" name="reset_login" value="<?php echo isset( $args['login'] ) ? $args['login'] : ''; ?>" />

    <?php endif; ?>

    <div class="clear"></div>

    <div class="row">
        <div class="col-md-12">
            <input type="submit" class="button" name="wc_reset_password" value="<?php echo 'lost_password' == $args['form'] ? __( 'Reset Password', 'woocommerce' ) : __( 'Save', 'woocommerce' ); ?>" />
        </div>
    </div>
	<?php wp_nonce_field( $args['form'] ); ?>

</form>