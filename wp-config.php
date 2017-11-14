<?php

/** Dotenv setup **/
require_once(__DIR__ . '/vendor/autoload.php');
(new \Dotenv\Dotenv(__DIR__))->load();

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
define('DB_NAME', 'wp_mail');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'db:3306');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/** Amazon S3 configuration **/
define('S3_UPLOADS_BUCKET', 'cai-xzito');
define('S3_UPLOADS_KEY', getenv('S3_UPLOADS_KEY'));
define('S3_UPLOADS_SECRET', getenv('S3_UPLOADS_SECRET'));
define('S3_UPLOADS_REGION', 'us-east-1');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'M!xTJu_*s,hx/a+Ok!l>3(~r-v6wry=E-|zJ6&q<{m/37X:es?$=2wqU.0:5UHDj');
define('SECURE_AUTH_KEY',  'pKhyiZmFXv/%Va +RMw+pLtYKAt?M2Y9P4}*BTJ2bI-S.Tx%6dpLn-M|Jk8EDBS-');
define('LOGGED_IN_KEY',    'X)i6c|E5kBf?4|a81J@5%|)r]k+)|6oRbHN;rEO-vqBSDf/4zVxVBDK~Vzq6-Nti');
define('NONCE_KEY',        'r;+3+W$w>SfPG|wWC9WVlfT-OAb8bAV];[@/z!`>Yy|qEWGI!ky_qAcKALRwE< +');
define('AUTH_SALT',        'Z!K?iM%)+8Ac~VpC&v+C,`lM0#|9yeb}XX5R+y/K5mZ~dXsCMf>$th8$j=VRBB}b');
define('SECURE_AUTH_SALT', '|R$=v|{-umii_*8qt+9R?]|xTM*D5NG~mLQVUE5^MM&<H34VAAf3bPiL>I}EESkq');
define('LOGGED_IN_SALT',   '0d5skanGt~1,7HM4Ye*-8>b>zRCAC]Oc9rM5LZa-,;iK`J9,9AJYA,F#VuWH4z9y');
define('NONCE_SALT',       'o0>}:Nf^c(,0v(1IlQJ&p3SQ?GKK~Y;TwUDIF]MH%snq}!CIhmHNF~>s[wjE4^aj');
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
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);

/**
 * If we're behind a proxy server and using HTTPS, we need to alert Wordpress of
 * that fact see also:
 *   http://codex.wordpress.org/Administration_Over_SSL#Using_a_Reverse_Proxy
 */
$header     = $_SERVER['HTTP_X_FORWARDED_PROTO'];
$header_set = (isset($header) ? true : false);
$is_https   = ($header === 'https' ? true : false);

if ($header_set && $is_https) {
	$_SERVER['HTTPS'] = 'on';
}

/* Path constants */
define('WP_HOME', 'https://' . $_SERVER['HTTP_HOST']);
define('WP_SITEURL', 'https://' . $_SERVER['HTTP_HOST'] . '/wp');
define('CONTENT_DIR', '/content');
define('WP_CONTENT_DIR', dirname(__FILE__) . CONTENT_DIR);
define('WP_CONTENT_URL', WP_HOME . CONTENT_DIR);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/wp/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
