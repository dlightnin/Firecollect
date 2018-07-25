<?php
session_start();

require '../../includes/dbConnect.php' ;


function validateInput($data){
  $data = trim(stripcslashes(htmlspecialchars($data)));
  return $data;


}



$project_id = $_SESSION['current_project_id'];

$data_set_id = $_SESSION['current_data_set_id'];


// if (isset($_POST['add_variable'])){
$title= validateInput($_POST['title']);
$datafile_id = validateInput($_POST['datafile_id']);
$times = validateInput($_POST['times']);
$periodicity = validateInput($_POST['periodicity']);
$period = validateInput($_POST['period']);
$software_name = validateInput($_POST['software_name']);
$software_link = validateInput($_POST['software_link']);
$variables = validateInput($_POST['variables']);
$comments = validateInput($_POST['comments']);
$variables = $variables;
$variables = str_replace('&quot;','',$variables);
// datafile_id:datafile_id, title:title,datefilter:datefilter,times:times,periodicity:periodicity,
//   software_name:software_name,software_link:software_link,variables:variables,comments:comments





    $query2= "UPDATE tbl_data_files SET data_set_id='$data_set_id',
    title='$title',period='$period',
    periodicity='$periodicity',times='$times',comments='$comments',software_name='$software_name',
    variables='$variables', software_link='$software_link' WHERE id = $datafile_id";

    if($result = $db_conn->query($query2)){
    echo"datafile updated!";
}
    // $row = $result->fetch_assoc();
    // echo $row['status';


    //
    // $row = $result->fetch_assoc();
    //   # code...
    //   $variable_id = $row['id'];
    //
    //   $_SESSION['current_variable_id']= $variable_id;



// }





 ?>
