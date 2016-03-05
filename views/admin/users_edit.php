<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <p class="text-right">
        <a href="/admin/index">
          <i class="fa fa-chevron-left"></i>Back to admin panel
        </a>
      </p>
      <hr>

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

      <form class="form-signing" action="" method="post">
        <h4 class="text-center">Edit user account</h4>
        <div class="form-group">
          <label for="exampleInputLogin">Login</label>
          <input type="text" name="login" id="inputLogin" class="form-control" value="<?php echo $user['login']; ?>" required>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail">Email</label>
          <input type="text" name="email" id="inputEmail" class="form-control" value="<?php echo $user['email']; ?>" required>
        </div>

        <div class="form-group">
          <label for="exampleInputPassword">Current password</label>
          <input type="password" name="password" id="inputPassword" class="form-control" value="<?php echo $user['password']; ?>" required>
        </div>

        <input type="submit" class="btn btn-main btn-block" value="Update" name="update">
      </form>
    </div>
  </div>
</div>