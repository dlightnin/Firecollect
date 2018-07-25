  <?php
    include '../includes/dbConnect.php' ;

    $keyword = $_POST['key'] ;
    $keyBig = $_POST['keyBig'] ;
    $keyArray = $_POST['array'] ;
    // $n = 0 ;


    $query = "SELECT d.keywords FROM tbl_data_set d WHERE d.status = 0 AND d.deleted = 0" ;
    $result = mysqli_query($db_conn,$query) ;

    if(mysqli_num_rows($result) > 0){

        while($row = mysqli_fetch_array($result)){

          $arr = explode(',',$row['keywords']); // array of keywords taken from database


            foreach($arr as $rr){
                    // if(similar_text($keyword, $rr) and in_array($rr,$keyArray, false)){
                    //   echo "<div id=keywordSec value='".$rr."' onclick=addTag('".$rr."')>".$rr."</div>" ;
                    // }

                    if( similar_text($keyword, $rr) ){
                    //   if(in_array($rr, $keyArray)){
                    //     continue ;
                    //   }
                    //   else{
                        echo "<div id=keywordSec value='".$rr."' onclick=addTag('".$rr."')>".$rr."</div>" ;
                    //   }
                    }

                    /*
                      if keyword in tag array:
                        skip with continue
                      else {
                          echo div with word in dropdown
                      }

                      why not working?
                         dropdown doesnt display when i type in words.
                         if the block that were trying to make is commented out,
                         the page works fine but repeated words still appear
                    */


            } // foreach
        } // while

    }
    else{
      echo "No Results" ;
    }// else





    if(isset($keyBig)){

      echo "<section id='$keyBig' style=margin-bottom:10px;font-size:13px;margin-left:5px class='tag label btn-info md'>
              <span id=tag >".$keyBig."</span> <a><i class='remove glyphicon glyphicon-remove-sign glyphicon-white'  onclick=removeTag(".$keyBig.") ></i></a>
            </section>" ;
      // echo "<p style=background-color:red;>".$keyBig."</p>" ;
    }
   ?>
