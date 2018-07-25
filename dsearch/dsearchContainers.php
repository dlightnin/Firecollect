<?php

  function projectContainer($row){
    // $row = row ;
    echo "<section id=resultSectionP value=projectDiv style='box-shadow: 3px 3px 3px #FD6B25;margin-top:35px;'>
            <div id=resultSectionImage  class=col-sm-2>
              <img src=imgs/fc_dummy_search.png align=center style=padding-top:10px;width:100%;height:80%;>

              <i class='fa fa-plus' style='font-size:22px;margin-top:15px;color:#0f758d;'></i>
              <i class='fa fa-share' style='font-size:22px;margin-top:15px;color:#0f758d;padding-left:12px'></i>
              <i class='fa fa-eye' style='font-size:22px;margin-top:15px;color:#0f758d;padding-left:12px'></i>
              <i class='fa fa-bars' style='font-size:22px;margin-top:15px;color:#0f758d;padding-left:12px'></i>


            </div>
            <div style=margin-top:5px id=resultSectionInfo class=col-sm-10 >
                <h3><b>Project Title:</b> ".$row['title']."</h3>
                  <h5><b>Author: </b>".$row['contact_name']."</h5>
                  <h5><b>Institution: </b>".$row['inst_name']."</h5>
                  <h5 id=descrip ><b>Description: </b>".$row['description']." </h5>

            </div>
          </section>
          ";
          // return echo $echo ;
  }

  function datasetContainer($row){

    echo "<section id=resultSectionD value=dataSetDiv style='box-shadow: 3px 3px 3px #19758B;margin-top:35px;'>
            <div id=resultSectionImage  class=col-sm-2>
              <img src=imgs/fc_dummy_search.png align=center style=padding-top:10px;width:100%;height:80%;>

              <i class='fa fa-plus' style='font-size:22px;margin-top:15px;color:#0f758d;'></i>
              <i class='fa fa-share' style='font-size:22px;margin-top:15px;color:#0f758d;padding-left:12px'></i>
              <i class='fa fa-eye' style='font-size:22px;margin-top:15px;color:#0f758d;padding-left:12px'></i>
              <i class='fa fa-bars' style='font-size:22px;margin-top:15px;color:#0f758d;padding-left:12px'></i>


            </div>
            <div style=margin-top:5px id=resultSectionInfo class=col-sm-10 >
                <h3><b>Dataset Title: </b>".$row[5]."</h3>
                  <h5><b>Parent Project: </b>".$row['title']."</h5>
                  <h5><b>Contact: </b>".$row['contact_name']."</h5>
                  <h5><b>Institution: </b>".$row['inst_name']."</h5>
                  <h5 id=descrip ><b>Description: </b>".$row['description']." </h5>
            </div>
          </section>";

  }

 ?>
