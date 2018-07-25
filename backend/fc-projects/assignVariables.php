<?php
  require '../includes/dbConnect.php' ;
  include '../includes/topMenu.php';
  include '../includes/sideBar.php';


  $u_id =$_SESSION["user_id"];
  $data_set = $_GET['ds_id'] ;


    function validateInput($data){
      $data = trim(stripcslashes(htmlspecialchars($data)));
      return $data;


    }

    $varQuery = "SELECT v.name ,v.data_set_id from tbl_variables v inner join tbl_data_set ds on v.data_set_id = ds.id left join tbl_projects p on ds.project_id = p.id left join tbl_user u on p.u_id = u.u_id where u.u_id ='$u_id'" ;
    $v = $db_conn->query($varQuery) ;



?>

            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    <!-- BEGIN THEME PANEL -->


                    <div class="portlet light">
                      <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-red sbold uppercase">Assign variables to:</span>
                        </div>
                      </div>
                      <!-- <input type="text" id="search"> -->
                      <select multiple="multiple" class="multi-select" id="my_multi_select1" name="my_multi_select1[]">
                        <?php
                          while($row = $v->fetch_assoc())
                          {
                            if($row['v.data_set_id'] == $data_set)
                            {
                              echo "<option selected>".$row['name']."</option>" ;
                            }

                            else
                            {
                              echo "<option>".$row['name']."</option>" ;
                            }
                          }
                        ?>
                      </select>

                    </div>
                </div>
            </div>

<?php
  include '../includes/footer.php';
 ?>

 <script type="text/javascript" src="includes/js/quicksearch.js"></script>

 <script type="text/javascript">
 $('#my_multi_select1').multiSelect({
 selectableHeader: "<input type='text' class='form-control input-sm' style='width:100%' autocomplete='off' placeholder='Filter'>",
 selectionHeader: "<input type='text' class='form-control input-sm' style='width:100%' autocomplete='off' placeholder='Filter'>",
 afterInit: function(ms){
   var that = this,
       $selectableSearch = that.$selectableUl.prev(),
       $selectionSearch = that.$selectionUl.prev(),
       selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
       selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

   that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
   .on('keydown', function(e){
     if (e.which === 40){
       that.$selectableUl.focus();
       return false;
     }
   });

   that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
   .on('keydown', function(e){
     if (e.which == 40){
       that.$selectionUl.focus();
       return false;
     }
   });
 },
 afterSelect: function(){
   this.qs1.cache();
   this.qs2.cache();
 },
 afterDeselect: function(){
   this.qs1.cache();
   this.qs2.cache();
 }
});
 </script>
