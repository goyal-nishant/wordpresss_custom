<?php
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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'dashbordProject' );

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
define( 'AUTH_KEY',         ')c@KqG_uoq}mD&he0r=|Bjd*qp7`K,3dFk?)f|i`nR,L4{@i7ml)^?[Jv5H2]3,5' );
define( 'SECURE_AUTH_KEY',  'l[36I@K|guQCE+_6{9d@IRD4tL&6ztvSN5Bn+^dp}K8 PBeicQ%k@l-OWA(|.b8H' );
define( 'LOGGED_IN_KEY',    '$ez@>[9g7l(~AW_,-8n+!9?o3GUbIh5-QfKkh3]=A&Qt2lw+G$w@/W(feF8Jj v@' );
define( 'NONCE_KEY',        '_>(&BfsLbI<BJe{/DJb0?7K?tn@Q%wl5$cU|9Y*D@9n^!|v1-TE*s_]a+!?h!iFh' );
define( 'AUTH_SALT',        'wq.MPnYEUEb,ewgVL/ bbi;=pp2eh|4X_u$kwIz%s{=L[< ~3KjaxpLUz!]WJBB*' );
define( 'SECURE_AUTH_SALT', 'E(%,Q@cu-g*-+mTXR#on4]75COfP@JP|9zcJ;SH#-,SsNcmEdfL}Xq0OE)kS$)@J' );
define( 'LOGGED_IN_SALT',   '+:-@A44Iu39Hmv];j#rxxdc:teOYx@=4V[t[`(u&>Wg ^I8ol^+;{b&2Y3Y9p_Tn' );
define( 'NONCE_SALT',       '-!X]s*e=s.jpnznX/Ky}9r<o7:P>bF{Q*Cup!/[`@gKuUJw(yRg]Ld/8I7*?V[DE' );

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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
