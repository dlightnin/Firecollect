<?php
  require 'includes/dbConnect.php' ;
  session_start();

  if(isset($_COOKIE["account_login"]) and isset($_COOKIE["account_token"]))
  {
    $checkEmail = $_COOKIE["account_login"] ;
    $checkToken = $_COOKIE["account_token"] ;

    $rem = $db_conn->query("SELECT email from tbl_user where email = '$checkEmail' and remember_hash = '$checkToken' ") ;
    $rem = $rem->fetch_assoc() ;
  }
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
        <title>Firecollect | Log in</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #2 for " name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="assets/global/css/components-md.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="assets/pages/css/login.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class="login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="../index.php">
                <img src="img/2018_logotype_rdata.png" alt="" /> </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->

                <h3 class="form-title" style="text-color:#00A9B2;">Log In</h3>
                <div class="alert alert-danger display-hide" id="alert">
                    <button class="close" data-close="alert"></button>
                </div>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->

                    <label class="control-label visible-ie8 visible-ie9">Email</label>
                    <?php
                      if(isset($checkEmail))
                      {
                        if($rem['email'] == $checkEmail)
                        {
                          echo "<input class='form-control form-control-solid' type='text' autocomplete='off' value=".$rem['email']." name='email' /> </div>";
                        }

                        else
                        {
                          echo "<input class='form-control form-control-solid placeholder-no-fix' type='text' autocomplete='off' placeholder='Email' name='email' /> </div>" ;
                        }
                      }

                      else
                      {
                        echo "<input class='form-control form-control-solid placeholder-no-fix' type='text' autocomplete='off' placeholder='Email' name='email' /> </div>" ;

                      }

                     ?>
                     <script>
                      var em = "<?php echo $checkToken ?>" ;

                     </script>


                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> </div>



                  <div class="form-actions" >

                      <button type="submit" style="width:100%; background-color:#00A9B2; " id="login_btn" class="btn green uppercase">submit</button>

                      <div class="row">
                      <label style="margin-top:10px !important ; margin-right:0px;" class="rememberme check mt-checkbox mt-checkbox-outline ">

                        <?php
                          if(isset($checkEmail))
                          {
                            echo "<input class='col-sm-3' type='checkbox' name='remember' checked/>Remember" ;
                          }

                          else
                          {
                            echo "<input class='col-sm-3' type='checkbox' name='remember' />Remember" ;
                          }


                         ?>

                          <span></span>
                      </label>
                      <a href="fc-user/forgotPass.php" class="pull-right" style="margin-top:3% !important;">Forgot Password?</a>
                  </div>
                </div>

                <!-- <div class="login-options">
                    <h4>Or login with</h4>
                    <ul class="social-icons">
                        <li>
                            <a class="social-icon-color facebook" data-original-title="facebook" href="javascript:;"></a>
                        </li>
                        <li>
                            <a class="social-icon-color twitter" data-original-title="Twitter" href="javascript:;"></a>
                        </li>
                        <li>
                            <a class="social-icon-color googleplus" data-original-title="Goole Plus" href="javascript:;"></a>
                        </li>
                        <li>
                            <a class="social-icon-color linkedin" data-original-title="Linkedin" href="javascript:;"></a>
                        </li>
                    </ul>
                </div> -->
              <a style="text-decoration:none; color:white;" href="fc-user/registerPage.php">
                <div class="create-account">
                    <p  class="uppercase">
                         Create an account
                    </p>
                </div>
              </a>

            <!-- END LOGIN FORM -->
            <!-- BEGIN FORGOT PASSWORD FORM -->


        </div>
        <!--[if lt IE 9]>
<script src="assets/global/plugins/respond.min.js"></script>
<script src="assets/global/plugins/excanvas.min.js"></script>
<script src="assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="assets/global/plugins/jquery-validation/js/jquery.validate.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-validation/js/additional-methods.js" type="text/javascript"></script>
        <script src="assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="assets/pages/scripts/login.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
        <script>
          // $(document).on("keypress",function(e){
          //   e.preventDefault();
          //   e.stopPropagation();
          //
          //   var key = e.which;
          //   if(key === 13)  // the enter key code
          //   {
          //     $(".login-form").submit();
          //   }
          //
          // });


          $(document).on("click","#login_btn",function(event){
            event.preventDefault();
            event.stopPropagation();

            var email = $("input[name='email']")[0].value ;
            var pass = $("input[name='password']")[0].value ;

            if($("input[name='remember']")[0].checked)
            {
              var remember = 1 ;
            }

            else
            {
              var remember = 0 ;
            }



            console.log(remember);

            $.ajax({
              url: "fc-user/includes/loginCheck.php",
              method: "post",
              data: {email:email,password:pass,remember:remember},
              success:function(data){
                if(data)
                {
                  if(data == "Success")
                  {
                    window.location.replace("fc-admin/dashboard.php");
                  }

                  else
                  {
                    $("#alert")[0].innerHTML = data ;
                    $("#alert").css("display","block") ;
                  }
                }
              }

            });


          });

          $(document).on("keypress",function(event){

            if(event.which == 13)  // the enter key code
            {
              event.preventDefault();

              var email = $("input[name='email']")[0].value ;
              var pass = $("input[name='password']")[0].value ;

              if($("input[name='remember']")[0].checked)
              {
                var remember = 1 ;
              }

              else
              {
                var remember = 0 ;
              }



              console.log(remember);

              $.ajax({
                url: "fc-user/includes/loginCheck.php",
                method: "post",
                data: {email:email,password:pass,remember:remember},
                success:function(data){
                  if(data)
                  {
                    if(data == "Success")
                    {
                      window.location.replace("fc-admin/dashboard.php");
                    }

                    else
                    {
                      $("#alert")[0].innerHTML = data ;
                      $("#alert").css("display","block") ;
                    }
                  }
                }

              });
            }

          });
        </script>
    </body>

</html>
