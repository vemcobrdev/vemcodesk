<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    function post($array) {
    $text=$array['field-description'];
    $dataId=$_GET['ticket'];
    $_url="https://api.trello.com/1/";
    $dataType="cards/";
    $dataAct="/actions/comments";
    $api_key="6cb2449ef416f281ef017d966323e4c1";
    $token="e2dea2395dbbc2735c157a3567e8342e6566cb3f19986b35dff90f6b87c102fe";
    $requestURL = $_url.$dataType.$dataId.$dataAct.'?key='.$api_key.'&token='.$token;

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HTTPHEADER, Array(
        "Accept: application/json",
        "Authorization: Bearer {$token}"
    )); 
    curl_setopt($ch, CURLOPT_URL, $requestURL);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "text=$text&id=$dataId");

    $result = curl_exec($ch); 
    $result = json_decode($result);
    curl_close($ch);
    print_r($result);
    }
    ?>
    <form action="" method="POST">
        <section class="inputs-container">
            <p>Título<input type="text" name="field-title" value="" id="field-title"></p>
            <p>Estado<select name="field-status" value="" id="field-status">
                <option value="new">Novo</option>
                <option value="working">Em andamento</option>
                <option value="waiting">Aguardando</option>
                <option value="cloded">Fechado</option>
            </p>
            <p>Descrição<input type="text" name="field-description" value="" id="field-description"></p>
            <input type="submit" name="submit" value="Submit">
        </section>
        <?php
        post($_POST)
        ?>
</body>
</html>

