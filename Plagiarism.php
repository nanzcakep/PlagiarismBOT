<?php

error_reporting(E_ERROR);
function request($text)
{
    $data = '{"text":"' . $text . '","pos":0,"_session_code":"8f859190-25b0-11ec-9e3c-adb6a8d02217"}';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.plagium.com/ajax/search/query");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $headers = array();
    $headers[] = "Cookie: plagium-session0218=s%3AtpJlWTem9IhUtu_XZVQBy02PRp_mzIml.spSkZRoq6156rzmCGcSe3e9Bn0lXred4NkmRyVADQ0c;";
    $headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.61 Safari/537.36";
    $headers[] = "Accept: */*";
    $headers[] = "Accept-Language: en-US,en;q=0.9,id;q=0.8";
    $headers[] = "Accept-Encoding: gzip, deflate, br";
    $headers[] = "Host: www.plagium.com";
    $headers[] = "Origin: https://www.plagium.com";
    $headers[] = "Content-Type: application/json";
    $headers[] = "X-Requested-With: XMLHttpRequest";

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HEADER, 1);

    curl_setopt($ch, CURLOPT_ENCODING, "GZIP");
    $exec = curl_exec($ch);
    return $exec;
    curl_close($ch);
}

function getstr($str, $exp1, $exp2)
{
    $a = explode($exp1, $str)[1];
    return explode($exp2, $a)[0];
}

echo "Text : ";
$text = trim(fgets(STDIN));



$plag = request($text);
if (strpos($plag, 'OK') !== false) {
    $result = getstr($plag, '"url":"', '"');
    echo "\n\n Result : $result\n";
} else {
    echo $plag;
    echo "Error plag\n";
}
