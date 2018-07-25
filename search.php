<html lang="en">
<!--<![endif]-->
<?php include 'includes/header.php' ;
  session_start() ;
  // $Q = array();
  // $_SESSION["test"] = $testArray ;

  // $Q = $_SESSION["test"] ;
?>
<div id="hblock">
  <?php include 'includes/topMenu.php' ;
        include 'includes/dbConnect.php' ;
  ?>
</div>

<!-- Body BEGIN -->
<body class="corporate" >
  <!-- <div id="test_container"> -->
    <div id="main">

  <!--  ontouchstart=""   add this as is to body so mobile devices recognize taps -->


<!-- search bar -->
    <div id="searchBar">
      <form id="lets_search" >
        <div name="sdiv1" class="input-group" >
          <input id="str" type="text" name="search" class="form-control" placeholder="Search..." autocomplete="off">
          <span class="input-group-btn">
            <button id='search' name="button" class="btn btn-primary">Search</button>
          </span>
        </div>
      </form>
      <div id="smsg" >

          <?php
          // $_SESSION["numRows"] = $numRows ;
          // if(isset($_SESSION["numRows"]))
          //           echo:<script></script>
          //         // echo "&nbsp<p>".$_SESSION["numRows"]." results found! </p>" ;
          //       else
          //         echo "0 results found!" ;
            ?>
            <script>
             function sessNum(){
               var session = Number("<? if(isset($_SESSION['numRows'])){echo $_SESSION['numRows'] ;}?>") ;

               // var intSess = Number(session);
               // var res += intSess;
 ;
               $('#smsg').html(session) ;
                }
            </script>
      </div>
    </div>
  </br></br>
    <!-- <div id="d"></div> -->


<!-- end search bar -->


<div id="sideResDiv" class="row">

<!-- filter sidebar -->

<div id="sidebar">
  <?php include 'dsearch/sidebar.php' ; ?>
</div>

<!-- end filter sidebar -->



<!-- search results -->
  <div id="results" class"results">

  </div>

<!-- end search results -->
</div>

</div> <!-- main -->

<!-- </div>  -->
<!-- <div id="sfooter"> -->
  <?php include 'includes/footer.php' ;?>
<!-- </div> -->

  </body>
</html>




<!-- <script src="dsearch/js/search.js"></script> -->

<script>
var Q = [] ; // this array will store all selected filters. it will be used to sort the filtered data
var searchKeys  = [] ;



// $.ajax({
//   type: 'POST',
//   url: '/dsearch/areas.php',
//   data: {area}
//
//
// }) ;

// ***********BIG SEARCH**************** ajax script that searches DB when user searches
$(document).on("click","#search",function(event){
      event.preventDefault();
      event.stopPropagation();


      var search = $("input[name='search']")[0].value ;

      // adding keywords to bigsearch
      //
      // if(searchKeys.length > 0){
      //   skeys
      // }

      $("#results").html('') ;
      $.ajax({
        type: 'POST' ,
        url: 'dsearch/bigSearch.php' ,
        data: {variable: search},
          success: function(data) {
            $("#results").html(data) ;
          }
      });
      $("#smsg").load(location.href+" #smsg>*");
    });






// *************FILTERS************** ajax script that gets checked boxes and loads/removes desired content
      function processForm(checkedId, filter){

        var sess = '<?php $sess = $_SESSION['numRows']; echo $sess ;?>' ;
        var checkedFilter = document.getElementById(checkedId) ;
        // alert(filter) ;

        if(checkedFilter.checked){

          // if datafiles selected:
              // remove all dataset containers and reload the ones with datafiles
          if((Q.indexOf('datasets') > -1) && (filter == 'datafiles') ){
            for(var j=0; j<sess; j++){
              $("#resultSectionD").remove(document.getElementById("#resultSectionD"));
            }
            // Q[Q.indexOf('datasets')] = filter ;
            // Q.push(filter) ;
          }
         else{
           Q.push(filter) ;
         }

          $.ajax({
            type: 'POST',
            url: 'dsearch/filters.php',
            data: { checked_box : filter},
            success: function(data) {
              $(data).appendTo("#results") ;
            }
         }) ;
       } // if
       else{

         var n =  0 ;
         if(filter == 'projects'){

            for(var i=0; i< sess; i++){
              $("#resultSectionP").remove(document.getElementById("#resultSectionP"));
              n += 1 ;
            }

        }
        else if(filter == 'datasets'){

          for(var j=0; j<sess; j++){
            $("#resultSectionD").remove(document.getElementById("#resultSectionD"));
          }

        }
        // alert(n) ;

       } // else

     } // processForm function


     // *************************** this block will execute when a SORT is selected.
     function sortBy(x){

       $.ajax({
         type: 'POST',
         url: 'dsearch/sort.php',
         data: { sortData : x, array : Q },
         success: function(data) {
           alert(x) ;
           $('#results').html(data) ;
         }
      }) ;
    }


    // *************************** this block autogenerates the author names in the author search bar
    $(document).ready(function(){
      $('#author').keyup(function(){
        var query = $(this).val() ;
        // alert(query) ;
        if(query != ""){
          $.ajax({
            url: "dsearch/authors.php",
            method: "POST",
            data: {query : query},
            success: function(data){
              $('#authorList').fadeIn() ;
              $('#authorList').html(data) ;
            }
          })
        }
        else{
          document.getElementById('authorList').style.display = 'none' ;
        }
      }) ;

      //onclick author search

      $(document).on("click",'#au',function(event){
        // event.preventDefault();
        // event.stopPropagation();
        // var t = document.getElementById('au').innerHTML;
        // alert( t ) ;

      }) ;

    }) ;


    // ************************ this block autogenerates variable names

    // $(document).ready(function(){
    //   $('#author').keyup(function(){
    //     var query = $(this).val() ;
    //     // alert(query) ;
    //     if(query != ""){
    //       $.ajax({
    //         url: "dsearch/.php",
    //         method: "POST",
    //         data: {query : query},
    //         success: function(data){
    //           $('#authorList').fadeIn() ;
    //           $('#authorList').html(data) ;
    //         }
    //       })
    //     }
    //     else{
    //       document.getElementById('authorList').style.display = 'none' ;
    //     }
    //   }) ;
    // }) ;


// ***********KEYWORDS************* this block gets selected keywords, displays them under the keywords input/
                                // keywords will be used by the Big Search


                                $(document).ready(function(){

                                  $('#keywordInput').keyup(function(){
                                    var key = $(this).val() ;
                                    // alert(key) ;
                                    if(key != ""){
                                      $.ajax({
                                        url: "dsearch/keywords.php",
                                        method: "POST",
                                        data: {key : key},
                                        success: function(data){
                                          $('#keywordsDrop').fadeIn() ;
                                          $('#keywordsDrop').html(data) ;
                                        }
                                      })
                                    }
                                    else{
                                      document.getElementById('keywordsDrop').style.display = 'none' ;
                                    }
                                  }) ;
                                }) ;


                      // the function below adds a tagged keyword uner the keywords input
                                function addTag(tag){
                                     $("#keywordsDrop").hide() ; // hides suggestion dropdown when user selects a tag

                                     searchKeys.push(tag) ; // add keywords to global array to be used in search

                                     $.ajax({
                                       url: "dsearch/keywords.php",
                                       method: "POST",
                                       data: {keyBig : tag, array : searchKeys},
                                       success: function(data){
                                         $(data).appendTo('#keywordsResult') ;

                                       }
                                     })
                                     document.getElementById("keywordInput").value = '' ;

                                     // document.getElementById(tag).hide() ;

                               } // END addTag function

                      // the function below removes each tag uppon beign clicked
                            function removeTag(tag){

                              // removes key from global array
                              if(searchKeys.indexOf(tag) > -1) {
                                searchKeys.splice(searchKeys.indexOf(tag), 1) ;
                              }
                                // removes tag from bottom of keywords input
                              $(tag).remove(document.getElementById(tag)) ;

                            } // END removeTag function


                    // the function below



</script>
