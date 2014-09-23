<?php
/**
 * PHP MVC Barebone Framework
 *
 * @package php-mvc
 * @author mosufy
 * @link http://mosufy.com
 * @link https://github.com/mosufy/php-mvc/
 * @license http://opensource.org/licenses/MIT MIT License
 */

// Sets the ROOT directory folder (parent directory of this file)
define('ROOT', dirname(dirname(__FILE__)));

// load the (optional) Composer auto-loader
if (file_exists(ROOT . '/vendor/autoload.php')) {
  require ROOT . '/vendor/autoload.php';
}

// Custom auto-loader function
function autoload($class_name){
  $class_name = str_replace('\\','/',$class_name);
  if (is_readable(ROOT . '/application/models/' . $class_name . '.php')) {
    require_once ROOT . '/application/models/' . $class_name . '.php';
  } else if (is_readable(ROOT . '/application/libs/' . $class_name . '.php')) {
    require_once ROOT . '/application/libs/' . $class_name . '.php';
  } else if (is_readable(ROOT . '/application/controller/' . $class_name . '.php')) {
    require_once ROOT . '/application/controller/' . $class_name . '.php';
  }
} spl_autoload_register("autoload");

// load application config
if (is_readable(ROOT . '/application/config/config.php')) {
  require ROOT . '/application/config/config.php';
} else {
  echo 'Error: Missing required config.php';
  exit;
}

// initialize the application
$app = new Bootstrap();

// start the application
$app = new Application();