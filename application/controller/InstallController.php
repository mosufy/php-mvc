<?php

class InstallController extends BaseController
{
  private $_folder = 'install/';
  private $_page = 'install';

  // http://domain.com/install/
  public function index()
  {
    $this->render($this->_folder . 'index', array(
      'metaTitle' => 'How to Install',
      'metaDescription' => 'Installation instructions for the php-mvc framework by mosufy',
      'page' => $this->_page
    ));
  }
}