<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'dishariroy_db' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'AN8Z2mLAXRC?8/xK%i[CxtPHhWlW=]j]|;eS*7ePgNJ0;0~l||f:T6o*X1Y.Ph1{' );
define( 'SECURE_AUTH_KEY',  'I}T{aF6k^ggifhHbw)gQ@oe&ncV.H1$1ZEnXMn-tqOB&i-li%k~`N~VAQ<vXo &>' );
define( 'LOGGED_IN_KEY',    'CIDjR01w=Fju#_O2 R>&Z-cA7r0`-S2<mW[[na(xCqhthCJd~e84QtZ{fLy1js`J' );
define( 'NONCE_KEY',        '[RR*hW+fj][oT?@.92fApn:Pkw l=_y[s76b`2B6s^{IT^X40XfhY^+77s&*}RE?' );
define( 'AUTH_SALT',        'oU07]25zeq3=^gJZ8RIoK/&&MGn[xLY ey6(?<^[%PjY`.8-}PiM-|:`gtnd0DO8' );
define( 'SECURE_AUTH_SALT', '1$6neu,Xb#Z4+I2f,l.`u0nhiJ>/kgxAhHmZ|Q,pLp0Ij@+OCNJ<%ry,p9<6Z{~D' );
define( 'LOGGED_IN_SALT',   'N0Y$M{LkK}y#b6<HN/noupO8!KCv_fCG?&K*!y!/0cnf$gXY)nYEmq9E-3?Wv7LS' );
define( 'NONCE_SALT',       '^Fcc?e)abt:oO#t]~PPgI;bODmn+BmnXJo?^La}#KWI=K{~0TO[?Ofb]q2%iEu 8' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
