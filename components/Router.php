<?php

/**
 * Class Router
 * Component for work with routes
 */
class Router {

  /**
   * Property for storage routes array
   * @var array
   */
  public $routes;

  /**
   * Router constructor.
   */
  public function __construct() {

    // Path to routes file
    $routePath = ROOT . '/config/routes.php';

    // Get routes from the file
    $this->routes = include ($routePath);
  }

  /**
   * Return query string
   */
  public function getURI() {
    if (!empty($_SERVER['REQUEST_URI'])) {
      return urldecode(trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
    }
  }

  /**
   * The method for processing the request
   */
  public function run() {

    // Get query string
    $uri = $this->getURI();

    // Check the availability of such a request in an array of routes (routes.php)
    foreach ($this->routes as $uriPattern => $path) {

      // Compare $uriPattern and $uri
      if (preg_match("~$uriPattern~", $uri)) {

        // Get the internal path from the outside under rule
        $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

        // Determine controller, action and parameters
        $segments = explode('/', $internalRoute);
        $controllerName = ucfirst(array_shift($segments)) . 'Controller';
        $actionName = 'action' . ucfirst(array_shift($segments));
        $parameters = $segments;

        if (class_exists($controllerName)) {

          // Create an object, call an action
          $controllerObject = new $controllerName;

          if (method_exists($controllerObject, $actionName)) {

            /* Call the required method ($actionName) from  $controllerObject
             * with parameters ($parameters)
             */
            call_user_func_array(array($controllerObject, $actionName), $parameters);
            return TRUE;
          }
          else Errors::error404();
        }
        else Errors::error404();
      }
    }
  }
}