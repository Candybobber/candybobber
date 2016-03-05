<div class="container">
  <!-- Content start -->
  <div class="row">
    <div class="col-sm-12">

      <?php if (!User::isGuest()): ?>
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#">View</a></li>
          <li role="presentation"><a href="/news/edit/<?php echo $newsItem['id']; ?>">Edit</a></li>
        </ul>
      <?php endif; ?>

      <h2><?php echo $newsItem['title'];?></h2>

      <div class="meta">

        <?php if (User::checkAdmin()): ?>
          <span><a href="/admin/users"><i class="fa fa-user""></i><?php echo $newsItem['author']; ?></a></span>
        <?php else: ?>
          <span><i class="fa fa-user""></i><?php echo $newsItem['author']; ?></span>
        <?php endif; ?>

        <span><i class="fa fa-calendar"></i><?php echo $newsItem['date']; ?></span>
      </div>
      <div class="field-item">
        <p><?php echo $newsItem['content'];?></p>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="col-sm-8">

            <?php if (!User::isGuest()): ?>
              <?php include ROOT . '/views/vote/vote.php' ?>
            <?php endif; ?>

          </div>
          <div class="col-sm-4 text-right">
            <a href="/"><i class="fa fa-angle-left"></i>News list</a>
          </div>
        </div>
      </div>
      <hr>

      <?php if (User::isGuest()): ?>
        <div class="link-wrapper">
          <p class="comment-post-log"><a href="/user/login">Login</a> or <a href="/user/register">Register</a> to post comments </p>
        </div>
      <?php endif; ?>

      <?php include ROOT . '/views/comment/comment.php' ?>

    </div>
  </div>
  <!-- Content end -->
</div>