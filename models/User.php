<?php

/**
 * Class User
 * Contains static methods with logic for users
 */
class User {

  /**
   * User authentication
   * @param $userId
   */
  public static function auth($userId) {
    $_SESSION['user'] = $userId;
  }

  /**
   * Checks $login: not less than 2 characters
   * @param $login
   * @return bool
   */
  public static function checkLogin($login) {
    if (strlen($login) >= 2) {
      return TRUE;
    }
    return FALSE;
  }

  /**
   * Checks $email
   * @param $email
   * @return bool
   */
  public static function checkEmail($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return TRUE;
    }
    return FALSE;
  }

  /**
   * Checks $password: not less than 6 characters
   * @param $password
   * @return bool
   */
  public static function checkPassword($password) {
    if (strlen($password) >= 6) {
      return TRUE;
    }
    return FALSE;
  }

  /**
   * Checks $confirm_password: not less than 6 characters
   * @param $confirm_password
   * @return bool
   */
  public static function checkRepeatPassword($confirm_password) {
    if (strlen($confirm_password) >= 6) {
      return TRUE;
    }
    return FALSE;
  }

  /**
   * Checks the $email exists
   * @param $email
   * @return bool
   */
  public static function checkEmailExists($email) {
    $db = DB::getConnection();
    $sql = ("SELECT COUNT(*) FROM user WHERE email = :email");
    $result = $db->prepare($sql);
    $result->bindParam(':email', $email, PDO::PARAM_STR);
    $result->execute();
    if ($result->fetchColumn())
      return TRUE;
    return FALSE;
  }

  /**
   * Checks the $login exists
   * @param $login
   * @return bool
   */
  public static function checkLoginExists($login) {
    $db = DB::getConnection();
    $sql = "SELECT COUNT(*) FROM user WHERE login = :login";
    $result = $db->prepare($sql);
    $result->bindParam(':login', $login, PDO::PARAM_STR);
    $result->execute();
    if ($result->fetchColumn())
      return TRUE;
    return FALSE;
  }

  /**
   * Checks are correctly re-enter your $password
   * @param $password
   * @param $confirm_password
   * @return bool
   */
  public static function checkPasswordConfirm($password, $confirm_password) {
    if ($password == $confirm_password) {
      return TRUE;
    }
    return FALSE;
  }

  /**
   * Check if the user exists with the specified $email and $password
   * @param $email
   * @param $password
   * @return bool
   */
  public static function checkUserData($email, $password) {
    $password = md5($password);
    $db = DB::getConnection();
    $sql = "SELECT * FROM user WHERE email = :email AND password = :password";
    $result = $db->prepare($sql);
    $result->bindParam(':email', $email, PDO::PARAM_STR);
    $result->bindParam(':password', $password, PDO::PARAM_STR);
    $result->execute();
    $user = $result->fetch();
    if ($user) {
      return $user['id'];
    }
    return FALSE;
  }

  /**
   * Returns the user id, if it is authorized
   * @return mixed
   */
  public static function checkLogged() {
    if (isset($_SESSION['user']))
      return $_SESSION['user'];
  }

  /**
   * Edition users data
   * @param $id
   * @param $login
   * @param $password
   * @return bool
   */
  public static function edit($id, $login, $password) {
    $db = DB::getConnection();
    $password = md5($password);
    $sql = "UPDATE user
                   SET login = :login, password = :password, date = NOW()
            WHERE id = :id";
    $result = $db->prepare($sql);
    $result->bindParam(':id', $id, PDO::PARAM_INT);
    $result->bindParam(':login', $login, PDO::PARAM_STR);
    $result->bindParam(':password', $password, PDO::PARAM_STR);
    $result->execute();
    return $result->execute();
  }

  /**
   * Get a list of all users
   * @return array
   */
  public static function getUsersList() {
    $db = DB::getConnection();
    $usersList = array();
    $sql = "SELECT * FROM user";
    $result = $db->prepare($sql);
    $result->execute();
    $i = 0;
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      $usersList[$i]['id'] = $row['id'];
      $usersList[$i]['login'] = $row['login'];
      $usersList[$i]['email'] = $row['email'];
      $usersList[$i]['date'] = date("m/d/y - H:i:s", strtotime($row['date']));
      $i++;
    }
    return $usersList;

  }

  /**
   * Returns the user with the specified id
   * @param $id
   * @return mixed
   */
  public static function getUserById($id) {

    if ($id) {
      $db = DB::getConnection();
      $sql = "SELECT * FROM user WHERE id = :id";
      $result = $db->prepare($sql);
      $result->bindParam(':id', $id, PDO::PARAM_INT);
      $result->execute();
      $user = $result->fetch(PDO::FETCH_ASSOC);
      $user['date'] = date("m/d/y - H:i:s", strtotime($user['date']));
      return $user;
    }
  }

  /**
   * Checks whether the guest user
   * @return bool
   */
  public static function isGuest() {
    if (isset($_SESSION['user']))
      return FALSE;
    return TRUE;
  }

  /**
   * Checks whether the user is an admin
   * @return bool
   */
  public static function checkAdmin() {
    $userId = User::checkLogged();
    $user = User::getUserById($userId);
    if (!empty($user && $user['id'] == 1))
      return true;
  }


  /**
   * User registration
   * @param $login
   * @param $email
   * @param $password
   * @return bool
   */
  public static function register($login, $email, $password) {
    $password = md5($password);
    $db = DB::getConnection();
    $sql = "INSERT INTO user (login, email, password)
            VALUES (:login, :email, :password)";
    $result = $db->prepare($sql);
    $result->bindParam(':login', $login, PDO::PARAM_STR);
    $result->bindParam(':email', $email, PDO::PARAM_STR);
    $result->bindParam(':password', $password, PDO::PARAM_STR);
    return $result->execute();
  }

  /**
   * Deleting user by $id
   * @param $id
   * @return bool
   */
  public static function deleteUserById($id) {
    $db = DB::getConnection();
    $sql = "DELETE FROM user WHERE id = :id";
    $result = $db->prepare($sql);
    $result->bindParam(':id', $id, PDO::PARAM_INT);
    return $result->execute();
  }

  /**
   * Updating user by $id
   * @param $id
   * @param $options
   * @return bool
   */
  public static function updateUserById($id, $options) {
    $db = DB::getConnection();
    $options['password'] = md5($options['password']);
    $sql = "UPDATE user
                   SET login = :login, email = :email,
                       password = :password, date = NOW()
            WHERE id = :id";
    $result = $db->prepare($sql);
    $result->bindParam(':id', $id, PDO::PARAM_INT);
    $result->bindParam(':login', $options['login'], PDO::PARAM_STR);
    $result->bindParam(':email', $options['email'], PDO::PARAM_STR);
    $result->bindParam(':password', $options['password'], PDO::PARAM_STR);
    return $result->execute();
  }
}