<?php
  include "../../includes/dbConnect.php";
  $token = $_GET["token"] ;

  $check = $db_conn->query("SELECT * from tbl_user where forgot_hash = '$token'") ;
  if($check->num_rows != 1)
  {
    header('location:noAccount.php') ;
    break;
  }

 ?>


<head>
    <meta charset="utf-8" />
    <title>Firecollect | Password Change </title>
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
    <link href="../../assets/global/css/components-md.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="../../assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="../../assets/pages/css/login.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico" /> </head>

<body class="login">
    <!-- BEGIN LOGO -->
    <div class="logo">
        <a href="../../../frontend/index.php">
            <img src="../../img/2018_logotype_rdata.png" alt="" /> </a>
    </div>
    <!-- END LOGO -->
    <!-- BEGIN LOGIN -->
    <div class="content">

      <form action="saveNewPass.php" method="post" style="display:block !important;" class="register-form">
          <h3 class="font-green">Change your Password</h3>
          <p class="hint"> Enter your new password: </p>
          <?php echo "<input style='display:none;' type='text' name='token' value=".$token.">" ; ?>
          <div class="form-group">
              <label class="control-label visible-ie8 visible-ie9" required='true'>Password</label>
              <input class="form-control placeholder-no-fix" type="password" minlength="8" autocomplete="off" id="register_password" placeholder="Password" name="password" /> </div>
          <div class="form-group">
              <label class="control-label visible-ie8 visible-ie9" required='true'>Re-type Your Password</label>
              <input class="form-control placeholder-no-fix" type="password" minlength="8" autocomplete="off" placeholder="Re-type Your Password" name="rpassword" /> </div>

            <div class="form-actions">
              <button type="submit" id="register-submit-btn" class="btn btn-success uppercase pull-right">Submit</button>
            </div>
      </form>
    </div>

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
  </body>
