// jQuery(document).ready(function($) {
$(document).on("click", ".clickable-row", function () {

    // $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });


    // $(".td_last").click(function(){
    //   // var td_project_id=  document.getElementById("firstTD").innerHTML;
    //   var td_project_id = this.parentElement.children[0].innerHTML;
    //
    //   console.log("td_project_id",td_project_id);
    //   alert(td_project_id);
    // });

    $(document).on("click", ".td_last", function () {
     var myId = this.parentElement.children[0].innerHTML;
     $(".modal-body #p_id").val( myId );
     // As pointed out in comments,
     // it is superfluous to have to manually call the modal.
     // $('#addBookDialog').modal('show');
});



// });
// $(".clickable-row").hover(function(){
//   $(this).css('cursor','pointer');,)
//
// };
