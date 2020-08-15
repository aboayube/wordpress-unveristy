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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '9$ee~t9[DF;LqXgPyTq^A4]Sh8}aPA<k_fjY$}S[JU<P>K7<+~w~m~n&Kh(&dfWV');
define('SECURE_AUTH_KEY',  '@o%R[X8fXQJ,W=90qol8(qMWNB3M~;:YlT9U).o{!~&!iQ|w_b%f{v*H5XqzjvkW');
define('LOGGED_IN_KEY',    'tI*a$5_UNbG-JlF*Hc`7L6>F3 w[No@!5><sgs{wvus0wMXpA>~,]$mQ?>1-9 -x');
define('NONCE_KEY',        ' )hJ;FP4)|!L+i2g!$ILR8dbo7hQX$b8yg6HxwwGBEQ{M?-[R6v^w7VstF{oPfv>');
define('AUTH_SALT',        'swn0RU=ylj2qZTu(]*aKeO#][cuyt6SjC{S@hJosH/u!=Jjv-.xbW{7)cjuAei)x');
define('SECURE_AUTH_SALT', 'PG;3l6]+,z!B1q#yJwmiCu4i1?~(:5g8m#S;0/ndYV+_biiOD7yC^)Y.yeD84V_X');
define('LOGGED_IN_SALT',   'iGpyq1>>yYk)Qfy(O_m!O4yuVvg!qXOA--.b*Het^BT4z2FTOQs?t9J~V(H ?a3I');
define('NONCE_SALT',       '*uHt+p [<{/RN?MmMw/,FoV=%^1>6d&2=LCV,dogqv|>=Q8!}&6+>j3Rr Z^%M|x');

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
