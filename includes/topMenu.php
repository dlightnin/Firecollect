<div class="header navbar">

    <!-- changed logo class from site-logo to my-logo -->
    <!-- <div id="logocx"> -->
    <a id="logolink" href="index.php" style="text-decoration: none ;">
      <img id="logo" src="imgs/2018_logotype_rdata.png"  style=""></img>
    </a>
  <!-- </div> -->


  <div id="nav">
    <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>

    <!-- BEGIN NAVIGATION -->
    <nav class="header-navigation">
      <ul id="menu">
        <li>
          <a id="menu_item" href="#" onclick="dropdownFunction()" style="color:#0f758d;" class="dropMenu"> MENU
            <i id="toggle" class="fa fa-angle-down dropMenu"></i>
          </a>
            <!--  small represents the small menu that is called when the sceen size changes to small/medium -->
          <ul id="small" class="dropdown-content" >
              <li><a href="#">Home</a></li>
              <li><a href="#">Tutorials</a></li>
              <li><a href="#">Articles</a></li>
              <li><a href="#">Inspiration</a></li>
          </ul>

      </li>
        <li>
          <a id="menu_item" href="search.php" style="color:#0f758d"> DATA SEARCH <i id="toggle" class="fa fa-search"></i> </a>
        </li>
        <li>
          <a id="menu_item" href="../backend/fc-user/registerPage.php" target="_blank" style="color:#0f758d"> REGISTER
              <i id="toggle" class="fa fa-user-plus"></i>
          </a>
        </li>
        <li>
          <a id="menu_item" href="backend/index.php" target="_blank" style="color:#0f758d"> LOG IN
              <i id="toggle" class="fa fa-sign-in"></i>
          </a>
        </li>

      </ul>

    </nav>

    <!-- END NAVIGATION -->

    <script>

      // this script enables the dropdown bar menu.
            function dropdownFunction() {
              // the function will choose whichever id is available, depending on screen size
              document.getElementById("down").classList.toggle("show");
              document.getElementById("small").classList.toggle("show");

              }
              // Close the dropdown menu if the user clicks outside of it
              window.onclick = function(event) {
              if (!event.target.matches('.dropMenu')) {

                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                  var openDropdown = dropdowns[i];
                  if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                  }
                }
              }
              }
    </script>


  </div>
  <div id="desktopMenu">
    <?php include 'dropDownMenu.php' ; ?>
  </div>

 </div>
