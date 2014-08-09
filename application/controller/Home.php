<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * Class name must be the same for file name, not case-sensitive as this is handled by autoload class specified on /index.php
 * Class {Home} extends {Controller} means that all methods within the {Controller} will exist within {Home} as well.
 * This is especially useful if you have similar methods that all your Controllers use.
 *
 */
class Home extends Controller
{
  /**
   * PAGE: index
   * This method handles what happens when you move to http://yourproject/ (which is the default page btw)
	 * $item is a variable that gets passed along when you move to http://yourproject/{item}
   */
  public function index($item=null)
  {
    if (!empty($item)) $this->displayItem($item);
    
    // Passes the following information to Controller->render() to render the view for the page
    $this->render('home', array(
      'metaTitle' => 'Hello World',
      'metaDescription' => 'Thank you for using php-mvc framework by mosufy'
    ));
  }
  
  public function page1()
  {
    $Item = new ItemModel();
    $itemsList = $Item->selectItemsList();
    
    $this->render('page1', array(
      'metaTitle' => 'Page 1',
      'metaDescription' => 'Thank you for using php-mvc framework by mosufy',
      'page' => 'page1',
      'itemsList' => $itemsList
    ));
  }
	
  public function page2()
  {
    $this->render('page2', array(
      'metaTitle' => 'Page 2',
      'metaDescription' => 'Thank you for using php-mvc framework by mosufy',
      'page' => 'page2'
    ));
  }
	
  public function page3()
  {		
    $this->render('page3', array(
      'metaTitle' => 'Page 3',
      'metaDescription' => 'Thank you for using php-mvc framework by mosufy',
      'page' => 'page3',
    ));
  }
	
  public function page4()
  {		
    $this->render('page4', array(
      'metaTitle' => 'Page 4',
      'metaDescription' => 'Thank you for using php-mvc framework by mosufy',
      'page' => 'page4',
    ));
  }
	
  /**
  * PAGE: item
  * This method handles what happens when you move to http://yourproject/{item}
  * This method was received from index() to check if the {item} really exists
  * Only then should you display the item. Otherwise, mark it as an error page
  */
  private function displayItem($item)
  {
    $Item = new ItemModel();
    $itemData = $Item->selectItemData($item);
    
    if (!$itemData) $this->displayError404();
    
    $this->render('item', array(
      'metaTitle' => 'Hello World',
      'metaDescription' => 'Thank you for using php-mvc framework by mosufy',
      'itemData' => $itemData
    ));
  }
}