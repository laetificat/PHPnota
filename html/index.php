<?php
session_start();

if(empty($_SESSION['username'])) {
        header("location:login.php");
    }
//////////////////////Importing SQL settings start//////////////////////
    require 'database_config.php';
//////////////////////Importing SQL settings end//////////////////////

//////////////////////Connect to database start//////////////////////
    $db_connect = mysql_connect($server, $user_name, $password);
    $db_select = mysql_select_db($database, $db_connect) or die("Can't connect to database");
//////////////////////Connect to database end//////////////////////

//////////////////////Defining variables start//////////////////////
    //$companyName = "Laetificat";
    $getCompanyName = mysql_query("SELECT ownerOf FROM accounts WHERE email='".$_SESSION['username']."'");
        while($db_field = mysql_fetch_assoc($getCompanyName)){
            $companyName = ucfirst($db_field['ownerOf']);
        }
    $getName = mysql_query("SELECT name, lastName FROM accounts WHERE email='".$_SESSION['username']."'");
    while($db_field = mysql_fetch_assoc($getName)){
        $userName = "".$db_field['name']." ".$db_field['lastName']."";
    }
    if(isset($_POST['isNew'])) {
        $new = $_POST['isNew'];
    } else {
        $new = "";
    }
    $getAdmin = mysql_query("SELECT isAdmin FROM accounts WHERE email='".$_SESSION['username']."'");
    while($db_field = mysql_fetch_assoc($getAdmin)){
        $isAdmin = $db_field['isAdmin'];
    }
//////////////////////Defining variables end//////////////////////
?>

<html lang="en"><head>
    <meta charset="utf-8">
    <title>PHPinvoice();</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="description">
    <meta content="" name="author">

    <!-- Le styles -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
        padding-left: 15px; /* 15px to make the side menu not all pasted to the side of the screen */
        padding-right: 15px; /* Just to even stuff out */
      }

      .container {
        margin-right: 0;
        margin-left: auto;
      }
    </style>
    <link rel="stylesheet" href="../css/bootstrap-responsive.css">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../js/bootstrap.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->

    <?php
    //if(empty($_SESSION['username'])) {
    //    header("location:login.php");
    ?>
  </head>

  <body data-spy="scroll" data-target=".nav">

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <button data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar" type="button">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="#" class="brand"><?php echo $companyName; ?></a>
          <div class="nav-collapse collapse">

            <ul class="nav pull-right">
                <li class="dropdown" id="fat-menu">
                  <a data-toggle="dropdown" class="dropdown-toggle" role="button" id="drop3" href="#"><?php echo $userName; ?> <b class="caret"></b></a>
                  <ul aria-labelledby="drop3" role="menu" class="dropdown-menu">
                    <li role="presentation"><a href="#settings" tabindex="-1" role="menuitem" data-toggle="modal">Settings</a></li>
                    <li role="presentation"><a href="logout.php" tabindex="-1" role="menuitem">Log out</a></li>
                    <?php
                        if($isAdmin == "1") {
                            echo "
                                <li class=\"divider\"></li>
                                <li role=\"presentation\"><a href=\"admin.php\" tabindex=\"-1\" role=\"menuitem\">Admin panel</a></li>
                            ";
                        } else {

                        }
                    ?>
                  </ul>
                </li>
            </ul>

            <ul class="nav pull-left">
                <li class="dropdown" id="fat-menu">
                  <a data-toggle="dropdown" class="dropdown-toggle" role="button" id="drop3" href="#">Quick menu <b class="caret"></b></a>
                  <ul aria-labelledby="drop3" role="menu" class="dropdown-menu">
                    <li role="presentation"><a href="new.php" tabindex="-1" role="menuitem">Create new invoice</a></li>
                    <li role="presentation"><a href="#quickAddContact" tabindex="-1" role="menuitem" data-toggle="modal">Add new contact</a></li>
                  </ul>
                </li>
            </ul>

            <ul class="nav">
              <li class="active"><a href="#">Dashboard</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

<?php
    if($new == "true") {
        echo "
    <div class=\"alert alert-success\">
    <a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
        Congratulations with your new account, we hope you'll enjoy your stay!
    </div>
    ";
    } else {

    }
?>
    <div class="alert alert">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
        This build is very unstable and barely working, use with caution!
    </div>

    <ul class="nav nav-tabs nav-stacked pull-left">
        <li><a href="#home">Overview</a></li>
        <li><a href="#about">Statistics</a></li>
        <li><a href="#contact">Turnover</a></li>
        <li><a href="#contact">Invoices</a></li>
        <li><a href="#contact">Contacts</a></li>
    </ul>

    <div class="container">

    <!-- Modal settings -->
        <div id="settings" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h3 id="myModalLabel">Settings</h3>
        </div>
        <div class="modal-body">
        <p>
            Test
        </p>
        </div>
        <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <button class="btn btn-primary">Save changes</button>
        </div>
        </div>
    <!-- End Modal -->

    <!-- Modal Quick add contact -->
        <div id="quickAddContact" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h3 id="myModalLabel">Add a contact</h3>
        </div>
        <div class="modal-body">
        <p>
            Test
        </p>
        </div>
        <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <button class="btn btn-primary">Add contact</button>
        </div>
        </div>
    <!-- End Modal -->

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  

</body></html>