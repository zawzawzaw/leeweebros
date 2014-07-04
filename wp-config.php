<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'lwb_db');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'QC>KG<ws!o{~1w=OWZoFT18QOA+a&i?J%-0|Y>NWBGAG4/o4%gvv]XZC_M`pFlXk');
define('SECURE_AUTH_KEY',  'K}-yab S~CtHO}CCPaFH3Ah!yi1-RUv,*h)J45Y-+J1RihrC`:l%^nO2>|@%PK(3');
define('LOGGED_IN_KEY',    'rdktmBwyrV|z!L9=b_6c)CqLiI)RH-[), ]9E2[t=xq^OeCG<A$GP:MYeVK(Z?)O');
define('NONCE_KEY',        '-wn#M$oJspG,;oycy)z?FSE;HU6O!`t&A$51D_95W|N?9usRMRkW2+$;{v0k~VmI');
define('AUTH_SALT',        '=>!Fg0TG4FG99Dq;hp~#K+WBdjm1Vt-hCW|1RF5Q8Y5&@rBB%0>+S-Az~,Hz9gE1');
define('SECURE_AUTH_SALT', '|0ZTbi1i39T>}<Es7gQ/iH&Z(?x6|QnO9},JS=g=daWc=Oq58zFI#eKc48*(XmDA');
define('LOGGED_IN_SALT',   'Q+uDy56-@=I57p)^+u!t~F{DZP<8-e-NU%eaU]u}c_$C]a]0= VY(Td n)f?lFiG');
define('NONCE_SALT',       '|Y7RaGw[3Hpkx)PO|sztO{,w;;h]cT!vJ^I?kwY&Qs2xaH@*VTScq?vSXX4r<jN@');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
