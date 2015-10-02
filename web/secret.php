<?php
    require("config.php");
    if(empty($_SESSION['user']))
    {
        header("Location: index.php");
        die("Redirecting to index.php");
    }
?>
<!-- Author: Michael Milstead / Mode87.com
     for Untame.net
     Bootstrap Tutorial, 2013
-->
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Student Community</title>
    <meta name="description" content="Bootstrap Tab + Fixed Sidebar Tutorial with HTML5 / CSS3 / JavaScript">
    <meta name="author" content="Untame.net">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="assets/bootstrap.min.js"></script>
    <link href="assets/bootstrap.min.css" rel="stylesheet" media="screen">
    <style type="text/css">
        .hero-unit { background-color: #fff; }
        .center { display: block; margin: 0 auto; }
    </style>
</head>

<body>

<div class="navbar navbar-fixed-top navbar-inverse">
  <div class="navbar-inner">
    <div class="container">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <a href="secret.php" class="brand">Student Community</a>
      <div class="nav-collapse">
        <ul class="nav pull-right">
          <li><a href="register.php">Register</a></li>
          <li class="divider-vertical"></li>
          <li><a href="logout.php">Log Out</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="container hero-unit">
    <h2>Hello <?php echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?>, we missed you!</h2>
    <p>
      Welcome back! Join your fellow students and share idees, resources and so much more. We are here to support!
    </p>
    <p><img src="assets/abbeybound.jpg" alt="" class="center" /></p>
</div>

</body>
</html>
