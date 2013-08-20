<?php
	include 'database_config.php';

//////////////////////Connect to database start//////////////////////
    $db_connect = mysql_connect($server, $user_name, $password);
    $db_select = mysql_select_db($database, $db_connect) or die("Can't connect to database");
//////////////////////Connect to database end//////////////////////

	$name = $_POST['inputName'];
	$lastName = $_POST['inputLastName'];
	$ownerOf = $_POST['inputCompany'];
	$email = $_POST['inputEmail'];
	$password = $_POST['inputPassword'];
	$language = $_POST['preferedLang'];

	if($_POST['inputName'] == "" || $_POST['inputLastName'] == "" || $_POST['inputCompany'] == "" || $_POST['inputEmail'] == "" || $_POST['inputPassword'] == ""){
		echo "Please fill in all the fields...<p></p>";
	} else {
		$sql = "SELECT COUNT(*) FROM accounts WHERE email = '".mysql_real_escape_string($email)."'";
		$result = mysql_query($sql) or die('error');
	    $row = mysql_fetch_assoc($result);
	    if(mysql_num_rows($row)) {
	      $errMsg = 'Username exists';
	      echo "".$errMsg."<br /><input type=\"button\" onclick=\"history.back();\" value=\"Back\">";
	    } else {
	    	echo "Success, account created! Click the button to continue.";
			mysql_query("INSERT INTO accounts (name, lastName, email, password, ownerOf, language) VALUES ('$name', '$lastName', '$email', '$password', '$ownerOf', '$language')");
			mysql_query("INSERT INTO companyinfo (name) VALUES ('$ownerOf')");
			?><form action="logincheck.php" method="post"><input type="hidden" value="<?php echo $email ?>" name="myusername"><input type="hidden" value="<?php echo $password ?>" name="mypassword"><input type="submit" value="Continue"></form><?php
	    }
	}
?>