function decrypt(input, key){

    // Split the input into its compontents
    var inputSplit = input.split(" ");
    var originalSize = parseInt(inputSplit[0]);
    var iv = cryptoHelpers.toNumbers(inputSplit[1]);
    var cipherIn = cryptoHelpers.toNumbers(inputSplit[2]);

    // Set up encryption parameters
    var keyAsNumbers = cryptoHelpers.toNumbers( bin2hex( key ) );

    var decrypted = slowAES.decrypt(
        cipherIn,
        slowAES.modeOfOperation.CBC,
        keyAsNumbers,
        iv
    );

    // Byte-array to text
    var retVal = hex2bin(cryptoHelpers.toHex(decrypted));
    retVal = cryptoHelpers.decode_utf8(retVal);

    return retVal;
}


project = decrypt(project,key_enc);




$(document).on("click","#change_permissions",function(evt) {
    var inputs = $(this).closest('.modal_tag').find(":input[type='checkbox']");
    // evt.stopPropagation();
    // evt.preventDefault();
    var Arr ;
    var Perm = [];
    for(var i = 0; i < 20; i++)
    {
      var Arr = inputs[i] ;
      if(Arr.checked)
      {
        Perm[i] = 1 ;
      }
      else {
        Perm[i] = 0;
      }
    }

    alert(Perm);


    var user = $(this).closest('.modal_tag').find("#id_enc").text() ;
    user = decrypt(user,key_enc) ;


    $.ajax({
       type:'POST',
       data: {Perm:Perm,user:user,project:project},
       url:'includes/changePermissions.php',

       success: function(data){
              console.log("yes") ;
            }

    });

});
