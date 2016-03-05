<div class="container">
  <div class="row">
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation"><a href="/account/index">View</a></li>
      <li role="presentation" class="active"><a href="/account/edit">Edit</a></li>
      <li role="presentation"><a href="/news/add">Add new post</a></li>
      <?php if (User::checkAdmin()): ?>
        <li role="presentation"><a href="/admin/index">Administration panel</a></li>
      <?php endif; ?>
    </ul>
    <?php if (isset($result) && $result): ?>
      <div class="error">
        <div class="alert alert-success" role="alert">
          <span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
          Your account has been successfully updated
          <a href="/account/index"><span class="back-to-acc glyphicon glyphicon-arrow-left"></span></a>
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
      <div class="row">

        <form class="form-signing" action="#" method="post">
          <h4 class="text-center">Edit user account</h4>
          <div class="form-group">
            <label for="exampleInputLogin">Login</label>
            <input type="text" name="login" id="inputLogin" class="form-control" value="<?php echo $user['login']; ?>" required>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Current password</label>
            <input type="password" name="password" id="inputPassword" class="form-control" value="<?php echo $user['password']; ?>" required>
          </div>

          <button class="btn btn-main btn-block" name="submit" type="submit">Save</button>
        </form>
      </div>
    <?php endif; ?>
  </div>
</div>
