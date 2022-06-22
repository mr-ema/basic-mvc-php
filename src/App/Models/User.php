<?php

namespace App\Models;

use Core\Model;

class User extends Model  {
  /**
   * * Get all users from database
   */
  public static function getAll(): void {
    $db = parent::getDB();
    $query = $db -> query('SELECT * FROM users');

    $users = $query -> fetchAll(\PDO::FETCH_ASSOC);

    if ($users) {
      // output data of each user
      foreach($users as $user) {
        echo "
          <span> {$user['id']} </span>
          <span> {$user['firstname']} </span>
          <span> {$user['lastname']} </span>
          <span> {$user['email']} </span>
        ";
      }
    } else {
      echo "0 results";
    }
    
  }

  // * Sanitize input
  private static function sanitize(array $inputs): array {
    $filters = [
      'string' => FILTER_SANITIZE_SPECIAL_CHARS,
      'email' => FILTER_SANITIZE_EMAIL
    ];

    return filter_var_array($inputs, $filters);
  }

  public static function newUser(string $first, string $last, string $mail ): void {
    try {
      self::sanitize(array(
        'string' => $first, 
        'string' => $last, 
        'email' => $mail
      ));
  
      $db = parent::getDB();
      $query = "INSERT INTO users (firstname, lastname, email)
      VALUES ('$first', '$last', '$mail')";
      // use exec() because no results are returned
      $db->exec($query);
    
    }catch(\Exception $e)  {
      echo $e -> getMessage();
    }
   
  }
}