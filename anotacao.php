<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anotações</title>
    <link rel="shortcut icon" href="./ico/favicon.ico" />
    <link rel="stylesheet" href="./css/note.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Mono&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Odibee+Sans&family=Poppins:wght@300;400&display=swap" rel="stylesheet">
    <script src="./js/index.js?v=<?php echo time(); ?>" defer></script>
    <script src="https://kit.fontawesome.com/5906fc9277.js" crossorigin="anonymous" defer></script>
</head>

<body>
    <header>
        <table style="width:100%">
            <tr>
                <th>
                    <a href='./ticket.php' id="titulo" onclick='location.reload(true)'>
                        <span>Vemco</span><span style="color: black; background-color: white">Desk</span>
                    </a>
                </th>
                <th>
                    <a href='./index.php' id="logout" onclick='location.reload(true)'>logout</a>
                </th>
            </tr>
        </table>
    </header>
    <main>
    <!--                Inicio das Funções                -->
        <?php
        /*Var de autenticação*/
        function cardHistory(){

        include './keys/apiData.php';
        /*dados do cartão*/
        $url="https://api.trello.com/1/";
        $dataType="cards/";
        $dataId=$_GET['ticket'];
        $dataAct="/actions";

        $requestURL = $url.$dataType.$dataId.$dataAct.'?key='.$api_key.'&token='.$token;

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

        foreach($result as $var){
            $datan = new DateTime($var->date);
            $datam = $datan->format('d-m-y H:i:s');
            if(isset($var->data->text)){
                print_r ("<tr>
                    <td>{$var->memberCreator->fullName}</td>
                    <td>{$var->data->text}</td>
                    <td>{$datam}</td>
                    <td><a href='#' onclick=\"return confirm('Deseja excluir essa anotação? Não há como reverter essa ação!'); return false;\">Apagar</a></td>
                    </tr>");
                }
            }
        }
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
            curl_exec($ch);
            curl_close($ch);
            }
        ?>
        <!--                Fim das Funções                -->
        
        <form action="" method="POST">
        <span style="background-color: #b1b2f8; color: black; font-size: 1em; font-weight: 600;">Adicionar Anotação</span>
            <section class="inputs-container">
                <p>Título<input type="text" name="field-title" value="" id="field-title"></p>
                Estado<select name="field-status" value="" id="field-status">
                    <option value="new">Novo</option>
                    <option value="working">Em andamento</option>
                    <option value="waiting">Aguardando</option>
                    <option value="cloded">Fechado</option>
                
                <p>Descrição<input type="text" name="field-description" value="" id="field-description"></p>
                
            </section>
            <section class="button">
                <input type="submit" name="submit" value="Submit">
            </section>
            <section>
                <!-- Área dos tickets -->
                <p>Histórico</p>
                <table id="tableTicket">
                    <tr id="tableTitle">
                        <td style='width: 160px'>Agente</td>
                        <td>Atividade</td>
                        <td style='width: 100px'>Data</td>
                        <td>Ações</td>
                    </tr>
                <!-- request dos tickets -->
                <?php cardHistory();
                post($_POST);?>
                <!-- fim do request -->
                </table>
            </section>
        </form>
    </main>
</body>

</html>