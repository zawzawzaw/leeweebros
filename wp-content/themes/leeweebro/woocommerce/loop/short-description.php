<?php
/**
 * loop short description
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;

if ( ! $post->post_excerpt ) return;
$desc = $post->post_excerpt;
$desc_array = explode('<em>', $desc);

$filtered_min_order = filter_var($desc_array[1], FILTER_SANITIZE_STRING);

if(!empty($filtered_min_order)) {
	$filtered_desc = filter_var($desc_array[0], FILTER_SANITIZE_STRING);
	if(strlen($filtered_desc) > 95) $shorten_desc = substr($filtered_desc, 0, 95);
	else $normal_desc = $filtered_desc;
}else {
	$filtered_desc = filter_var($desc_array[0], FILTER_SANITIZE_STRING);
	if(strlen($filtered_desc) > 140) $shorten_desc = substr($filtered_desc, 0, 140);
	else $normal_desc = $filtered_desc;
}
?>
<p class="desc"><?php echo (!empty($shorten_desc)) ? $shorten_desc . '...' : $normal_desc; ?>﻿<?php echo (!empty($filtered_min_order)) ? '<br><br><br><em>'.$filtered_min_order.'</em>' : ''; ?>﻿</p>
<div class="space20"></div>