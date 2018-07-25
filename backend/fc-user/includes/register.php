<?php
require '../../includes/dbConnect.php' ;
require 'passwordModule.php' ;
require '../../PHPMailer/PHPMailerAutoload.php' ;
include 'getUserIp.php' ;

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

//
$email = $db_conn->real_escape_string($_POST['email2']);
$check = $db_conn->query("SELECT * From tbl_user where email = '$email'") ;

if($check->num_rows >0)
{
  header('location:alreadyExists.php');
  break;
}
if(!isset($_POST['token']))
{
  $pass = $db_conn->real_escape_string($_POST['password']) ;
  $token = md5($email.time());
}
else
{
  $token = $_POST['token'] ;
  $email = $_POST['email'] ;
}
//
$hash_pass = password_hash($pass,PASSWORD_DEFAULT) ;
//
$date = date("Y/m/d") ;

$ip = getUserIP() ;




//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;
$mail->IsHTML(true);

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "oficina.catec@upr.edu";

//Password to use for SMTP authentication
$mail->Password = "UndiaenlaOficina";

//Set who the message is to be sent from
$mail->setFrom('oficina.catec@upr.edu', 'Firecollect');

//Set an alternative reply-to address
$mail->addReplyTo('noreply@Catec.com', 'First Last');

//Set who the message is to be sent to
$mail->addAddress($email,'');

//Set the subject line
$mail->Subject = 'Firecollect account activation';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//Replace the plain text body with one created manually
$mail->Body = "<html>
                <head>
                  <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'>
                  <title>PHPMailer Test</title>
                </head>
                <body>
                <div style='width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;'>
                  <h1>Click on the button below to activate your Firecollect account.</h1>
                  <div align='center'>
                  <button class='btn green uppercase'>
		                <a style='text-decoration:none ; color:black ' href='136.145.54.38/~catec/firecollect_ts/backend/fc-user/includes/activate.php?token=".$token."'>Activate</a>

                  </button>
                  </div>

                </div>
                </body>
              </html>";

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send())
{
    //echo "Mailer Error: " . $mail->ErrorInfo;
    echo "<h1>Error sending email</h1>
          <p>
            There was a problem sending the activation email to the provided address.
            Please register with an existing address.
          </p>" ;

    // Add Header location
}

else
{

    $accountQuery = "INSERT INTO tbl_user(email,password,create_date,create_ip,last_login_ip,activation_hash,activated)
                     Values('$email','$hash_pass','$date','$ip','$ip','$token',0)" ;

    $db_conn->query($accountQuery) ;

    $user_id = $db_conn->insert_id;

    $infoQuery = "INSERT INTO tbl_user_info(u_id) values ($user_id)" ;

    $db_conn->query($infoQuery) ;



    header("location:sent.php") ;
    //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    #if (save_mail($mail)) {
    #    echo "Message saved!";
    #}
}

//Section 2: IMAP
//IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
//Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
//You can use imap_getmailboxes($imapStream, '/imap/ssl') to get a list of available folders or labels, this can
//be useful if you are trying to get this working on a non-Gmail IMAP server.
function save_mail($mail) {
    //You can change 'Sent Mail' to any other folder or tag
    $path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";

    //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
    $imapStream = imap_open($path, $mail->Username, $mail->Password);

    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    imap_close($imapStream);

    return $result;
}

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
