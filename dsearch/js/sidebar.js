$('.md-checkbox').click(function() {
  var id = $(this).attr('id') ;
  // var val = document.getElementById(id).value ;
  $("input[name='search']")[0].value ;

  if(this.checked){
    $.ajax({
      type: "POST",
      url: 'dsearch/searchEngine.php',
      data: {variable: id},
      success: function(data) {
        alert('WO') ;
        $("#results").html(data) ;
      }

    })
  }

})


// $(document).on("click","#search",function(event){
//       event.preventDefault();
//       event.stopPropagation();
//
//
//       var search = $("input[name='search']")[0].value ;
//       // var test = "";
//       $("#results").html('') ;
//       $.ajax({
//         type: 'POST' ,
//         url: 'dsearch/searchEngine.php' ,
//         data: {variable: search},
//           success: function(data) {
//             $("#results").html(data) ;
//           }
//       });
//       $("#smsg").load(location.href+" #smsg>*");
//     });
