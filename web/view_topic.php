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
	if ($_SESSION['username']) { echo "<tr><td colspan='2'><input type='submit' value='Add reply' onClick=\"window.location = 'post_reply.php?cid=".$cid."&$tid=".$tid."'\"/<hr/>"; } 
  else {
 	echo "<tr><td colspan='2'><p>Log in to reply.</p><hr/></td></tr>"; }
while($row = mysql_fetch_assoc($res)) {
	$sql2 = "SELECT * FROM posts WHERE category_id='".$cid."' AND topic_id='".$tid."'"; 
	$res2 = mysql_query($sql2) or die (mysql_error());
	while ($row2 = mysql_fetch_assoc($res2)) {
		echo  "<tr><td valign='top' style='border: 1px solid #000000;'><div style='min-height: 120px;'>".$row['topic_title']."<br />
		by ".$row2['post_creator']." - ".$row2['post_date']."<hr />"
		.$row2['post_content']."</div></td><td width='200' valign='top' align='center' style='border: 1px solid #000000;'>User info here</td></tr>
		<td colspan='2'><hr /></td></tr>";
	}
}
} else {
	echo "<p> This topic does not exist yet.</p>";
}	
/*LIMIT -> you only want one topic to print out*/


?>
</div>




</div>
</div>
</div>
</body>

</html>