<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <h2 class="admin-title">Do you really want to delete comment #<em><?php echo $commentItem['id']?></em></h2>
      <hr>
      <div class="row">
        <div class="col-sm-12">
          <form action="#" method="post">
            <input class="btn btn-main" type="submit" value="Delete" name="submit">
            <a class="del-comment" href="/news/<?php echo $commentItem['news_id']?>">Cancel</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>