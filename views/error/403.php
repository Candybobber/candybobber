<?php header('HTTP/1.1 403 Forbidden'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>403 Access denied | <?php echo SITE_NAME; ?></title>
  <meta name="msapplication-TileColor" content="#5bc0de" />
  <meta name="msapplication-TileImage" content="assets/img/metis-tile.png" />

  <!-- Bootstrap -->
  <link href="/template/css/bootstrap.min.css" rel="stylesheet">
  <link href="/template/css/main.css" rel="stylesheet">
  <link href="/template/css/bootstrap-theme.min.css" rel="stylesheet">
  <link href="/template/css/error.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

</head>
<body>
<div class="container">
  <div class="row">
    <div class="col-sm-12 text-center">
      <div class="logo">
        <h1 class="error-mark">403</h1>
      </div>
      <p class="lead text-muted">Oops, access denied. Forbidden!</p>
      <br>
      <div class="col-lg-6 col-lg-offset-3">
        <a href="/" class="btn btn-main">Return Website</a>
      </div>
    </div><!-- /.col-sm-12 -->
  </div>
</div>
</body>
</html>