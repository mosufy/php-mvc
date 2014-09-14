<?php
 
class Model
{
  protected $db = null;
  protected $_memcache = null;
  
  function __construct()
  {
    if (class_exists('Memcached')){
      $this->_memcache = new Memcached;
      $this->_memcache->addServer('localhost', 11211) or die ("Could not connect to MEMCACHE");
    }
  }
  
  /**
  * METHOD: connectDB()
  * Establishes a connection to the database
  * PHP PDO represents a prepared statement, allows to execute queries and converts results safely and securely
  * @see http://wiki.hashphp.org/PDO_Tutorial_for_MySQL_Developers
  */
  protected function connectDB()
  {
    // checks if connection already existing
    if (!$this->db){
      try {
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, $options);
      } catch (Exception $e){
        error_log("File: \"". $e->getFile() ."\" Line: \"". $e->getLine()."\" Message: \"". $e->getMessage()."\"");
        echo 'Database connection error.';
        exit;
      }
    }
  }
}