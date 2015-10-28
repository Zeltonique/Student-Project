<?php session_start(); ?>
<!DOCTYPE html PUBLIC>
<head> <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Student Community</title>

  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="style.css" />



</head>
<title>Post login</title>
<body>

  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">Student Community Online</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="active"><a href="index.php">Topics <span class="sr-only"></span></a></li>
          <li><a href="profile.php">Profile</a></li>

        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout_parse.php">Logout</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div id="wrapper">
  <h1>Making student life a little bit easier and fun!</h1>


  <?php
  if (!isset($_SESSION['username'])) {

    echo "<form action='https://pacific-tor-6903.herokuapp.com/login_parse.php' method='post'>
    <span class='label label-primary'>REGISTERED MEMBERS</span> Please sign in here.<br>
    Username: <input type='text' name='username' /><br><br>
    Password: <input type='password' name='password' /><br><br>
    <input type='submit' name='submit' value='Log In' /><br><br>
    </form>
    ";
  } else {
    echo "<p>You are logged in as ".$_SESSION['username']."";
  }
  ?>
  <br> <br>
  <form action="register.php" method="post" >
    <p><span class="label label-primary">NEW USERS</span> Register here for Student Comminity Online</p>

    <p></p> <label for="username">User Name:</label>
    <input name="username" type="text" id="username" size="30"/>
  </p>

  <p><label for="email">E-mail:</label>
    <input name="email" type="text" id="email" size="30"/>
  </p>
  <p>
    <label for="password">Password:</label>
    <input name="password" type="password" id="password" size="30 "/>
  </p>
  <p>
    <input name="submit" type="submit" value="Submit"/>
  </p>

  <?php
  session_start();
  if(isset($_SESSION['error']))
  {
    echo '<p>'.$_SESSION['error']['username'].'</p>';
    echo '<p>'.$_SESSION['error']['email'].'</p>';
    echo '<p>'.$_SESSION['error']['password'].'</p>';
    unset($_SESSION['error']);
  }
  ?>
  </form
  <hr /><br><br>


  <div id="content">
    <div class="headingcat">Categories<br>Choose a category to see further posts</div>
    <?php
    /*adding categories to the forum */

    include_once("connect.php");
    $sql = "SELECT * FROM categories";
    $res = mysql_query($sql) or die(mysql_error());
    $categories = "";
    if (mysql_num_rows($res)> 0) {
      while ($row = mysql_fetch_assoc($res)) {
        $id = $row['id'];
        $title = $row['category_title'];
        $description = $row['category_description'];
        $categories = "<a href='view_category.php?cid=".$id."' class='cat_links'>".$id.". ".$title." - <font size='-1'>".$description."</font></a><br>"; /*append the data to*/
        echo $categories;
      }
    } else {
      echo "<p>No categories available yet.</p>";
    }
    ?>
  </div>
</div>



</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>
