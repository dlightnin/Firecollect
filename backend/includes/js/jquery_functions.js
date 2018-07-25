$(document).on("click", "btn-accept", function () {
 var myId = this.parentElement.children[0];
 $(".modal-body #p_id").val( myId );

 // As pointed out in comments,
 // it is superfluous to have to manually call the modal.
 // $('#addBookDialog').modal('show');
});
