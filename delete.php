<?php

/*Var de autenticação*/
include './keys/apiData.php';

/*info cartões*/
$url="https://api.trello.com/1/";
$dataType="cards/";
$dataId=$_GET['ticket'];
$requestURL = $url.$dataType.$dataId.'?key='.$api_key.'&token='.$token;
$requestType = "DELETE";
$ch = curl_init();

curl_setopt($ch, CURLOPT_HTTPHEADER, Array(
    "Accept: application/json",
    "Authorization: Bearer {$token}"
)); 
curl_setopt($ch, CURLOPT_URL, $requestURL);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $requestType);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch); 
$result = json_decode($result);
curl_close($ch);

header("Location: ./ticket.php");
exit();

?>