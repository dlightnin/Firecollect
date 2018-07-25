<head>
    <meta charset="utf-8" />
    <title>Firecollect | Registration </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Preview page of Metronic Admin Theme #2 for " name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="../assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="../assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="../assets/global/css/components-md.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="../assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="../assets/pages/css/login.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico" /> </head>

<body class="login">
    <!-- BEGIN LOGO -->
    <div class="logo">
        <a href="../../index.php">
            <img src="../img/2018_logotype_rdata.png" alt="" /> </a>
    </div>
    <!-- END LOGO -->
    <!-- BEGIN LOGIN -->
    <div class="content">

      <form action="includes/register.php" method="post" style="display:block !important;" class="register-form">
          <h3 class="font-green">Sign Up</h3>
          <p class="hint"> Enter your personal details below: </p>
          <div class="form-group">
              <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
              <label class="control-label visible-ie8 visible-ie9">Email
                <span class="required">*</span>
              </label>
              <input required='true' class="form-control placeholder-no-fix" type="text" placeholder="Email" email2="true" name="email2" />
          </div>

          <div class="form-group">
              <label class="control-label visible-ie8 visible-ie9" required='true'>Password</label>
              <input class="form-control placeholder-no-fix" minlength="8" type="password" autocomplete="off" id="register_password" placeholder="Password" name="password" /> </div>
          <div class="form-group">
              <label class="control-label visible-ie8 visible-ie9" required='true'>Re-type Your Password</label>
              <input class="form-control placeholder-no-fix" minlength="8" type="password" autocomplete="off" placeholder="Re-type Your Password" name="rpassword" /> </div>
          <div class="form-group margin-top-20 margin-bottom-20">
              <label class="mt-checkbox mt-checkbox-outline">
                  <input type="checkbox" name="tnc" required='true'/> I agree to the
                  <a href="javascript:;">Terms of Service </a> &
                  <a href="javascript:;">Privacy Policy </a>
                  <span></span>
              </label>
              <div id="register_tnc_error"> </div>
          </div>
            <div class="form-actions">
              <a type="button" href="../index.php" class="btn green btn-outline">Log in page</a>
              <button type="submit" id="register-submit-btn" class="btn btn-success uppercase pull-right">Submit</button>
            </div>
      </form>
    </div>

      <script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
      <script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
      <script src="../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
      <script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
      <script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
      <script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
      <!-- END CORE PLUGINS -->
      <!-- BEGIN PAGE LEVEL PLUGINS -->
      <script src="../assets/global/plugins/jquery-validation/js/jquery.validate.js" type="text/javascript"></script>
      <script src="../assets/global/plugins/jquery-validation/js/additional-methods.js" type="text/javascript"></script>
      <script src="../assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
      <!-- END PAGE LEVEL PLUGINS -->
      <!-- BEGIN THEME GLOBAL SCRIPTS -->
      <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
      <!-- END THEME GLOBAL SCRIPTS -->
      <!-- BEGIN PAGE LEVEL SCRIPTS -->
      <script src="../assets/pages/scripts/login.min.js" type="text/javascript"></script>
  </body>
