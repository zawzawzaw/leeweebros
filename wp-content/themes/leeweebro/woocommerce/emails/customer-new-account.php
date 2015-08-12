<?php
/**
 * Customer new account email
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php do_action( 'woocommerce_email_header', $email_heading ); ?>

<p><strong><?php printf( __( "Thanks for creating an account on %s!", 'woocommerce' ), esc_html( $blogname ) ); ?></strong></p
<p>
	<?php printf( __( "Your username is <strong>%s</strong>.", 'woocommerce' ), esc_html( $user_login ) ); ?>
	<?php if ( get_option( 'woocommerce_registration_generate_password' ) == 'yes' && $password_generated ) : ?>
		<?php printf( __( "Your password has been automatically generated: <strong>%s</strong>", 'woocommerce' ), esc_html( $user_pass ) ); ?>
	<?php endif; ?>
</p>
<p><?php printf( __( 'You can access your account area to view your orders and change your password here: <strong>%s.</strong>', 'woocommerce' ), '<a href="'.get_permalink( wc_get_page_id( 'myaccount' ) ).'" style="color:#603913;font-weight:bold;text-decoration:underline">'.get_permalink( wc_get_page_id( 'myaccount' ) ).'</a>' ); ?></p>
<p></p>

<?php do_action( 'woocommerce_email_footer' ); ?>