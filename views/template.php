<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="/template/images/favicon.png">

  <title><?php echo $title; ?></title>

  <!-- Bootstrap core CSS -->
  <link href="/template/css/bootstrap.min.css" rel="stylesheet">
  <link href="/template/css/bootstrap-theme.min.css" rel="stylesheet">
  <link href="/template/css/main.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link href="/template/css/scrollUpButton.css" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,400italic,300italic' rel='stylesheet' type='text/css'>
  <script src="/template/libs/ckeditor/ckeditor.js"></script>
</head>
<body>
<!-- Header start -->
<header>
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="/"><?php echo SITE_NAME; ?></a>
      </div>
      <nav class="navbar-collapse collapse">
        <div class="conteiner">
          <ul class="nav navbar-nav navbar-right">
            <li class="<?php if ($_SERVER['REQUEST_URI'] == '/') echo 'active'; ?>"><a href="/">Home</a></li>

            <?php if (User::isGuest()): ?>
              <li class="<?php if (($_SERVER['REQUEST_URI'] == '/user/login') || ($_SERVER['REQUEST_URI'] == '/user/register')) echo 'active'; ?>">
              <a href="/user/login"><i class="fa fa-sign-in"></i>Login</a>
            <?php else: ?>
              <li class="<?php if ($_SERVER['REQUEST_URI'] == '/account') echo 'active'; ?>"><a href="/account"><i class="fa fa-user"></i>Account</a></li>
              <li><a href="/user/logout"><i class="fa fa-sign-out"></i>Logout</a></li>
            <?php endif; ?>

          </ul>
        </div>
      </nav>
    </div>
  </nav>
</header>
<!-- Header end -->

<!-- Title start -->
<div class="title">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 text-center">
        <?php echo $pageTitle; ?>
      </div>
    </div>
  </div>
</div>
<!-- Title end -->

<!-- Page wrapper -->
<div class="page-wrapper">
  <?php echo $content; ?>
</div>
<!-- Page wrapper end -->

<!-- Footer start -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-sm-8">
        My Site © 2016
      </div>
      <div class="col-sm-4 text-right">
        <a href="mailto:"><i class="fa fa-envelope fa-lg"></i></a>
        <a href=""><i class="fa fa-vk fa-lg"></i></a>
        <a href=""><i class="fa fa-facebook fa-lg"></i></a>
        <a href=""><i class="fa fa-twitter fa-lg"></i></a>
      </div>
    </div>
  </div>
</footer>
<!-- Footer end -->

<a href="#" class="scrollUpButton"><span class="glyphicon glyphicon-chevron-up"></span></a>

<!-- Bootstrap core JavaScript
================================================== -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="/template/js/bootstrap.min.js"></script>
<script src="/template/js/scrollUpButton.js"></script>

</body>
</html>