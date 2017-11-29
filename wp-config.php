<?php

/* dotenv configuration */
require_once(__DIR__ . '/vendor/autoload.php');
(new \Dotenv\Dotenv(__DIR__))->load();

/* Database configuration */
define('DB_NAME',     getenv('DB_NAME'));
define('DB_USER',     getenv('DB_USER'));
define('DB_PASSWORD', getenv('DB_PASSWORD'));
define('DB_HOST',     getenv('DB_HOST'));
define('DB_CHARSET',  getenv('DB_CHARSET'));
define('DB_COLLATE',  getenv('DB_COLLATE'));

$table_prefix = 'wp_';

/** Amazon S3 configuration **/
define('S3_UPLOADS_BUCKET', getenv('S3_UPLOADS_BUCKET'));
define('S3_UPLOADS_KEY',    getenv('S3_UPLOADS_KEY'));
define('S3_UPLOADS_SECRET', getenv('S3_UPLOADS_SECRET'));
define('S3_UPLOADS_REGION', getenv('S3_UPLOADS_REGION'));

/**
 * Secrets and salts
 * regenerate: https://api.wordpress.org/secret-key/1.1/salt/
 */
define('AUTH_KEY',         'M!xTJu_*s,hx/a+Ok!l>3(~r-v6wry=E-|zJ6&q<{m/37X:es?$=2wqU.0:5UHDj');
define('SECURE_AUTH_KEY',  'pKhyiZmFXv/%Va +RMw+pLtYKAt?M2Y9P4}*BTJ2bI-S.Tx%6dpLn-M|Jk8EDBS-');
define('LOGGED_IN_KEY',    'X)i6c|E5kBf?4|a81J@5%|)r]k+)|6oRbHN;rEO-vqBSDf/4zVxVBDK~Vzq6-Nti');
define('NONCE_KEY',        'r;+3+W$w>SfPG|wWC9WVlfT-OAb8bAV];[@/z!`>Yy|qEWGI!ky_qAcKALRwE< +');
define('AUTH_SALT',        'Z!K?iM%)+8Ac~VpC&v+C,`lM0#|9yeb}XX5R+y/K5mZ~dXsCMf>$th8$j=VRBB}b');
define('SECURE_AUTH_SALT', '|R$=v|{-umii_*8qt+9R?]|xTM*D5NG~mLQVUE5^MM&<H34VAAf3bPiL>I}EESkq');
define('LOGGED_IN_SALT',   '0d5skanGt~1,7HM4Ye*-8>b>zRCAC]Oc9rM5LZa-,;iK`J9,9AJYA,F#VuWH4z9y');
define('NONCE_SALT',       'o0>}:Nf^c(,0v(1IlQJ&p3SQ?GKK~Y;TwUDIF]MH%snq}!CIhmHNF~>s[wjE4^aj');

/* Debugging */
define('WP_DEBUG',         true);
define('WP_DEBUG_LOG',     true);
define('WP_DEBUG_DISPLAY', false);

/* Reverse proxy detection */
$header     = $_SERVER['HTTP_X_FORWARDED_PROTO'];
$header_set = (isset($header) ? true : false);
$is_https   = ($header === 'https' ? true : false);


if ($header_set && $is_https) {
  $_SERVER['HTTPS'] = 'on';
}

/* Absolute path to the WordPress directory */
if (!defined('ABSPATH')) {
  define('ABSPATH', dirname(__FILE__) . '/wp/');
}

/* Path definitions */
define('WP_HOME',        'https://' . $_SERVER['HTTP_HOST']);
define('WP_SITEURL',     'https://' . $_SERVER['HTTP_HOST'] . '/wp');
define('CONTENT_DIR',    '/content');
define('PLUGIN_DIR',     '/content/plugins');

$content_dir = dirname(__FILE__) . CONTENT_DIR;
$content_url = WP_HOME . CONTENT_DIR;
$plugin_dir  = dirname(__FILE__) . PLUGIN_DIR;
$plugin_url  = WP_HOME . PLUGIN_DIR;

define('WP_CONTENT_DIR', $content_dir);
define('WP_CONTENT_URL', $content_url);
define('WP_PLUGIN_DIR',  $plugin_dir);
define('WP_PLUGIN_URL',  $plugin_url);

/* Unlike the other path definitions above, the path to the uploads directory is
 * always relative, so it must be defined after ABSPATH is set. */
$uploads_dir =    'content/uploads';
define('UPLOADS', $uploads_dir);

require_once(ABSPATH . 'wp-settings.php');
