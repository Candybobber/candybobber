<?php if (!empty($commentList) && is_array($commentList)): ?>
  <button class="btn btn-main" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    Comments
  </button>
  <div class="collapse" id="collapseExample">
    <div id="comments" class="comments-view">
      <?php foreach ($commentList as $commentItem): ?>
        <div class="well-lg">
          <div class="meta">
            <span><?php echo $commentItem['name']; ?></span>
            <span><?php echo $commentItem['date']; ?></span>
          </div>
          <p class="m-comment"><?php echo $commentItem['text']; ?></p>
          <?php if (User::isGuest()): ?>
            <p class="comment-post-log"><a href="/user/login">Login</a> or <a href="/user/register">Register</a> to post comments </p>
          <?php elseif (User::checkAdmin()): ?>
            <div class="col-sm-12">
              <div class="comment-action">
                <a href="/comment/edit/<?php echo $commentItem['id']?>" type="button" class="btn btn-s">
                  <i class="fa fa-pencil"></i>
                  Edit
                </a>
                <a href="/comment/delete/<?php echo $commentItem['id']; ?>" type="button" class="btn btn-s">
                  <i class="fa fa-trash"></i>
                  Delete
                </a>
              </div>
            </div>
          <?php endif; ?>
        </div>
        <hr>
      <?php endforeach; ?>
    </div>
  </div>

<?php endif; ?>

<?php if (!User::isGuest() && User::checkLogged()): ?>
  <div class="comment-form">
    <form class="form-horizontal" action="#" method="post">

      <div class="form-group">
        <label class="col-sm-2 control-label">Your name</label>
        <div class="col-sm-10">
          <p class="form-control-static"><a href="#"><?php echo $user['login']; ?></a></p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">Comment</label>
        <div class="col-sm-10">
          <textarea class="form-control" name="text" rows="7" required></textarea>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" name="comment" class="btn btn-main">Save</button>
        </div>
      </div>
    </form>
  </div>
<?php endif; ?>