<?php

namespace Core;

/**
 * * Base controller
 * * PHP 8.0 
 */

abstract class Controller {
  /**
   * * Parameters from the matched route
   * @var array
   */
  protected $route_params = [];

  /**
   * * Class constructor
   * 
   * @return void
   */
 /*  public function __construct(array $route_params) 
  {
    $this -> route_params = $route_params;
  }
 */
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