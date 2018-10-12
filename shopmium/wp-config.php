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
define('DB_NAME', 'gradites_shopmium');


/** MySQL database username */
define('DB_USER', 'gradites_shopmiu');


/** MySQL database password */
define('DB_PASSWORD', '}~.Y?d(rCTcM');


/** MySQL hostname */
define('DB_HOST', 'localhost');


/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');


/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/** Ms Set Wordpress Memory Limit */
define( 'WP_MEMORY_LIMIT', '256M' );



/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'cNlP+~!1ILa!~;BA|oY*Se*|S/p(Xzv=Y?g0Z&PP;t@stX2%n3-zRn;;2IV}4ZBH');

define('SECURE_AUTH_KEY',  '<B3$gMmO+N[a0;jd1?74{eCWB0Tst4mJEYKtPqfe4X~Z;%arO8mf/a48IcBlO-|<');

define('LOGGED_IN_KEY',    '4c=}nB.DrV/.0uAt5AF]/[(W5L@U6L+$g;l<EdURPBcKxi P]s`dIu)R~nZ&=H)N');

define('NONCE_KEY',        'Jy?7;6HK[%mGb^5i8RGvuy@&5~6*[}K&=oTF<E]!e&(,3q[2&UAOct%%C*Ft6fyp');

define('AUTH_SALT',        'Sy?RiiNivL[8G@VPqu>z/v:Sza]R$mHe5U$2#sosw}h4n6WJb=Un]`vnp&&k=_5W');

define('SECURE_AUTH_SALT', 'Z%Ke uT9IvE~j r|$x6W8U^;I#~=Yk5X9>loW.b&M#jBT>rgb4U&1_VzH[g/]<#R');

define('LOGGED_IN_SALT',   'O)@}hiTEJ22f{Fy~x>^Zd7K)8Dvd4D?`(*04}Lfbg&pz3lF*j+G_ZvcGI:ui-g2e');

define('NONCE_SALT',       'v?j#98p65x4Z?{2:|2Pd13#T*w!06Es`!h[uL^;n!s,=^pFRksaYoH@?jUm&kf^O');


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';


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
define( 'WP_DEBUG_LOG', true );
define ( 'WP_DEBUG_DISPLAY', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
