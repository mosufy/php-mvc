<?php

class Application
{	
  private $Controller = null;
  private $_controller = null;
  private $_controller_raw = null;
  private $_action = null;
  private $_parameter_1 = null;
  private $_parameter_2 = null;
  private $_parameter_3 = null;
  private $_parameter_4 = null;
  
  /**
  * "Start" the application:
  * Analyze the URL elements and calls accordingly the controller/method or the fallback
  */
  public function __construct()
  {
    // create array with URL parts in $url
    $this->splitUrl();
    
    // check for controller: does such a controller exist?
    if (file_exists(ROOT . '/application/controller/' . str_replace('\\','/',$this->_controller) . '.php')){
      // if so, then load this file and create this controller
      // example: if controller would be "Book", then this line would translate into: $Book = new Book();
      $this->Controller = new $this->_controller();
      
      // check for method: does such a method exist in the controller ?
      if (method_exists($this->Controller, $this->_action)){
        // call the method and pass the arguments to it
        if (isset($this->_parameter_3)){
          // will translate to something like $Controller->action($param_1, $param_2, $param_3);
          $this->Controller->{$this->_action}($this->_parameter_1, $this->_parameter_2, $this->_parameter_3);
        } elseif (isset($this->_parameter_2)){
          // will translate to something like $Controller->action($param_1, $param_2);
          $this->Controller->{$this->_action}($this->_parameter_1, $this->_parameter_2);
        } elseif (isset($this->_parameter_1)){
          // will translate to something like $Controller->action($param_1);
          $this->Controller->{$this->_action}($this->_parameter_1);
        } else {
          // if no parameters given, just call the method without parameters, like $Controller->action();
          $this->Controller->{$this->_action}();
        }
      } else {
        // default/fallback: call the index() method of a selected controller
        if (isset($this->_action)){
          $this->Controller->index($this->_action);
        } else {
          $this->Controller->index();
        }
      }
    } else {
      // invalid URL, so simply show home/index
      $HomeController = new HomeController();
      if (empty($this->_controller)){
        // empty URL, so simply show home->index()
        $HomeController->index();
      } else {
        // convert to methodName style
        $method = $this->camelCase($this->_controller_raw);
        if (method_exists($HomeController, $method)){
          $HomeController->$method();
        } else {
          $HomeController->index($this->_controller_raw);
        }
      }
    }
  }
  
  /**
  * Split the URL accordingly to the respective name parameters
  */
  private function splitUrl()
  {		
    if (isset($_GET['url'])){
      $url = trim($_GET['url'], '/');
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = explode('/', $url);

      // Check if first parameter corresponds to the folder structure in Controller
      if ($url[0]=='v1'){
        $this->_controller_raw = isset($url[1]) ? $url[1] : null;
        $this->_controller = 'V1' . (isset($url[1])? '\\'.$this->camelCase($url[1],true) . 'Controller' : '');
        $url = array_splice($url,1);
      } else {
        $this->_controller_raw = isset($url[0]) ? $url[0] : null;
        $this->_controller = isset($url[0]) ? $this->camelCase($url[0],true) . 'Controller' : null;
      }
      
      $this->_action = isset($url[1]) ? $this->camelCase($url[1]) : null;
      $this->_parameter_1 = isset($url[2]) ? $url[2] : null;
      $this->_parameter_2 = isset($url[3]) ? $url[3] : null;
      $this->_parameter_3 = isset($url[4]) ? $url[4] : null;
    }
  }
  
  /**
  * Converts string to camelCase
  * E.g; about-us ==> AboutUs / aboutUs depending on 2nd parameter
  */
  private function camelCase($url, $capitalizeFirstCharacter=false)
  {
    $str = str_replace(' ', '', ucwords(str_replace('-', ' ', $url)));
    if (!$capitalizeFirstCharacter){
      $str = lcfirst($str);
    }
    return $str;
  }
}