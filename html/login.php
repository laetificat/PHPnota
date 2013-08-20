<?php
session_start();
//////////////////////Importing SQL settings start//////////////////////
    require 'database_config.php';
//////////////////////Importing SQL settings end//////////////////////

//////////////////////Connect to database start//////////////////////
    $db_connect = mysql_connect($server, $user_name, $password);
    $db_select = mysql_select_db($database, $db_connect) or die("Can't connect to database");
//////////////////////Connect to database end//////////////////////

//////////////////////Language file selector//////////////////////
    require '../language/language_settings.php';
////////////////////Language file selector end////////////////////
?>

<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Sign in · PHPinvoice();</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHPinvoice(); - Opensource invoicing">
    <meta name="author" content="Kevin Heruer - Laetificat">

    <!-- Le styles -->
    <link href="../css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
    <link href="../css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../js/bootstrap.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="">
                    <link rel="apple-touch-icon-precomposed" href="">
                                   <link rel="shortcut icon" href="">
  </head>

  <body>

    <div class="container">

      <form class="form-signin" action="logincheck.php" method="post">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input class="input-block-level" placeholder="Email address" type="text" name="myusername">
        <input class="input-block-level" placeholder="Password" type="password" name="mypassword">
        <label class="checkbox">
          <input value="remember-me" type="checkbox"> Remember me
        </label>
        <label>
          <a href="recover.php">Forgot your password?</a>
        </label>
        <button class="btn btn-large btn-primary" type="submit">Sign in</button>
        <!-- Button to trigger modal -->
        <a href="#signup" role="button" class="btn btn-large btn-success" data-toggle="modal">Sign up</a>
      </form>

    <!-- Modal -->
    <div id="signup" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Create an account</h3>
    </div>
    <div class="modal-body">
    <p>
    <form class="form-horizontal" action="register.php" method="post">
      <div class="control-group">
          <label class="control-label" for="inputName">First name</label>
          <div class="controls">
           <input class="inputName" type="text" name="inputName" required>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="inputLastName">Last name</label>
          <div class="controls">
           <input class="inputLastName" type="text" name="inputLastName" required>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="inputCompany">Company name</label>
          <div class="controls">
           <input class="inputLastName" type="text" name="inputCompany" required>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="inputEmail">Email</label>
          <div class="controls">
           <input class="inputEmail" type="email" name="inputEmail" required>
          </div>
        </div>
      <div class="control-group">
        <label class="control-label" for="inputPassword">Password</label>
        <div class="controls">
          <input class="inputPassword" type="password" name="inputPassword" required>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="inputPassword">Retype password</label>
        <div class="controls">
          <input class="inputPassword" type="password" required>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="preferedLang">Prefered Language</label>
        <div class="controls">
          <select name="preferedLang">
             <option value="english">English</option>
             <option value="dutch">Dutch</option>
          </select>
        </div>
      </div>
      <div class="control-group">
        <div class="controls">
          <button type="submit" class="btn">Sign up</button>
        </div>
      </div>
    </form>
    </p>
    </div>
    <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
    </div>

    </div> <!-- /container -->



    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>

</body></html>