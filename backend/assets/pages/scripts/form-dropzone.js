
var FormDropzone = function () {


    return {
        //main function to initiate the module
        init: function () {

            Dropzone.options.myDropzone = {
                dictDefaultMessage: "",
                init: function() {
                  // $(document).on('click', '.upload_btn', function(event) {

                  // this.on("error", function(file) {
                  //   $(document).on("click", '.upload_btn', function(event) {
                  //
                  //   // var upload_btn = document.getElementsByClassName("upload_btn");
                  //   // upload_btn.addEventListener("click", function(e){
                  //       // document.getElementById("demo").innerHTML = "Hello World!";
                  //       this.removeFile(file);
                  //       console.log("clickd upload_btn");
                  //   });
                  // });

// }

                    this.on("complete", function(file) {
                        // Create the remove button
                        // var removeButton = Dropzone.createElement("<a href='javascript:;'' class='btn red btn-sm btn-block'>Remove</a>");

                        // Capture the Dropzone instance as closure.
                        var _this = this;
                        $(document).on("click", '.upload_btn', function(event) {

                        // var upload_btn = document.getElementsByClassName("upload_btn");
                        // upload_btn.addEventListener("click", function(e){
                            // document.getElementById("demo").innerHTML = "Hello World!";
                            _this.removeFile(file);
                            console.log("clickd upload_btn");
                        });
                        // Listen to the click event
                        // removeButton.addEventListener("click", function(e) {
                        //   // Make sure the button click doesn't submit the form:
                        //   e.preventDefault();
                        //   e.stopPropagation();
                        //
                        //   // Remove the file preview.
                        //   _this.removeFile(file);
                        //   // If you want to the delete the file on the server as well,
                        //   // you can do the AJAX request here.
                        //   // console.log("form-drop retrieved name: ",file.name);
                        //   // $.ajax({
                        //   //   url: 'includes/delete_dropzone_file.php',
                        //   //   method: 'POST',
                        //   //   // dataType:"text",
                        //   //   data: {file_name:file.name},
                        //   //   success: function(data){
                        //   //     if (data != ''){
                        //   //       console.log("image deleted!", data);
                        //   //       $(".mt-element-card").load("load_gallery.php .mt-element-card");
                        //   //
                        //   //
                        //   //     }
                        //   //
                        //   //   }
                        //   //   // dataType: dataType
                        //   // });
                        //   // $.post('delete_file.php',{file_name:file.name},function(){
                        //   //   alert('file deleted');  });
                        //
                        //
                        // });

                        // Add the button to the file preview element.
                        // if (select_flag ==1){}
                        // file.previewElement.appendChild(removeButton);


                    });

                }
            }
        }
    };
}();

jQuery(document).ready(function() {
   FormDropzone.init();
});
