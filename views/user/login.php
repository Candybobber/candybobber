<div class="container">

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
    <h4 class="text-center">User login</h4>
    <form class="form-signing" action="#" method="post">

      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>

      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>

      <button class="btn btn-main btn-block" name="submit" type="submit">Login</button>
      <a class="btn btn-main btn-block" href="/user/register"  type="submit" role="button">Create new account</a>
    </form>
  </div>
</div> <!-- /container -->