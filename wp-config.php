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
define('WP_CACHE', true);
define( 'WPCACHEHOME', '/opt/lampp/htdocs/wordpress/wp-content/plugins/wp-super-cache/' );
define('DB_NAME', 'incotec');

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
define('AUTH_KEY',         'eEfLsIS3!zO;cL<6,:Hn[3|a)*}RA^b~ G]5h*)s/f;,6{)gBlV.$J6|jw=]_O2$');
define('SECURE_AUTH_KEY',  '>y#3ioz=Ryt*z*S2wU:i+zq*qR-{X4@Pn)$St}98f}srh%`[K.|)xj3T5Bf.y^QO');
define('LOGGED_IN_KEY',    '|@gw+U,0V`1ss+*~yw5fa9bA[(cIDTVnm@%gdyYCo@dmZQ0e0KI5dj;m/W<U><C3');
define('NONCE_KEY',        '_, 2Mhliwk~biS13$/Su}fAGI.?2oPvyE,gT=*brq`eum:eV`aXU(*&HpM?u%/Wz');
define('AUTH_SALT',        '_#Xl4OPx|S}yPEmIc^,|Ch&I:h&?e&/R]PkrH_R[/3*fgUtQE2@YOT:W^]($(x:N');
define('SECURE_AUTH_SALT', 'o=qnIS:3fi4Hsjo$rDVs8j2gLg8KJf39k`s4EQS>Zj}Z&_gC2;7..|jd-YS52g2k');
define('LOGGED_IN_SALT',   '%Mh= o+kxV/xr3np^oREH<rS3Rg6]0)N0LZX#WUi=vVN@C4b+Pt|q/{R-G_d6+`!');
define('NONCE_SALT',       'Qk`fBa`^?cp/-rK>.`*qh/#%4-}C6xHvf1ZvaQw=mGR7/14]/pt-6De<1aWrewU:');
define('FS_METHOD','direct');
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
