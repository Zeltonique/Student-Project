<?php session_start(); ?>
<!DOCTYPE html PUBLIC>
<head>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
	<title>View Categories</title>
<body>

<div id="wrapper">
	<div class= "h2">Student Forum</div>
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
	echo "<p>You are logged in as ".$_SESSION['username']." &bull; <a href='logout_parse.php'>Logout</a>";
}
?>

<hr /><br>
<div id="content">	

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
			$creator = $row['topic_creator'];
			$topics .= "<tr><td><a href='view_topic.php?cid=".$cid.".&tid=".$tid."'>".$title."<a><br/><span class='post_info'>Posted 
by: ".$creator." on ".$date."</span></td><td align='center'>0</td><td align='center'>".$views."</td></tr>";
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
</body>

</html>