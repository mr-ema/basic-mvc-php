<?php

namespace Core;

/**
 * * DEMO ROUTER
 * * THIS ROUTER DON'T HAVE ANY SECURITY FOR THE MOMENT
 * * NEITHER HAVE CUSTOM REQUEST HANDLER ( post|get|delete|put )
 * * PHP 8.0 
 */

class Router  {
  protected $routes = [];

  // * Valid request methods
  private const METHODS = [
    'get' => 'route',
    'post' => 'route',
    'put' => 'route',
    'delete' => 'route'
  ];

  /**
   * * Validate URL
   */
  protected function sanitize(string $requestUrl): string {
    if ($requestUrl === '/')  return $requestUrl;

    $requestUrl = filter_var($requestUrl, FILTER_SANITIZE_URL);
    $requestUrl = rtrim($requestUrl, '/');
    $requestUrl = strtok($requestUrl, '?');
  
    return $requestUrl;
  }

  /**
   * * MAGIC METHOD
   * Check if call is a valid method inside 'METHODS'
   * @return mixed Return 'route function' to add a route
   * The route is added IF the controller exist otherwise return an Exepcion 
   */
  public function __call(string $method, array $args): mixed  {
    if ( !in_array( $method, array_keys(self::METHODS) ) )  {
      throw new \BadMethodCallException();
    }

    $route = $args[0]; // Url route
    $controller = $args[1]; // Front-controller to load

    return call_user_func( array(self::class, 'route'), $route, $controller );
  }

  /**
   * * Add Valid Routes
   * Check IF the route is a valid route and add to $routes array
   * Otherwise return an Exepcion
   * @return void  
  */
  private function route(string $route, string $controller): void {
    try {
      $nameSpace = 'App\Controllers\\'. $controller;

      if ( class_exists($nameSpace) ){
        array_push($this -> routes, array($route => $controller));
      }else {
        throw new \Exception("This route don't have a controller");
      }
    }catch(\Exception $e) {
      echo $e->getMessage();
    }
  }

  /**
   * * Return the controller to render the page
   * * IF the request is a valid url on $routes
   * * This is not the best way to do it, I'm doing research to come with a best method
   */
  public function render($url) {
    $routes = $this -> routes;
    $nameSpace = 'App\Controllers\\';
    $url = $this -> sanitize($url);
    $exist = false;
 
    foreach($routes as $route)  {
      if (array_key_exists($url, $route)) {
        $exist = true;
        $nameSpace = $nameSpace.$route["$url"];
        break;
      }
    }

    if ($exist) {
      $render = new $nameSpace;
      return $render -> indexAction();
    }else {
      throw new \Exception("Not Found", 404);
    }
  }
}