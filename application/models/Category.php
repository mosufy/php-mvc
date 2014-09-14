<?php

class Category extends Model
{

  function __construct()
  {
    parent::__construct();
  }
  
  public function selectCategoryList()
  {
    if ($this->_memcache){
      $key = MEM.'selectCategoryList';
      $cache_result = array();
      $cache_result = $this->_memcache->get($key);
      if ($cache_result) return $cache_result;
    }
  
    $this->connectDB();
    $stmt = $this->db->query('
      SELECT *
      FROM categories
      WHERE is_active=1
    ');
    $db = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
    if ($this->_memcache) $this->_memcache->set($key, $db, 3600);
    return $db;
  }
}

?>