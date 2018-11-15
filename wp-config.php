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
define('DB_NAME', 'c9');

/** MySQL database username */
define('DB_USER', 'nigel_tj');

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
define('AUTH_KEY',         '>QEo=:X H`Xd>;&cI^Z4k/SJQ*(@o2l0r%.;dL77#@D#>i_HruVvVn)vV;s|Vm5J');
define('SECURE_AUTH_KEY',  'dewzvR$g1 Kq@op9{zV/a*OHzK4?V^Cr3q-:A|-B0 *g8?/Iu`[x9{WjIZReN(IZ');
define('LOGGED_IN_KEY',    'Ad+tz+h|khlAlP)pq~A3qzVjSn;(|+%n.X7T*/-WYZ7Zo6o0QFp&C98dW#-g|245');
define('NONCE_KEY',        '?bxOYH_d7sA/zSyOJnxTU1zWcV6:;C8LGSmtRj=ykl1UCiSIf&]B6QOpR3D}.wH ');
define('AUTH_SALT',        'akx=~*Ro8csoK)AF;xr%<jcF`v>vX!$X(U8twIjR_! o.O/Z*ZLz@YsNl-svmWLv');
define('SECURE_AUTH_SALT', 'XAR,-eGuSB+U.h=hXHpo7~ApFn&bx;D.q;.Cczkb5m:HOL8A!{z/4Y!7dKM2^Wq1');
define('LOGGED_IN_SALT',   'wUsyAaA8!~o0DCl0$#T~A9L_8B*G5[($7*nVJi,{Cn;8P,<.iK9;vRmR=[ B6R}D');
define('NONCE_SALT',       '2&YslYiaGOVnQiNDu`3im8MYr@p/gRoWPlKNX6{<BOQPTFy1|znj(Q,B#9+I!h&!');

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
