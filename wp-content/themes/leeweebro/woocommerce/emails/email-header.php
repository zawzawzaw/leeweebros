<?php
/**
 * Email Header
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Load colours
$bg 		= get_option( 'woocommerce_email_background_color' );
$body		= get_option( 'woocommerce_email_body_background_color' );
$base 		= get_option( 'woocommerce_email_base_color' );
$base_text 	= wc_light_or_dark( $base, '#202020', '#ffffff' );
$text 		= get_option( 'woocommerce_email_text_color' );

$bg_darker_10 = wc_hex_darker( $bg, 10 );
$base_lighter_20 = wc_hex_lighter( $base, 20 );
$text_lighter_20 = wc_hex_lighter( $text, 20 );

// For gmail compatibility, including CSS styles in head/body are stripped out therefore styles need to be inline. These variables contain rules which are added to the template inline. !important; is a gmail hack to prevent styles being stripped if it doesn't like something.
$wrapper = "
	background-color: " . esc_attr( $bg ) . ";
	width:100%;
	-webkit-text-size-adjust:none !important;
	margin:0;
	padding: 70px 0 70px 0;
";
$template_container = "
	-webkit-box-shadow:0 0 0 3px rgba(0,0,0,0.025) !important;
	box-shadow:0 0 0 3px rgba(0,0,0,0.025) !important;
	-webkit-border-radius:6px !important;
	border-radius:6px !important;
	background: url(http://103.25.202.72/wp-content/themes/leeweebro/images/content/top-bg.jpg) repeat-x left 0px, url(http://103.25.202.72/wp-content/themes/leeweebro/images/content/middle-bg.jpg) repeat left 0px;
	/*background-color: " . esc_attr( $body ) . ";*/
	/*border: 1px solid $bg_darker_10;*/
	-webkit-border-radius:6px !important;
	border-radius:6px !important;
";
$template_header = "
	/*background-color: " . esc_attr( $base ) .";*/
	color: $base_text;
	-webkit-border-top-left-radius:6px !important;
	-webkit-border-top-right-radius:6px !important;
	border-top-left-radius:6px !important;
	border-top-right-radius:6px !important;
	border-bottom: 0;
	/*font-family:Arial;
	font-weight:bold;
	line-height:100%;*/
	vertical-align:middle;
";
$body_content = "
	/*background-color: " . esc_attr( $body ) . ";*/
	-webkit-border-radius:6px !important;
	border-radius:6px !important;
";
$body_content_inner = "
	color: $text_lighter_20;

	/*font-family:Arial;
	font-size:14px;
	line-height:150%;*/

  	font-family: 'Open Sans', Verdana, sans-serif;
  	font-weight: 400;
  	font-style: normal;
  	font-size: 13px;
	line-height: 18px;
	color: #603913;
	text-align:left;
";
$header_content_h1 = "
	color: " . esc_attr( $base_text ) . ";
	margin:0;
	padding: 28px 24px;
	text-shadow: 0 1px 0 $base_lighter_20;
	display:block;
	/*font-family:Arial;
	font-size:30px;
	font-weight:bold;*/
	font-family: 'SolanoGothicMVBStd-Bd', Verdana, sans-serif;
	font-weight: 300;
	font-style: normal;
	font-size: 42px;
	line-height: 36px;
	text-transform: uppercase;
	display: block;
	color: #da0009;
	text-align:left;
	/*line-height: 150%;*/
";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo get_bloginfo( 'name' ); ?></title>
        <style>
			@font-face {
			  font-family: 'SolanoGothicMVBStd-Bd';
			  src: url('http://103.25.202.72/wp-content/themes/leeweebro/fonts/SolanoGothicMVBStd-Bd.eot?') format('eot'), 
			       url('http://103.25.202.72/wp-content/themes/leeweebro/fonts/SolanoGothicMVBStd-Bd.otf')  format('opentype'),
			       url('http://103.25.202.72/wp-content/themes/leeweebro/fonts/SolanoGothicMVBStd-Bd.woff') format('woff'), 
			       url('http://103.25.202.72/wp-content/themes/leeweebro/fonts/SolanoGothicMVBStd-Bd.ttf')  format('truetype'),
			       url('http://103.25.202.72/wp-content/themes/leeweebro/fonts/SolanoGothicMVBStd-Bd.svg#SolanoGothicMVBStd-Bd') format('svg');
			}
			@font-face {
			  font-family: 'Auto1-Bold';
			  src: url('http://103.25.202.72/wp-content/themes/leeweebro/fonts/Auto1-Bold.eot?') format('eot'), 
			       url('http://103.25.202.72/wp-content/themes/leeweebro/fonts/Auto1-Bold.woff') format('woff'), 
			       url('http://103.25.202.72/wp-content/themes/leeweebro/fonts/Auto1-Bold.ttf')  format('truetype'),
			       url('http://103.25.202.72/wp-content/themes/leeweebro/fonts/Auto1-Bold.svg#Auto1-Bold') format('svg');
			}
        </style>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600,700' rel='stylesheet' type='text/css'>
	</head>
    <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
    	<div style="<?php echo $wrapper; ?>">
        	<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
            	<tr>
                	<td align="center" valign="top">
                    	<table border="0" cellpadding="0" cellspacing="0" width="600" id="template_container" style="<?php echo $template_container; ?>">
                        	<tr>
                        		<td align="center" valign="top">
                        			<?php
			                			if ( $img = get_option( 'woocommerce_email_header_image' ) ) {
			                				echo '<p style="margin-top:47px;"><img src="' . esc_url( $img ) . '" alt="' . get_bloginfo( 'name' ) . '" /></p>';
			                			}
			                		?>
                        		</td>
                        	</tr>
                        	<tr>
                            	<td align="center" valign="top">
                                    <!-- Header -->
                                	<table border="0" cellpadding="0" cellspacing="0" width="600" id="template_header" style="<?php echo $template_header; ?>">
                                        <tr>
                                            <td>
                                            	<hr style="margin-left: 24px;margin-right: 24px;border: none;height: 1px;background:#da0009;">
                                            	<h1 style="<?php echo $header_content_h1; ?>"><?php echo $email_heading; ?></h1>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- End Header -->
                                </td>
                            </tr>
                        	<tr>
                            	<td align="center" valign="top">
                                    <!-- Body -->
                                	<table border="0" cellpadding="0" cellspacing="0" width="600" id="template_body">
                                    	<tr>
                                            <td valign="top" style="<?php echo $body_content; ?>">
                                                <!-- Content -->
                                                <table border="0" cellpadding="20" cellspacing="0" width="100%">
                                                    <tr>
                                                        <td valign="top">
                                                            <div style="<?php echo $body_content_inner; ?>">