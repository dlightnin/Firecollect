<?php
  include "../../includes/dbConnect.php" ;
  include "passwordModule.php" ;
  $token = $_POST['token'] ;
  $pass = $_POST['password'];
  $hash_pass = password_hash($pass,PASSWORD_DEFAULT) ;


  $db_conn->query("UPDATE tbl_user set forgot_hash = NULL, password = '$hash_pass' where forgot_hash = '$token'") ;

?>

<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.7
Version: 4.7.5
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Firecollect | Login</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #2 for " name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="../../assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="../../assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="../../assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="../../assets/pages/css/login.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class="login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="../../../frontend/index.php">
                <img src="../../img/2018_logotype_rdata.png" alt="" /> </a>
        </div>
       <div class="content" align='center'>

          <?php
              echo "<h1>Password Successfully changed!</h1>
              <p>
                You may now log in <a href='../../index.php'>here</a>
              </p>" ;


          ?>
      </div>


               <!-- BEGIN CORE PLUGINS -->
               <script src="../../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
               <script src="../../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
               <script src="../../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
               <script src="../../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
               <script src="../../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
               <script src="../../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
               <!-- END CORE PLUGINS -->
               <!-- BEGIN PAGE LEVEL PLUGINS -->
               <script src="../../assets/global/plugins/jquery-validation/js/jquery.validate.js" type="text/javascript"></script>
               <script src="../../assets/global/plugins/jquery-validation/js/additional-methods.js" type="text/javascript"></script>
               <script src="../../assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
               <!-- END PAGE LEVEL PLUGINS -->
               <!-- BEGIN THEME GLOBAL SCRIPTS -->
               <script src="../../assets/global/scripts/app.min.js" type="text/javascript"></script>
               <!-- END THEME GLOBAL SCRIPTS -->
               <!-- BEGIN PAGE LEVEL SCRIPTS -->
               <script src="../../assets/pages/scripts/login.min.js" type="text/javascript"></script>
               <!-- END PAGE LEVEL SCRIPTS -->
               <!-- BEGIN THEME LAYOUT SCRIPTS -->
               <!-- END THEME LAYOUT SCRIPTS -->

           </body>

       </html>