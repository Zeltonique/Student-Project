<?php
/*connect the site with the database "FORUM" created*/
$host = "us-cdbr-iron-east-03.cleardb.net";
$username ="b1ea00acc6e328";
$password ="bbfc3ba1";
$db = "heroku_22d0c2d27921dcd";

mysql_connect($host, $username, $password) or die(mysql_error());
mysql_select_db($db);

//function dbConnection() {
//    $connection = mysqli_connect("us-cdbr-iron-east-03.cleardb.net",);
?>