<?php

class HomeController extends BaseController
{
  private $_folder = 'home/';

  // http://domain.com/
  public function index($bookName=null)
  {
    if (!empty($bookName)) $this->displayItem($bookName);
    
    $this->render($this->_folder . 'index', array(
      'metaTitle' => 'Hello World',
      'metaDescription' => 'Thank you for using php-mvc framework by mosufy'
    ));
  }
	
  // http://domain.com/book-name
  private function displayBook($bookName)
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