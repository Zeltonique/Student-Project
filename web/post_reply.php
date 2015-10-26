<?php session_start(); ?>
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
echo "<p>You are logged in as ".$_SESSION['username']." &bull; <a href='logout_parse.php'>Logout</a>";
?>

<hr /><br>
<div id="content">	
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
</div>

</body>
</html>