<?php 
session_start();
session_destroy();
echo "<center>Logging out...</center>";
header("location:index.php");
exit;
?>