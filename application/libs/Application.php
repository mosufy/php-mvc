<?php

class Application
{	
  private $url_controller = null;
  private $url_action = null;
  private $url_file_name = null;
  private $url_parameter_1 = null;
  private $url_parameter_2 = null;
  private $url_parameter_3 = null;
  
  /**
  * "Start" the application:
  * Analyze the URL elements and calls the according controller/method or the fallback
  */
  public function __construct()
  {	
    // create array with URL parts in $url
    $this->splitUrl();
    
    // check for controller: does such a controller exist ?
    if (file_exists('./application/controller/' . $this->url_controller . '.php')){
      // if so, then load this file and create this controller
      // example: if controller would be "Item", then this line would translate into: $this->Item = new Item();
      require './application/controller/' . $this->url_controller . '.php';
      $classObject = implode('\\', array_map('ucfirst', explode('/', $this->url_controller)));
      $this->url_controller = str_replace('\\','',$classObject);
      $this->url_controller = new $classObject();
      
      // check for method: does such a method exist in the controller ?
      if (method_exists($this->url_controller, $this->url_action)){
        // call the method and pass the arguments to it
        if (isset($this->url_parameter_3)){
          // will translate to something like $this->home->method($methodName, $param_1, $param_2, $param_3);
          $this->url_controller->{$this->url_action}($this->url_file_name, $this->url_parameter_1, $this->url_parameter_2, $this->url_parameter_3);
        } elseif (isset($this->url_parameter_2)){
          // will translate to something like $this->home->method($methodName, $param_1, $param_2);
          $this->url_controller->{$this->url_action}($this->url_file_name, $this->url_parameter_1, $this->url_parameter_2);
        } elseif (isset($this->url_parameter_1)){
          // will translate to something like $this->home->method($methodName, $param_1);
          $this->url_controller->{$this->url_action}($this->url_file_name, $this->url_parameter_1);
        } else {
          // if no parameters given, just call the method without parameters, like $this->home->method($methodName);
          $this->url_controller->{$this->url_action}($this->url_file_name);
        }
      } else {
        // default/fallback: call the index() method of a selected controller
        $this->url_controller->index($this->url_file_name,$this->url_parameter_1);
      }
    } else {
      // invalid URL, so simply show home/index
      require './application/controller/home.php';
      $Home = new Home();
      if (empty($this->url_controller)){
        // empty URL, so simply show home->index()
        $Home->index();
      } else {
        $method = $this->convertMethodName($this->url_controller);
        if (method_exists($Home, $method)){
          // Check if method exists in home. If yes, serve the method. Eg.; www.domain.com/method-name
          $Home->$method();
        } else {
          // direct item is served. Eg.; www.domain.com/item-1
          $Home->index($this->url_controller);
        }
      }
    }
  }
  
  /**
  * Get and split the URL
  */
  private function splitUrl()
  {		
    if (isset($_GET['url'])){
      $url = rtrim($_GET['url'], '/');
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = explode('/', $url);
      
      if (isset($url[0])){
        // check if $url[0] is calling for any of the reserved controllers
        if ($url[0]=='api' || $url[0]=='account' || $url[0]=='admin'){
          // replace the url to "controller-safe" naming convention
          $this->url_controller = $url[0] .'_'. (isset($url[1])? $this->convertMethodName($url[1]) : ($url[0] == 'api'? 'v1':'dashboard'));
          $url = array_splice($url,1);
        } else {
          // the first url is the controller
          $this->url_controller = $url[0];
        }
      } else {
        $this->url_controller = null;
      }
      
      // sets the action (method). method will call index if no method is set
      $this->url_action = (isset($url[1]) ? (isset($url[1]) ? $this->convertMethodName($url[1]) : 'index') : null);
      // opens this file. set to home if not set
      $this->url_file_name = (isset($url[1]) ? $url[1] : 'home');
      $this->url_parameter_1 = (isset($url[2]) ? $url[2] : null);
      $this->url_parameter_2 = (isset($url[3]) ? $url[3] : null);
      $this->url_parameter_3 = (isset($url[4]) ? $url[4] : null);
    }
  }
  
  /**
  * Converts from URL name to Method Name
  * E.g; about-us ==> aboutUs
  */
  private function convertMethodName($url)
  {
    $methodName = lcfirst(str_replace('-','',implode('-', array_map('ucfirst', explode('-', $url)))));
    return $methodName;
  }
}