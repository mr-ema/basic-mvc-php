<?php

namespace App\Controllers;

use \Core\View;
use \Core\Controller as Controller;

/**
 * * Home controller
 *
 * * PHP version 8.0
 */
class Home extends Controller {

  // Show index page
  public function indexAction(): void {
    $userModel = $this -> model('User');
    $users = $userModel::getAll();
    
    View::render('test.php', ['users' => $users]);
  }

  // Add Data To DataBase
  // * This Data Should Be Pass By Url Params 
  public function addAction(array $params): void {}
}