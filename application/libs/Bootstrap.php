<?php

class Bootstrap
{
  function __construct()
  {
    $this->setDefaultTimeZone();
    $this->setReporting();
    $this->setSessionPath();
  }
  
  /**
  * Configuration for: Error reporting
  * Show all errors and log them to error_log as defined below
  */
  private function setReporting()
  {
    error_reporting(E_ALL);
    ini_set('display_errors','On');
    ini_set('log_errors', 'On');
    ini_set('error_log', ROOT . '/application/tmp/errors/error_'.date('Ymd').'.log');
  }
  
  /**
  * Configuration for: Set Session Path
  * Set the path to store sessions
  */
  private function setSessionPath()
  {
    ini_set('session.save_path',ROOT . '/application/tmp/sessions');
  }
  
  /**
  * Configuration for: Set Default timezone
  * Set the timezone to local time
  */
  private function setDefaultTimeZone()
  {
    date_default_timezone_set(DEFAULT_TIMEZONE);
  }
}
