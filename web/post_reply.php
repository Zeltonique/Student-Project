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
<?php
if ((!isset($_SESSION['username'])) || ($_GET['cid'] == "")) {
	header("Location: index.php");
	exit();
/*this creates a security for members only*/
}

$cid = $_GET['cid'];
$tid = $_GET['tid'];
?>

<!DOCTYPE html PUBLIC>
<head>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<title>Create Forum Topic</title>
</head>
	
<body>

<div id="wrapper">
	<h2>Forum Post Reply</h2>

<?php
echo "<p class='text-success'>You are logged in as ".$_SESSION['username']."";
?>

<hr /><br>
	
<form action="post_reply_parse.php" method="post" enctype="multipart/form-data">
<p>Reply Content</p>
<textarea name="reply_content" rows="5" cols="70"></textarea>
<br /><br />
<input type="hidden" name="cid" value="<?php echo $cid; ?>" />
<input type="hidden" name="tid" value="<?php echo $tid; ?>" />
<input type="file" name="file_img"/>
<input type="submit" name="reply_submit" value="Post Reply" />
</form>







</div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>