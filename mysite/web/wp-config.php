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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'wordpress' );

/** MySQL database password */
define( 'DB_PASSWORD', 'wordpress' );

/** MySQL hostname */
define( 'DB_HOST', 'database' );

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
define( 'AUTH_KEY',         '4/)&vWx)S{!*~AjHdQ= T|h7vpC`yQKi=a6dWji##D:A$0tIJ+}D6tc%#g #DH#A' );
define( 'SECURE_AUTH_KEY',  '@|xBqj(zXuk3)pu&{`91q%FBHmjp&HyLioW23@M;AHR`;v1!2GqsAY9BKGdFn1< ' );
define( 'LOGGED_IN_KEY',    'nKCc3S5b-IexypcMW]6)%yKCy]Z5$g$iwldZ(0&,Qo.EWI`;v:O/)j$5{>,2<W]C' );
define( 'NONCE_KEY',        '[,c)aL}{nOh=cIVpV*F,$5~Bbz-_[5&sTgpVsn-PW2/B+7==[F4XW*A;g8&B+/!9' );
define( 'AUTH_SALT',        '[z8q[iVy^h|@Y0>LMi8nPtihp~a0r@y*4o!j5f$@,&nG<vj^nTK0hpBlA~ }6xPs' );
define( 'SECURE_AUTH_SALT', 'wFq*^#J<ZSy9N/|d*)P>vnx>x8^4DYN,+T~-8kE6{E~c#[8CBxl{N%spSrxjTP=l' );
define( 'LOGGED_IN_SALT',   '7Fe6DED#~4r$mcspw,*#~l)R>#W!gYOYKJ;QNIu=$W(dZ!^b@?Pk&6B;_@bX_-#x' );
define( 'NONCE_SALT',       'W~$uCbQ[V+J,g1Mh9p}j[LD#6^wCf/x[=-%k^xE}YF1WZ>uY=Y]~`]BRYe,+L-z-' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
