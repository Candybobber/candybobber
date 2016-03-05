<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <p class="text-right">
        <a href="/admin/index">
          <i class="fa fa-chevron-left"></i>Back to admin panel
        </a>
      </p>
      <h2 class="admin-title">Do you really want to delete article "<em><?php echo $newsItem['title']; ?></em>"</h2>
      <hr>
      <div class="row">
        <div class="col-sm-12">
          <form action="#" method="post">
            <input class="btn btn-main" type="submit" value="Delete" name="submit">
            <a class="del-comment" href="/admin/news">Cancel</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>