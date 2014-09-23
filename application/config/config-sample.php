<?php

/**
 * 32-character (256-bit) encryption private key. Use for PHP Encryption
 * Every new project should have its unique key
 */
define('AES_KEY', 'YOEHaOJ26QN41i54G1JlS8x0MB4XNfcL');

/**
 * This is used to seperate the Memcache naming so it does not conflict with other apps using the same Memcache services
 * Every new project should have its own name
 */
define('MEM', 'PHPMVC_');

/**
 * Set the default timezone to use for scripting
 */
define('DEFAULT_TIMEZONE','Asia/Singapore');

/**
 * This is the place where you define your database credentials, database type etc.
 */
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', '');
define('DB_USER', '');
define('DB_PASS', '');

///////////////////////////////////////////////////
// ANYTHING BELOW THIS LINE SHOULD BE LEFT AS IS //
///////////////////////////////////////////////////

/**
 * Automatically defines the actual protocol to use 
 * E.g; "http://" or "https://"
 */
define('HTTP_PROTOCOL',(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://");

/**
 * Automatically define the BASE URL E.g; "http://www.domain.com/"
 * DOMAIN will take from HTTP_HOST. DOMAIN is especially useful for setting COOKIE
 */
define('URL', HTTP_PROTOCOL . $_SERVER['HTTP_HOST'] . '/');
define('DOMAIN', ltrim($_SERVER['HTTP_HOST'],'www.'));

/**
 * PATH_VIEWS is the path where your view files are. Don't forget the trailing slash!
 * PATH_VIEW_FILE_TYPE is the ending of your view files, like .php, .twig or similar.
 * PATH_VIEW_TWIG_CACHE to store your twig caches.
 */
define('PATH_VIEWS', ROOT . '/application/views/');
define('PATH_VIEW_FILE_TYPE', '.twig');
define('PATH_VIEW_TWIG_CACHE', ROOT . '/application/tmp/cache/');