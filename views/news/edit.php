<div class="container">
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation"><a href="/news/<?php echo $newsItem['id']; ?>">View</a></li>
    <li role="presentation" class="active"><a href="">Edit</a></li>
  </ul>
  <div class="row">
    <div class="account-index">
      <form action="#" method="post" enctype="multipart/form-data">

        <div class="form-group">
          <label>Title</label>
          <input type="text" name="title" class="form-control" maxlength="100" value="<?php echo $newsItem['title']; ?>" required>
          <p class="help-block">Post title.</p>
        </div>

        <div class="form-group">
          <label>Description</label>
          <textarea class="form-control" name="short_content" maxlength="150" rows="5" required><?php echo $newsItem['short_content']; ?></textarea>
          <p class="help-block">Add description to the post.</p>
        </div>

        <div class="form-group">
          <label class="label-image">Image</label>
          <img src="<?php echo News::getImage($newsItem['id']); ?>" class="img-thumbnail" width="200" height="200">
          <input type="file" name="image" class="form-control upload" value="">
          <p class="help-block">Upload an image to go with this article.</p>
        </div>

        <div class="form-group">
          <label>Body</label>
            <textarea class="form-control" name="content" rows="15" required>
              <?php echo $newsItem['content']; ?>
            </textarea>
          <script type="text/javascript"> CKEDITOR.replace("content"); </script>
          <p class="help-block">Add full text of post.</p>
        </div>

        <button type="submit" name="submit" class="btn btn-default">Submit</button>
      </form>
    </div>
  </div>
</div>