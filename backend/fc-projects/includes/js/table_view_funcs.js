//append  table inside contain_df_table div
$(document).ready(function(){
  //hide table
  // $(".df_table").closest("#sample_editable_1_wrapper").css("display","none");

    $(".contain_df_table").append($("#sample_editable_1_wrapper"));
});


var view_flag=1//flag for view modal
//toggle view mode
$(document).on("click", '.view_mode', function(event) {
  view_flag=(view_flag+1)%2;

  if (view_flag == 1){
  $(".datafile_border").css("display","none");
  $(".df_table").css("display","table");
  $(".df_table").closest("#sample_editable_1_wrapper").css("display","block");

  $(".view_mode i").removeClass("fa-list-ul");
  $(".view_mode i").addClass("fa-th-large");
//change to table delete function
  $("#df_del").addClass("delete_df_check");
  $("#df_del").removeClass("delete_df");
  $(".select_file").css("display","none");
  $(".delete_df_check").css("display","block");



  if ($("#sample_editable_1_wrapper").length==0){
    $(".df_table"  ).dataTable( {
       aaSorting:[], 'searching': true,
      'lengthMenu': [[20, 50, 100, 200, -1],[20, 50, 100,200, "All"]]
    });
    $(".contain_df_table").append($("#sample_editable_1_wrapper"));

  }


}
else {
  $(".datafile_border").css("display","block");
  $(".df_table,#df_del").css("display","none");
  $(".df_table").closest("#sample_editable_1_wrapper").css("display","none");
  $(".view_mode i").removeClass("fa-th-large");
  $(".view_mode i").addClass("fa-list-ul");
  //change to datafile block delete function
  $("#df_del").addClass("delete_df");
  $("#df_del").removeClass("delete_df_check");
  $("#df_sel").addClass("select_all");
  $("input[type='checkbox']").prop('checked', false);
  $(".select_file").css("display","block");

  if (select_flag==1){
  $(".delete_single_df").css("display","block");}
}

});
var check_all_flag = 0 ;
// $(document).on("click", '#df_check_all ', function(event) {
//   // check_all_flag = (check_all_flag + 1) % 2;
//   // $('.checkboxes').click();
//   // if (check_all_flag == 1){
//   //   $("#df_sel").text("DESELECT ALL");
//   // }
//   // else {
//   //   $("#df_sel").text("SELECT ALL");
//   //
//   // }
//
// });
$(document).on("click", '#df_check_all ', function(event) {
  // event.preventDefault();
    event.stopPropagation();
    check_all_flag = (check_all_flag + 1) % 2;
    if (check_all_flag ==1){
      $('.checkboxes').each(function(){
        // if ($(this)[0].checked == false ){
          $(this)[0].checked = true;
        });
    }
    else {
      $('.checkboxes').each(function(){
        // if ($(this)[0].checked == true ){
          $(this)[0].checked = false;
        // }
        });
    }


console.log($('.checkboxes')[0]);

});
$(document).on("click", '.checkboxes,#df_check_all', function(event) {
  $(".delete_df_check").css("display","block");
});


$(document).on("click", '.delete_df_check', function(event) {

// $(".delete_df").click(function () {
  // if ($(".datafile_border").hasClass("selekted")==false){
    if ($(".checkboxes[type=checkbox]:checked").length < 1 ){
    alert("No file(s) selected")
  }
  else {
    swal({
        title: "Are you sure?",
        text: "Your file(s) will be deleted.",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false,
        dangerMode: true,
      },
        function(isConfirm) {
          if (isConfirm)
          {

    $(".checkboxes[type=checkbox]:checked").each(function () {
      // find datafile id
      // var file_id = $(this).find("input").attr("id");
      // LAST THING I DID
      var this_ = this;
      var del = $(this).closest("tr").find(".id").text();
      del_arr.push(del);
    //after ajax


    });
    delete_df();

      // }//if end
    }
  }
);
  }

});
