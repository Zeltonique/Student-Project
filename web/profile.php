<?php session_start(); ?>
<!DOCTYPE html PUBLIC>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Student Community</title>

  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="style.css" />

  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
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
  <div class= "h2">Student Community Online // Profile</div>
  <br>

  <?php
  if (!isset($_SESSION['username'])) {
    echo "<form action='login_parse.php' method='post'>
    Username: <input type='text' name='username' /><br><br>
    Password: <input type='password' name='password' /><br><br>
    <input type='submit' name='submit' value='Log In' /><br><br>
    </form>

    ";
  } else {
    echo "<p class='text-success'>You are logged in as ".$_SESSION['username']."";
  }
  ?>

  <hr /><br>
  <div id="profilecontent">


    <?php

    include_once("connect.php");

    //------------------------------------------------

    $username = $_SESSION["username"];

    // fetch detail of logged in user
    $userRow = mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE `username` = '$username'"));
    // if there is an id, the user exists
    if ($userRow["username"])

    {
      //echo $userRow["username"]; // prints that users username
      // etc. print and format all the other fields such as "aboutme"
      //echo $query("$userRow")
    }

    // else the user does not exist

    else

    echo "Please Log in";

    //------------------------------------------------


    //------------------------------------------------
    //image upload

    if(isset($_POST['btn_upload']))
    {
      $filetmp = $_FILES["file_img"]["tmp_name"];
      $filename = $_FILES["file_img"]["name"];
      $filetype = $_FILES["file_img"]["type"];
      $filepath = "photo/".$filename;

      move_uploaded_file($filetmp, $filepath);

      $sql = "UPDATE users SET img_name='$filename',img_path='$filepath',img_type='$filetype' where username='$username';";

      $result = mysql_query($sql);

    }

    //------------------------------------------------

    ?>



    <table width="398" border="0" align="center" cellpadding="0">
      <tr>
        <td height="26" colspan="2"><h4>Your Profile Information</h4> </td>


      </tr>

      <tr>
        <td width="129" rowspan="5"><img src="<?php echo $userRow['img_path'] ?>" alt="You have no profile pic" class="img-circle">
          <br><br>
          <form action="profile.php" method="post" enctype="multipart/form-data">
            <input type="file" name="file_img"/>
            <br>
            <input type="submit" name="btn_upload" value="upload"</input>



          </form></td>
          <td width="82" valign="top"><div align="right">Username:</div></td>
          <td width="165" valign="top"><?php echo $userRow["username"] ?></td>
        </tr>
        <tr>
          <td valign="top"><div align="right">Email:</div></td>
          <td valign="top"><?php echo $userRow["email"] ?></td>
        </tr>

      </table>

      <p align="center"><a href="index.php"></a></p>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

  </body>
  </html>
