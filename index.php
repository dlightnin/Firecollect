<div id="parent">
<!--
This parent div handles the x-axis overflow. Its main purpose is to substitute the
body as a parent, so the CSS option overflow-x: hidden affects the parent div and
not the body, enabling the bottom right arrow that scrolls to the top of the page
to be visible.
-->
<html lang="en">
<!--<![endif]-->
<?php include 'includes/header.php' ; ?>

<!-- Body BEGIN -->
<body class="corporate" >
  <!--  ontouchstart=""   add this as is to body so mobile devices recognize taps -->

  <?php include 'includes/topMenu.php' ;
        include 'includes/slider.php' ;
  ?>

    <div class="main">
      <div class="container-fluid">

    <!-- BEGIN SERVICE BOX -->
        <div id="first_div" class="row service-box margin-bottom-40 ">

        <!-- FIRST BOX -->
          <a onclick="onScrollTo('#first')" class="zoom_icons" style="text-decoration: none" >
            <div id="d1" class="col-sm-3 col-sm-3">
              <div class="text-center">
                <i class="fa fa-tasks zoom" style="color:#0f758d"></i>
                  </br></br>
              </div>
              <div class="service-box-heading">
                  <h3 align="center">Manage Your Projects</h3>
              </div>
            </div>
          </a>

        <!-- SECOND BOX -->
        <a onclick="onScrollTo('#second')" class="zoom_icons" style="text-decoration: none;">
          <div class="col-sm-3 col-sm-3">
            <div class="text-center">
              <i class="fa fa-desktop zoom" style="color:#EFC230" ></i>
                </br></br>
            </div>
            <div class="service-box-heading" >
                <h3 align="center"> User-Friendly UI </h3>
            </div>
          </div>
        </a>

        <!-- THIRD BOX -->
        <a onclick="onScrollTo('#third')" class="zoom_icons" style="text-decoration: none;">
          <div class="col-sm-3 col-sm-3">
            <div class="text-center">
              <em><i class="fa fa-users zoom" style="color:#1bbc9b"></i></em>
                </br></br>
            </div>
            <div class="service-box-heading">
                <h3 align="center">Collaborative Space</h3>
            </div>
          </div>
        </a>

        <!-- FOURTH BOX -->
        <a class="zoom_icons" onclick="onScrollTo('#fourth')" style="text-decoration: none;">
          <div class="col-sm-3 col-sm-3">
            <div class="text-center">
              <i class="fa fa-lock zoom" style="color:#ff6b0b"></i>
                </br></br>
            </div>
            <div class="service-box-heading">
                <h3 align="center">Secure Interface</h3>
            </div>
          </div>
        </a>

      </div>
    <!-- END SERVICE BOX DIV -->

    <!-- REGISTER/LOGIN DIV -->
        <div id="top_banner" class="row recent-work clearfix" style="background-color:#0f758d;">
            <h1> Made to Aid Your Research Data Growth </h1>
              </br></br>
                <h3 align="center">
                    <b style="color:#efc230"> Fast, Secure, and Reliable process </b>
                      </br>
                  that grows with your research projects.
                </h3>
              </br></br>
              <center>
                <a href="../backend/fc-user/registerPage.php" target="_blank">
                  <button type="button" id="b1" >
                    Register!
                  </button>  &nbsp &nbsp &nbsp
                </a>
                <a href="../backend/index.php" target="_blank">
                  <button type="button" id="b2">
                    Log In!
                  </button>
                </a>
              </center>
          </br>
        </div>
      <!-- REGISTER/LOGIN DIV -->

      <script>
      /*
      this script handles the scroll to div on click function
      displayed by the zooom icons under the slider.
      */

        function onScrollTo(id){
        var targetOffset = $(id).offset().top - 100;
        $('html, body').animate({scrollTop: targetOffset}, 1000);

          }
      </script>


        <!-- FUNCTIONALITY -->


          <!--  1   START MANAGE PROJECTS DIV-->
          <div id="backdiv1">

            <div id="first" class="row functionality_divs" >
              <div class="text-center">
                <i class="fa fa-tasks" style="color:#0f758d"></i>
                <h1>Manage Your Projects with Ease</h1>
              </div>


              <div class="container">

                <div class="col-md-6">

                  <h3> Manage your projects effortlessly </h3>
                    <p style="font-size:18px"> Now you can manage your projects free from anywhere.
                      Firecollect is fast to set up and can send you alerts when someone are share the information.
                    </p>

                  <h3> Administer projects details </h3>
                    <p style="font-size:18px">
                        Like names, quantities, or prices quickly and easily.
                        Get automatic emails when you start to run low on an item.
                    </p>

                  <h3> Create point your projects into a maps </h3>
                    <p style="font-size:18px">
                      Light soy, extra noodles—item modifiers make it simple and efficient to get your customers’ orders just right.
                    </p>

                </div>

                <div id="im1" class="col-md-6" align="center" >
                  <img src="imgs/dummy.png" >
                </div>

                <div id="test" class="container" align="center" >
                  <img src="imgs/dummy.png" />
                </div>

              </div>

            </div>

          </div> <!-- backdiv1 END -->

          <!--  END MANAGE PROJECTS DIV-->


          <!--  2     START User-Friendly UI DIV-->


            <div id="second" class="row functionality_divs">

              <div class="text-center">
                <i class="fa fa-desktop" style="color:#EFC230"></i>
                <h1>User-Friendly UI</h1>
              </div>

              <div class="container" align="center">

                <h3> Manage your projects effortlessly </h3>
                  <p style="font-size:18px"> Now you can manage your projects free from anywhere. </br>
                    Firecollect is fast to set up and can send you alerts when someone are share the information.
                  </p>

                <h3> Administer projects details </h3>
                  <p style="font-size:18px">
                      Like names, quantities, or prices quickly and easily. </br>
                      Get automatic emails when you start to run low on an item.
                  </p>

                <h3> Create point your projects into a maps </h3>
                  <p style="font-size:18px">
                    Light soy, extra noodles—item modifiers make it simple and efficient to get your customers’ orders just right.
                  </p>
                </br></br>
              </div>

            </div>
            <!--  END User-Friendly UI DIV-->

            <!--  3    START Share your Data DIV-->
            <div id="backdiv2">

            <div id="third" class="row functionality_divs">
              <div class="text-center">
                <i class="fa fa-users" style="color:#1bbc9b"></i>
                <h1>Collaborative Space</h1>
              </div>

              <div class="container" >

                <div class="col-sm-6">

                  <h3> Manage your projects effortlessly </h3>
                    <p style="font-size:18px"> Now you can manage your projects free from anywhere.
                      Firecollect is fast to set up and can send you alerts when someone are share the information.
                    </p>

                  <h3> Administer projects details </h3>
                    <p style="font-size:18px">
                        Like names, quantities, or prices quickly and easily.
                        Get automatic emails when you start to run low on an item.
                    </p>

                  <h3> Create point your projects into a maps </h3>
                    <p style="font-size:18px">
                      Light soy, extra noodles—item modifiers make it simple and efficient to get your customers’ orders just right.
                    </p>

                </div>

              <div id="im3" class="col-sm-4" align="center">
                <img src="imgs/dummy2.png" />
              </div>

              <div id="test2" class="container" align="center" >
                <img src="imgs/dummy2.png" />
              </div>

            </div>
            </div>

          </div> <!-- backdiv2 END -->

            <!-- END Share your Data DIV -->

            <!--  4   START Secure interface DIV -->
              <div id="fourth" class="row functionality_divs">
                <div class="text-center">
                  <i class="fa fa-lock" style="color:ff6b0b"></i>
                  <h1>Secure Interface</h1>
                </div>
                <div class="container" align="center">

                  <h3> Manage your projects effortlessly </h3>
                    <p style="font-size:18px"> Now you can manage your projects free from anywhere. </br>
                      Firecollect is fast to set up and can send you alerts when someone are share the information.
                    </p>

                  <h3> Administer projects details </h3>
                    <p style="font-size:18px">
                        Like names, quantities, or prices quickly and easily. </br>
                        Get automatic emails when you start to run low on an item.
                    </p>

                  <h3> Create point your projects into a maps </h3>
                    <p style="font-size:18px">
                      Light soy, extra noodles—item modifiers make it simple and efficient to get your customers’ orders just right.
                    </p>

                </div>
              </div>
              <!--  Secure interface DIV -->


        <!-- END FUNCTIONALITY-->

        <!-- SECOND REGISTER/LOGIN DIV -->
            <div id="bottom_banner" class="row recent-work clearfix" style="background-color:#0f758d;">
                <h1> <b style="color:#efc230"> Effortless </b> metadata organization.  </h1>
                  </br></br>
                  <center>
                    <a href="../backend/fc-user/registerPage.php" target="_blank">
                      <button type="button" id="b1" >
                        Register!
                      </button>  &nbsp &nbsp &nbsp
                    </a>
                    <a href="../backend/index.php" target="_blank">
                      <button type="button" id="b2">
                        Log In!
                      </button>
                    </a>
                  </center>
            </div>
          <!-- SECOND REGISTER/LOGIN DIV -->

      </div>
    </div>



    <?php include 'includes/footer.php' ; ?>

    <!-- Load javascripts at bottom, this will reduce page load time -->
    <!-- BEGIN CORE PLUGINS (REQUIRED FOR ALL PAGES) -->
    <!--[if lt IE 9]>
    <script src="assets/plugins/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript">
        jQuery(document).ready(function() {
            Layout.init();
            Layout.initOWL();
            Layout.initTwitter();
            //Layout.initFixHeaderWithPreHeader(); /* Switch On Header Fixing (only if you have pre-header) */
            //Layout.initNavScrolling();
        });
    </script>
    <!-- END PAGE LEVEL JAVASCRIPTS -->
    <!-- <div class="fake" >

    </div> -->

    </body>


    <!-- END BODY -->
    </html>

  </div>
