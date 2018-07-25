<?php
  require '../../includes/dbConnect.php' ;


  //
  // if (isset($_POST['edit_project'])){
  // $title = validateInput($_POST['project_title']);
  // $short_name = validateInput($_POST['short_name']);
  // $start_date = validateInput($_POST['start_date']);
  // $end_date = validateInput($_POST['end_date']);
  // $description = validateInput($_POST['project_description']);
  // $contact_name = validateInput($_POST['contact_name']);
  // $contact_email = validateInput($_POST['contact_email']);
  // $status = validateInput($_POST['status']);
  // $sponsor = validateInput($_POST['sponsor']);
  // $research_area = validateInput($_POST['research_area']);



    //
    // $query = "INSERT INTO tbl_projects (title,short_name,starting_date,
    //   end_date, description, contact_name,contact_email, status, sponsor,research_area)
    //   VALUES ('$title','$short_name','$start_date', '$end_date', '$description',
    //   '$contact_name','$contact_email','$status','$sponsor','$research_area')";

      $query= "SELECT * FROM tbl_projects";

      $result = $db_conn->query($query);

      // $row = $result->fetch_assoc();
      // echo $row['status'];

      while ($row = $result->fetch_assoc() ) {
        # code...
        $project_id = $row['id'];
        $title= $row['title'];
        $start_date= $row['starting_date'];
        $end_date= $row['end_date'];
        $status= (int)$row['status'];

        if ($status == 0 ){
        echo "
        <tr>
            <td><a href='a_project.php?id=$project_id'> $title</a> </td>
            <td> $start_date </td>
            <td> $end_date </td>
            <td style='text-align:center;'> <span  style='color:red;font-size: 23px; align: center;' class='fa fa-times' ></span></td>


            <td style='text-align:center;'>
              <a style='color: #666; font-size:23px;text-decoration:none;' class=' fa fa-edit' href='edit.php?id=$project_id' ></a>
                <a style='font-size:23px;text-decoration:none;color:#666;' class='share fa fa-share' href='javascript:;'>  </a>
                <a style='font-size:23px;text-decoration:none;color:#666;' class='delete fa fa-trash-o' href='javascript:;'>  </a>

            </td>
        </tr>
        ";}else{
          echo "
          <tr>
              <td><a href='a_project.php?id=$project_id'> $title</a> </td>
              <td> $start_date </td>
              <td> $end_date </td>
              <td style='text-align:center;'> <span  style='color:green;font-size: 23px; align: center;' class='fa fa-check' ></span></td>


              <td style='text-align:center;'>
                <a style='color: #666; font-size:23px;text-decoration:none;' class=' fa fa-edit' href='edit.php?id=$project_id' ></a>
                  <a style='font-size:23px;text-decoration:none;color:#666;' class='share fa fa-share' href='javascript:;'>  </a>
                  <a style='font-size:23px;text-decoration:none;color:#666;' class='delete fa fa-trash-o' href='javascript:;'>  </a>

              </td>
          </tr>
          ";
        }
      }




?>
