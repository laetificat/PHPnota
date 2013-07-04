<?php
	//The language selector, checks which language is set in the accounts table. Then selects a language file on that decision.

	session_start();

	require '../html/database_config.php';

	$db_connect = mysql_connect($server, $user_name, $password);
    $db_select = mysql_select_db($database, $db_connect) or die("Can't connect to database");

    $whichLang = mysql_query("SELECT language FROM accounts WHERE email='".$_SESSION['username']."'");
        while($db_field = mysql_fetch_assoc($whichLang)){
            $whichLang = $db_field['language'];
        }

    switch ($whichLang) {
    	case "english":
    		require 'english.lang';
    		break;
    	case "dutch":
    		require 'dutch.lang';
    		break;
    	default:
    		require 'english.lang';
    }