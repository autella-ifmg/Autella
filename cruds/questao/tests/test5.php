<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test 5</title>
    <link rel="stylesheet" href="../../../libraries/bootstrap/bootstrap.css">
    <?php
    //Inicia a sessão.
    session_start();

    //Inclui as funções presentes no arquivo dbSelect.
    require_once "../../../utilities/dbSelect.php";

    //Obtém o id do usuário que está logado no momento.
    $id_user = $_SESSION["userData"]["id"];
    //Obtém o id da disciplina correspondente ao usuário que está logado no momento.
    $id_discipline = $_SESSION["userData"]["id_discipline"];

    $array = selectDisciplineQuestions($id_discipline);
    //var_dump($array);

    $rowsQuant = selectRowsQuantTableQuestion($id_discipline);
    //var_dump($rowsQuant);
    ?>
</head>

<body>
    <section class="d-flex justify-content-center mt-3">
        <div class="d-flex flex-column">
            <div class="d-flex flex-row bd-highlight">
                <div class="p-2 flex-fill bd-highlight border border-dark">Nº: 0</div>
                <div class="p-2 flex-fill bd-highlight border border-dark border-left-0">Fácil</div>
                <div class="p-2 w-75 bd-highlight border border-dark border-left-0">Teste - Teste</div>
            </div>

            <div class="d-flex flex-row">
                <div class="p-2 flex-fill bd-highlight border border-dark border-top-0">Data de Criação: 00/00/0000</div>
                <div class="p-2 w-75 bd-highlight border border-dark border-left-0 border-top-0">Inclusa em: Teste1, Teste2 e Teste3</div>
            </div>

            <div>
                <div name="toolbar" id="toolbar-container" class="border border-dark border-top-0 border-bottom-0"></div>
                <div name="editor" id="editor" class="w-100 border border-dark border-bottom-0" style="min-width: 60rem; max-width: 65rem;  min-height: 20rem; max-height: 20rem; resize: none;"></div>
            </div>
            <div class="d-flex justify-content-end border border-dark border-top-0">
                <img src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/pencil-square.svg" width="50" height="50" onclick="edit()"/>
            </div>
            <div id="correctAnswer" class="border border-dark border-top-0 mb-5">
                <div class="d-flex flex-row justify-content-center mt-2">
                    <img src="../../../images/alternatives/A.png" alt="A" class="rounded-circle mr-1 mb-3" style="background-color: powderblue;" data-toggle="modal" data-target="#staticBackdrop">
                    <textarea name="question" id="question" cols="90" rows="3" class="ml-1 mb-3" style="resize: none;"></textarea>
                </div>
            </div>
        </div>
    </section>
    <!--
    
-->
    <section class="d-flex justify-content-center mt-3">
        <div class="d-flex flex-column">
            <div class="d-flex flex-row bd-highlight">
                <div class="p-2 flex-fill bd-highlight border border-dark">Nº: 0</div>
                <div class="p-2 flex-fill bd-highlight border border-dark border-left-0">Fácil</div>
                <div class="p-2 w-75 bd-highlight border border-dark border-left-0">Teste - Teste</div>
            </div>

            <div class="d-flex flex-row">
                <div class="p-2 flex-fill bd-highlight border border-dark border-top-0">Data de Criação: 00/00/0000</div>
                <div class="p-2 w-75 bd-highlight border border-dark border-left-0 border-top-0">Inclusa em: Teste1, Teste2 e Teste3</div>
            </div>

            <textarea name="enunciate" id="enunciate" cols="140" class="border border-dark border-top-0" style="height: 20rem; resize: none;" readonly="true">Enunciado</textarea>
            <div id="correctAnswer" class="border border-dark border-top-0 mb-5">
                <div class="d-flex flex-row justify-content-center mt-2">
                    <img src="../../../images/alternatives/A.png" alt="A" class="rounded-circle mr-1 mb-3" style="background-color: powderblue;">
                    <textarea name="question" id="question" cols="90" rows="3" class="ml-1 mb-3" style="resize: none;" readonly="true"></textarea>
                </div>
            </div>
        </div>
    </section>

    <!--Inclui a navbar-->
    <?php require_once '../../../views/navbar.php'; ?>

    <section class="d-flex justify-content-center mt-3">
        <div class="d-flex flex-column">
            <?php
            for ($i = 0; $i < $rowsQuant; $i++) {
                $questionNumber = "Nº: " . ($i + 1);

                $discipline_subject =  disciplineNameToUpdate($id_discipline) . subjectNamesToUpdate($array[$i]["id_subject"]);

                $date = $array[$i]["date"];
                $date = strtotime($date);
                $date = "Data de criação: " . date("d/m/Y", $date);

                echo
                    '<div class="d-flex flex-row bd-highlight">
                        <div class="p-2 flex-fill bd-highlight border border-dark">' . $questionNumber . '</div>
                        <div class="p-2 flex-fill bd-highlight border border-dark border-left-0">' . $array[$i]["id"] . '</div>
                        <div class="p-2 w-75 bd-highlight border border-dark border-left-0">' . $discipline_subject . '</div>
                    </div>

                    <div class="d-flex flex-row">
                        <div class="p-2 flex-fill bd-highlight border border-dark border-top-0">' . $date . '</div>
                        <div class="p-2 w-75 bd-highlight border border-dark border-left-0 border-top-0">Inclusa em: Global1, Prova do César, Global3</div>
                    </div>';


                if ($array[$i][2] == $id_user) {
                    echo
                        '<div name="toolbar' . $i . '" id="toolbar-container' . $i . '" class="border border-dark border-top-0 border-bottom-0" disabled></div>
                        <div name="editor' . $i . '" id="editor' . $i . '" style="height: 20rem; border: 1px solid black;" onclick="editIcon()">' . $array[$i]["enunciate"] . '</div>
                        <div id="correctAnswer" class="border border-dark border-top-0 mb-5">
                            <div class="d-flex flex-row justify-content-center mt-2">
                                <img src="../../../images/alternatives/' . $array[$i]["correctAnswer"] . '.png" alt="A" class="rounded-circle mr-1 mb-3" style="background-color: powderblue;" data-toggle="modal" data-target="#staticBackdrop">
                                <textarea name="question' . $array[$i]["correctAnswer"] . '" id="question' . $array[$i]["correctAnswer"] . '" cols="90" rows="3" class="ml-1 mb-3" style="resize: none;" readonly="false"></textarea>
                            </div>
                        </div>';
                } else {
                    echo
                        '<textarea name="enunciate" id="enunciate" cols="139" class="border border-dark border-top-0" style="height: 20rem; resize: none;" readonly="true">' . $array[$i]["enunciate"] . '</textarea>
                        <div id="correctAnswer" class="border border-dark border-top-0 mb-5">
                            <div class="d-flex flex-row justify-content-center mt-2">
                                <img src="../../../images/alternatives/' . $array[$i]["correctAnswer"] . '.png" alt="A" class="rounded-circle mr-1 mb-3" style="background-color: powderblue;">
                                <textarea cols="90" rows="3" class="ml-1 mb-3" style="resize: none;" readonly="true"></textarea>
                            </div>
                        </div>';
                }
            }
            ?>
        </div>
    </section>

    </form>
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

    <!--Importações do Bootstrap-->
    <script src="../../../libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="../../../libraries/bootstrap/bootstrap.bundle.js"></script>

    <!--Importação do CkEditor-->
    <script src="https://cdn.ckeditor.com/ckeditor5/23.1.0/decoupled-document/ckeditor.js"></script>

    <script>
        <?php
        for ($i = 0; $i < $rowsQuant; $i++) {
            if ($array[$i][2] == $id_user) {
                echo
                    'DecoupledEditor
                    .create(document.querySelector("#editor' . $i . '"))
                    .then(editor => {
                        const toolbarContainer = document.querySelector("#toolbar-container' . $i . '");

                        toolbarContainer.appendChild(editor.ui.view.toolbar.element);
                    })
                    .catch(error => {
                        console.error(error' . $i . ');
                    });';
            }
        }
        ?>
    </script>

    <script>
        DecoupledEditor
            .create(document.querySelector('#editor'), {
                placeholder: 'Insira o enunciado...'
            })
            .then(editor => {
                const toolbarContainer = document.querySelector('#toolbar-container');

                toolbarContainer.appendChild(editor.ui.view.toolbar.element);
            })
            .catch(error => {
                console.error(error);
            });

        function edit() {
            console.log("teste")
            editor = document.getElementById("editor");
            editor.remove("readonly");
        }
    </script>

</body>

</html>