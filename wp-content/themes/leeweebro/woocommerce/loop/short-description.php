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
?>
<p class="desc"><?php echo $post->post_excerpt; ?>﻿</p>
<div class="space10"></div>