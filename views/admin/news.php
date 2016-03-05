<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <p class="text-right">
        <a href="/admin/index">
          <i class="fa fa-chevron-left"></i>Back to admin panel
        </a>
      </p>
      <div class="col-sm-10">
        <h3>News list</h3>
        <table class="table table-striped">
          <thead>
          <tr>
            <th>#</th>
            <th>Author</th>
            <th>Title</th>
            <th>Date</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>
          <?php foreach ($newsList as $newsItem): ?>
            <tr>
              <td><?php echo ++$i; ?></td>
              <td><?php echo $newsItem['author']; ?></td>
              <td><?php echo $newsItem['title']; ?></td>
              <td><?php echo $newsItem['date']; ?></td>
              <td>
                <a href="/admin/news/delete/<?php echo $newsItem['id']; ?>">
                  <i class="fa fa-trash-o"></i>Delete</a>
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
