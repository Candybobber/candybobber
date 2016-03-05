<?php

/**
 * Class UserController
 */
class UserController extends Controller{


  /**
   * Action for page 'Registration'
   */
  public function actionRegister() {
    $login = '';
    $email = '';
    $password = '';
    $confirm_password = '';
    $result = FALSE;
    $errors = FALSE;
    // title and pageTitle for main template
    $title =  'Registration' . SEP . SITE_NAME;
    $pageTitle = 'Registration';
    // Form processing
    if (isset($_POST['submit'])) {
      $login = $_POST['login'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $confirm_password = $_POST['confirm_password'];
      // Login validation
      if (!User::checkLogin($login)) {
        $errors[] = 'The login should not be less than 2 characters';
      }
      // Email validation
      if (!User::checkEmail($email)) {
        $errors[] = 'Wrong email';
      }
      // Password validation
      if (!User::checkPassword($password)) {
        $errors[] = 'The password should not be less than 6 characters';
      }
      // confirm password validation
      if (!User::checkRepeatPassword($confirm_password)) {
        $errors[] = 'The current password should not be less than 6 characters';
      }
      // Check email
      if (User::checkEmailExists($email)) {
        $errors[] = $email . ' already in use';
      }
      // Check login
      if (User::checkLoginExists($login)) {
        $errors[] = 'Login ' . $login . ' already in use';
      }
      // Check match password and confirm
      if (!User::checkPasswordConfirm($password, $confirm_password)) {
        $errors[] = 'Passwords do not match';
      }

      if ($errors == FALSE) {
        $result = User::register($login, $email, $password);
      }
    }
    // Including view with params
    $this->view->render('user/register', ['result' => $result,
                                          'errors' => $errors,
                                          'login' => $login,
                                          'email' => $email,
                                          'password' => $password,
                                          'confirm_password' => $confirm_password,
                                          'title' => $title,
                                          'pageTitle' => $pageTitle]);
  }

  /**
   * Action for page 'Login'
   */
  public function actionLogin() {
    $email = '';
    $password = '';
    $errors = FALSE;
    // title and pageTitle for main template
    $title =  'Login' . SEP . SITE_NAME;
    $pageTitle = 'Login';
    // Form processing
    if (isset($_POST['submit'])) {
      $email = $_POST['email'];
      $password = $_POST['password'];
      // Check email
      if (!User::checkEmail($email)) {
        $errors[] = 'Incorrect email';
      }
      // Check password
      if (!User::checkPassword($password)) {
        $errors[] = 'The password should not be less than 6 characters';
      }
      // Check User exist
      $userId = User::checkUserData($email, $password);
      if ($userId == FALSE) {
        $errors[] = 'Incorrect information to access the site';
      }
      // if data is right, authorise user
      else {
        User::auth($userId);
        // Redirect in personal page
        header('Location: /account');
      }
    }
    // Including view with params
    $this->view->render('user/login', ['errors' => $errors,
                                       'email' => $email,
                                       'password' => $password,
                                       'title' => $title,
                                       'pageTitle' => $pageTitle]);
  }

  /**
   * Action for deleting session with user data
   */
  public function actionLogout() {
    unset($_SESSION['user']);
    header('Location: /');
  }
}