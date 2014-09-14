<?php

class Book extends Model
{

  function __construct()
  {
    parent::__construct();
  }
  
  public function selectBooksByAuthor($authorName)
  {
    if ($this->_memcache){
      $key = MEM.'selectBooksByAuthor' . $authorName;
      $cache_result = array();
      $cache_result = $this->_memcache->get($key);
      if ($cache_result) return $cache_result;
    }
  
    $this->connectDB();
    $stmt = $this->db->prepare('
      SELECT B.bookID,B.bookName,A.authorName
      FROM books B
      JOIN authors A
        ON B.authorID = A.authorID
      WHERE A.name_slug = ? AND B.is_active=1 AND A.is_active=1
    ');
    $stmt->db->execute(array($authorName));
    $db = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
    if ($this->_memcache) $this->_memcache->set($key, $db, 3600);
    return $db;
  }
  
  public function selectBooksByCategory($categoryName)
  {
    if ($this->_memcache){
      $key = MEM.'selectBooksByCategory' . $categoryName;
      $cache_result = array();
      $cache_result = $this->_memcache->get($key);
      if ($cache_result) return $cache_result;
    }
  
    $this->connectDB();
    $stmt = $this->db->prepare('
      SELECT B.bookID,B.bookName,C.categoryName
      FROM books B
      JOIN categories C
        ON B.categoryID = C.categoryID
      WHERE C.name_slug = ? AND B.is_active=1 AND C.is_active=1
    ');
    $stmt->db->execute(array($categoryName));
    $db = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
    if ($this->_memcache) $this->_memcache->set($key, $db, 3600);
    return $db;
  }
  
  public function selectBookData($bookName)
  {
    if ($this->_memcache){
      $key = MEM.'selectBookData' . $bookName;
      $cache_result = array();
      $cache_result = $this->_memcache->get($key);
      if ($cache_result) return $cache_result;
    }
  
    $this->connectDB();
    $stmt = $this->db->prepare('
      SELECT *
      FROM books
      WHERE B.name_slug = ? AND is_active=1
    ');
    $stmt->db->execute(array($bookName));
    $db = $stmt->fetch(PDO::FETCH_ASSOC);
  
    if ($this->_memcache) $this->_memcache->set($key, $db, 3600);
    return $db;
  }
}

?>