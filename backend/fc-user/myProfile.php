<?php
  require '../includes/dbConnect.php';
  include '../includes/topMenu.php';
  include '../includes/sideBar.php';

  $U = $_SESSION['user_id'];
  $Q = "SELECT * from tbl_user_info where u_id = '$U'";
  $info = $db_conn->query($Q) ;

  if($info->num_rows > 0)
  {
    $info = $info->fetch_assoc() ;
  }

?>





            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                  <div class="row">
                      <div class="col-md-12">
                          <!-- BEGIN PROFILE SIDEBAR -->
                          <div class="profile-sidebar">
                              <!-- PORTLET MAIN -->
                              <div class="portlet light profile-sidebar-portlet ">
                                  <!-- SIDEBAR USERPIC -->
                                  <div class="profile-userpic">
                                      <img src='<?="uploads/userImages/".$info['image_path']?>' class="img-responsive" alt=""> </div>
                                  <!-- END SIDEBAR USERPIC -->
                                  <!-- SIDEBAR USER TITLE -->
                                  <div class="profile-usertitle">
                                      <div class="profile-usertitle-name">
                                        <?php
                                          if(isset($info['f_name']) and isset($info['l_name']))
                                          {
                                            echo $info['f_name']." ".$info['l_name'] ;
                                          }

                                          else
                                          {
                                            echo $_SESSION['user_data'][0] ;
                                          }
                                        ?>
                                        </div>
                                        <!-- <div class="profile-usertitle-job"> Developer </div> -->
                                  </div>
                                  <!-- END SIDEBAR USER TITLE -->
                                  <!-- SIDEBAR BUTTONS -->

                                  <div class="profile-userbuttons">
                                      <a type="button" data-toggle="modal" class="btn btn-circle btn-sm" href="#basic">Change Photo</a>

                                  </div>

                                  <!-- Photo Modal -->
                                  <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
                                      <div class="modal-dialog">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                  <h4 class="modal-title">Profile Picture Upload</h4>
                                              </div>
                                              <div class="modal-body">
                                                <form method="post" action="includes/saveUserImage.php" class="form-horizontal form-bordered" enctype="multipart/form-data">
                                                    <div class="form-body">
                                                      <div class="form-group last">
                                                          <div class="col-md-9">
                                                            <?php if(isset($info['image_path'])): ?>
                                                              <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                  <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                      <img src=<?php echo "img/".$info["image_path"] ;  ?> alt="" /> </div>
                                                                  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>

                                                                  <div>
                                                                      <span class="btn default btn-file">
                                                                          <span class="fileinput-new"> Select image </span>
                                                                          <span class="fileinput-exists"> Change </span>
                                                                          <input type="file" name="user_image"> </span>
                                                                      <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                                  </div>
                                                              </div>
                                                            <?php else: ?>
                                                              <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                  <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                      <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
                                                                  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>

                                                                  <div>
                                                                      <span class="btn default btn-file">
                                                                          <span class="fileinput-new"> Select image </span>
                                                                          <span class="fileinput-exists"> Change </span>
                                                                          <input type="file" name="user_image"> </span>
                                                                      <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                                  </div>
                                                              </div>
                                                            <?php endif ?>
                                                              <div class="clearfix margin-top-10"></div>
                                                          </div>
                                                      </div>
                                                    </div>


                                              </div>
                                              <div class="modal-footer">
                                                  <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                                  <button type="submit" name="save_image" class="btn green">Save changes</button>
                                              </div>
                                              </form>
                                          </div>
                                          <!-- /.modal-content -->
                                      </div>
                                      <!-- /.modal-dialog -->
                                  </div>
                                  <!-- END SIDEBAR BUTTONS -->
                                  <!-- SIDEBAR MENU -->
                                  <div class="profile-usermenu">
                                    <!-- <ul class="nav">
                                        <li>
                                            <a href="page_user_profile_1.html">
                                                <i class="icon-home"></i> Overview </a>
                                        </li>
                                        <li class="active">
                                            <a href="page_user_profile_1_account.html">
                                                <i class="icon-settings"></i> Account Settings </a>
                                        </li>
                                        <li>
                                            <a href="page_user_profile_1_help.html">
                                                <i class="icon-info"></i> Help </a>
                                        </li>
                                    </ul> -->
                                  </div>
                                  <!-- END MENU -->
                              </div>
                              <!-- END PORTLET MAIN -->
                              <div class="portlet light ">
                                  <!-- STAT -->
                                  <?php
                                    $numP = "SELECT count(*) from tbl_projects where u_id = '$U'" ;
                                    $numP = $db_conn->query($numP) ;
                                    $numP =  $numP->fetch_assoc() ;

                                  ?>
                                  <div class="row list-separated profile-stat">
                                      <div class="col-md-6 col-sm-6 col-xs-6">
                                          <div class="uppercase profile-stat-title"> <?php echo $numP['count(*)'] ;  ?> </div>
                                          <div class="uppercase profile-stat-text"> Project(s) </div>
                                      </div>
                                      <div class="col-md-6 col-sm-6 col-xs-6">
                                          <div class="uppercase profile-stat-title"> 0 </div>
                                          <div class="uppercase profile-stat-text"> Publications </div>
                                      </div>
                                  </div>
                                  <!-- END STAT -->
                                  <div>
                                      <h4 class="profile-desc-title">
                                        <?php

                                          if(isset($info['pos_id']))
                                          {
                                            $pos = $info['pos_id'] ;
                                            $getPos = "SELECT * from tbl_position where pos_id = $pos" ;
                                            $posName = $db_conn->query($getPos) ;
                                            $posRow = $posName->fetch_assoc() ;
                                            echo $posRow['position'] ;
                                          }

                                          else
                                          {
                                            echo "Not Specified" ;
                                          }


                                        ?>
                                      </h4>
                                      <span class="profile-desc-text">
                                        <?php
                                          if(isset($info['description']))
                                          {
                                            echo $info['description'] ;

                                          }

                                          else
                                          {
                                            echo "Not Specified" ;
                                          }
                                        ?>

                                      </span>

                                  </div>
                              </div>
                              <!-- END PORTLET MAIN -->
                          </div>

                          <!-- BEGIN PROFILE CONTENT -->
                          <div class="profile-content">
                              <div class="row">
                                  <div class="col-md-12">
                                      <div class="portlet light">
                                          <div class="portlet-title">
                                              <div class="caption caption-md">
                                                  <i class="icon-globe theme-font hide"></i>
                                                  <span class="title firecollect" >Profile Information </span>
                                              </div>

                                          </div>
                                      <div class="portlet-body form">
                                          <div class="form-body">


                                                    <div class="form-group form-md-line-input">
                                                        <div class="form-control form-control-static text firecollect"> <?php echo $_SESSION['user_data'][0] ; ?> </div>
                                                        <label class="subject firecollect" for="form_control_1">Account Email</label>
                                                    </div>

                                                    <div class="form-group form-md-line-input">
                                                        <div class="form-control form-control-static text firecollect">
                                                          <?php
                                                            if(isset($info['institution_id']))
                                                            {
                                                              $in = $info['institution_id'] ;
                                                              $getInst = "SELECT * from tbl_institution where inst_id = $in" ;
                                                              $inName = $db_conn->query($getInst) ;
                                                              $inRow = $inName->fetch_assoc() ;
                                                              echo $inRow['inst_name'] ;
                                                            }

                                                            else
                                                            {
                                                              echo "N/A" ;
                                                            }
                                                          ?>
                                                          </div>
                                                        <label  class="subject firecollect" for="form_control_1">Institution</label>
                                                    </div>
                                                    <div class="form-group form-md-line-input">
                                                        <div class="form-control form-control-static text firecollect">
                                                          <?php
                                                            if(isset($info['phone_number']))
                                                            {
                                                              echo $info['phone_number'] ;
                                                            }

                                                            else
                                                            {
                                                              echo "N/A" ;
                                                            }
                                                          ?>
                                                        </div>
                                                        <label class="subject firecollect" for="form_control_1">Phone</label>
                                                    </div>


                                                    <a class="btn firecollect" data-toggle="modal" href='#large'>Edit</a>

                                                    <div class="modal fade bs-modal-lg" id="large" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                    <h4 class="modal-title">Edit User Information</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                  <form role="form" method="POST" action="includes/saveUserInfo.php">
                                                                    <!-- First Name -->
                                                                    <div class="form-body">

                                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                                        <?php
                                                                          if(isset($info['f_name']))
                                                                          {
                                                                            echo "<input type='text' value=".$info['f_name']." class='form-control' id='form_control_1' name='fname'>" ;
                                                                          }

                                                                          else
                                                                          {
                                                                            echo "<input type='text' class='form-control' id='form_control_1' name='fname'>" ;

                                                                          }
                                                                        ?>
                                                                        <label for="form_control_1">First Name</label>
                                                                        <span class="help-block">Some help goes here...</span>
                                                                    </div>

                                                                    <!-- Last Name -->
                                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                                        <?php
                                                                          if(isset($info['l_name']))
                                                                          {
                                                                            echo "<input type='text' value=".$info['l_name']." class='form-control' id='form_control_1' name='lname'>" ;
                                                                          }

                                                                          else
                                                                          {
                                                                            echo "<input type='text' class='form-control' id='form_control_1' name='lname'>" ;
                                                                          }
                                                                        ?>
                                                                        <label for="form_control_1">Last Name</label>
                                                                        <span class="help-block">Some help goes here...</span>
                                                                    </div>

                                                                    <div class="form-group form-md-radios">
                                                                        <label>Gender</label>
                                                                        <div class="md-radio-list">
                                                                          <?php
                                                                            if(isset($info['gender']))
                                                                            {
                                                                              if($info['gender'] == 1 )
                                                                              {
                                                                                echo "<div class='md-radio'>
                                                                                    <input type='radio' id='radio1' name='gender' class='md-radiobtn' value='1' checked>
                                                                                    <label for='radio1'>
                                                                                        <span></span>
                                                                                        <span class='check'></span>
                                                                                        <span class='box'></span> Male </label>
                                                                                </div>
                                                                                <div class='md-radio'>
                                                                                    <input type='radio' id='radio2' name='gender' class='md-radiobtn' value='2'>
                                                                                    <label for='radio2'>
                                                                                        <span></span>
                                                                                        <span class='check'></span>
                                                                                        <span class='box'></span> Female </label>
                                                                                </div>" ;
                                                                              }

                                                                              elseif ($info['gender'] == 2)
                                                                              {
                                                                                echo "<div class='md-radio'>
                                                                                    <input type='radio' id='radio1' name='gender' class='md-radiobtn' value='1'>
                                                                                    <label for='radio1'>
                                                                                        <span></span>
                                                                                        <span class='check'></span>
                                                                                        <span class='box'></span> Male </label>
                                                                                </div>
                                                                                <div class='md-radio'>
                                                                                    <input type='radio' id='radio2' name='gender' class='md-radiobtn' value='2' checked>
                                                                                    <label for='radio2'>
                                                                                        <span></span>
                                                                                        <span class='check'></span>
                                                                                        <span class='box'></span> Female </label>
                                                                                </div>" ;
                                                                              }
                                                                            }
                                                                            else
                                                                            {
                                                                              echo "<div class='md-radio'>
                                                                                  <input type='radio' id='radio1' name='gender' class='md-radiobtn' value='1'>
                                                                                  <label for='radio1'>
                                                                                      <span></span>
                                                                                      <span class='check'></span>
                                                                                      <span class='box'></span> Male </label>
                                                                              </div>
                                                                              <div class='md-radio'>
                                                                                  <input type='radio' id='radio2' name='gender' class='md-radiobtn' value='2'>
                                                                                  <label for='radio2'>
                                                                                      <span></span>
                                                                                      <span class='check'></span>
                                                                                      <span class='box'></span> Female </label>
                                                                              </div>" ;
                                                                            }



                                                                          ?>
                                                                        </div>
                                                                    </div>


                                                                    <!-- Institution -->
                                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                                        <select class="form-control edited" id="form_control_1" name="inst">
                                                                          <?php
                                                                            if(isset($info['institution_id']))
                                                                            {
                                                                              $i = $info['institution_id'] ;
                                                                              $instQuery1 = "SELECT * FROM tbl_institution where inst_id = $i" ;
                                                                              $instQuery2 = "SELECT * FROM tbl_institution where inst_id != $i" ;
                                                                              $inst1 = $db_conn->query($instQuery1) ;
                                                                              $inst2 = $db_conn->query($instQuery2) ;

                                                                              $row1 = $inst1->fetch_assoc() ;


                                                                              echo "<option value=".$row1['inst_id'].">".$row1['inst_name']."</option>" ;
                                                                              echo "<option>Not Specified</option>" ;

                                                                              while ($row2 = $inst2->fetch_assoc())
                                                                              {
                                                                                echo "<option value=".$row['inst_id'].">".$row['inst_name']."</option>" ;

                                                                              }


                                                                            }

                                                                            else
                                                                            {
                                                                              $instQuery = "SELECT * FROM tbl_institution" ;
                                                                              $inst = $db_conn->query($instQuery) ;

                                                                              echo "<option>Not Specified</option>" ;

                                                                              while($row = $inst->fetch_assoc())
                                                                              {
                                                                                echo "<option value=".$row['inst_id'].">".$row['inst_name']."</option>" ;
                                                                              }
                                                                            }


                                                                           ?>
                                                                        </select>
                                                                        <label for="form_control_1">Institution</label>
                                                                    </div>

                                                                    <!--  -->
                                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                                        <select class="form-control edited" id="form_control_1" name="pos">
                                                                          <?php
                                                                            if(isset($info['pos_id']))
                                                                            {
                                                                              $i = $info['pos_id'] ;
                                                                              $posQuery1 = "SELECT * FROM tbl_position where pos_id = $i" ;
                                                                              $posQuery2 = "SELECT * FROM tbl_position where pos_id != $i" ;
                                                                              $pos1 = $db_conn->query($posQuery1) ;
                                                                              $pos2 = $db_conn->query($posQuery2) ;

                                                                              $row1 = $pos1->fetch_assoc() ;


                                                                              echo "<option value=".$row1['pos_id'].">".$row1['position']."</option>" ;
                                                                              echo "<option>Not Specified</option>" ;

                                                                              while ($row2 = $pos2->fetch_assoc())
                                                                              {
                                                                                echo "<option value=".$row['pos_id'].">".$row['position']."</option>" ;
                                                                              }


                                                                            }

                                                                            else
                                                                            {
                                                                              $posQuery = "SELECT * FROM tbl_position" ;
                                                                              $pos = $db_conn->query($posQuery) ;

                                                                              echo "<option>Not Specified</option>" ;

                                                                              while($row = $pos->fetch_assoc())
                                                                              {
                                                                                echo "<option value=".$row['pos_id'].">".$row['position']."</option>" ;
                                                                              }
                                                                            }


                                                                           ?>
                                                                        </select>
                                                                        <label for="form_control_1">Position</label>
                                                                    </div>
                                                                    <?php if(isset($info['description'])): ?>
                                                                      <div class="form-group form-md-line-input form-md-floating-label">
                                                                          <textarea class="form-control" rows="3" name="desc"><?php echo $info['description'] ;?></textarea>
                                                                          <label for="form_control_1">Occupation Description</label>
                                                                      </div>
                                                                    <?php else: ?>
                                                                      <div class="form-group form-md-line-input form-md-floating-label">
                                                                          <textarea class="form-control" rows="3" name="desc"></textarea>
                                                                          <label for="form_control_1">Occupation Description</label>
                                                                      </div>
                                                                    <?php endif ?>

                                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                                        <?php
                                                                          if(isset($info['phone_number']))
                                                                          {
                                                                            echo "<input type='text' value=".$info['phone_number']." class='form-control' id='form_control_1' name='phone'>" ;
                                                                          }

                                                                          else
                                                                          {
                                                                            echo "<input type='text' class='form-control' id='form_control_1' name='phone'>" ;

                                                                          }
                                                                        ?>
                                                                        <label for="form_control_1">Phone</label>
                                                                        <span class="help-block">Some help goes here...</span>
                                                                    </div>

                                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                                        <select class="form-control edited" id="form_control_country" name="country">
                                                                          <?php
                                                                            if(isset($info['country']))
                                                                            {
                                                                              echo "<option value='PR'>Puerto Rico</option>
                                                                              <option value=''>Not Specified</option>";
                                                                            }

                                                                            else
                                                                            {
                                                                              echo "<option value=''>Not Specified</option>
                                                                              <option value='PR'>Puerto Rico</option>" ;

                                                                            }


                                                                           ?>
                                                                          <!-- <option value="AF">Afghanistan</option>
                                                                          <option value="AL">Albania</option>
                                                                          <option value="DZ">Algeria</option>
                                                                          <option value="AS">American Samoa</option>
                                                                          <option value="AD">Andorra</option>
                                                                          <option value="AO">Angola</option>
                                                                          <option value="AI">Anguilla</option>
                                                                          <option value="AR">Argentina</option>
                                                                          <option value="AM">Armenia</option>
                                                                          <option value="AW">Aruba</option>
                                                                          <option value="AU">Australia</option>
                                                                          <option value="AT">Austria</option>
                                                                          <option value="AZ">Azerbaijan</option>
                                                                          <option value="BS">Bahamas</option>
                                                                          <option value="BH">Bahrain</option>
                                                                          <option value="BD">Bangladesh</option>
                                                                          <option value="BB">Barbados</option>
                                                                          <option value="BY">Belarus</option>
                                                                          <option value="BE">Belgium</option>
                                                                          <option value="BZ">Belize</option>
                                                                          <option value="BJ">Benin</option>
                                                                          <option value="BM">Bermuda</option>
                                                                          <option value="BT">Bhutan</option>
                                                                          <option value="BO">Bolivia</option>
                                                                          <option value="BA">Bosnia and Herzegowina</option>
                                                                          <option value="BW">Botswana</option>
                                                                          <option value="BV">Bouvet Island</option>
                                                                          <option value="BR">Brazil</option>
                                                                          <option value="IO">British Indian Ocean Territory</option>
                                                                          <option value="BN">Brunei Darussalam</option>
                                                                          <option value="BG">Bulgaria</option>
                                                                          <option value="BF">Burkina Faso</option>
                                                                          <option value="BI">Burundi</option>
                                                                          <option value="KH">Cambodia</option>
                                                                          <option value="CM">Cameroon</option>
                                                                          <option value="CA">Canada</option>
                                                                          <option value="CV">Cape Verde</option>
                                                                          <option value="KY">Cayman Islands</option>
                                                                          <option value="CF">Central African Republic</option>
                                                                          <option value="TD">Chad</option>
                                                                          <option value="CL">Chile</option>
                                                                          <option value="CN">China</option>
                                                                          <option value="CX">Christmas Island</option>
                                                                          <option value="CC">Cocos (Keeling) Islands</option>
                                                                          <option value="CO">Colombia</option>
                                                                          <option value="KM">Comoros</option>
                                                                          <option value="CG">Congo</option>
                                                                          <option value="CD">Congo, the Democratic Republic of the</option>
                                                                          <option value="CK">Cook Islands</option>
                                                                          <option value="CR">Costa Rica</option>
                                                                          <option value="CI">Cote d'Ivoire</option>
                                                                          <option value="HR">Croatia (Hrvatska)</option>
                                                                          <option value="CU">Cuba</option>
                                                                          <option value="CY">Cyprus</option>
                                                                          <option value="CZ">Czech Republic</option>
                                                                          <option value="DK">Denmark</option>
                                                                          <option value="DJ">Djibouti</option>
                                                                          <option value="DM">Dominica</option>
                                                                          <option value="DO">Dominican Republic</option>
                                                                          <option value="EC">Ecuador</option>
                                                                          <option value="EG">Egypt</option>
                                                                          <option value="SV">El Salvador</option>
                                                                          <option value="GQ">Equatorial Guinea</option>
                                                                          <option value="ER">Eritrea</option>
                                                                          <option value="EE">Estonia</option>
                                                                          <option value="ET">Ethiopia</option>
                                                                          <option value="FK">Falkland Islands (Malvinas)</option>
                                                                          <option value="FO">Faroe Islands</option>
                                                                          <option value="FJ">Fiji</option>
                                                                          <option value="FI">Finland</option>
                                                                          <option value="FR">France</option>
                                                                          <option value="GF">French Guiana</option>
                                                                          <option value="PF">French Polynesia</option>
                                                                          <option value="TF">French Southern Territories</option>
                                                                          <option value="GA">Gabon</option>
                                                                          <option value="GM">Gambia</option>
                                                                          <option value="GE">Georgia</option>
                                                                          <option value="DE">Germany</option>
                                                                          <option value="GH">Ghana</option>
                                                                          <option value="GI">Gibraltar</option>
                                                                          <option value="GR">Greece</option>
                                                                          <option value="GL">Greenland</option>
                                                                          <option value="GD">Grenada</option>
                                                                          <option value="GP">Guadeloupe</option>
                                                                          <option value="GU">Guam</option>
                                                                          <option value="GT">Guatemala</option>
                                                                          <option value="GN">Guinea</option>
                                                                          <option value="GW">Guinea-Bissau</option>
                                                                          <option value="GY">Guyana</option>
                                                                          <option value="HT">Haiti</option>
                                                                          <option value="HM">Heard and Mc Donald Islands</option>
                                                                          <option value="VA">Holy See (Vatican City State)</option>
                                                                          <option value="HN">Honduras</option>
                                                                          <option value="HK">Hong Kong</option>
                                                                          <option value="HU">Hungary</option>
                                                                          <option value="IS">Iceland</option>
                                                                          <option value="IN">India</option>
                                                                          <option value="ID">Indonesia</option>
                                                                          <option value="IR">Iran (Islamic Republic of)</option>
                                                                          <option value="IQ">Iraq</option>
                                                                          <option value="IE">Ireland</option>
                                                                          <option value="IL">Israel</option>
                                                                          <option value="IT">Italy</option>
                                                                          <option value="JM">Jamaica</option>
                                                                          <option value="JP">Japan</option>
                                                                          <option value="JO">Jordan</option>
                                                                          <option value="KZ">Kazakhstan</option>
                                                                          <option value="KE">Kenya</option>
                                                                          <option value="KI">Kiribati</option>
                                                                          <option value="KP">Korea, Democratic People's Republic of</option>
                                                                          <option value="KR">Korea, Republic of</option>
                                                                           <option value="KW">Kuwait</option>
                                                                          <option value="KG">Kyrgyzstan</option>
                                                                          <option value="LA">Lao People's Democratic Republic</option>
                                                                          <option value="LV">Latvia</option>
                                                                          <option value="LB">Lebanon</option>
                                                                          <option value="LS">Lesotho</option>
                                                                          <option value="LR">Liberia</option>
                                                                          <option value="LY">Libyan Arab Jamahiriya</option>
                                                                          <option value="LI">Liechtenstein</option>
                                                                          <option value="LT">Lithuania</option>
                                                                          <option value="LU">Luxembourg</option>
                                                                          <option value="MO">Macau</option>
                                                                          <option value="MK">Macedonia, The Former Yugoslav Republic of</option>
                                                                          <option value="MG">Madagascar</option>
                                                                          <option value="MW">Malawi</option>
                                                                          <option value="MY">Malaysia</option>
                                                                          <option value="MV">Maldives</option>
                                                                          <option value="ML">Mali</option>
                                                                          <option value="MT">Malta</option>
                                                                          <option value="MH">Marshall Islands</option>
                                                                          <option value="MQ">Martinique</option>
                                                                          <option value="MR">Mauritania</option>
                                                                          <option value="MU">Mauritius</option>
                                                                          <option value="YT">Mayotte</option>
                                                                          <option value="MX">Mexico</option>
                                                                          <option value="FM">Micronesia, Federated States of</option>
                                                                          <option value="MD">Moldova, Republic of</option>
                                                                          <option value="MC">Monaco</option>
                                                                          <option value="MN">Mongolia</option>
                                                                          <option value="MS">Montserrat</option>
                                                                          <option value="MA">Morocco</option>
                                                                          <option value="MZ">Mozambique</option>
                                                                          <option value="MM">Myanmar</option>
                                                                          <option value="NA">Namibia</option>
                                                                          <option value="NR">Nauru</option>
                                                                          <option value="NP">Nepal</option>
                                                                          <option value="NL">Netherlands</option>
                                                                          <option value="AN">Netherlands Antilles</option>
                                                                          <option value="NC">New Caledonia</option>
                                                                          <option value="NZ">New Zealand</option>
                                                                          <option value="NI">Nicaragua</option>
                                                                          <option value="NE">Niger</option>
                                                                          <option value="NG">Nigeria</option>
                                                                          <option value="NU">Niue</option>
                                                                          <option value="NF">Norfolk Island</option>
                                                                          <option value="MP">Northern Mariana Islands</option>
                                                                          <option value="NO">Norway</option>
                                                                          <option value="OM">Oman</option>
                                                                          <option value="PK">Pakistan</option>
                                                                          <option value="PW">Palau</option>
                                                                          <option value="PA">Panama</option>
                                                                          <option value="PG">Papua New Guinea</option>
                                                                          <option value="PY">Paraguay</option>
                                                                          <option value="PE">Peru</option>
                                                                          <option value="PH">Philippines</option>
                                                                          <option value="PN">Pitcairn</option>
                                                                          <option value="PL">Poland</option>
                                                                          <option value="PT">Portugal</option>
                                                                          <option value="QA">Qatar</option>
                                                                          <option value="RE">Reunion</option>
                                                                          <option value="RO">Romania</option>
                                                                          <option value="RU">Russian Federation</option>
                                                                          <option value="RW">Rwanda</option>
                                                                          <option value="KN">Saint Kitts and Nevis</option>
                                                                          <option value="LC">Saint LUCIA</option>
                                                                          <option value="VC">Saint Vincent and the Grenadines</option>
                                                                          <option value="WS">Samoa</option>
                                                                          <option value="SM">San Marino</option>
                                                                          <option value="ST">Sao Tome and Principe</option>
                                                                          <option value="SA">Saudi Arabia</option>
                                                                          <option value="SN">Senegal</option>
                                                                          <option value="SC">Seychelles</option>
                                                                          <option value="SL">Sierra Leone</option>
                                                                          <option value="SG">Singapore</option>
                                                                          <option value="SK">Slovakia (Slovak Republic)</option>
                                                                          <option value="SI">Slovenia</option>
                                                                          <option value="SB">Solomon Islands</option>
                                                                          <option value="SO">Somalia</option>
                                                                          <option value="ZA">South Africa</option>
                                                                          <option value="GS">South Georgia and the South Sandwich Islands</option>
                                                                          <option value="ES">Spain</option>
                                                                          <option value="LK">Sri Lanka</option>
                                                                          <option value="SH">St. Helena</option>
                                                                          <option value="PM">St. Pierre and Miquelon</option>
                                                                          <option value="SD">Sudan</option>
                                                                          <option value="SR">Suriname</option>
                                                                          <option value="SJ">Svalbard and Jan Mayen Islands</option>
                                                                          <option value="SZ">Swaziland</option>
                                                                          <option value="SE">Sweden</option>
                                                                          <option value="CH">Switzerland</option>
                                                                          <option value="SY">Syrian Arab Republic</option>
                                                                          <option value="TW">Taiwan, Province of China</option>
                                                                          <option value="TJ">Tajikistan</option>
                                                                          <option value="TZ">Tanzania, United Republic of</option>
                                                                          <option value="TH">Thailand</option>
                                                                          <option value="TG">Togo</option>
                                                                          <option value="TK">Tokelau</option>
                                                                          <option value="TO">Tonga</option>
                                                                          <option value="TT">Trinidad and Tobago</option>
                                                                          <option value="TN">Tunisia</option>
                                                                          <option value="TR">Turkey</option>
                                                                          <option value="TM">Turkmenistan</option>
                                                                          <option value="TC">Turks and Caicos Islands</option>
                                                                          <option value="TV">Tuvalu</option>
                                                                          <option value="UG">Uganda</option>
                                                                          <option value="UA">Ukraine</option>
                                                                          <option value="AE">United Arab Emirates</option>
                                                                          <option value="GB">United Kingdom</option>
                                                                          <option value="US">United States</option>
                                                                          <option value="UM">United States Minor Outlying Islands</option>
                                                                          <option value="UY">Uruguay</option>
                                                                          <option value="UZ">Uzbekistan</option>
                                                                          <option value="VU">Vanuatu</option>
                                                                          <option value="VE">Venezuela</option>
                                                                          <option value="VN">Viet Nam</option>
                                                                          <option value="VG">Virgin Islands (British)</option>
                                                                          <option value="VI">Virgin Islands (U.S.)</option>
                                                                          <option value="WF">Wallis and Futuna Islands</option>
                                                                          <option value="EH">Western Sahara</option>
                                                                          <option value="YE">Yemen</option>
                                                                          <option value="ZM">Zambia</option>
                                                                          <option value="ZW">Zimbabwe</option> -->
                                                                        </select>
                                                                        <label for="form_control_country">Country</label>
                                                                    </div>
                                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                                        <?php if(isset($info['city'])): ?>

                                                                            <input type='text' value='<?=$info['city']?>' class='form-control' id='form_control_city' name='city'>


                                                                          <?php else: ?>

                                                                            <input type='text' class='form-control' id='form_control_city' name='city'>

                                                                          <?php endif ?>


                                                                        <label for="form_control_city">City</label>
                                                                        <span class="help-block">Some help goes here...</span>
                                                                    </div>

                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn green">Save changes</button>
                                                                    </div>
                                                                  </form>

                                                                <!-- <div class="modal-footer">
                                                                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn green">Save changes</button>
                                                                </div> -->
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    <!-- <div class="form-group form-md-line-input">
                                                        <input type="text" class="form-control" id="form_control_1" placeholder="Enter your name">
                                                        <label for="form_control_1">Regular input</label>
                                                        <span class="help-block">Some help goes here...</span>
                                                    </div> -->
                                                </div>

                                              </div>

                                      </div>
                                  </div>




                                <div class="portlet light">
                                  <div class="portlet title">
                                        <div class="caption caption-md">

                                          <span class="title firecollect"> Projects </span>
                                        </div>

                                  </div>
                                      <div class="portlet-body">


                                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                                              <thead>
                                                <tr>
                                                  <th style="text-align: center;"> Title </th>
                                                  <th style="text-align: center;"> Period </th>

                                                  <th style="text-align: center;"> Status </th>

                                                </tr>
                                              </thead>
                                              <tbody>

                                                <?php
                                                  $query= "SELECT * FROM tbl_projects where u_id='$U' and deleted = 0";

                                                  $result = $db_conn->query($query);

                                                    while ($r = $result->fetch_assoc() ) {
                                                                                # code...
                                                      $project_id = $r['id'];
                                                      $title= $r['title'];
                                                      $period= $r['period'];

                                                      $status= (int)$r['status'];

                                                      if ($status == 0 ){
                                                      echo "
                                                          <tr class='clickable-row' data-href='../fc-projects/user_project.php?id=$project_id'>
                                                          <td><a href='../fc-projects/user_project.php?id=$project_id'> $title</a> </td>
                                                          <td style='text-align: center;'> $period </td>

                                                          <td style='text-align:center;'> <span class='label label-danger' >private </span></td>
                                                          </tr>
                                                          ";}
                                                      else{
                                                            echo "
                                                              <tr class='clickable-row' data-href='../fc-projects/user_project.php?id=$project_id'>
                                                                <td><a href='../fc-projects/user_project.php?id=$project_id'> $title</a> </td>
                                                                <td style='text-align: center;'> $period </td>

                                                                <td style='text-align:center;'><span class='label label-success' >public </span></td>
                                                              </tr>
                                                              ";
                                                          }
                                                      }


                                                    ?>
                                                  </tbody>
                                                </table>
                                              </div>
                                            </div>
                                </div>
                              </div>
                            </div>
                          </div>

                      </div>
                  </div>
                </div>



        <!-- END CONTAINER -->
      <?php
        include '../includes/footer.php' ;
      ?>

      <script>
        var p = "<?php echo $_SESSION['pic_change'] ; ?>" ;
        if( p == "1" )
        {
          swal({
              position: 'top-right',
              type: 'success',
              title: 'Your profile image has been saved',
              showConfirmButton: false,
              timer: 1500
            });

        }

        var i = "<?php echo $_SESSION['info_change'] ; ?>" ;
        if( i == "1" )
        {
          swal({
              type: 'success',
              title: 'Your personal information has been saved',
              showConfirmButton: false,
              timer: 1500
            });
        }


      </script>

      <?php
        unset($_SESSION['pic_change']) ;
        unset($_SESSION['info_change']) ;
       ?>
