<?php

/**
 * AESEncryption Class
 * Encrypts and Decrypts data for sensitive information storage
 * Couple with SSL Cert to prevent eavesdropping.
 * Using AES RIJNDAEL algorithm
 * Encryption algorithm: IV + 256-bit key + value
 *
 * Requires:
 * (1) 256 bit (32 character) AES_pKEY in config/config.php
 * Database:
 * (1)	Type: BLOB
 */

class AESEncryption
{
  private $_pKey;

  public function __construct()
  {
    $this->_pKey = AES_KEY;
    if (strlen($this->_pKey) !== 32){
      throw new Exception("AES_KEY must be 32 characters in length! ".strlen($this->_pKey)." provided instead");
      return false;
    }
  }
  
  /*
  * Returns encrypted data using AES Encryption technology
  * $value = value to be encrypted
  * $iv = Initialization Vector (random key prepended to the front of the encrypted data)
  *	$key = Private Key. If not provided, use default AES_KEY
  */	
  public function aesEncrypt($value, $key=null)
  {
    if (!empty($value)){
      $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC);
      $iv = mcrypt_create_iv($iv_size,MCRYPT_DEV_URANDOM);
      return base64_encode($iv.mcrypt_encrypt(MCRYPT_RIJNDAEL_256, ($key? $key:$this->_pKey), $value, MCRYPT_MODE_CBC, $iv));
    }
    return '';
  }
  
  /*
  * Returns decrypted data
  * $value = value to be decrypted
  * $iv = Initialization Vector (random key prepended to the front of the encrypted data)
  * $key = Private Key. If not provided, use default AES_pKEY in config
  */
  public function aesDecrypt($value, $key=null)
  {
    if (!empty($value)){
      $value = base64_decode($value);
      $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC);
      $iv = substr($value,0,$iv_size);
      $value = substr($value,$iv_size);
      return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, ($key? $key:$this->_pKey), $value, MCRYPT_MODE_CBC, $iv));
    }
    return '';
  }
}