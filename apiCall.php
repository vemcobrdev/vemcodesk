<?php

include './keys/apiData.php';
$url="https://api.trello.com/1/";
$board="GiuUlLAF"; /*$dataId=$_GET['board']*/
$dataId="5f43bc41232f201307c6adf7"; /*$dataId=$_GET['ticket']*/

/* Case Switch instruções
1 - Deletar tickets
2 - Carregar histórico
3 - Carregar tickets do quadro
4 - Postar ação em ticket
*/

$id="4";
switch ($id){
    case "1":
        $requestURL = $url.'cards/'.$dataId.'/?key='.$api_key.'&token='.$token;
        $requestType = "DELETE";
        break;
    case "2":
        $requestURL = $url.'cards/'.$dataId.'/actions?key='.$api_key.'&token='.$token;
        $requestType = "GET";
       break;
    case "3":
        $requestURL = $url.'boards/'.$board.'/cards?key='.$api_key.'&token='.$token;
        $requestType = "GET";
        break;
    case "4":
        $requestURL = $url.'cards/'.$dataId.'/actions/comments'.'?key='.$api_key.'&token='.$token;
        $requestType = "POST";
        break;
}

print_r($requestURL);

function allCall() {

/* cURL requests */
    global $requestURL, $requestType, $id, $text, $dataId, $token;

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HTTPHEADER, Array(
        "Accept: application/x.vc.v2+json",
        "Authorization: Bearer {$token}"
    )); 
    curl_setopt($ch, CURLOPT_URL, $requestURL);        
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $requestType);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    switch ($id){
        case "4":
            curl_setopt($ch, CURLOPT_POSTFIELDS, "text=$text&id=$dataId");
            break;
        }
    $result = curl_exec($ch); 
    $result = json_decode($result);
    curl_close($ch);
    }

    /* Ação final */
    switch ($id){
        case "1":
            header("Location: ./ticket.php");
            exit();
            break;
        case "2":
            foreach($result as $var){
                print_r ("<tr>
                    <td><a href='./anotacao.php?ticket=$var->id'>{$var->name}</a></td>
                    <td>{$var->idList}</td>
                    <td>Douglas William</td>
                    <td>Cliente</td>
                    <td>{$var->dateLastActivity}</td>
                    <td><a href='./editor.php?ticket=$var->id'>Editar</a>
                    <a href='./delete.php?ticket=$var->id' onclick=\"return confirm('Deseja excluir esse ticket? Não há como reverter essa ação!'); return false;\">Apagar</a></td>
                </tr>
                ");
            };
            break;
        case "4":
            
            break;
    }
?>