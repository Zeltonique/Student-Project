<?php
session_start();
include('connect.php');

if(isset($_POST['submit']))
{
  //whether the username is blank
  if($_POST['username'] == '')
  {
    $_SESSION['error']['username'] = "We would realy like to know your name!";
  }
  else
  {
    $username= $_POST['username'];
    $sql1 = "SELECT * FROM users WHERE username = '$username'";
    $result1 = mysql_query($sql1) or die(mysql_error());
    if (mysql_num_rows($result1) > 0)
    {
      $_SESSION['error']['username'] = "Ooh SNAP... this username is already registered.";
    }
    //whether the email is blank
    if($_POST['email'] == '')
    {
      $_SESSION['error']['email'] = "Yeah, we kinda need your email please...";
    }
    else
    {
      //whether the email format is correct
      if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9._-]+)+$/", $_POST['email']))
      {
        //if it has the correct format whether the email has already exist
        $email= $_POST['email'];
        $sql1 = "SELECT * FROM users WHERE email = '$email'";
        $result1 = mysql_query($sql1) or die(mysql_error());
        if (mysql_num_rows($result1) > 0)
        {
          $_SESSION['error']['email'] = "Ooh SNAP... this email is already registered.";
        }
      }
      else
      {
        //this error will set if the email format is not correct
        $_SESSION['error']['email'] = "Uhm, we need a valid email please.";
      }
    }
    //whether the password is blank


    if($_POST['password'] == '')
    {
      $_SESSION['error']['password'] = "You realy need a password...";
    }


    /////// Password match md5


    /*else
    {
    if (preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/',$_POST['password']))
    {
    $_SESSION['error']['password'] = "This password is not correct.";
  }
}*/



//if the error exist, we will go to registration form
if(isset($_SESSION['error']))
{
  header("Location: index.php");
  exit;
}
else
{
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = md5(trim($_POST['password'])); //md5 encrypt password.

  $sql2 = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
  $result2 = mysql_query($sql2) or die(mysql_error());
  header("Location: index.php");
  exit;
}
}
}
?>
