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
define( 'DB_NAME', 'sql47_96_152_54' );

/** MySQL database username */
define( 'DB_USER', 'sql47_96_152_54' );

/** MySQL database password */
define( 'DB_PASSWORD', 'rDrzWeETRw' );

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
define( 'AUTH_KEY',         '4h|8DW?l@`G.r5r%oLv2}k!_{tDO/FzZcB-(Sg],?!`KXIKHZMi[VR+pR,shX$p)' );
define( 'SECURE_AUTH_KEY',  'V%=B4%S/Mxe72AqdnTmo8+BX@zqxP]-oV7ICO`habX>Sr5UlI.M!1H<&CgH0)Wa}' );
define( 'LOGGED_IN_KEY',    'Ex>H~|{.#YVV0{TJs~_vKn~j aUb2%B$/m+0FQgZxR)s}?Hz2zooZ=-**mXCEWNI' );
define( 'NONCE_KEY',        ')`dWV)?7`ShWsw47]/AA.ehGa&mN#Qxe,A:@]nJB|d4o)HD3Vcecm({4?tt;%>~t' );
define( 'AUTH_SALT',        '(M2J6{UEm:*<-TV9@R*=q%#$avATkHgrq^sBFi<~awc]Po aAVUnMlmgIY^:%9VX' );
define( 'SECURE_AUTH_SALT', '&(u9]7 qq1.#qrGEmB&a2*Z1SL*=d~  5*?F]2!u/+cWzS8H~#@;ok?/t{}E;FU+' );
define( 'LOGGED_IN_SALT',   'pfa&5@ui3UK(KyJ[+P/7b^<YSP/sJmg6.Ms;tf&9CvqkNZ3?OLU&#EH3F-zMPWQx' );
define( 'NONCE_SALT',       'N!T[_yCB_AXZVfMb&vl@8(I06R)2lAhya.CZzdXQSvzou0.{2j[&ZHz:A8kw*ylc' );

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
