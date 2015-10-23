<?php session_start(); ?>
<?php
if ((!isset($_SESSION['username'])) || ($_GET['cid'] == "")) {
	header("Location: index.php");
	exit();
/*this creates a security for members only*/
}

$cid = $_GET['cid'];
?>

<!DOCTYPE html PUBLIC>
<head>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<title>Create Forum Topic</title>
</head>
	
<body>

<div id="wrapper">
	<h2>Student Forum</h2>

<?php
echo "<p>You are logged in as ".$_SESSION['username']." &bull; <a href='logout_parse.php'>Logout</a>";
?>

<hr /><br>
<div id="content">	
<form action="create_topic_parse.php" method="post">
<p>Topic Title</p>
<input type="test" name="topic_title" size="70" maxlength="120" />
<p>Topic Content</p>
<textarea name="topic_content" rows="5" cols="72"></textarea>
<br><br>
<input type="hidden" name="cid" value="<?php echo $cid; ?>" />
<input type="submit" name="topic_submit" value="Create Topic"/>
</form>

</div>
</div>

</body>
</html>