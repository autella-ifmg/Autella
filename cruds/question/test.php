<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autella | Visualizar questão</title>
    <link rel="stylesheet" href="../../libraries/bootstrap/bootstrap.css">
    <?php
    //Inicia a sessão.
    session_start();
    //var_dump($_SESSION);

    require_once "readSQL.php";
    //Inclui as funções presentes no arquivo dbSelect.
    require_once "../../utilities/dbSelect.php";

    //Obtém o cargo do usuário que está logado no momento.
    $id_role = $_SESSION["userData"]["id_role"];
    //Obtém o id do usuário que está logado no momento.
    $id_user = $_SESSION["userData"]["id"];
    //Obtém o id da disciplina correspondente ao usuário que está logado no momento.
    $id_discipline = $_SESSION["userData"]["id_discipline"];
    //var_dump($id_discipline);

    $array = questionsDiscipline($id_user);
    //var_dump($array);

    $rowsQuant = selectRowsQuantTableQuestion($id_discipline);
    //var_dump($rowsQuant);
    ?>
</head>

<body>
    <!--Inclui a navbar-->
    <?php require_once '../../views/navbar.php'; ?>

    <section class="d-flex justify-content-center mt-3">
        <div class="d-flex flex-column">
            <div class="d-flex flex-row justify-content-center mb-2">
                <!--Select das disciplinas-->
                <div id="container_selectDisciplines" class="w-25 mr-3" hidden>
                    <label id="labelDisciplines" for="disciplines" class="mt-1 mr-2">Disciplina:</label>
                    <select name="disciplines" id="disciplines" class="form-control" required>
                        <option value=0></option>
                        <?php
                        disciplineNames($id_discipline, 0);
                        ?>
                    </select>
                </div>

                <div class="w-25">
                    <!--Botão para criar questões-->
                    <a href="createGUI.php" type="button" class="w-50 btn btn-primary mr-2">Criar questão</a>
                </div>
            </div>

            <form method="post">
                <div class="d-flex flex-column">
                    <?php
                    if ($rowsQuant > 0) {
                        for ($i = 0; $i < $rowsQuant; $i++) {
                            $questionNumber = "Nº: " . ($i + 1);
                            $dificulty = dificultyTratament($array[$i]["dificulty"]);
                            $discipline_subject =  disciplineNames($id_discipline, 1) . subjectNamesToRead($array[$i]["id_subject"]);
                            $date = dateTratament($array[$i]["date"]);
                            $enunciate =  $array[$i]["enunciate"];
                            $correctAnswer = "Alternativa correta: " . $array[$i]["correctAnswer"];

                            echo '<div class="d-flex flex-row bd-highlight">
                                    <div class="p-2 flex-fill bd-highlight border border-dark">' . $questionNumber . '</div>
                                    <div class="p-2 flex-fill bd-highlight border border-dark border-left-0">' . $dificulty . '</div>
                                    <div class="p-2 w-25 bd-highlight border border-dark border-left-0">' . $correctAnswer  . '</div>
                                    <div class="p-2 w-50 bd-highlight border border-dark border-left-0">' . $discipline_subject . '</div>
                                  </div>

                                 <div class="d-flex flex-row">
                                    <div class="p-2 flex-fill bd-highlight border border-dark border-top-0">' . $date . '</div>
                                    <div class="p-2 w-75 bd-highlight border border-dark border-left-0 border-top-0">Inclusa em: Global1, Prova do César, Global3</div>';
                            if ($id_role == 1) {
                                echo
                                    '<div class="p-2 flex-fill bd-highlight border border-dark border-left-0 border-top-0"> <img src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/pencil-square.svg" width="25" height="25" onclick="edit()"/></div>';
                            } elseif ($array[$i][2] == $id_user) {
                                echo
                                    '<div class="p-2 flex-fill bd-highlight border border-dark border-left-0 border-top-0"> <img src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/pencil-square.svg" width="25" height="25" onclick="edit()"/></div>';
                            }

                            echo
                                '</div>

                                 <div name="toolbar' . $i . '" id="toolbar-container' . $i . '" class="border border-dark border-top-0 border-bottom-0" disabled></div>
                                 <div name="editor' . $i . '" id="editor' . $i . '" class="border border-dark border-top-0" style="min-width: 65rem; max-width: 65rem; min-height: 20rem; max-height: 20rem;">' . $enunciate . '</div>';
                        }
                    }
                    ?>
                </div>
            </form>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        /*
        function requestCreate() {
            try {
                request = new XMLHttpRequest();
            } catch (currentIE) {

                try {
                    request = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (oldIE) {

                    try {
                        request = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (erro) {
                        request = false;
                    }
                }
            }

            if (!request)
                alert("Seu Navegador não suporta Ajax!");
            else
                return request;
        }

        function getDisciplineId() {

            // Declaração de Variáveis
            var xmlreq = requestCreate();

            var selectDiscipline = document.getElementById("disciplines");
            selectDiscipline = selectDiscipline.value;
            console.log(selectDiscipline);
            var container = document.getElementById("container");

            var invisibleDiv = document.createElement("div");
            //invisibleDiv.setAttribute("style", "display: none");
            container.appendChild(invisibleDiv);

            //Exibi a imagem de progresso
            invisibleDiv.innerHTML = '<img src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/arrow-repeat.svg"/>';

            // Iniciar uma requisição
            xmlreq.open("GET", "test.php?id_discipline=" + selectDiscipline, true);

            // Atribui uma função para ser executada sempre que houver uma mudança de dado
            xmlreq.onreadystatechange = function() {

                // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
                if (xmlreq.readyState == 4) {

                    // Verifica se o arquivo foi encontrado com sucesso
                    if (xmlreq.status == 200 && xmlreq.status != 304) {
                        invisibleDiv.innerHTML = "Success!";


                    } else {
                        invisibleDiv.innerHTML = "Erro: " + xmlreq.statusText;
                    }
                }
            };
            xmlreq.send();
        }
        */

        document.querySelector("#disciplines").addEventListener("onchange", () => {
            var selectDiscipline = document.getElementById("disciplines").value;
            var req = this.createXMLHTTPObject();
            if (!req) return;
            var url = 'http://autella.com/cruds/question/readSQL.php?id_discipline = ' + selectDiscipline;
            req.open('GET', url, true);
            req.onreadystatechange = function() {
                if (req.readyState != 4) {
                    return;
                }
                if (req.status != 200 && req.status != 304) {
                    alert('HTTP error ' + req.status);
                    return;
                }


                alert('ok');
            }
            if (req.readyState == 4) return;
            req.send();


        });
    </script>

    <script>
        <?php
        if ($id_role == 1) {
            echo
                'var div = document.getElementById("container_selectDisciplines");
               
                div.removeAttribute("hidden");';
        }
        ?>
    </script>

    <!--Importações do Bootstrap-->
    <script src="../../libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="../../libraries/bootstrap/bootstrap.bundle.js"></script>

    <!--Importação do CkEditor-->
    <script src="../../libraries/ckeditor5/ckeditor.js"></script>
    <script>
        <?php
        if ($rowsQuant > 0) {
            for ($i = 0; $i < $rowsQuant; $i++) {
                echo '
                DecoupledEditor
                .create(document.querySelector("#editor' . $i . '"))
                .then(editor' . $i . ' => {
                    const toolbarContainer' . $i . ' = document.querySelector("#toolbar-container' . $i . '");

                    toolbarContainer' . $i . '.appendChild(editor' . $i . '.ui.view.toolbar.element);

                    editor' . $i . '.isReadOnly = true;
                })
                .catch(error' . $i . ' => {
                    console.error' . $i . '(error' . $i . ');
                });
                
                ';
            }
        }
        ?>
    </script>
</body>

</html>