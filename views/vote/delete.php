<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <h2 class="admin-title">Do you really want to delete votes of news #<em><?php echo $newsItem['id']; ?></em></h2>
      <hr>
      <div class="row">
        <div class="col-sm-12">
          <form action="#" method="post">
            <input class="btn btn-main" type="submit" value="Delete" name="submit">
            <a class="del-comment" href="/news/<?php echo $newsItem['id']; ?>">Cancel</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>