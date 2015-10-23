<?php

session_start();
include('connect.php');

if(isset($_POST['submit'])) {
 {
  $username = $_POST['username'];
  $password = md5(trim($_POST['password']));
  $query = "SELECT * FROM users WHERE username='$username' AND password='$password'"; 
  echo $query;
  $result = mysql_query($query) or die("Database Error");
  $num_row = mysql_num_rows($result);
  $row=mysql_fetch_array($result);
  if( $num_row ==1 )
         {
   $_SESSION['username']=$row['username'];
   header("Location: index.php");
   exit;
  }
  else
         {
   echo 'You must register first please. Thank you!';
  }
 }
}
?>