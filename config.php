<?php

    // These variables define the connection information for my MySQL database
    $username="root";
    $password="mysql";
    $database="Student";
    mysql_connect(localhost,$username,$password);
    @mysql_select_db($database) or die("Database Error");

//What the difference???
    $username = "root";
    $password = "mysql";
    $host = "localhost";
    $dbname = "Student";
///////////////////////////
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    try { $db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options); }
    catch(PDOException $ex){ die("Failed to connect to the database: " . $ex->getMessage());}
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    header('Content-Type: text/html; charset=utf-8');
    session_start();
?>
