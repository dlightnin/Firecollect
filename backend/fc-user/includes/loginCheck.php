<?php
    require "../../includes/dbConnect.php" ;
    require "passwordModule.php" ;
    include "getUserIp.php" ;

    $email = $_POST['email'] ;
    $pass = $_POST['password'] ;


    // if(isset($_POST['remember']))
    // {
    //   $rem = $_POST['remember'] ;
    //   $T = md5($email.time());
    //   $T = password_hash($T,PASSWORD_DEFAULT) ;
    //   setcookie($email,$T) ;
    // }

    $res = $db_conn->query("SELECT * From tbl_user where email = '$email'") ;


    if($res->num_rows == 1)
    {
      $res = $res->fetch_assoc() ;



      if(password_verify($pass, $res['password']))
      {
        if($res['activated'] == 0)
        {
          header("location:notActive.php?email=".$email."" ) ;
        }
        else
        {
          session_start();
          $_SESSION["user_id"]= $res['u_id'];
          $user = array($email) ;
          $ip = getUserIP() ;
          $_SESSION["user_data"] = $user ;
          $db_conn->query("UPDATE tbl_user Set last_login = current_timestamp where email = '$email'") ;
          $db_conn->query("UPDATE tbl_user Set last_login_ip = '$ip' where email = '$email'") ;

          if($_POST["remember"] == "1")
          {
            $accountToken = openssl_random_pseudo_bytes(16);
            $accountToken = bin2hex($accountToken);

    				setcookie ("account_login",$email,time()+ (86400 * 365),"/");
    				setcookie ("account_token",$accountToken,time()+ (86400 * 30),"/");

            $db_conn->query("UPDATE tbl_user Set remember_hash = '$accountToken' where email = '$email'") ;
			    }

          else
          {
				    if(isset($_COOKIE["account_login"]))
            {
					    setcookie ("account_login","");
				    }

				    if(isset($_COOKIE["account_token"]))
            {
              setcookie ("account_token","");
				    }

            $db_conn->query("UPDATE tbl_user Set remember_hash = NULL where email = '$email'") ;

			    }



          // header("location:../../fc-admin/dashboard.php" ) ;
          echo "Success" ;
        }

      }

      else
      {
        // header("location:../../index.php") ;
        echo "Some of your info isn't correct. Please try again." ;
      }
    }

    else
    {
      // header("location:../../index.php") ;
      echo "Some of your info isn't correct. Please try again.";
    }




 ?>
