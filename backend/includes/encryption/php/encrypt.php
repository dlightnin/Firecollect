<?php
require 'aes_fast.php' ;
require 'cryptoHelpers.php' ;

function encrypt( $plaintext, $key ){

    // Set up encryption parameters.
    $plaintext_utf8 = utf8_encode($plaintext);
    $inputData = cryptoHelpers::convertStringToByteArray($plaintext);
    $keyAsNumbers = cryptoHelpers::toNumbers(bin2hex($key));
    $keyLength = count($keyAsNumbers);
    $iv = cryptoHelpers::generateSharedKey(16);

    $encrypted = AES::encrypt(
        $inputData,
        AES::modeOfOperation_CBC,
        $keyAsNumbers,
        $keyLength,
        $iv
    );

    // Set up output format (space delimeted "plaintextsize iv cipher")
    $retVal = $encrypted['originalsize'] . " "
        . cryptoHelpers::toHex($iv) . " "
        . cryptoHelpers::toHex($encrypted['cipher']);

    return $retVal;
}

function decrypt( $input, $key ){

    // Split the input into its parts
    $cipherSplit = explode( " ", $input);
    $originalSize = intval($cipherSplit[0]);
    $iv = cryptoHelpers::toNumbers($cipherSplit[1]);
    $cipherText = $cipherSplit[2];

    // Set up encryption parameters
    $cipherIn = cryptoHelpers::toNumbers($cipherText);
    $keyAsNumbers = cryptoHelpers::toNumbers(bin2hex($key));
    $keyLength = count($keyAsNumbers);

    $decrypted = AES::decrypt(
        $cipherIn,
        $originalSize,
        AES::modeOfOperation_CBC,
        $keyAsNumbers,
        $keyLength,
        $iv
    );

    // Byte-array to text.
    $hexDecrypted = cryptoHelpers::toHex($decrypted);
    $retVal = pack("H*" , $hexDecrypted);

    return $retVal;
}

/**
 * Some simple testing code
 **/

// $key_enc = "UnDiaEnLaOficina";

 ?>
