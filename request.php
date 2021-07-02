<?php

/*Var de autenticação*/
$api_key="6cb2449ef416f281ef017d966323e4c1";
$token="e2dea2395dbbc2735c157a3567e8342e6566cb3f19986b35dff90f6b87c102fe";

/*Get cartões*/
$url="https://api.trello.com/1/";
$dataType="boards/";
$dataId="GiuUlLAF/cards";

$requestURL = $url.$dataType.$dataId.'?key='.$api_key.'&token='.$token;

$requestType = "GET";
$ch = curl_init();

curl_setopt($ch, CURLOPT_HTTPHEADER, Array(
    "Accept: application/x.vc.v2+json",
    "Authorization: Bearer {$token}"
)); 
curl_setopt($ch, CURLOPT_URL, $requestURL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $requestType);
curl_setopt($ch, CURLOPT_POST, 1);

$result = curl_exec($ch); 
$result = json_decode($result);
curl_close($ch); 

/*
foreach($result as $var){
    print_r ("<table>
                <tr>
                    <th>Cartão</th>
                    <th>Atividade</th>
                </tr>
                <tr>
                    <td>{$var->id}</td>
                    <td>{$var->dateLastActivity}<td>
                </tr>
            </table>
    ");
}
*/



?>