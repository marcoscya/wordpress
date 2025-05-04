<?php

define( 'WP_CACHE', false /* Modified by NitroPack */ );
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'M6qN !f90<6^mX]tpU%-AW/[6|^LQ01&b|#ht)P*bezSM9qo1)L]K]_WYxbHxC&|' );
define( 'SECURE_AUTH_KEY',  '>GD#o@r<qn>)]zo2a(:)=809D6(>+w{HZ)yI4Ehb{(;)+GR=~2L?@6gq26%3RqI=' );
define( 'LOGGED_IN_KEY',    '.nW`=lmBIkCj[)T4~f}xX,ft7$HRwG(glcD/`ps1>eSgy/p+- 9`i-kx;BOX`LqX' );
define( 'NONCE_KEY',        ']T6GP*vK%f)!+Ry#A)<!b=i}KVkfbgB-4-sOva}!Gb7g0Ej@p}=:!i]h,5ddtM4>' );
define( 'AUTH_SALT',        'b*s?N=ma(X}y{YYO@K*g{Y]|Qz1ZIJalAw/%mb? zXO`:)e=8 70x:2=q6nVFU]T' );
define( 'SECURE_AUTH_SALT', 'lQvAhgzEvTux.FIAWR-&G1vO`:y Py6us:t4X1|*25$~1PAK}vF19*Y.|+5i|HN<' );
define( 'LOGGED_IN_SALT',   '[9qjSzvQ 88DZ{+bn~slxu&oW275iI +{z0xYzGX0My5U8[X:!ZeK0`1%FfXb*R,' );
define( 'NONCE_SALT',       '!KR5DmNV6F@/I[qh%=NFn?JVSc,;$|,>KUiioJ77vH%`@PB_]2hl;dA(U[b/hi3`' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
