<?php

  ############ PERMISOS PARA PROJECTOS #############################

  if($user_id != $owner_id)
  {
    $permissionQuery = "SELECT * from tbl_collaborators where user_id = '$user_id' and p_id = '$project_id'";
    $perm = $db_conn->query($permissionQuery) ;
    $perm = $perm->fetch_assoc() ;
  }


  function editProject($user_id,$owner_id,$project_id,$perm)
  {
    if($user_id == $owner_id or $perm['edit_project'] == 1)
    {
      echo "<a href='edit.php?id=$project_id' class=' icon-btn '>
       <i class='fa fa-edit'></i>
       <div> Edit Project  </div>
       </a>";
    }
  }


  function editMap($user_id,$owner_id,$perm)
  {
    if($user_id == $owner_id or $perm['edit_map'] == 1)
    {
     echo "<a href='add_location.php' class=' icon-btn'>
           <i class='fa fa-map-marker'></i>
           <div>Add Location </div>
           </a>" ;
    }
  }


  function addImages($user_id,$owner_id,$perm)
  {
    if($user_id == $owner_id or $perm['add_images'] == 1)
    {
      echo "<a href='image_gallery.php' class=' icon-btn  '>
      <i class='fa fa-image'></i>
      <div> View/Add Images </div>
      </a>";
    }
  }

  function copyProject($user_id,$owner_id,$perm)
  {
    if($user_id == $owner_id or $perm['copy_project'] == 1)
    {
      echo "<a href='copy_project.php' class=' icon-btn '>
       <i class='fa fa-clone'></i>
       <div> Copy Project </div>
      </a>";
    }
  }

  function inviteUsers($user_id,$owner_id,$perm)
  {
    if($user_id == $owner_id or $perm['invite_users'] == 1)
    {
      echo "<a href='#basic' class=' icon-btn' data-toggle='modal' >
        <i class='fa fa-user-plus'></i>
        <div> Invite User </div>
      </a>";
    }

  }

  function changePermissions($user_id,$owner_id,$project_id,$perm)
  {
    if($user_id == $owner_id or $perm['change_permissions'] == 1)
    {
      echo "<a href='projectSettings.php?project=$project_id' class=' icon-btn  '>
        <i class='fa fa-gear'></i>
        <div> Permissions </div>
      </a>";
    }
  }

  function changeStatus($user_id,$owner_id,$perm,$status)
  {
    if($user_id == $owner_id or $perm['change_status_project'] == 1)
    {
      if ($status == 0)
      {
        // echo"<h4 style='margin-bottom:20px;' class= 'subject firecollect sbold '>Status:<p class='text firecollect' style='padding-left:10px;'>private</p></h4>";
        echo "
        <div id= '1' class='status_toggle pull-right'>
        <input type='checkbox' class='make-switch' data-on-text='Public' data-off-text='Private'  data-on-color='success' data-off-color='danger'>
        </div>

        ";
      }
      else
      {
        // echo"<h4 style='margin-bottom:20px;' class= 'subject firecollect sbold '>Status:<p class='text firecollect' style='padding-left:10px;'>public</p></h4>";
        echo "
        <div id='0' class='status_toggle pull-right'>
        <input type='checkbox' checked class='make-switch' data-on-text='Public' data-off-text='Private'  data-on-color='success' data-off-color='danger'>
        </div>
        ";
      }
    }
  }

  function addDatasets($user_id,$owner_id,$project_id,$perm)
  {
    if($user_id == $owner_id or $perm['add_dataset'] == 1)
    {
      echo "<a href='add_data_set.php?id=$project_id' class=' icon-btn '>
            <i class='fa fa-database'></i>
            <div> Add Data Set </div>
            </a>" ;
    }
  }

  function deleteProject($user_id,$owner_id,$project_id,$perm)
  {
    if($user_id == $owner_id)
    {
      echo "<a id='$project_id'  class=' icon-btn delete_project  '>
        <i class='fa fa-trash '></i>
        <div> Delete Project </div>
      </a>";
    }
  }

############ PERMISOS PARA DATASET #############################
function editDataset($user_id,$owner_id,$perm,$data_set_id)
{
  if($perm['edit_dataset'] == 1 or $owner_id == $user_id)
  {
    echo "<a href='edit_data_set.php?id=$data_set_id' class='icon-btn '>
     <i class='fa fa-edit'></i>
     <div> Edit Data Set  </div>

     </a>";
  }
}

function copyDataset($user_id,$owner_id,$perm)
{
  if($perm['copy_dataset'] == 1 or $owner_id == $user_id)
  {
    echo "<a href='copy_data_set.php' class='icon-btn  '>
     <i class='fa fa-clone'></i>
     <div> Copy Data Set </div>
    </a>" ;
  }
}

function deleteDataset($user_id,$owner_id,$perm)
{
  if($perm['delete_dataset'] == 1 or $owner_id == $user_id)
  {
    echo "<a id='$data_set_id' class='icon-btn delete_dataset '>
      <i class='fa fa-trash'></i>
      <div> Delete Data Set </div>
    </a>" ;
  }
}

function changeStatusDataset($user_id,$owner_id,$perm, $status)
{
  if($perm['change_status_dataset'] == 1 or $owner_id == $user_id)
  {
    if ($status==0)
    {
      echo "<div id= '1' class='status_toggle pull-right'>
      <input type='checkbox' class='make-switch' data-on-text='Public' data-off-text='Private'  data-on-color='success' data-off-color='danger'>
      </div>";
    }
    else
    {
      echo "<div id='0' class='status_toggle pull-right'>
      <input type='checkbox' checked class='make-switch' data-on-text='Public' data-off-text='Private'  data-on-color='success' data-off-color='danger'>
      </div> ";
    }
  }
}

function addVariable($user_id,$owner_id,$perm)
{
  if($perm['add_variable'] == 1 or $owner_id == $user_id)
  {
    echo "<a href='add_variable.php' class='icon-btn  '>
      <i class='fa fa-flask'></i>
      <div> Add Variables </div>
    </a>" ;
  }

}

function editVariables($user_id,$owner_id,$perm,$variable_id)
{
  if($perm['edit_variable'] == 1 or $owner_id == $user_id)
  {
    echo "<a href='edit_variable.php?id=$variable_id' class='btn btn-icon-only blue'>
            <i style='font-size:16px;' class='fa fa-pencil'></i>
          </a>";
  }
}

function deleteVariables($user_id,$owner_id,$perm)
{
  if($perm['delete_variable'] == 1 or $owner_id == $user_id)
  {
    echo "<a href='javascript:;' class='btn btn-icon-only red delete_variable'>
            <i style='font-size:16px;' class=' fa fa-trash'></i>
          </a>";
  }
}

function viewDatafiles($user_id,$owner_id,$perm)
{
  if($perm['view_datafile'] == 1 or $owner_id == $user_id)
  {
    echo "<a href='datafiles.php'class='icon-btn '>
      <i class='fa fa-file-o'></i>
      <div> Data Files </div>
    </a>";
  }

}

############ PERMISOS PARA MOVIL #############################
function editProjectMobile($user_id,$owner_id,$project_id,$perm)
{
  if($user_id == $owner_id or $perm['edit_project'] == 1)
  {
    echo "<li>
        <a href='edit.php?id=$project_id'> Edit Project </a>
    </li>";
  }
}


function editMapMobile()
{
  if($user_id == $owner_id or $perm['edit_map'] == 1)
  {
   echo "<li>
       <a href='add_location.php'> Add Location </a>
   </li>" ;
  }
}


function addImagesMobile()
{
  if($user_id == $owner_id or $perm['add_images'] == 1)
  {
    echo "<li>
        <a href='image_gallery.php'> View/Add Images </a>
    </li>";
  }
}

function copyProjectMobile()
{
  if($user_id == $owner_id or $perm['copy_project'] == 1)
  {
    echo "<li>
        <a href='copy_project.php'> Copy Project </a>
    </li>";
  }
}

function inviteUsersMobile()
{
  if($user_id == $owner_id or $perm['invite_users'] == 1)
  {
    echo "<li>
        <a href='#basic' data-toggle='modal'> Invite User </a>
    </li>";
  }

}

function changePermissionsMobile($user_id,$owner_id,$project_id,$perm)
{
  if($user_id == $owner_id or $perm['change_permissions'] == 1)
  {
    echo "<li>
        <a href='projectSettings.php?project=$project_id'> Change Permissions </a>
    </li>";
  }
}

function changeStatusMobile()
{
  if($user_id == $owner_id or $perm['change_status_project'] == 1)
  {}
}

function addDatasetsMobile($user_id,$owner_id,$project_id,$perm)
{
  if($user_id == $owner_id or $perm['add_dataset'] == 1)
  {
    echo "<li>
        <a href='add_data_set.php?id=$project_id'> Add Data Set </a>
    </li>" ;
  }
}

function deleteProjectMobile($user_id,$owner_id,$project_id,$perm)
{
  if($user_id == $owner_id)
  {
    echo "<li>
        <a id='$project_id' href=''javascript:;'' class='delete_project'> Delete Project </a>
    </li>";
  }
}



 ?>
