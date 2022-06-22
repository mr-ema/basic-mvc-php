<?php

namespace Core;

use Config\Database as CONFIG;

abstract class Model  {
  /**
   * * Connection params
   * @param string
   */
  private const DSN = 'mysql:host='.CONFIG::DB_HOST.';dbname='.CONFIG::DB_NAME;
  private const USER = CONFIG::DB_USER;
  private const PASS = CONFIG::DB_PASSWORD; 

  // * Get PDO database connection
  protected static function getDB(): mixed {
    static $db = NULL;

    try {
      if ($db === NULL) {
        $db = new \PDO(self::DSN, self::USER, self::PASS);

        // Throw an Exception when an error occurs
        $db -> setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $db;
      }
    }catch(\Exception $e)  {
      return $e -> getMessage();
    }
  }

}