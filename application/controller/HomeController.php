<?php

class HomeController extends BaseController
{
  private $_folder = 'home/';

  // http://domain.com/
  public function index($bookName=null)
  {
    if (!empty($bookName)) $this->displayItem($bookName);
    
    $this->render($this->_folder . 'index', array(
      'metaTitle' => 'PHP-MVC Barebone Framework',
      'metaDescription' => 'Thank you for using PHP-MVC Barebone Framework by mosufy. Learn Model-View-Controller by implementing it yourself.',
      'page' => 'home'
    ));
  }
	
  // http://domain.com/book-name
  private function displayItem($bookName)
  {
    $Book = new Book();
    $bookData = $Book->selectBookData($bookName);
    if (!$bookData) $this->displayError404();
    
    $this->render($this->_folder . 'book', array(
      'metaTitle' => 'Hello World',
      'metaDescription' => 'Thank you for using php-mvc framework by mosufy',
      'bookData' => $bookData
    ));
  }
}