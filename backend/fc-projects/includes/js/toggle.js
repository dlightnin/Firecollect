

$('#project_status').click(function () {
if($('button span').hasClass('fa-eye-slash'))
{   $(".eyeToggle").remove();
$('#project_status').html('<span style="font-size:30px; padding: 10px 0;" class="eyeToggle fa fa-eye"></span><input type="hidden" name="status" value="1">');

}
else
{   $(".eyeToggle").remove();

    $('#project_status').html('<span style="font-size:30px; padding: 10px 0;" class="eyeToggle fa fa-eye-slash" ></span><input type="hidden" name="status" value="0"> ');

}
});

$("#project_status").hover(function(){
        $(this).css("background-color", "#ddd");
        }, function(){
        $(this).css("background-color", "white");
    });
