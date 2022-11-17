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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'net-assist-elementor' );

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
define( 'AUTH_KEY',         '{0{n&$#%ZN(:ewCS89M~Y(u@0X ^u9dggO0gS9/QLC[9D~hqTcYfPXrrCpPsf1Uf' );
define( 'SECURE_AUTH_KEY',  '=Lzu=46g{4b6M*hZT;/@I!GV{.MLNR)8(D-5|p,Fb(1^S?TfKVh1g;Q4+7-9^ZLx' );
define( 'LOGGED_IN_KEY',    '$neN[UxlV!^TJ-&E3iC#2SkIklkV6v* .rA_y76eg#sy|3^sIPtr5c2Gz;Cr!sdI' );
define( 'NONCE_KEY',        'LGZs-2E`[_F0DAm>E@s.=0Z>:{V_&^K~k9;#bi~-?y@@AC_;9&BwcLzlikq^*eV$' );
define( 'AUTH_SALT',        'm,104JL2%(c/&p~.-I!#??T.Uv!nm_Q%4rsC,?,3R:[}7@xjK S0>21#b&bBKU J' );
define( 'SECURE_AUTH_SALT', 'u?|2HCp(w<`mX{c{xG$(ERd`PTRUUh ,H^s<?5Z/=T=TCrT)bi1C]A`{u-AtKG$j' );
define( 'LOGGED_IN_SALT',   '9c>+KE>vCZVV<c*3JJ_p3$%0v3`)bDgGx)a<DOIr9+=BX5U1R{+i|z9pEzXTq>$|' );
define( 'NONCE_SALT',       '_#4:L{MgAVhsQ,nt`]>~{FjX}qp^8:Nj9p PPiAs?Vy(5OwiNyEaGW$X$cu23Zl[' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
