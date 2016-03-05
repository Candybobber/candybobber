<?php

/**
 * Class AdminUsersController
 * Administration users
 */
class AdminUsersController extends Controller{

  /**
   * Action for page 'Administration users'
   */
  public function actionUsers() {
    // Checking user for admin rights
    if(User::checkAdmin()) {
      // title and pageTitle for main template
      $title = 'Administration users' . SEP . SITE_NAME;
      $pageTitle = 'Administration users';
      $usersList = User::getUsersList();
      // counter for cycle
      $i = 0;
      // Including view with params
      $this->view->render('admin/users', ['usersList' => $usersList,
                                          'i' => $i,
                                          'title' => $title,
                                          'pageTitle' => $pageTitle,]);
    }
    else Errors::error403();
  }

  /**
   * Action for page 'Delete users'
   * @param $id
   */
  public function actionDelete($id) {
    // Checking user for admin rights
    if(User::checkAdmin()) {
      $user = User::getUserById($id);
      // title and pageTitle for main template
      $title = 'Delete ' . $user['login'] . SEP . SITE_NAME;
      $pageTitle = 'Delete user';
      // Processing forms
      if (isset($_POST['submit'])) {
        User::deleteUserById($id);
        header("Location: /admin/users");
      }
      // Including view with params
      $this->view->render('admin/users_delete', ['user' => $user,
                                                 'title' => $title,
                                                 'pageTitle' => $pageTitle,]);
    }
    else Errors::error403();
  }

  /**
   * Action for page 'Delete users'
   * @param $id
   */
  public function actionEdit($id) {
    // Checking user for admin rights
    if(User::checkAdmin()) {
      $errors = FALSE;
      $result = FALSE;
      $user = User::getUserById($id);

      // title and pageTitle for main template
      $title = 'Edit ' . $user['login'] . SEP . SITE_NAME;
      $pageTitle = 'Edit user';

      // Processing forms
      if (isset($_POST['update'])) {
        $options['login'] = $_POST['login'];
        $options['email'] = $_POST['email'];
        $options['password'] = md5($_POST['password']);

        // Email validation
        if (!User::checkEmail($options['email'])) {
          $errors[] = 'Wrong email';
        }
        // Validation login
        if (!User::checkLogin($options['login'])) {
          $errors[] = 'The login should not be less than 2 characters';
        }
        // Validation password
        if (!User::checkPassword($options['password'])) {
          $errors[] = 'The password should not be less than 6 characters';
        }
        // If there are no errors, edit the data
        if ($errors == FALSE) {
          $result = User::updateUserById($id, $options);
          header("Location: /admin/users");
        }
      }
      // Including view with params
      $this->view->render('admin/users_edit', ['user' => $user,
                                               'title' => $title,
                                               'pageTitle' => $pageTitle,
                                               'result' => $result,
                                               'errors' => $errors]);
    }
    else Errors::error403();
  }
}