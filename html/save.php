<?php
	session_start();
	require 'database_config.php';

	$db_connect = mysql_connect($server, $user_name, $password);
    $db_select = mysql_select_db($database, $db_connect) or die("Can't connect to database");

	$languageSavedChanges = $_POST['group1'];

	switch ($languageSavedChanges) {
    	case "english":
    		mysql_query("UPDATE accounts SET language = 'english' WHERE email='".$_SESSION['username']."'");
    		header("location:index.php");
    		break;
    	case "dutch":
    		mysql_query("UPDATE accounts SET language = 'dutch' WHERE email='".$_SESSION['username']."'");
    		header("location:index.php");
    		break;
    	case "":
    		header("location:index.php");
    		break;
    	default:
    		echo "FATAL ERROR, PLEASE CLICK <a href=\"index.php\">HERE</a>";
    }

?>