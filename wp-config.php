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
define( 'AUTH_KEY',          'j4-S(ZB@-]mOA,SLdr^AuVe$<: A43p`_C!gDL~u;+4njNSF2^uuR+|][>79(;2F' );
define( 'SECURE_AUTH_KEY',   'Qet-O1Hr>,| tGT!SDmU$iB.pyG{.WGpxX06-Rwq+ii}`&J>xzG_c++Rk4e.|>&/' );
define( 'LOGGED_IN_KEY',     'nf.)M.t)AzUfDWtJ>`Nh7-p>uAl7Q=44`@(U 3[$QmmA.Tf8[.mutsf]X0)Z:$R;' );
define( 'NONCE_KEY',         ')9;h= 3gc1EZx?S/C%{~AjA-qe^_9lj=<hvX ,GcN(`^I*9G^<.l,Q$myi4l6e,V' );
define( 'AUTH_SALT',         '_cNHXRJyxfFoTp 3HU>7g9;ON2U,^>Y>dn,(@;xXem.uNS#J&w9DnEW!x`EZCLeE' );
define( 'SECURE_AUTH_SALT',  'EY!^)iH^N)q&);&1joC:0yYN@8Uui3}{+f]xlEj6^X &02Px_O@l3&@.?{O+ZnZ|' );
define( 'LOGGED_IN_SALT',    '. G|2TH:1mytb`kt,45Su+8YYS3jZ o=MSYIw^?vEWJL<D9~-q@@~;S,qGw4h5eq' );
define( 'NONCE_SALT',        'TSE96& Yao][r26{AE2,Pi f?m,5O_nB3fe4lSYIl(xjVQSR]}iDJivc$[QBlhQR' );
define( 'WP_CACHE_KEY_SALT', 'Ss*PxHFXL9:>}T*Q]N|( -#/{WlHu7ZT^Lg(( $>~ds1d],XUQ~@r@ gD*,K3xnb' );


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
