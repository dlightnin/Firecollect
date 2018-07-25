<div class="page-sidebar-wrapper " align="left">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div id="sidebarFunctionality"class="page-sidebar navbar-collapse collapse " style="height:100%">
      <span style="font-size:30px">  Filters </span>

      <div class="form-group form-md-checkboxes">
      <!-- </br> -->

      <form id="form1" method="post">

        <!-- ############################################### SORTS ############################################### -->

        <div id="sortDiv" align="left" >
            <h3 style="font-size:20px;margin-bottom:15px">Sort By</h3>

          <div style="margin-bottom:20px;">
                  <select id="sort" style="width:100px" onChange="sortBy(this.value) ">
                    <option value="recent" >Recent</option>
                    <option value="oldest">Oldest</option>
                    <option value="order" >Order(A-z)</option>
                    <option value="reverse">Order(Z-a)</option>
                  </select>
          </div>

          <!-- <div class="dropdown">
            <button class="dropbtn">Dropdown</button>
            <div class="dropdown-content">
              <a href="#">Link 1</a>
              <a href="#">Link 2</a>
              <a href="#">Link 3</a>
            </div>
          </div> -->

          <!-- <input type="text" name="country" id="autocomplete"/> -->

        </div>

        <!-- ############################################### SORTS ############################################### -->

        <!-- ############################################### DROPDOWNS ############################################### -->


        <div align="left">
          <h3 style="font-size:20px;margin-bottom:18px">Research Areas</h3>
            <!-- <select > -->
              <?php include 'areas.php' ; ?>
              <!-- <option value="volvo">Volvo</option>
              <option value="saab">Saab</option>
              <option value="mercedes">Mercedes</option>
              <option value="audi">Audi</option> -->
            <!-- </select> -->
        </div>
      </br>
          <!-- </br> -->

      <!-- ############################################### DROPDOWNS ############################################### -->


<!-- ******************** FILTER BY ********************* -->
        <div class="md-checkbox-list" id="filterDiv" align="left">
          <h3 style="font-size:20px;margin-bottom:15px">Filters</h3>

                    <div class="md-checkbox" >
                        <input class="md-check"  type="checkbox" id="chk5" name="projects" value="projects" onclick="processForm(this.id, this.value); sessNum()"  />
                          <label for="chk5">
                            <span class="check"></span>
                            <span class="box"></span>
                              Projects
                          </label>
                    </div>

                    <div class="md-checkbox" >
                        <input class="md-check"  type="checkbox" id="chk6" name="f2" value="datasets" onclick="processForm(this.id, this.value); sessNum()" />
                           <label for="chk6">
                            <span class="check"></span>
                            <span class="box"></span>
                              Datasets
                           </label>
                    </div>

                    <div class="md-checkbox" >
                        <input class="md-check"  type="checkbox" id="chk7" name="f3" value="publications"  onclick="processForm()"/>
                           <label for="chk7">
                            <span class="check"></span>
                            <span class="box"></span>
                              Publications
                           </label>
                    </div>

                    <div class="md-checkbox" >
                        <input class="md-check"  type="checkbox" id="chk8" name="f4" value="datafiles"  onclick="processForm()"/>
                           <label for="chk8">
                            <span class="check"></span>
                            <span class="box"></span>
                              Datafiles
                           </label>
                    </div>

          </div>

        </form>

        </div>

          <!-- <h3 style="font-size:20px">Focus Search</h3> -->

        <!-- <div align="left" style="margin-right:15px">
          <h3 style="font-size:18px;margin-bottom:18px">Author</h3>
            <input id="str" type="text" name="search" class="form-control" placeholder="keyword1, keyword2, etc...">
        </div> -->
      <!-- </br> -->

      <!-- ############################################### SEARCH BY VARIABLES ############################################### -->


        <div align="left" style="margin-right:15px">
          <h3 style="font-size:18px;margin-bottom:18px">Variables</h3>
            <input id="str" type="text" name="search" class="form-control" placeholder="keyword1, keyword2, etc...">
        </div>
      </br>
      <!-- ############################################### SEARCH BY VARIABLES ############################################### -->



      <!-- ############################################### SEARCH BY LOCATION ############################################### -->

        <div align="left">
          <h3 style="font-size:18px;margin-bottom:18px">Location</h3>
            <input id="str" type="text" name="search" class="form-control" placeholder="address">
          </br>
            <div class="col-sm-5">
              <input id="coord1" style="width:100px;margin-left:-15px" class="form-control"placeholder="latitude">
            </div>
            <!-- </br -->
            <div class="col-sm-5">
              <input id="coord2" style="width:100px;margin-left:10px" class="form-control" placeholder="longitude">
            </div>

        </div></br></br>
        <!-- ############################################### SEARCH BY LOCATION ############################################### -->



        <!-- ############################################### SEARCH BY AUTHOR ############################################### -->
        <div style="width:154px;margin-top:10px">
          <h3 style="font-size:18px;margin-bottom:18px;">Author Name</h3>
            <input type="text" name="author" id="author"  placeholder="Author name"  class="form-control"/>
            <div id="authorList" style="background-color:white;"></div>
        </div>
        <!-- ############################################### SEARCH BY AUTHOR ############################################### -->



        <!-- ############################################### SEARCH BY KEYWORDS ############################################### -->
      </br>

        <div id="keywordsDiv" style="margin-right:15px;" >
          <h3 style="font-size:18px;margin-bottom:18px">Keywords</h3>
            <input id="keywordInput" type="text" name="search" class="form-control" placeholder="keyword1, keyword2, etc..." style="z-index:0" data-role="tagsinput" autocomplete="off">
              <section id="keywordsDrop" style="background-color: white;"></section></br>

        </div>


        <!-- ############################################### END SEARCH BY KEYWORDS ############################################### -->

        <!-- ############################################### CLEAR ALL  ############################################### -->

      <div>

          <div class="bootstrap-tags bootstrap-3 row">
              <!-- tags result div is now inside the clear button div so it pushes the clear button on adding a new tag -->
              <div id="keywordsResult"  style="margin-bottom:25px;margin-left:12px" ></div>
          </div>
        </br>

          <form id="clearcheck" method="post">
              <button type="submit" class="btn btn-7 btn-7b" style="background-color:#099DAA;color:#ffffff;" name="clr" value="clear" onchange=" document.getElementById('clearcheck').submit()"> clear all </button>
          </form>

      </div>

      <!-- ############################################### END CLEAR ALL  ############################################### -->


                      <!-- onclick="$('input:checkbox').prop('checked', false); " -->
                <!-- </ul> -->
          <!-- </ul> -->
    </div>

</div>
</br></br>



<!-- <script type="text/javascript" src="dsearch/js/sidebar.js"></script> -->

<!-- <div id="results">

</div> -->
