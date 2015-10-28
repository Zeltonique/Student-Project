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
        <a class="navbar-brand" href="index.php">Student Community</a>
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
  <div class= "h2">View Categories</div>
  <br>

  <?php
  if (!isset($_SESSION['username'])) {
    echo "<form action='login_parse.php' method='post'>
    Username: <input type='text' name='username' /><br><br>
    Password: <input type='password' name='password' /><br><br>
    <input type='submit' name='submit' value='Log In' /><br><br>
    ";
  } else {
    echo "<p class='text-success'>You are logged in as ".$_SESSION['username']."";
  }
  ?>

  <hr /><br>
  <div id="viewtopiccontent">

    <?php
    /*view topic code here*/

    include_once("connect.php");
    $cid = $_GET['cid'];
    $tid = $_GET['tid'];
    /*querying the database*/
    $sql = "SELECT * FROM topics WHERE category_id='".$cid."' AND id='".$tid."' LIMIT 1";
    $res = mysql_query($sql) or die(mysql_error());
    /*do a check*/
    if (mysql_num_rows($res) == 1) {
      echo "<table width ='100%'>";
      /*check to see if usesr session is set*/
      if ($_SESSION['username']) { echo "<tr><td colspan='2'><input type='submit' value='Add reply' onClick=\"window.location = 'post_reply.php?cid=".$cid."&tid=".$tid."'\"/<hr/>"; }
      else {
        echo "<tr><td colspan='2'><p>Log in to reply.</p><hr/></td></tr>"; }
        while($row = mysql_fetch_assoc($res)) {
          $sql2 = "SELECT * FROM posts WHERE category_id='".$cid."' AND topic_id='".$tid."'";
          $res2 = mysql_query($sql2) or die (mysql_error());
          while ($row2 = mysql_fetch_assoc($res2)) {
            $creator_id = $row2['post_creator'];
            $sql9 = "SELECT * FROM users WHERE id=$creator_id;";
            $res9 = mysql_query($sql9) or die (mysql_error());
            $creator_user = mysql_fetch_assoc($res9);
            echo  "<tr><td valign='top' style='border: 1px solid #000000;'><div style='min-height: 120px;'>".$row['topic_title']."<br />
            by ".$creator_user['username']." - ".$row2['post_date']."<hr />"
            .$row2['post_content']."</div></td></tr>


            ";
            echo "<td colspan='2'>";
            $file_path = $row2['img_path'];
            echo "<img src='$file_path' alt='No image uploaded' class='img-rounded'>";
            echo "</td></tr>";



            // <img src='$file_path'>
          }
          $old_views = $row['topic_views'];
          $new_views = $old_views + 1;
          $sql3 = "UPDATE topics SET topic_views='".$new_views."' WHERE category_id='".$cid."' AND id='".$tid."' LIMIT 1";
          $res3 = mysql_query($sql3)or die(mysql_error());
        } echo "</table>";
      } else {
        echo "<p> This topic does not exist yet.</p>";
      }
      /*LIMIT -> you only want one topic to print out*/


      ?>
    </div>




  </div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>

</html>
