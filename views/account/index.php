<div class="container">
  <div class="row">
    <div class="col-sm-12">

      <?php if(isset($user) && is_array($user)): ?>
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#">View</a></li>
          <li role="presentation"><a href="/account/edit">Edit</a></li>
          <li role="presentation"><a href="/news/add">Add new post</a></li>
          <?php if (User::checkAdmin()): ?>
            <li role="presentation"><a href="/admin/index">Administration panel</a></li>
          <?php endif; ?>
        </ul>
        <div class="account-index">
          <h2>Hello, <?php echo $user['login'];?>!</h2>
          <div class="meta">
            <p>Registration date: <?php echo $user['date']?></p>
          </div>
        </div>
      <?php else: ?>
        <div class="alert alert-default text-center" role="alert">
          <h3><i class="fa fa-exclamation"></i> No data for display</h3>
        </div>
      <?php endif; ?>

    </div>
  </div>
</div>
