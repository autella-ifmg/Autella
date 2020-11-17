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

    $array = questionsDiscipline($id_discipline);
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
                <div class="mr-3">
                    <label id="labelDisciplines" for="disciplines" class="text-muted mt-1 mr-2">Disciplina:</label>
                    <select name="disciplines" id="disciplines" class="form-control" disabled required>
                        <option value=0></option>
                        <?php
                        disciplineNamesToDdIs_Read(0);
                        ?>
                    </select>
                </div>
            </div>

            <form method="post">
                <div class="d-flex flex-column">
                    <?php
                    if ($rowsQuant > 0) {
                        for ($i = 0; $i < $rowsQuant; $i++) {
                            $questionNumber = "Nº: " . ($i + 1);
                            $dificulty = dificultyTratament($array[$i]["dificulty"]);
                            $discipline_subject =  disciplineNamesToDdIs_Read($id_discipline) . subjectNamesToRead($array[$i]["id_subject"]);
                            $date = dateTratament($array[$i]["date"]);
                            $enunciate =  $array[$i]["enunciate"];
                            $correctAnswer = $array[$i]["correctAnswer"];
                            $correctAnswerEnunciate = $array[$i]["correctAnswerEnunciate"];

                            echo '<div class="d-flex flex-row bd-highlight">
                                    <div class="p-2 flex-fill bd-highlight border border-dark">' . $questionNumber . '</div>
                                    <div class="p-2 flex-fill bd-highlight border border-dark border-left-0">' . $dificulty . '</div>
                                    <div class="p-2 w-75 bd-highlight border border-dark border-left-0">' . $discipline_subject . '</div>
                                 </div>

                                 <div class="d-flex flex-row">
                                    <div class="p-2 flex-fill bd-highlight border border-dark border-top-0 border-bottom-0">' . $date . '</div>
                                    <div class="p-2 w-75 bd-highlight border border-dark border-left-0 border-top-0 border-bottom-0">Inclusa em: Global1, Prova do César, Global3</div>';

                            if ($id_role == 0) {
                                echo
                                    '<div class="p-2 flex-fill bd-highlight border border-dark border-left-0 border-top-0 border-bottom-0"> <img src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/pencil-square.svg" width="25" height="25" onclick="edit()"/></div>';
                            } elseif ($array[$i][2] == $id_user) {
                                echo
                                    '<div class="p-2 flex-fill bd-highlight border border-dark border-left-0 border-top-0 border-bottom-0"> <img src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/pencil-square.svg" width="25" height="25" onclick="edit()"/></div>';
                            }
                            echo
                                '</div>

                                <div name="toolbar' . $i . '" id="toolbar-container' . $i . '" class="border border-dark border-top-0 border-bottom-0" disabled></div>
                                <div name="editor' . $i . '" id="editor' . $i . '" style="min-width: 65rem; max-width: 65rem;  min-height: 20rem; max-height: 20rem; border: 1px solid gray;">' . $enunciate . '</div>

                                <div id="correctAnswer" class="border border-dark border-top-0 mb-5">
                                    <div class="d-flex flex-row justify-content-center mt-2">
                                        <img src="../../../images/alternatives/' . $correctAnswer . '.png" alt="' . $correctAnswer . '" class="bg-info rounded-circle mr-1 mb-3"/>
                                        <textarea cols="110" rows="3" class="ml-1 mb-3" style="resize: none;" readonly>' . $correctAnswerEnunciate . '</textarea>
                                    </div>
                                </div>';
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
        <?php
        if ($id_role == 0) {
            echo
                'var label = document.getElementById("labelDisciplines");
                var selectDiscipline = document.getElementById("disciplines");

                label.removeAttribute("class");
                label.setAttribute("class", "mt-1 mr-2");

                selectDiscipline.removeAttribute("disabled");';
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