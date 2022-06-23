<?php

namespace Core;

class View  {
  /**
   * * Render a view file
   * @param string $view // * The view file
   * @param array $args // * Associative array of data to display in the view (optional)
   */

   public static function render(string $view, array $data = []): void {
    extract($data, EXTR_SKIP);

    // * rute relative to core directory /src in this case
    $file = dirname(__DIR__) . "/App/Views/$view";

    if ( is_readable($file) ) {
      require $file;
    }else {
      throw new \Exception("Sorry can't found $file");
    }
   }
}