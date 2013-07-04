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
    require '../language/language_settings.php';
////////////////////Language file selector end////////////////////
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
                    <li role="presentation"><a href="#settings" tabindex="-1" role="menuitem" data-toggle="modal"><?php echo $language_Settings; ?></a></li>
                    <li role="presentation"><a href="logout.php" tabindex="-1" role="menuitem"><?php echo $language_Logout; ?></a></li>
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
                    <li role="presentation"><a href="newpurchase.php" tabindex="-1" role="menuitem">Create new purchase invoice</a></li>
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

    <div class="container-fluid">
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
        <div class="row-fluid">
            <div class="span2">
                <ul class="nav nav-tabs nav-stacked">
                    <li class="active"><a href="#home">Overview</a></li>
                    <li><a href="#about">Statistics</a></li>
                    <li><a href="#contact">Turnover</a></li>
                    <li><a href="#contact">Invoices</a></li>
                    <li><a href="#contact">Purchase Invoices</a></li>
                    <li><a href="#contact">Contacts</a></li>
                </ul>
            </div>
            <div class="span10">
                <!-- Modal settings -->
                <div id="settings" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                        <h3 id="myModalLabel"><?php echo $language_Settings; ?></h3>
                        </div>
                        <div class="modal-body">
                        <p>
                            <h4><?php echo $language_LanguageSetting ?></h4>
                            <form method="post" action="save.php">
                              <input type="radio" name="group1" value="english"><?php echo $language_English ?><br />
                              <input type="radio" name="group1" value="dutch"><?php echo $language_Dutch ?><br />
                        </p>
                        </div>
                        <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo $language_CancelButton ?></button>
                        <button class="btn btn-primary"><?php echo $language_SaveChanges ?></button></form>
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

                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Status</th>
                      <th>Date created</th>
                      <th>Due date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td><span class="label label-success">PAID</span></td>
                      <td>10/06/2013</td>
                      <td>19/06/2013</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td><span class="label label-success">PAID</span></td>
                      <td>10/06/2013</td>
                      <td>19/06/2013</td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td><span class="label label-success">PAID</span></td>
                      <td>10/06/2013</td>
                      <td>19/06/2013</td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td><span class="label label-info">WAITING FOR RESPONSE</span></td>
                      <td>10/06/2013</td>
                      <td>10/07/2013</td>
                    </tr>
                    <tr>
                      <td>5</td>
                      <td><span class="label label-warning">DUE DATE SOON</span></td>
                      <td>10/06/2013</td>
                      <td>30/06/2013</td>
                    </tr>
                    <tr>
                      <td>6</td>
                      <td><span class="label label-warning">DUE DATE SOON</span></td>
                      <td>10/06/2013</td>
                      <td>28/06/2013</td>
                    </tr>
                    <tr>
                      <td>7</td>
                      <td><span class="label label-important">3 DAYS LATE</span></td>
                      <td>10/06/2013</td>
                      <td>22/06/2013</td>
                    </tr>
                  </tbody>
                </table>

            </div>
        </div>
    </div>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  

</body></html>