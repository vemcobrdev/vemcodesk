<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets</title>
    <link rel="shortcut icon" href="./ico/favicon.ico" />
    <link rel="stylesheet" href="./css/tickets.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Mono&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Odibee+Sans&family=Poppins:wght@300;400&display=swap" rel="stylesheet">
    <script src="./js/index.js" defer></script>
    <script src="https://kit.fontawesome.com/5906fc9277.js" crossorigin="anonymous" defer></script>
</head>

<body>
    <header>
        <table style="width:100%">
            <tr>
                <th>
                    <a href='#' id="titulo" onclick='location.reload(true)'>
                        <span>Vemco</span><span style="color: black; background-color: white">Desk</span>
                    </a>
                </th>
                <th>
                    <a href='./index.php' id="logout">logout</a>
                </th>
            </tr>
        </table>
    </header>
    <main>

    <!-- Desclaração de funções -->
        <!-- Organizar colunas -->
    <script>
        function sortTable(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("tableTicket");
        switching = true;
        //Set the sorting direction to ascending:
        dir = "asc"; 
        /*Make a loop that will continue until
        no switching has been done:*/
        while (switching) {
            //start by saying: no switching is done:
            switching = false;
            rows = table.rows;
            /*Loop through all table rows (except the
            first, which contains table headers):*/
            for (i = 1; i < (rows.length - 1); i++) {
            //start by saying there should be no switching:
            shouldSwitch = false;
            /*Get the two elements you want to compare,
            one from current row and one from the next:*/
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            /*check if the two rows should switch place,
            based on the direction, asc or desc:*/
            if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                //if so, mark as a switch and break the loop:
                shouldSwitch= true;
                break;
                }
            } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                //if so, mark as a switch and break the loop:
                shouldSwitch = true;
                break;
                }
            }
            }
            if (shouldSwitch) {
            /*If a switch has been marked, make the switch
            and mark that a switch has been done:*/
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            //Each time a switch is done, increase this count by 1:
            switchcount ++;      
            } else {
            /*If no switching has been done AND the direction is "asc",
            set the direction to "desc" and run the while loop again.*/
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
            }
        }
        }
    </script>

    <?php
        /* Listar tickes */ 
    function ticketsCall() {

        /*Var de autenticação*/
        include './keys/apiData.php';

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
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $requestType);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch); 
        $result = json_decode($result);
        curl_close($ch);
        foreach($result as $var){
            $datan = new DateTime($var->dateLastActivity);
            $datam = $datan->format('y-m-d H:i:s');
            switch ($var->idList){
                case "5df11b05a848d0742d9f3991":
                    $lista="Novo";
                        break;
                case "5df11b05a848d0742d9f3992":
                    $lista="Em progresso";
                    break;
                case "5df11b05a848d0742d9f3993":
                    $lista="Em espera";
                    break;
                case "5df11b05a848d0742d9f3994":
                    $lista="Pendente cliente";
                    break;
                case "5df11b05a848d0742d9f3995":
                    $lista="Concluído";
                    break;
            };
            switch ($var->idMembers[0]){
                case "5b153a426aaae06a1fe099d1":
                    $membro0="Douglas William";
                    break;
                case "5e0e15a9c2f41864280c7211":
                    $membro0="Breno de Oliveira Moura";
                    break;
                case "":
                    $membro0="Sem reponsável";
                    break;
            };
            switch ($var->idMembers[1]){
                case "5b153a426aaae06a1fe099d1":
                    $membro1="Douglas William";
                    break;
                case "5e0e15a9c2f41864280c7211":
                    $membro1="Breno de Oliveira Moura";
                    break;
                case "5df7b7d43fe2b47e6dd445dc":
                    $membro1="Priscila Rodrigues";
                    break;
                case "":
                    $membro1="";
                    break;
            };
#
            print_r ("<tr>
                <td><a href='./anotacao.php?ticket=$var->id'>{$var->name}</a></td>
                <td>{$lista}</td>
                <td>{$membro0}</td>
                <td>{$membro1}</td>
                <td>{$datam}</td>
                <td><a href='./editor.php?ticket=$var->id'>Editar</a>
                <a href='./delete.php?ticket=$var->id' onclick=\"return confirm('Deseja excluir esse ticket? Não há como reverter essa ação!'); return false;\">Apagar</a></td>
            </tr>
            ");
        };
    }
    ?><span></span>
    <!-- Final das funções-->
        <form>
            <section class="btn-new">
                <a href="./editor.php" id="btn-new">Novo Chamado</a>
            </section>
            <!-- Área dos tickets -->
            <table id="tableTicket">
                <tr id="tableTitle">
                    <th style='cursor: pointer; width: 1500px' onclick="sortTable(0)">Chamado</th>
                    <th style='width: 200px'>Estado</th>
                    <th style='width: 200px'>Analista</th>                    
                    <th style='width: 160px'>Cliente</th>
                    <th style='cursor: pointer; width: 100px' onclick="sortTable(4)">Última atividade</th>
                    <th style='width: 100px'>Ações</th>
                </tr>
                <!-- request dos tickets -->
                <?php ticketsCall()?>
                <!-- fim do request -->
            </table>
        </form>

    </main>
</body>

</html>