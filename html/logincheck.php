<?php
session_start();
//////////////////////Importing SQL settings start//////////////////////
    require 'database_config.php';
//////////////////////Importing SQL settings end//////////////////////

//////////////////////Connect to database start//////////////////////
    $db_connect = mysql_connect($server, $user_name, $password);
    $db_select = mysql_select_db($database, $db_connect) or die("Can't connect to database");
//////////////////////Connect to database end//////////////////////

// username and password sent from form 
$myusername = $_POST['myusername']; 
$mypassword = $_POST['mypassword'];

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);
$sql = "SELECT * FROM accounts WHERE email='$myusername' AND password='$mypassword'";
$result = mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){

// Register $myusername, $mypassword and redirect to file "login_success.php"
$_SESSION['username'] = $myusername;
$_SESSION['password'] = $mypassword;

header("location:index.php");
}
else {
echo "Wrong Username or Password";
}
?>