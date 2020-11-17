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

    //Inclui as funções presentes no arquivo dbSelect.
    require_once "../../utilities/dbSelect.php";

    //Obtém o id do usuário que está logado no momento.
    $id_user = $_SESSION["userData"]["id"];
    //Obtém o id da disciplina correspondente ao usuário que está logado no momento.
    $id_discipline = $_SESSION["userData"]["id_discipline"];

    $role = selectRoles();

    $array = selectDisciplineQuestions($id_discipline);
    //var_dump($array);

    $rowsQuant = selectRowsQuantTableQuestion($id_discipline);
    //var_dump($rowsQuant);

    ?>
</head>

<body">
    <!--Inclui a navbar-->
    <?php require_once '../../views/navbar.php'; ?>

    <form action="updateSQL.php" method="post">
        <section class="d-flex justify-content-center mt-3">
            <div class="d-flex flex-column">
                <?php
                for ($i = 0; $i < $rowsQuant; $i++) {
                    $questionNumber = "Nº: " . ($i + 1);

                    $dificulty = $array[$i]["dificulty"];
                    switch ($dificulty) {
                        case 1:
                            $dificulty = "Nível: Fácil";
                            break;
                        case 2:
                            $dificulty = "Nível: Médio";
                            break;
                        default:
                            $dificulty = "Nível: Difícil";
                            break;
                    }


                    $discipline_subject =  disciplineNameToUpdate($id_discipline) . subjectNamesToUpdate($array[$i]["id_subject"]);

                    $date = $array[$i]["date"];
                    $date = strtotime($date);
                    $date = "Data de criação: " . date("d/m/Y", $date);

                    $enunciate =  $array[$i]["enunciate"];
                    $correctAnswer = $array[$i]["correctAnswer"];
                    $correctAnswerEnunciate = $array[$i]["correctAnswerEnunciate"];

                    echo '<div class="d-flex flex-row bd-highlight">
                        <div class="p-2 flex-fill bd-highlight border border-dark">' . $questionNumber . '</div>
                        <div class="p-2 flex-fill bd-highlight border border-dark border-left-0">' . $dificulty . '</div>
                        <input type="text" class="p-2 w-75 bd-highlight border border-dark border-left-0" value="' . $discipline_subject . '"></input>
                    </div>

                    <div class="d-flex flex-row">
                        <div class="p-2 flex-fill bd-highlight border border-dark border-top-0">' . $date . '</div>
                        <div class="p-2 w-75 bd-highlight border border-dark border-left-0 border-top-0">Inclusa em: Global1, Prova do César, Global3</div>
                    </div>';

                    if ($array[$i][2] == $id_user) {
                        echo '<div name="toolbar' . $i . '" id="toolbar-container' . $i . '" class="border border-dark border-top-0 border-bottom-0"></div>
                        <div name="editor' . $i . '" id="editor' . $i . '" style="height: 20rem; border: 1px solid black;">' . $enunciate . '</div>
                        <div id="correctAnswer" class="border border-dark border-top-0 mb-5">
                            <div class="d-flex flex-row justify-content-center mt-2">
                                <img src="../../../images/alternatives/' . $correctAnswer . '.png" alt="' . $correctAnswer . '" class="bg-info rounded-circle mr-1 mb-3" data-toggle="modal" data-target="#staticBackdrop">
                                <textarea name="question' . $correctAnswer . '" id="question' . $correctAnswer . '" cols="110" rows="3" class="ml-1 mb-3" style="resize: none;">' . $correctAnswerEnunciate . '</textarea>
                            </div>
                        </div>';
                    } else {
                        echo '<textarea name="txtEnunciate" id="txtEnunciate" cols="139" class="border border-dark border-top-0" style="height: 20rem; resize: none;" readonly>' . $enunciate . '</textarea>
                        <div id="correctAnswer" class="border border-dark border-top-0 mb-5">
                            <div class="d-flex flex-row justify-content-center mt-2">
                                <img src="../../../images/alternatives/' . $correctAnswer . '.png" alt="' . $correctAnswer . '" class="bg-info rounded-circle mr-1 mb-3">
                                <textarea cols="110" rows="3" class="ml-1 mb-3" style="resize: none;" readonly>' . $correctAnswerEnunciate . '</textarea>
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
    <script src="../../libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="../../libraries/bootstrap/bootstrap.bundle.js"></script>

    <!--Importação do CkEditor-->
    <script src="../../libraries/ckeditor5/ckeditor.js"></script>
    <script>
        <?php
        for ($i = 0; $i < $rowsQuant; $i++) {
            if ($array[$i][2] == $id_user) {
                echo 'DecoupledEditor
                .create(document.querySelector("#editor' . $i . '"))
                .then(editor => {
                    const toolbarContainer = document.querySelector("#toolbar-container' . $i . '");

                    toolbarContainer.appendChild(editor.ui.view.toolbar.element);

                    editor' . $i . '.isReadOnly = true;
                })
                .catch(error => {
                    console.error(error' . $i . ');
                });';
            }
        }
        ?>
    </script>
    </body>

</html>