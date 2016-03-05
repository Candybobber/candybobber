<?php

/**
 * Function __autoload for auto connection classes
 * @param $class_name
 */
function __autoload($class_name) {

  // An array of folders that may be necessary classes
  $array_path = array(
    '/models/',
    '/components/',
    '/controllers/',
  );

  // Pass through an array of folders
  foreach ($array_path as $path) {

    // Form the name and path of the file with the class
    $path = ROOT . $path . $class_name . '.php';

    // If such file exists, connect it
    if (is_file($path)) {
      include_once $path;
    }
  }
}