<div class="container">

  <?php if (isset($result) && $result): ?>
    <div class="error">
      <div class="alert alert-success" role="alert">
        <i class="fa fa-check-square-o"></i>
        Your account has been successfully created
        <a href="/user/login" class="fa-pull-right"><i class="fa fa-sign-in"></i>Login</a>
      </div>
    </div>
  <?php else: ?>
    <?php if (isset($errors) && is_array($errors)): ?>
      <?php foreach ($errors as $error): ?>
        <div class="error">
          <div class="alert alert-danger" role="alert">
            <i class="fa fa-exclamation"></i>
            <?php echo $error; ?>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
    <h4 class="text-center">Create new account</h4>
    <form class="form-signing" action="#" method="post">

      <label for="inputPassword" class="sr-only">Password</label>
      <input type="text" name="login" id="inputLogin" class="form-control" placeholder="Login" value="<?php echo $login ;?>" required>

      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" value="<?php echo $email; ?>" required autofocus>

      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" value="<?php echo $password; ?>" required>

      <label for="inputPassword" class="sr-only">Repeat password</label>
      <input type="password" name="confirm_password" id="inputPassword" class="form-control" placeholder="Repeat password" value="<?php echo $confirm_password; ?>" required>
      <button class="btn btn-main btn-block" name="submit" type="submit">Create new account</button>
    </form>

  <?php endif; ?>

</div> <!-- /container -->
