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
define('DB_NAME', 'soap');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'P@ssword123');

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
define('AUTH_KEY',         ']W=1AvaDN<eKxx$!NJ,;jqyKV.U@MkatX*5o(4Hnl%G>DMx@^^IGJi(ZBap|2^=U');
define('SECURE_AUTH_KEY',  '(^_yyzh>--p$n,y4r/&<s|k+x1<R6NS75g/f&Rq<mmKdpmS5%:D.l{pEJAnaRa]K');
define('LOGGED_IN_KEY',    'k=(Pqc_kwivVL W(w893!bWEb;bOH}.i6btoz1{Us!Y;-rdYFEcwLar^f2`H:A;T');
define('NONCE_KEY',        '(W8erl  TL&eC:-=h/eQX,@^fT9o,(n>Bga`LE]3!}j3qrNl1HRP!1Qqvuam4P)p');
define('AUTH_SALT',        'wzL&M)ndK:1.xIX?1|@QhLycSH7=1p<MlQO,>9RgS-RVQi~IiJeO)n#4UyLsQAZ|');
define('SECURE_AUTH_SALT', 'qG`8(Ha3sFiV7g4VKt9!Vp~A=Gcd6mG%Kusi=-8!|j=:8sZ3{ldlH$$l,;4V{Ii#');
define('LOGGED_IN_SALT',   '*w#L|eBHa*;svZY(j|QiT$~M<?o+C)=O(.B+M)UcKPhc (JjsQ(`A1H<U#uz>i7n');
define('NONCE_SALT',       '/>xqw( *xve~ HDRRMxjY+0<p;yV5I,nm0l$#yNO)0/9UI3xlq&`zYH`b$yPbX_^');

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
