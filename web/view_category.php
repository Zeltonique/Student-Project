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
</head>
<title>View Categories</title>
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
  <div class= "h2">Student Forum</div>
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
  <div id="categorycontent">

    <?php
    include_once ("connect.php");
    /* get variable id   */
    $cid = $_GET['cid'];

    if (isset($_SESSION['username'])) {
      $logged = " | <a href='create_topic.php?cid=".$cid."'>Click here to Create a Topic</a>";
    } else {
      $logged = "<br> Please log in to create topic in this forum.";
    }
    /*This creates a link to create a topic and if not logged in one cannot add to a topic*/
    $sql = "SELECT id FROM categories WHERE id='".$cid."' LIMIT 1";
    $res = mysql_query($sql) or die(mysql_error());
    if (mysql_num_rows($res) ==1) {
      $sql2 = "SELECT * FROM topics WHERE category_id='".$cid."' ORDER BY topic_reply_date DESC";
      $res2 = mysql_query($sql2) or die(mysql_error());
      if (mysql_num_rows($res2) > 0) {
        $topics .= "<table width='100%' style='border-collapse: collapse;'>";
        $topics .= "<tr><td colspan='3'><a href='index.php'>Return to Forum Index</a>".$logged."<hr /></td></tr>";
        $topics .= "<tr style='background-color: #dddddd;'><td>Topic Title</td> <td width='65' align='center'>Replies</td><td width='65' align='center'>Views</td></tr>";
        $topic .= "<tr><td colspan='3'><hr /></td></tr>";
        /*.= means you are appending to the data*/
        while ($row = mysql_fetch_assoc($res2)) {
          $tid = $row['id'];
          $title = $row['topic_title'];
          $views = $row['topic_views'];
          $date = $row['topic_date'];
          $creator_id = $row['topic_creator'];
          $sql9 = "SELECT * FROM users WHERE id=$creator_id;";
          $res9 = mysql_query($sql9) or die (mysql_error());
          $creator_user = mysql_fetch_assoc($res9);
          $topics .= "<tr><td><a href='view_topic.php?cid=".$cid.".&tid=".$tid."'>".$title."<a><br/><span class='post_info'>Posted
          by: ".$creator_user['username']." on ".$date."</span></td><td align='center'>0</td><td align='center'>".$views."</td></tr>";
          $topics .= "<tr><td colspan='3'><hr /></td></tr>";
        }
        $topics .= "</table>";
        echo $topics;
        /* echo $topics displays he topics*/
      } else {
        echo "<a href='index.php'>Return to forum Index</a>";
        echo "<p>There are no topics in this category yet.".$logged;
      }


    } else {
      echo "<a href='index.php'>Return to forum Index</a><hr />";
      echo "<p>The category you are trying to view does not exist yet.";
    }
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
