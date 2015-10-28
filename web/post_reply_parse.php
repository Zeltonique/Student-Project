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


<?php

/*file to process the reply*/
if ($_SESSION['username']) {
  if (isset($_POST['reply_submit'])) {

    echo "Reply submit running<br>";

    include_once("connect.php");
    $creator = $_SESSION['username'];
    $cid = $_POST['cid'];
    $tid = $_POST['tid'];
    $reply_content = $_POST['reply_content'];


    $filetmp = $_FILES["file_img"]["tmp_name"];
    $filename = $_FILES["file_img"]["name"];
    $filetype = $_FILES["file_img"]["type"];
    $filepath = "photo/".$filename;

    move_uploaded_file($filetmp, $filepath);

    $sql = "INSERT INTO posts (category_id, topic_id, post_creator, post_content, post_date, img_name,img_path,img_type) VALUES ('".$cid."', '".$tid."', '".$creator."', '".$reply_content."', now(), '".$filename."', '".$filepath."','".$filetype."');";

    $result = mysql_query($sql);

  }
  $res = mysql_query($sql) or die(mysql_error());
  $sql2 = "UPDATE categories SET last_post_date=now(), last_user_posted='".$creator."' WHERE id='".$cid."' LIMIT 1";
  $res2 = mysql_query($sql2) or die(mysql_error());
  $sql3 = "UPDATE topics SET topic_reply_date=now(), topic_last_user='".$creator."' WHERE id='".$tid."' LIMIT 1";
  $res3 = mysql_query($sql3) or die(mysql_error());

  /*email sending*/

  if (($res) && ($res2) && ($res3)) {
    echo "<p>Your reply has been successfully posted.<a href='view_topic.php?cid=".$cid."&tid=".$tid."'>Click here to return to topic</a></p>";
  } else {
    echo "<p>There was a problem with posting your reply. Try again later.</p>";
  }
} else {
  exit();
}
?>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>

</html>
