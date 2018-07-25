<?php
  require '../../includes/dbConnect.php' ;
  function dec_enc($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    $secret_key = 'This is my secret key';
    $secret_iv = 'This is my secret iv';

    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}

  $perm = $_POST['Perm'] ;
  $user = $_POST['user'] ;
  $project = $_POST['project'] ;

  $res = $db_conn->query("SELECT * from tbl_collaborators where user_id = '$user' and p_id = '$project'") ;

  if($res->num_rows == 1)
  {
    $db_conn->query("UPDATE tbl_collaborators
                     SET edit_project = '$perm[0]', edit_map = '$perm[1]', add_images = '$perm[2]', copy_project = '$perm[3]',
                     invite_users = '$perm[4]', change_permissions = '$perm[5]', 	change_status_project = '$perm[6]', add_dataset = '$perm[7]',
                     edit_dataset = '$perm[8]', copy_dataset = '$perm[9]', delete_dataset = '$perm[10]', change_status_dataset = '$perm[11]',
                     add_variable = '$perm[12]', edit_variable = '$perm[13]', 	delete_variable = '$perm[14]', view_datafile = '$perm[15]',
                     download_datafile = '$perm[16]', upload_datafile = '$perm[17]', edit_datafile = '$perm[18]', delete_datafile = '$perm[19]'
                     WHERE user_id = '$user' and p_id = '$project'") ;
  }


 ?>
