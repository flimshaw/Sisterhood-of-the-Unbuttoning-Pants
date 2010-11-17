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
define('DB_NAME', 'sisterhood_wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         ']BG`}fKv0<e5aJdJ}elo<^BD:`PP9Jlrj`M1n~z+]~,u8Rgpc$=Qhr1@WUwjcvHS');
define('SECURE_AUTH_KEY',  'K1p|. 8N9.=4q&erQR+.82ysg)SFhm~-xN1|9ST3_hT%^xX${v*AWYq)~p=1PZfN');
define('LOGGED_IN_KEY',    'ojdi6b1 r 1^DnKz#Rb|cRb#tz6ClMBpG4StKL5&].ZZ yl9DLNwwG(1Z(`+^cUf');
define('NONCE_KEY',        'dD91M2MnB%_Y[vhlvEXja:=}0LX(2@Xrv GS4]F.@ON*CE3cRoVZDf_+GpM,]qH-');
define('AUTH_SALT',        'UQAWC[MM8`g4SrN`a3PGtr6(3u[,y.m%z06 :#JmLf+]b5uVuE?pX6JnX#%#Ku:i');
define('SECURE_AUTH_SALT', '(Skd8:ZY4Ls~2?0qv^f1tf/#7`jXF]IG#C-aehSo]Ng]+)VU[QoYV^>:FP~a4>]F');
define('LOGGED_IN_SALT',   'S|^+&gw0Xn{}Ia~Zr@D7T$z>d&Rx)bbvX_8Vn)G d9Izb_|zi~hH@Ek|GF}~Sobq');
define('NONCE_SALT',       '-e hQ>>8.!,$E^Bccc>W(hdm.5xV+;31wOkWp)vRVOZ[g9`_NHn,I*|?>=Q..&cZ');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'sisterhood_wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress.  A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de.mo to wp-content/languages and set WPLANG to 'de' to enable German
 * language support.
 */
define ('WPLANG', '');

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
