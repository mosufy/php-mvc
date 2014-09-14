<?php

class CatalogueController extends BaseController
{
  private $_folder = 'catalogue/';

  // http://domain.com/catalogue/
  public function index()
  {
    $this->render($this->_folder . 'index', array(
      'metaTitle' => 'Catalogue',
      'metaDescription' => 'Thank you for using php-mvc framework by mosufy'
    ));
  }
  
  // http://domain.com/catalogue/author/
  public function author($authorName=null)
  {
    if (!empty($authorName)) $this->showByAuthor($authorName);

    $Author = new Author();
    $authorList = $Author->selectAuthorList();

    $this->render($this->_folder . 'author', array(
      'metaTitle' => 'Author - Catalogue',
      'metaDescription' => 'Thank you for using php-mvc framework by mosufy',
      'authorList' => $authorList
    ));
  }
  
  // http://domain.com/catalogue/category/
  public function category($categoryName=null)
  {
    if (!empty($categoryName)) $this->showByCategory($categoryName);

    $Category = new Category();
    $categoryList = $Category->selectCategoryList();

    $this->render($this->_folder . 'category', array(
      'metaTitle' => 'Category - Catalogue',
      'metaDescription' => 'Thank you for using php-mvc framework by mosufy',
      'categoryList' => $categoryList
    ));
  }

  // http://domain.com/catalogue/author/jk-rowling/
  private function showByAuthor($authorName)
  {
    $Book = new Book();
    $booksByAuthor = $Book->selectBooksByAuthor($authorName);
    if (!$booksByAuthor) $this->displayError404();

    $this->render($this->_folder . 'author', array(
      'metaTitle' => 'Author - Catalogue',
      'metaDescription' => 'Thank you for using php-mvc framework by mosufy',
      'books' => $booksByAuthor
    ));
  }

  // http://domain.com/catalogue/category/non-fiction/
  private function showByCategory($categoryName)
  {
    $Book = new Book();
    $booksByCategory = $Book->selectBooksByCategory($categoryName);
    if (!$booksByCategory) $this->displayError404();

    $this->render($this->_folder . 'category', array(
      'metaTitle' => 'Category - Catalogue',
      'metaDescription' => 'Thank you for using php-mvc framework by mosufy',
      'books' => $booksByCategory
    ));
  }
}