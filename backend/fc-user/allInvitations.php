<?php
  require '../includes/dbConnect.php' ;
  include '../includes/topMenu.php' ;
  include '../includes/sideBar.php' ;

 ?>

 <div class="page-content-wrapper">
     <!-- BEGIN CONTENT BODY -->
     <div class="page-content">
       <div class="row">
           <div class="col-md-12">
             <div class="portlet light" style="height:425px">
                 <div class="portlet-title">
                   <div class="caption caption-md">
                     <!-- <i class="icon-fire font-red"></i> -->
                     <span class="caption-subject bold uppercase" style="color:#FFA500">Invitations</span>
                   </div>
                 </div>
                 <div class="portlet-body">
                   <table id="table-style" data-toggle="table" data-height="299" data-row-style="rowStyle">
                     <thead>
                       <tr>
                           <th style="text-align: center; "> Invited by </th>
                           <th style="text-align: center;"> Project </th>
                           <th style="text-align: center;"> Accept/Reject </th>

                       </tr>
                     </thead>
                         <tbody>
                           <?php
                             $req = $db_conn->query("SELECT * from tbl_requests where receiver_id = '$U'") ;
                             while($row = $req->fetch_assoc())
                             {
                               $sender = $row['sender_id'] ;
                               $s = $db_conn->query("SELECT * from tbl_user_info where u_id = '$sender'") ;
                               $s = $s->fetch_assoc() ;

                               $project = $row['project_id'] ;
                               $p = $db_conn->query("SELECT * from tbl_projects where id = '$project'") ;
                               $p = $p->fetch_assoc() ;

                               echo "  <tr>

                                     <td> ".$s['f_name']." ".$s['l_name']."</td>
                                     <td> ".$p['title']." </td>

                                     <td style='text-align:center;'>
                                         <a href='includes/acceptInvitation.php?p_id=".$project."&r_id=".$row['request_id']."' style='text-decoration:none;color:white;margin-left:25px;'  class='btn btn-sm btn-info btn-accept' >accept</a>
                                         <a href='includes/declineInvitation.php?r_id=".$row['request_id']."' style='text-decoration:none;color:white;margin-left:25px;'  class='btn btn-sm btn-danger btn-decline'>Reject</a>

                                     </td>
                                 </tr>" ;
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




 <?php
    include '../includes/footer.php' ;
  ?>
