<?php
session_start();

if(empty($_SESSION['username'])) {
    header("location:../login.php");
}
//////////////////////Importing SQL settings start//////////////////////
    require '../database_config.php';
//////////////////////Importing SQL settings end//////////////////////

//////////////////////Connect to database start//////////////////////
    $db_connect = mysql_connect($server, $user_name, $password);
    $db_select = mysql_select_db($database, $db_connect) or die("Can't connect to database");
//////////////////////Connect to database end//////////////////////

//////////////////////Defining variables start//////////////////////
    $getCompanyName = mysql_query("SELECT ownerOf FROM accounts WHERE email='".$_SESSION['username']."'");
        while($db_field = mysql_fetch_assoc($getCompanyName)){
            $companyName = ucfirst($db_field['ownerOf']);
        }
    $getName = mysql_query("SELECT name, lastName FROM accounts WHERE email='".$_SESSION['username']."'");
    while($db_field = mysql_fetch_assoc($getName)){
        $userName = "".$db_field['name']." ".$db_field['lastName']."";
    }
    if(isset($_POST['isNew'])) {
        $new = "true";
    } else {
        $new = "true"; //Change this to false once the sign up stuff works!
    }
    $getAdmin = mysql_query("SELECT isAdmin FROM accounts WHERE email='".$_SESSION['username']."'");
    while($db_field = mysql_fetch_assoc($getAdmin)){
        $isAdmin = $db_field['isAdmin'];
    }
//////////////////////Defining variables end//////////////////////

//////////////////////Language file selector//////////////////////
    require '../../language/language_settings.php';
////////////////////Language file selector end////////////////////

    $filename = basename($_FILES['uploaded']['name']);

    if(!file_exists('../../users/'.$userName)){
        mkdir('../../users/'.$userName, 0777, true);
        echo "Folder created!<br />";
    }

    $target = "../../users/".$userName."/"; 
    $target = $target . basename( $_FILES['uploaded']['name']) ; 
    $ok=1; 
    
    //This is our size condition 
    if ($uploaded_size > 350000){ 
        echo "Your file is too large.<br>"; 
        $ok=0; 
    } 
    
    //This is our limit file type condition 
    if ($uploaded_type =="text/php"){ 
        echo "No PHP files<br>"; 
        $ok=0; 
    } 
    
    //Here we check that $ok was not set to 0 by an error 
    if ($ok==0){ 
        echo "Sorry your file was not uploaded"; 
    } 
    
    //If everything is ok we try to upload it 
    else { 
    if(move_uploaded_file($_FILES['uploaded']['tmp_name'], $target)){ 
        echo "The file ". basename( $_FILES['uploadedfile']['name']). " has been uploaded"; 
        header("Location: index.php?error=1");
    } else { 
        echo "Sorry, there was a problem uploading your file."; 
        header("Location: index.php?error=2");
    } 
    } 

    //mysql_query("INSERT INTO invoices (filename, date, type) VALUES ('$filename', '$date', '$type')");
?>