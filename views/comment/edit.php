<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <div class="comment-form">
        <form class="form-horizontal" action="#" method="post">
          <div class="form-group">
            <label class="col-sm-2 control-label">Your name</label>
            <div class="col-sm-10">
              <p class="form-control-static"><a href="#"><?php echo $commentItem['name']; ?></a></p>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label">Comment</label>
            <div class="col-sm-10">
              <textarea class="form-control" name="text" rows="7" required><?php echo $commentItem['text']; ?></textarea>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" name="submit" class="btn btn-main">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>