<div class="container">
  <div class="row">
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" ><a href="/account/index">View</a></li>
      <li role="presentation"><a href="/account/edit">Edit</a></li>
      <li role="presentation" class="active"><a href="/news/add">Add new post</a></li>

      <?php if (User::checkAdmin()): ?>
        <li role="presentation"><a href="/admin/index">Administration panel</a></li>
      <?php endif; ?>

    </ul>
    <div class="account-index">
      <form action="#" method="post" enctype="multipart/form-data">

        <div class="form-group">
          <label>Title</label>
          <input type="text" name="title" class="form-control" maxlength="100" required>
          <p class="help-block">Post title.</p>
        </div>

        <div class="form-group">
          <label>Description</label>
          <textarea class="form-control" name="short_content" rows="5" maxlength="150" required></textarea>
          <p class="help-block">Add description to the post.</p>
        </div>

        <div class="form-group">
          <label>Image</label>
          <input type="file" name="image" class="form-control upload">
          <p class="help-block">Upload an image to go with this article.</p>
        </div>

        <div class="form-group">
          <label>Body</label>
          <textarea class="form-control" name="content" rows="15" required></textarea>
          <script type="text/javascript"> CKEDITOR.replace("content"); </script>
          <p class="help-block">Add full text of post.</p>
        </div>

        <button type="submit" name="submit" class="btn btn-main">Save</button>
      </form>
    </div>
  </div>
</div>