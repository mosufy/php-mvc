<?php

class Controller
{
  /**
  * METHOD: render()
  * This method will output your code to /application/views/{$view}
  */
  protected function render($view, $data_array=array())
  {
    // load Twig, the template engine
    // @see http://twig.sensiolabs.org
    $twig_loader = new Twig_Loader_Filesystem(PATH_VIEWS);
    $twig = new Twig_Environment($twig_loader, array(
      'cache' => PATH_VIEW_TWIG_CACHE,
      'auto_reload' => true
    ));
  
    // render a view while passing the to-be-rendered data
    echo $twig->render($view . PATH_VIEW_FILE_TYPE, $data_array);
    exit;
  }
  
  protected function displayError404()
  {
    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
    $this->render('error404', array(
      'metaTitle' => 'Page not found',
      'metaDescription' => 'The page you\'re looking for may have been moved or deleted'	
    ));
  }
}