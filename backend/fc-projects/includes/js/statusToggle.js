
//Global variable: last intereacted swicth element
var last_switch ;
var update_id;
//initialize bootstrapSwitch after clicking links
$(document).on("click","a", function(event) {
  $('.make-switch').bootstrapSwitch();
});

function status_swal (status,update_id,url){
  swal({
      title: "Are you sure?",
      text: (status == 1) ? "Your project will become public.":"Your project will become private.",
      // text: "<input class='checkbox' type='checkbox' name='vehicle' value='Bike'>",
      // html: true,
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: (status == 1) ? "btn-success":"btn-danger",
      confirmButtonText: (status == 1) ? "Yes, change to public!":"Yes, change to private!",
      closeOnConfirm: false
    },
      function(isConfirm) {
        if (isConfirm)
        {
          $.ajax({
            url: url,
            method: 'POST',
            // dataType:"text",
            data: {status:status, update_id:update_id},
            success: function(data){
              if (data != ''){

                if (parseInt(data) == 1){

                  $(last_switch).closest(".status_toggle")[0].id = 0;
                }
                else {

                  $(last_switch).closest(".status_toggle")[0].id = 1;
                }

                console.log(data);
                swal({title:"Status Changed!",
                text:"Your project status has been changed.",
                type:"success",
                showConfirmButton: false,
                timer:1500});
              }
            }


          });//end ajax

        }//end is if confirm
      });
}
//just call this function with the mode and id of what you want to change the status
//must have modal in page already
function setStatusToggle(mode,url) {

  $('.make-switch').on('switchChange.bootstrapSwitch', function (e, data,update_id) {
    $('#checkbox14').attr('checked', false);
    last_switch=this;
    var new_status = $(this).closest(".status_toggle").attr('id');

    if(mode=='table'){
      var update_id = $(this).closest("tr").find(".id")[0].innerHTML;
      $("#modal_terms").find('.id')[0].innerHTML=update_id;
      console.log("shouldnt be here");

    }
    else {
      var update_id = $("#modal_terms").find(".id")[0].innerHTML;
    }

    console.log(update_id);
    $(this).bootstrapSwitch('state', !data, true);

        if (new_status==0){
          status_swal (new_status,update_id, url);
        }
        else{
          $('#modal_terms').modal('show');
        }
                  // }

          });

  $(document).on("click",".sa-button-container .confirm ", function(event) {

        $(last_switch).bootstrapSwitch('toggleState', true, true);

  } );
  $(document).on("click", '#change_status', function(event) {
    // retrieve new status value
    var new_status = $(last_switch).closest(".status_toggle").attr('id');

    // if (mode == 'table'){
      // retrieve id from table
      var update_id = $(this).closest("#modal_terms").find(".id")[0].innerHTML;

      // }

    console.log("how bout here",update_id);
    console.log(mode);
    // if checkbox is checked
    if ($("#checkbox14[type=checkbox]:checked ").length>0){
      $(".close_modal").click();
      status_swal (new_status,update_id, url);
    }
  });

}
