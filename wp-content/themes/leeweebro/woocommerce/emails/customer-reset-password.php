<?php
/**
 * Customer Reset Password email
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php do_action( 'woocommerce_email_header', $email_heading ); ?>

<p><strong><?php _e( 'You have requested for password be reset for the following account:', 'woocommerce' ); ?></strong></p>
<p><?php printf( __( 'Username: <strong>%s</strong>', 'woocommerce' ), $user_login ); ?></p>
<p><?php _e( 'If this was a mistake, just ignore this email and nothing will happen.', 'woocommerce' ); ?></p>
<p>
	<?php _e( 'To reset your password, visit the following address:', 'woocommerce' ); ?><br>
	<a href="<?php echo esc_url( add_query_arg( array( 'key' => $reset_key, 'login' => rawurlencode( $user_login ) ), wc_get_endpoint_url( 'lost-password', '', get_permalink( wc_get_page_id( 'myaccount' ) ) ) ) ); ?>" style="color:#603913;font-weight:bold;text-decoration:underline">
			<?php _e( 'Click here to reset your password', 'woocommerce' ); ?></a>
</p>
<p></p>

<?php do_action( 'woocommerce_email_footer' ); ?>