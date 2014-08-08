<?php

class ItemModel extends Model
{
  /**
  * Every model needs a database connection and/or Memcached, passed to the model
  * This construct ensures that
  */
  function __construct()
  {
    parent::__construct();
  }
  
  public function selectItemsList()
  {
    // checks if Object Memcached() exists
    if ($this->_memcache){
      $key = MEM.'selectItemsList';
      $cache_result = array();
      $cache_result = $this->_memcache->get($key);
      if ($cache_result){
        return $cache_result;
      }
    }
  
    $this->connectDB();
    $stmt = $this->db->query('
      SELECT itemID,itemName,slug
      FROM items
      WHERE is_active=1
      ORDER BY zIndex ASC
    ');
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
    // stores the data to Memcached for faster data retrieval
    if ($this->_memcache) $this->_memcache->set($key, $data, 3600);
    return $data;
  }
  
  public function selectItemData($item)
  {
    // checks if Object Memcached() exists
    if ($this->_memcache){
      $key = MEM.'selectItemData'.$item;
      $cache_result = array();
      $cache_result = $this->_memcache->get($key);
      if ($cache_result){
        return $cache_result;
      }
    }
  
    // get the last intval assuming our $item is in this format "this-is-an-awesome-shirt-25"
    $itemID = intval(substr(strrchr($item, "-"), 1));
    
    $this->connectDB();
    $stmt = $this->db->prepare('
      SELECT itemID,itemName,slug
      FROM items
      WHERE is_active=1 AND itemID=?
    ');
    $stmt->execute(array($itemID));
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // stores the data to Memcached for faster data retrieval
    if ($this->_memcache) $this->_memcache->set($key, $data, 3600);
    return $data;
  }
}

?>