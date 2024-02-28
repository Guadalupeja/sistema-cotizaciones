<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          ' h8hMEG<.`/>-eYou/+1-*Rkqd=:alI2Qn=;fbryn&sr?hvdgoGccj!&Km af-O}' );
define( 'SECURE_AUTH_KEY',   '=6/s  bE9k?z?cXMZIr$<&@ehRO_K,xW,O9Veyt/dVJ?(Ym!![R*oBU9.]~C.O(c' );
define( 'LOGGED_IN_KEY',     'x_a)`i;gcG{ HF_G[WR4$J&y85-(|nvr?FhgU3yoIm|u(2@TOP:K93xzK&c>Kpc.' );
define( 'NONCE_KEY',         'Rgm@6e*rwYnJPO43oTIy%J8CGsl{NvH;;.:4u4,4A+90Od5D>Y8cTiDp)F1d:,}$' );
define( 'AUTH_SALT',         '!{Lv{|i-X6!Kg*:`GSU/aE@N<[XiPl_>+#:&m^PZeej.L!)`/YrF-+],8d/e>^ ;' );
define( 'SECURE_AUTH_SALT',  'v-Y77SM|B.1`V|TxcLhf]N?umgBj(<^x>aX#PZM8c>.9Ic%[]ta.en6mS?6%9L]&' );
define( 'LOGGED_IN_SALT',    'P<#:-T^NrlT-@F1AT2$252q4xh[Z]@VS=ki8)R9x%^5KeViPK{Tp7SZ4=G^,_|.m' );
define( 'NONCE_SALT',        '7Gs4P#S95dm=|,T6#bzn&dt/L>Zi|0(w(Km2wHOVCq5V<P!0~}^Fxm -j.jJHj/|' );
define( 'WP_CACHE_KEY_SALT', 'm30WF1O]N9_|T)s(Wh3EP#q2NU?ZXU{6j2>q@83i:SXzE#f< {:WuO< )7Z-[Jy5' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
