<?php
  $shareQuery = "SELECT * from tbl_user_info where u_id != '$user_id' and f_name != 'NULL' and l_name != 'NULL' and country != 'NULL' and city != 'NULL' and institution_id != 'NULL' " ;
  $res = $db_conn->query($shareQuery) ;

?>


<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                              <h4 class="title firecollect">Invite Collaborators</h4>
                            </div>
                            <div class="modal-body">

                                              <!--BEGIN FORMS  -->
                              <div class="portlet-body form">
                                <form role="form" method="post" action="includes/inviteUser.php">
                                  <?php
                                    echo "<input value=$project_id id = 'p_id' name='p_id' style='display:none;' />" ;

                                   ?>
                                  <div class="form-group">

                                      <div class="input-group select2-bootstrap-append">
                                          <select name="users[]" id="multi-append" class="form-control select2" placeholder="Select Users" multiple>
                                              <?php
                                                while ($row = $res->fetch_assoc()) {
                                                  echo "<option value=".$row['u_id'].">
                                                        ".$row['f_name']." ".$row['l_name']."
                                                        </option>";
                                                }
                                               ?>
                                          </select>
                                          <span class="input-group-btn">
                                              <button class="btn btn-default" type="button" data-select2-open="multi-append">
                                                  <span class="glyphicon glyphicon-search"></span>
                                              </button>
                                          </span>
                                      </div>
                                  </div>


                                  <div class="modal-footer">
                                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn firecollect">Invite</button>
                                  </div>
                                </form>
                              </div>
                            </div>




                      </div>
                                        <!-- /.modal-content -->
                </div>
                                    <!-- /.modal-dialog -->
            </div> <!-- END MODAL -->
