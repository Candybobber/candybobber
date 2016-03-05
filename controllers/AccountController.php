<?php

/**
 * Class AccountController
 * For user account management
 */
class AccountController extends Controller{

  /**
   * Action for page 'Account'
   */
  public function actionIndex() {
    // If user logged
    if (User::checkLogged()) {
      $userId = User::checkLogged();
      $user = User::getUserById($userId);
      // title and pageTitle for main template
      $title =  $user['login'] . SEP . SITE_NAME;
      $pageTitle = 'Account';
      // Including view with params
      $this->view->render('account/index', ['user' => $user,
                                            'title' => $title,
                                            'pageTitle' => $pageTitle]);
    }
    else Errors::error403();
  }

  /**
   * Action for page 'Account edit'
   */
  public function actionEdit() {
    // If user logged
    if (User::checkLogged()) {
    $errors = FALSE;
    $result = FALSE;
    $userId = User::checkLogged();
    $user = User::getUserById($userId);
    // title and pageTitle for main template
    $title =  'Edit ' . $user['login'] . SEP . SITE_NAME;
    $pageTitle = 'Edit user account';
    // Processing forms
    if (isset($_POST['submit'])) {
      $login = $_POST['login'];
      $password = $_POST['password'];
      // Validation login
      if (!User::checkLogin($login)) {
        $errors[] = 'The login should not be less than 2 characters';
      }
      // Validation password
      if (!User::checkPassword($password)) {
        $errors[] = 'The password should not be less than 6 characters';
      }
      // If there are no errors, edit the data
      if ($errors == FALSE) {
        $result = User::edit($userId, $login, $password);
      }
    }
    // Including view with params
    $this->view->render('account/edit', ['result' => $result,
                                         'user' => $user,
                                         'errors' => $errors,
                                         'title' => $title,
                                         'pageTitle' => $pageTitle]);
  }
    else Errors::error403();
  }
}