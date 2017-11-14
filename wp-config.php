<?php
/* Find and replace the string '#$#$' with the site name.  */

/* dotenv configuration */
require_once(__DIR__ . '/vendor/autoload.php');
(new \Dotenv\Dotenv(__DIR__))->load();

/* Database configuration */
define('DB_NAME',     'wp_#$#$');
define('DB_USER',     'root');
define('DB_PASSWORD', 'root');
define('DB_HOST',     'db:3306');
define('DB_CHARSET',  'utf8');
define('DB_COLLATE',  '');

$table_prefix = 'wp_';

/** Amazon S3 configuration **/
define('S3_UPLOADS_BUCKET', '#$#$-xzito');
define('S3_UPLOADS_KEY',    getenv('S3_UPLOADS_KEY'));
define('S3_UPLOADS_SECRET', getenv('S3_UPLOADS_SECRET'));
define('S3_UPLOADS_REGION', 'us-east-1');

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
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);

/* Reverse proxy detection */
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

/* Absolute path to the WordPress directory */
if (!defined('ABSPATH')) {
  define('ABSPATH', dirname(__FILE__) . '/wp/');
}

require_once(ABSPATH . 'wp-settings.php');
