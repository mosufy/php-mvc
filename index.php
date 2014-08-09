<?php
/**
 * A simple PHP MVC skeleton
 *
 * @package php-mvc
 * @author Panique
 * @link http://www.php-mvc.net
 * @link https://github.com/panique/php-mvc/
 * @license http://opensource.org/licenses/MIT MIT License
 */

// load the (optional) Composer auto-loader
if (file_exists('vendor/autoload.php')) {
  require 'vendor/autoload.php';
}

// Custom auto-loader function
function autoload($class_name){
  $class_name = str_replace("_","/",$class_name);
  if (is_readable('application/models/' . $class_name . '.php')) {
    require_once 'application/models/' . $class_name . '.php';
  } else if (is_readable('application/libs/' . $class_name . '.php')) {
    require_once 'application/libs/' . $class_name . '.php';
  } else if (is_readable('application/controller/' . $class_name . '.php')) {
    require_once 'application/controller/' . $class_name . '.php';
  }
} spl_autoload_register("autoload");

// load application config (error reporting etc.)
require 'application/config/config.php';

// initialize bootstrap
$app = new Bootstrap();

// start the application
$app = new Application();