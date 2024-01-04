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
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'site3' );

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
define( 'AUTH_KEY',         'a`{rv{L2@iaI4uL|b m(.47hr5/fF*!;,(CshX1rfQwkYubRMe2ihAzg.^.yyc:x' );
define( 'SECURE_AUTH_KEY',  'W:h`@T=zib+)Tpfzm9-}7AZpg5J_Ol(hAkW~MhG -*hB|xV8#3PMycZSJuAi]`qp' );
define( 'LOGGED_IN_KEY',    '=hE=J,:.aFrF:n/$IH>9-Yb(Z>2tkrP&x;<GyKJ{9OKCc{,c<7YARTI*ZBx*zpv)' );
define( 'NONCE_KEY',        '/GWg!.n&nXq{l<ng3AnB!8f!g$$hjqhq:~+UbL)]&mwdtd0,ZGE@GO^QfR6Us!Nd' );
define( 'AUTH_SALT',        'Z_)6!y[be~0!4_8&e[zjoa n#[=d?[MH92oe=zv<vy+0#CDS$*lxYS;](7v/wz:9' );
define( 'SECURE_AUTH_SALT', 'uaa{NauE[XD>)2hA4nLaeGTC*nohk7%W/5$xx?QTCaSO7SLrAh~}l^lD{v|HM^yk' );
define( 'LOGGED_IN_SALT',   '2Sbm)2)1BPKb%ZvNfh_1*`B;=MpKV%|r0f#vQc.s XO-8Kdg|^`}t0p~ ,=^?!Aq' );
define( 'NONCE_SALT',       'IDhwQ4_`#-S/]Jb@%4fin4$;[i~uO9G7((b&=eLr]L=E#)px5Kij#eECpwSY(NoH' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

define('JWT_AUTH_SECRET_KEY', 'WordPress Tutorial');
/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
