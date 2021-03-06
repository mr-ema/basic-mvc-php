<?php

namespace App\Controllers;

use \Core\View;
use \Core\Controller as Controller;

/**
 * Home controller
 *
 * PHP version 8.0
 */
class About extends Controller {

  // Show index page
  public function indexAction(): void {
      View::render('about.php');
  }
}