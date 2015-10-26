<?php session_start(); ?>
<!DOCTYPE html PUBLIC>
<head>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
	<title>View Profile</title>
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

include_once("connect.php");

//------------------------------------------------

$username = $_SESSION["username"];

// fetch detail of logged in user
$userRow = mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE `username` = '$username'"));
 // if there is an id, the user exists
if ($userRow["username"])

{
    echo $userRow["username"]; // prints that users username
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
    <td height="26" colspan="2">Your Profile Information </td>
	<td><div align="right"><a href="logout_parse.php">logout</a></div></td>
  </tr>
  <tr>
    <td width="129" rowspan="5"><img src="<?php echo $userRow['img_path'] ?>" width="129" height="129" alt="no image found"/>
	  <form action="profile.php" method="post" enctype="multipart/form-data">
<input type="file" name="file_img"/>
	<input type="submit" name="btn_upload" value="upload">


</form></td>
    <td width="82" valign="top"><div align="left">Username:</div></td>
    <td width="165" valign="top"><?php echo $userRow["username"] ?></td>
  </tr>
  <tr>
    <td valign="top"><div align="left">Email Address:</div></td>
    <td valign="top"><?php echo $userRow["email"] ?></td>
  </tr>

</table>
<p align="center"><a href="index.php"></a></p>
    
</body>