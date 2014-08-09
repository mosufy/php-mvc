<?php

class Account_Base extends Controller
{
  protected $_userID = null;
  
  function __construct()
  {
    /*if (!isset($_SESSION)) session_start();
    
    $Auth = new AuthModel();
    if (!$Auth->authenticateUser()){
      header('Location: ' . URL . 'login');
      exit;
    } else {
      $this->_userID = $_SESSION['userID'];
    }*/
    
    $this->_userID = 1;
  }
  
  protected function setCommonVars()
  {
    $data = array(
      'name' => isset($_SESSION['name'])? $_SESSION['name']:'Sample User',
      'is_admin' => isset($_SESSION['is_admin'])? $_SESSION['is_admin']:0
    );
    return $data;
  }
}