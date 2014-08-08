<?php

/**
 * Configuration for: AesEncryption
 * AES_KEY is a 32-character (256-bit) encryption private key. Use for PHP Encryption
 * Every new project should have its unique key
 */
define('AES_KEY', 'YOEHaOJ26QN41i54G1JlS8x0MB4XNfcL');

/**
 * Configuration for: MEMCACHE
 * This is used to seperate the Memcache naming so it does not conflict with other memcache services
 * Every new project should have its own name
 */
define('MEM', 'PHPMVC_');

/**
 * Configuration for: Default TimeZone
 * Set the default timezone to use for scripting
 */
define('DEFAULT_TIMEZONE','Asia/Singapore');

/**
 * Configuration for: Database
 * This is the place where you define your database credentials, database type etc.
 */
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', '');
define('DB_USER', '');
define('DB_PASS', '');

/**
 * Configuration for: HTTP_PROTOCOL
 * DO NOT AMEND. Define the actual protocol in use. .htaccess is already converting http into https
 */
define('HTTP_PROTOCOL',(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://");

/**
 * Configuration for: URL
 * DO NOT AMEND. This will help to define the BASE URL
 */
define('URL', HTTP_PROTOCOL . $_SERVER['HTTP_HOST'] . '/');

/**
 * Configuration for: Twig Views
 * PATH_VIEWS is the path where your view files are. Don't forget the trailing slash!
 * PATH_VIEW_FILE_TYPE is the ending of your view files, like .php, .twig or similar.
 * PATH_VIEW_TWIG_CACHE to store your twig caches.
 */
define('PATH_VIEWS', 'application/views');
define('PATH_VIEW_FILE_TYPE', '.twig');
define('PATH_VIEW_TWIG_CACHE', 'application/tmp/cache');