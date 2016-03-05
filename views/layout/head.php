<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="/template/images/favicon.ico">

  <title>Mysite | <?php echo $_SERVER['REQUEST_URI']; ?></title>

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
<header>
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="/">CandyBobber</a>
      </div>
      <nav class="navbar-collapse collapse">
        <div class="conteiner">
          <ul class="nav navbar-nav navbar-right">
            <li class=""><a href="/">Home</a></li>
            <?php if (User::isGuest()): ?>
              <li><a href="/user/login"><i class="fa fa-sign-in"></i>Login</a>
            <?php else: ?>

                <li><a href="/account/index"><i class="fa fa-user"></i>Account</a></li>
                <li><a href="/user/logout"><i class="fa fa-sign-out"></i>Logout</a></li>
            <?php endif; ?>
          </ul>
        </div>
      </nav><!--/.nav-collapse -->
    </div><!--/.container -->
  </nav><!--/.navbar -->
</header>
<div class="title">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 text-center">
        Main page
      </div>
    </div>
  </div>
</div>
<div class="page-wrapper">