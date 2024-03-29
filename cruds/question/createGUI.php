<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autella | Criar questão</title>
    <link rel="stylesheet" href="../../libraries/bootstrap/bootstrap.css">
    <script src="../../libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="../../libraries/bootstrap/bootstrap.bundle.js"></script>
    <script src="../../libraries/ckeditor-inline/build/ckeditor.js"></script>
    <?php
    require_once "createSQL.php";
    require_once "../../libraries/ckeditor-inline/CKEditorImport.php";
    ?>
</head>

<body>
    <!--NavBar-->
    <?php require_once '../../views/navbar.php'; ?>

    <section class="d-flex justify-content-center mt-2">
        <div class="d-flex flex-column">
            <form id="questionForm" action="createSQL.php" method="post">
                <div class="d-flex flex-row mb-2 justify-content-between">
                    <!--Select disciplina-->
                    <div id="disciplineSelection_container" class="w-25 mt-1 mr-3" hidden>
                        <label for="disciplines">Disciplina:</label>
                        <select name="disciplines" id="disciplines" class="form-control" onchange="updateSubjects()">
                            <?php selectDisciplineNamesToDropdowns(0); ?>
                        </select>
                    </div>
                    <!--Select matérias-->
                    <div class="w-25 mt-1 mr-3">
                        <label for="subjects">Matéria:</label>
                        <select name="subjects" id="subjects" class="form-control" required>
                            <!--updateSubjects()-->
                        </select>
                    </div>
                    <!--Select dificuldade-->
                    <div class="w-25 mt-1 mr-3">
                        <label for="dificulty">Dificuldade:</label>
                        <select name="dificulty" id="dificulty" class="form-control" required>
                            <option value="" disabled selected>Escolha...</option>
                            <option value="1">Fácil</option>
                            <option value="2">Média</option>
                            <option value="3">Difícil</option>
                        </select>
                    </div>
                    <!--Select alternativa correta-->
                    <div class="w-25 mt-1">
                        <label for="correctAnswer">Alternativa correta:</label>
                        <select name="correctAnswer" id="correctAnswer" class="form-control" required>
                            <option value="" disabled selected>Escolha...</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                        </select>
                    </div>
                </div>

                <hr>

                <!--Enunciado da questão-->
                <span id="enunciate_popover" class="d-flex flex-row" data-toggle="popover" data-placement="top" data-html="true" data-content='<img class="p-1 w-auto h-auto" src="../../images/question/ckeditor-warning-icon/warning.png" alt="Atenção!"> Insira o enunciado da questão.'>
                    <div id="editor0" style="min-width: 72rem; max-width: 72rem; min-height: 20rem; max-height: 20rem; border: 1px solid gray;" onclick="disablePopover('#enunciate_popover')"></div>
                </span>

                <!--Alternativas-->
                <div class="d-flex justify-content-center">
                    <div id="alternatives_container" class="d-flex flex-column mt-3"></div>
                </div>

                <hr>

                <!--Botões-->
                <div class="d-flex flex-row justify-content-around mb-5">
                    <a href="readGUI.php" type="button" class="w-25 btn btn-danger mr-2">Cancelar</a>
                    <button name="submit" id="submit" type="submit" class="w-25 btn btn-success">Criar questão</button>
                </div>
            </form>
        </div>
    </section>

    <!--Importação das funções .js utilizadas nessa página-->
    <script src="../../utilities/jsFunctions/question/verifications.js"></script>
    <script src="../../utilities/jsFunctions/question/selects.js"></script>
    <script src="../../utilities/jsFunctions/question/alternativesField.js"></script>
    <script src="../../utilities/jsFunctions/question/submitEnunciate.js"></script>

    <script>
        <?php
        //Variável global com o id_role atual.
        $js_var = json_encode($id_role);
        echo "id_role = Number(" . $js_var . ");\n";

        //Array global com todas as matérias registradas.
        $php_array = selectSubjects();
        $js_array = json_encode($php_array);
        echo "subjects = " . $js_array . ";\n";

        //Variável global que informa a função da página atual.
        echo "page_action = 2;"
        ?>

        //Quando o documento estiver carregado, executa o método verifyRole().
        document.addEventListener("DOMContentLoaded", verifyRole(), false);

        //Quando o documento estiver carregado, executa o método updateSubjects().
        document.addEventListener("DOMContentLoaded", updateSubjects(), false);

        //Quando o documento estiver carregado, executa o método alternativesField().
        document.addEventListener("DOMContentLoaded", alternativesField(), false);
    </script>

    <!--CKEditor-->
    <?php forCreate() ?>

</body>

</html>