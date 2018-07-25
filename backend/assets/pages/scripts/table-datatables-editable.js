var TableDatatablesEditable = function () {

    var handleTable = function () {

        function restoreRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                oTable.fnUpdate(aData[i], nRow, i, false);
            }

            oTable.fnDraw();
        }

        function editRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[0] + '">';
            jqTds[1].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[1] + '">';
            jqTds[2].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[2] + '">';
            jqTds[3].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[3] + '">';
            jqTds[4].innerHTML = '<a class="edit" href="">Save</a>';
            jqTds[5].innerHTML = '<a class="cancel" href="">Cancel</a>';
        }

        function saveRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
            oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 4, false);
            oTable.fnUpdate('<a class="delete" href="">Delete</a>', nRow, 5, false);
            oTable.fnDraw();
        }

        function cancelEditRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
            oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 4, false);
            oTable.fnDraw();
        }

        var table = $('#sample_editable_1');
        var table2 = $('#sample_editable_2');
        var table3 = $('#sample_editable_3') ;
        var oTable = table.dataTable({

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "lengthMenu": [
                [20, 50, 100, 200, -1],
                [20, 50, 100,200, "All"] // change per page values here
            ],

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},

            // set the initial value
            "pageLength": 20,

            "language": {
                "lengthMenu": " _MENU_ records"
            },
            "columnDefs": [{ // set default column settings
                'orderable': true,
                'targets': [0]
            }, {
                "searchable": true,
                "targets": [0]
            }],
            "order": [
                [0, "asc"]
            ] // set first column as a default sort by asc
        });

        var oTable2 = table2.dataTable({

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "lengthMenu": [
              [20, 50, 100, 200, -1],
              [20, 50, 100,200, "All"] // change per page values here
            ],

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},

            // set the initial value
            "pageLength": 5,

            "language": {
                "lengthMenu": " _MENU_ records"
            },
            "columnDefs": [{ // set default column settings
                'orderable': true,
                'targets': [0]
            }, {
                "searchable": true,
                "targets": [0]
            }],
            "order": [
                [0, "asc"]
            ] // set first column as a default sort by asc
        });

        var oTable3 = table3.dataTable({

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "lengthMenu": [
              [20, 50, 100, 200, -1],
              [20, 50, 100,200, "All"] // change per page values here
            ],

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},

            // set the initial value
            "pageLength": 5,

            "language": {
                "lengthMenu": " _MENU_ records"
            },
            "columnDefs": [{ // set default column settings
                'orderable': true,
                'targets': [0]
            }, {
                "searchable": true,
                "targets": [0]
            }],
            "order": [
                [0, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = $("#sample_editable_1_wrapper");
        // var tableWrapper2 = $("#sample_editable_2_wrapper");

        var nEditing = null;
        var nNew = false;

        $('#sample_editable_1_new').click(function (e) {
            e.preventDefault();

            if (nNew && nEditing) {
                if (confirm("Previose row not saved. Do you want to save it ?")) {
                    saveRow(oTable, nEditing); // save
                    $(nEditing).find("td:first").html("Untitled");
                    nEditing = null;
                    nNew = false;

                } else {
                    oTable.fnDeleteRow(nEditing); // cancel
                    nEditing = null;
                    nNew = false;

                    return;
                }
            }

            var aiNew = oTable.fnAddData(['', '', '', '', '', '']);
            var nRow = oTable.fnGetNodes(aiNew[0]);
            editRow(oTable, nRow);
            nEditing = nRow;
            nNew = true;
        });
// my projects table
$(document).on( 'click','.delete_project',function(){

        // table.on('click', '.delete', function (e) {
            // e.preventDefault();
            // var nRow = $(this).parents('tr')[0];
            //if deleting the project from a table
            // console.log("table tho?",$(this).closest("tr")[0]);
            // if($(this).closest("tr")[0]){
            //   var del = $(this).closest("tr").find(".id").text();
            // }
            // //if deleting project from somewhere else
            // else {
              var del = $(this)[0].id;



            swal({
                title: "Are you sure?",
                text: "Your project will be deleted.",
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
                    $.ajax({
                       type:'POST',
                       data: {del:del},
                       url:'includes/deleteProject.php',


                       success: function(data){

                              swal({title:"Deleted!",
                              text:"Your project been deleted.",
                              type:"success",
                              showConfirmButton: false,
                              timer:1500});
                              // oTable.fnDeleteRow(nRow);
//                               table.row( $(this).parents('tr') ).remove().draw();
// $(this).closest("tr").remove();
                              //if in projects.php
                              if(window.location.href =="http://136.145.54.38/~catec/firecollect_ts/backend/fc-projects/projects.php" ){
                                  replaceElement(".shared_table");
                                  replaceElement(".trash_table");
                                  replaceElement(".projects_table");
                                  

                              }
                              else {
                                window.location.replace('projects.php');
                              }

                              // $(".projects_table").addClass("active");

                            }

                          }) ;
                  }



                 });
              });

              $(document).on( 'click','.delete_variable',function(){

                      // table.on('click', '.delete', function (e) {
                          // e.preventDefault();
                          var nRow = $(this).parents('tr')[0];

                          var del = $(this).closest("tr").find(".id").text();

                          swal({
                              title: "Are you sure?",
                              text: "The variable will be deleted.",
                              type: "warning",
                              showCancelButton: true,
                              confirmButtonClass: "btn-danger",
                              confirmButtonText: "Yes, delete it!",
                              closeOnConfirm: false
                            },
                              function(isConfirm) {
                                if (isConfirm)
                                {
                                  $.ajax({
                                     type:'POST',
                                     data: {del:del},
                                     url:'includes/deleteVariable.php',


                                     success: function(data){
                                            swal({title:"Deleted!",
                                            text:"Your variable has been deleted.",
                                            type:"success",
                                            showConfirmButton: false,
                                            timer:1500});
                                            // oTable.fnDeleteRow(nRow);
              //                               table.row( $(this).parents('tr') ).remove().draw();
              // $(this).closest("tr").remove();
                                            // replaceElement(".shared_table ");
                                            // if ($(".trash_table"))
                                             // var has =( $("table").hasClass("trash_table"));
                                             $.get(String(window.location.href), function (adata) {
                                               var has = $(adata).find("table").hasClass("trash_table");
                                               if(has){replaceElement(".trash_table ");}
                                               replaceElement(".variable_table ");

                                             });

                                            // update modals
                                            $.get(String(window.location.href), function (loaded_data) {
                                                loaded_data = $(loaded_data).find(".modal_tag");
                                                $(".contain_modals").empty();
                                                $(".contain_modals").append(loaded_data);
                                              });


                                            // $(".projects_table").addClass("active");

                                          }

                                        }) ;
                                }



                               });
                            });


              table2.on('click', '.delete', function (e) {
                  e.preventDefault();
                  var nRow = $(this).parents('tr')[0];

                  var del = $(this).closest("tr").find(".id").text();

                  swal({
                      title: "Are you sure?",
                      text: "Your project will be deleted.",
                      type: "warning",
                      showCancelButton: true,
                      confirmButtonClass: "btn-danger",
                      confirmButtonText: "Yes, delete it!",
                      closeOnConfirm: false
                    },
                      function(isConfirm) {
                        if (isConfirm)
                        {
                          $.ajax({
                             type:'POST',
                             data: {del:del},
                             url:'includes/deleteProject.php',


                             success: function(data){
                                    swal("Deleted!", "Your project been deleted.", "success");
                                    oTable.fnDeleteRow(nRow);
                                  }

                                }) ;
                        }



                       });
                    });


                            table3.on('click', '.delete', function (e) {
                                e.preventDefault();
                                var nRow = $(this).parents('tr')[0];

                                var del = $(this).closest("tr").find(".id").text();

                                swal({
                                    title: "Are you sure?",
                                    text: "Your project will be deleted.",
                                    type: "warning",
                                    showCancelButton: true,
                                    confirmButtonClass: "btn-danger",
                                    confirmButtonText: "Yes, delete it!",
                                    closeOnConfirm: false
                                  },
                                    function(isConfirm) {
                                      if (isConfirm)
                                      {
                                        $.ajax({
                                           type:'POST',
                                           data: {del:del},
                                           url:'includes/deleteProject.php',


                                           success: function(data){
                                                  swal("Deleted!", "Your project been deleted.", "success");
                                                  oTable.fnDeleteRow(nRow);
                                                }

                                              }) ;
                                      }



                                     });
                                  });

$(document).on( 'click','.delete_dataset',function(){
              // table.on('click', '.delete2', function (e) {
                  // e.preventDefault();
                  // var nRow = $(this).parents('tr')[0];

                  // var del = $(this).closest("tr").find(".id").text();
                  var del = $(this)[0].id;

                  swal({
                      title: "Are you sure?",
                      text: "The dataset will be deleted.",
                      type: "warning",
                      showCancelButton: true,
                      confirmButtonClass: "btn-danger",
                      confirmButtonText: "Yes, delete it!",
                      closeOnConfirm: false
                    },
                      function(isConfirm) {
                        if (isConfirm)
                        {
                          $.ajax({
                             type:'POST',
                             data: {del:del},
                             url:'includes/deleteDataSet.php',


                             success: function(data){
                               swal({title:"Deleted!",
                               text:"Your dataset been deleted.",
                               type:"success",
                               showConfirmButton: false,
                               timer:1500});
                               // oTable.fnDeleteRow(nRow);


                               if(window.location.href =="http://136.145.54.38/~catec/firecollect_ts/backend/fc-projects/data_sets.php" ){
                                 replaceElement(".shared_table ");
                                 replaceElement(".trash_table ");
                                 replaceElement(".dataset_table ");
                                 

                               }
                               else {
                                 window.location.replace('data_sets.php');
                               }
                               // $(".dataset_table").addClass("active");
                                    // oTable.fnDeleteRow(nRow);
                                  }

                                }) ;
                        }



                       });
                    });

                    table2.on('click', '.delete2', function (e) {
                        e.preventDefault();
                        var nRow = $(this).parents('tr')[0];

                        var del = $(this).closest("tr").find(".id").text();

                        swal({
                            title: "Are you sure?",
                            text: "This will remove the data set.",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonClass: "btn-danger",
                            confirmButtonText: "Yes, delete it!",
                            closeOnConfirm: false
                          },
                            function(isConfirm) {
                              if (isConfirm)
                              {
                                $.ajax({
                                   type:'POST',
                                   data: {del:del},
                                   url:'includes/deleteDataSet.php',


                                   success: function(data){
                                          swal("Deleted!", "Your imaginary file has been deleted.", "success");
                                          oTable.fnDeleteRow(nRow);
                                        }

                                      }) ;
                              }



                             });
                          });

                          table3.on('click', '.delete2', function (e) {
                              e.preventDefault();
                              var nRow = $(this).parents('tr')[0];

                              var del = $(this).closest("tr").find(".id").text();

                              swal({
                                  title: "Are you sure?",
                                  text: "This will remove the data set.",
                                  type: "warning",
                                  showCancelButton: true,
                                  confirmButtonClass: "btn-danger",
                                  confirmButtonText: "Yes, delete it!",
                                  closeOnConfirm: false
                                },
                                  function(isConfirm) {
                                    if (isConfirm)
                                    {
                                      $.ajax({
                                         type:'POST',
                                         data: {del:del},
                                         url:'includes/deleteDataSet.php',


                                         success: function(data){
                                                swal("Deleted!", "Your imaginary file has been deleted.", "success");
                                                oTable.fnDeleteRow(nRow);
                                              }

                                            }) ;
                                    }



                                   });
                                });



        table.on('click', '.cancel', function (e) {
            e.preventDefault();
            if (nNew) {
                oTable.fnDeleteRow(nEditing);
                nEditing = null;
                nNew = false;
            } else {
                restoreRow(oTable, nEditing);
                nEditing = null;
            }
        });

        table.on('click', '.edit', function (e) {
            e.preventDefault();
            nNew = false;

            /* Get the row as a parent of the link that was clicked on */
            var nRow = $(this).parents('tr')[0];

            if (nEditing !== null && nEditing != nRow) {
                /* Currently editing - but not this row - restore the old before continuing to edit mode */
                restoreRow(oTable, nEditing);
                editRow(oTable, nRow);
                nEditing = nRow;
            } else if (nEditing == nRow && this.innerHTML == "Save") {
                /* Editing this row and want to save it */
                saveRow(oTable, nEditing);
                nEditing = null;
                alert("Updated! Do not forget to do some ajax to sync with backend :)");
            } else {
                /* No edit in progress - let's start one */
                editRow(oTable, nRow);
                nEditing = nRow;
            }
        });
    }

    return {

        //main function to initiate the module
        init: function () {
            handleTable();
        }

    };

}();

jQuery(document).ready(function() {
    TableDatatablesEditable.init();
});

function replaceElement(element) {
    //retrieve updated table and replace it with the current one
    $.get(String(window.location.href), function (loaded_data) {
        loaded_data = $(loaded_data).find(element);
        $(element).closest(".dataTables_wrapper").replaceWith(loaded_data);
    // activate datatable functionality
        $(element  ).dataTable( {
           aaSorting:[], 'searching': true,
          'lengthMenu': [[20, 50, 100, 200, -1],[20, 50, 100,200, "All"]]
        });
      });
}
