<?php
/*connect the site with the database "FORUM" created*/
$db_host = "us-cdbr-iron-east-03.cleardb.net";
$db_username ="b1ea00acc6e328";
$db_password ="bbfc3ba1";
$db_db = "heroku_22d0c2d27921dcd";

mysql_connect($db_host, $db_username, $db_password) or die(mysql_error());
mysql_select_db($db_db);

//function dbConnection() {
//    $connection = mysqli_connect("us-cdbr-iron-east-03.cleardb.net",);
?>