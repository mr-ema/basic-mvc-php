<?php
// PHP 8.0
// * Auto load classes

require dirname(__DIR__) . '/vendor/autoload.php';

use Core\View;
View::render('test.php');