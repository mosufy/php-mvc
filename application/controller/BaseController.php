<?php

class BaseController extends Controller
{  
  protected function displayError404()
  {
    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
    $this->render('error404', array(
      'metaTitle' => 'Page not found',
      'metaDescription' => 'The page you\'re looking for may have been moved or deleted'	
    ));
  }
}