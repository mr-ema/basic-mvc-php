<?php

namespace Core;

/**
 * * Base controller
 * * PHP 8.0 
 */

abstract class Controller {

  /**
   * * Get Model Class From App\Models
   */

  protected function model($model): mixed {
    $nameSpace = 'App\Models\\' . $model;
    try {
      if (class_exists($nameSpace)) {

        $model = new $nameSpace;
        return $model;

      }else {
        throw new \Exception("This Model Not Exist");
      }
    
    }catch(\Exception $e) {
      echo $e -> getMessage();
    }
    
  }
  /**
   * Magic method, called when a inaccessible or no-exitent method
   * is called on an object of this class.
   */
  public function __call(string $name, array $args) : void
  {
    $method = $name . 'Action';

    if (method_exists( $this, $method )) {
      if ($this -> before()) {
        call_user_func_array([$this, $method], $args);
        $this -> after();
      }
    }else {
      throw new \Exception( "Method $method not found in controller".get_class($this) );
    }
  }
  
  // * Called before method
  protected function before(): void {}

  // * Called after method
  protected function after(): void {}
}