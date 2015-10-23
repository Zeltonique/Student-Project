<?php session_start(); ?>
<!DOCTYPE html PUBLIC>
<head>
<link rel="stylesheet" type="text/css" href="style.css" />



</head>
	<title>Post login</title>
<body>

<div id="wrapper">
	<h2>Student Forumh</h2>
	

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
    
      <form action="register.php" method="post" >
            <p>
              <label for="username">User Name:</label>
              <input name="username" type="text" id="username" size="30"/>
            </p>
            <p>
              <label for="email">E-mail:</label>
              <input name="email" type="text" id="email" size="30"/>
            </p>
            <p>
              <label for="password">Password:</label>
              <input name="password" type="password" id="password" size="30 "/>
            </p>
            <p>
              <input name="submit" type="submit" value="Submit"/>
            </p>
         
          <?php
          session_start();
          if(isset($_SESSION['error']))
          {
            echo '<p>'.$_SESSION['error']['username'].'</p>';
            echo '<p>'.$_SESSION['error']['email'].'</p>';
            echo '<p>'.$_SESSION['error']['password'].'</p>';
            unset($_SESSION['error']);
          }
          ?>
           </form
<hr /><br>

<div id="content">	
<div class="headingcat">Categories<br>Choose a category to see further posts</div>
<?php
/*adding categories to the forum */

include_once("connect.php");
$sql = "SELECT * FROM categories";
$res = mysql_query($sql) or die(mysql_error());
$categories = "";
if (mysql_num_rows($res)> 0) {
	while ($row = mysql_fetch_assoc($res)) {
		$id = $row['id'];
		$title = $row['category_title'];
		$description = $row['category_description'];
		$categories = "<a href='view_category.php?cid=".$id."' class='cat_links'>".$id.". ".$title." - <font size='-1'>".$description."</font></a><br>"; /*append the data to*/
		echo $categories;
	}	
} else {
	echo "<p>No categories available yet.</p>"; 
}
?>
</div>
</div>



</div>
</body>
</html>