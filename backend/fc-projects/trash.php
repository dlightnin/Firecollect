<?php
  require '../includes/dbConnect.php' ;
  include '../includes/topMenu.php';
  include '../includes/sideBar.php';

?>

            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    
                    <h1 class="page-title"> Admin Dashboard 2
                        <small>statistics, charts, recent events and reports</small>
                    </h1>
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="icon-home"></i>
                                <a href="index.html">Home</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <span>Dashboard</span>
                            </li>
                        </ul>
                        <div class="page-toolbar">
                            <div class="btn-group pull-right">
                                <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Actions
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li>
                                        <a href="#">
                                            <i class="icon-bell"></i> Action</a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon-shield"></i> Another action</a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon-user"></i> Something else here</a>
                                    </li>
                                    <li class="divider"> </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon-bag"></i> Separated link</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- END PAGE HEADER-->
                    <!-- BEGIN  PORTLET-->
                    <div class="portlet light portlet-fit ">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <i class="icon-fire font-red"></i>
                                                            <span class="caption-subject font-red sbold uppercase">Projects</span>
                                                        </div>

                                                    </div>
                                                    <div class="portlet-body">
                                                        <div class="table-toolbar">

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="btn-group">
                                                                      <a href="add_project.php" >
                                                                        <button  class="btn "   style="background-color:#FFA500; color: white;"> Add Project
                                                                            <i class="fa fa-plus"></i>
                                                                        </button>
                                                                      </a>
                                                                    </div>
                                                                </div>


                                                              <!-- modal begin -->
                                                              <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
                                                                                                  <div class="modal-dialog">
                                                                                                      <div class="modal-content">
                                                                                                          <div class="modal-header">
                                                                                                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                                                              <h4 class="modal-title">Add project</h4>
                                                                                                          </div>
                                                                                                          <div class="modal-body">

                                                                                                            <!--BEGIN FORMS  -->
                                                                                                            <div class="portlet-body form">
                                                                                                              <form role="form">
                                                                                                                <div class="form-body">


                                                                                                                  <div class="form-group form-md-line-input">
                                                                                                                       <input style="color:orange;" type="text" class="form-control" id="form_control_1" placeholder="Project title goes here...">
                                                                                                                       <label for="form_control_1">Project Title</label>
                                                                                                                       <span class="help-block">Some help goes here...</span>
                                                                                                                   </div>
                                                                                                                  <div class="form-group " style="margin-bottom: 10px; ">
                                                                                                                        <label for:'projectTitle'>Short Name: </label>
                                                                                                                        <div class="input-group">

                                                                                                                            <input id='projectTitle' type="text" class="form-control" placeholder="Short name" > </div>
                                                                                                                            <p class="help-block" style='font-size:12px;'> Write a short name that identify this project. Can be an initial or pseudonym.</p>
                                                                                                                      </div>

                                                                                                                      <div class="form-group">
                                                                                                                          <label>Description</label>
                                                                                                                          <textarea class="form-control" rows="3" placeholder="Description"></textarea>
                                                                                                                          <p class="help-block" style='font-size:12px;'>Write a description in detail about this Project.</p>
                                                                                                                      </div>














                                                                                                                </div>
                                                                                                              </form>
                                                                                                            </div>
                                                                                                            <!--FORMS END  -->






                                                                                                             Modal body goes here </div>

                                                                                                          <div class="modal-footer">
                                                                                                              <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                                                                                              <button type="button" class="btn green">Save changes</button>
                                                                                                          </div>
                                                                                                      </div>
                                                                                                      <!-- /.modal-content -->
                                                                                                  </div>
                                                                                                  <!-- /.modal-dialog -->
                                                                                              </div>
                                                              <!--modal end  -->



                                                            </div>
                                                        </div>
                                                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                                                            <thead>
                                                                <tr>
                                                                    <th> Title </th>
                                                                    <th> Deletion Date </th>
                                                                    <th> Destroy Date </th>
                                                                    <th> Action </th>
                                                                    <th> Edit </th>
                                                                    <th> Delete </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td><span class="icon-share"></span> Zitemon </td>
                                                                    <td>  </td>
                                                                    <td> 1234 </td>
                                                                    <td  style="text-align:center;" class="center"> <span  style="color:green;font-size: 20px; " class="icon-check"></span> </td>
                                                                    <td>
                                                                        <a class="edit" href="javascript:;"> Edit </a>
                                                                    </td>
                                                                    <td>
                                                                        <a class="delete" href="javascript:;"> Delete </a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td> lisa </td>
                                                                    <td> Lisa Wong </td>
                                                                    <td> 434 </td>
                                                                    <td style="text-align:center;"> <span  style="color:red;font-size: 20px; align: center;" class="icon-close" ></span></td>
                                                                    <td>
                                                                        <a class="edit" href="javascript:;"> Edit </a>
                                                                    </td>
                                                                    <td>
                                                                        <a class="delete" href="javascript:;"> Delete </a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td> nick12 </td>
                                                                    <td> Nick Roberts </td>
                                                                    <td> 232 </td>
                                                                    <td  style="text-align:center;" class="center"> <span  style="color:green;font-size: 20px; text-align: center;" class="icon-check"></span>  </td>
                                                                    <td>
                                                                        <a class="edit" href="javascript:;"> Edit </a>
                                                                    </td>
                                                                    <td>
                                                                        <a class="delete" href="javascript:;"> Delete </a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td> goldweb </td>
                                                                    <td> Sergio Jackson </td>
                                                                    <td> 132 </td>
                                                                    <td class="center"  style="text-align:center;"> <span  style="color:green;font-size: 20px; text-align: center;" class="icon-check"></span> </td>
                                                                    <td>
                                                                        <a class="edit" href="javascript:;"> Edit </a>
                                                                    </td>
                                                                    <td>
                                                                        <a class="delete" href="javascript:;"> Delete </a>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td> webriver </td>
                                                                    <td> Antonio Sanches </td>
                                                                    <td> 462 </td>
                                                                    <td class="center"> new user </td>
                                                                    <td>
                                                                        <a class="edit" href="javascript:;"> Edit </a>
                                                                    </td>
                                                                    <td>
                                                                        <a class="delete" href="javascript:;"> Delete </a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td> gist124 </td>
                                                                    <td> Nick Roberts </td>
                                                                    <td> 62 </td>
                                                                    <td  style="text-align:center;" class="center">  <span  style="color:red;font-size: 20px; text-align: center;" class="icon-close" ></span> </td>
                                                                    <td>
                                                                        <a class="edit" href="javascript:;"> Edit </a>
                                                                    </td>
                                                                    <td>
                                                                        <a class="delete" href="javascript:;"> Delete </a>
                                                                    </td>
                                                                </tr>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                    <!-- END PORTLET -->

                                </div>
                            </div>
                        </div>
                        <!-- END CONTENT BODY -->
                    </div>
                    <!-- END CONTENT -->



                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->

        </div>
        <!-- END CONTAINER -->
      <?php
        include '../includes/footer.php' ;
      ?>
