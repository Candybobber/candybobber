<?php

/**
 * Created by PhpStorm.
 * User: qwerty
 * Date: 13.02.2016
 * Time: 14:51
 */
class ErrorController extends Controller{
  public function action404() {
//    header("HTTP/1.1 404 Not Found");
    $data['title'] = '404';
    $this->view->render('error/404', ['data' => $data]);
  }

  public function action403() {
//    header("HTTP/1.1 404 Not Found");
//    $data['title'] = '404';
    include ROOT . '/views/error/403.php';
  }
}