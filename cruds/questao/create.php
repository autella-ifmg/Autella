<?php
//Inicia a sessão.
session_start();

//Inclui as funções presentes no arquivo dbSelect.
require_once "../../utilities/dbSelect.php";

//Função que remove conteúdos indejados dos inputs.
function securityCheck($input)
{
    global $connection;

    $aux = mysqli_escape_string($connection, $input);

    $aux = htmlspecialchars($aux);

    return $aux;
}

$id_user = $_SESSION["userData"]["id"];
$id_discipline = $_SESSION["userData"]["id_discipline"];

if (isset($_POST["inputSubmit"])) {
    //Inclui a conexão com o banco de dados.
    require_once "../../utilities/dbConnect.php";

    date_default_timezone_set("America/Sao_Paulo");
    $date = date("Y-m-d H:i:s");
    $id_subject = securityCheck($_POST["subjects"]);
    $dificulty = securityCheck($_POST["dificulty"]);
    $enunciate = securityCheck($_POST["enunciate"]);
    $correctAnswer = securityCheck($_POST["correctAnswer"]);

    $alternativesQuant = securityCheck($_POST["alternativesQuant"]);
    $answersEnunciate = "";
    for ($i = 0; $i < $alternativesQuant; $i++) {
        $answersEnunciate .= "<br>" . securityCheck($_POST["question$i"]);
    }
    $enunciate .= "<br>" . $answersEnunciate;

    $sql = "INSERT INTO question (date, id_user, id_subject, dificulty, enunciate, correctAnswer) VALUES ('$date', '$id_user', '$id_subject', '$dificulty', '$enunciate', '$correctAnswer');";

    if ($connection->query($sql) === TRUE) {
        $message = "Questão criada com sucesso!";
    } else {
        $message = "Erro: " . $sql . "<br>" . $connection->error;
    }

    $connection->close();
    echo $message;
    array_push($_SESSION['debug'], $message);

    var_dump($_POST);
    echo $date . "<br>";
    echo $id_subject . "<br>";
    echo $dificulty . "<br>";
    echo $id_user . "<br>";
    echo $enunciate . "<br>";
    echo $correctAnswer . "<br>";

    //echo $alternativesQuant . "<br>";
    //echo $answersEnunciate;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autella | Criar questão</title>
    <link rel="stylesheet" href="../../libraries/bootstrap/bootstrap.css">
</head>

<body>
    <!--Inclui a navbar-->
    <?php require_once '../../views/navbar.php'; ?>

    <!--Primeiro título-->
    <h1 class="text-center">Autella | Crie sua questão</h1>

    <!--Formulário-->
    <form id="questionForm" method="post">
        <!--Seção dos selects-->
        <section>
            <!--Segundo título-->
            <h1 class="text-left">Informações gerais</h1>

            <!--Select das matérias-->
            <div class="form-group">
                <input type="hidden" id="id">
                <label for="subjects">Matéria:</label>
                <select name="subjects" id="subjects" class="dropdown-toggle" autofocus required>
                    <option></option>
                    <?php
                    subjectNamesToDropdownItems($id_discipline);
                    ?>
                </select>
            </div>

            <!--Select da dificuldade-->
            <div class="form-group">
                <label for="dificulty">Dificuldade:</label>
                <select name="dificulty" id="dificulty" class="btn btn-primary dropdown-toggle" required>
                    <option></option>
                    <option value="1">Fácil</option>
                    <option value="2">Médio</option>
                    <option value="3">Difícil</option>
                </select>
            </div>

            <!--Select do número de alternativas-->
            <div class="form-group">
                <label for="alternativesQuant">Número de alternativas:</label>
                <select name="alternativesQuant" id="alternativesQuant" class="btn btn-primary dropdown-toggle" onchange="updateCorrectAnswer_EnunciateFields()" required>
                    <option></option>
                    <option value=4>4</option>
                    <option value=5>5</option>
                </select>
            </div>

            <!--Select da alternativa correta-->
            <div class="form-group">
                <label for="correctAnswer">Alternativa correta:</label>
                <select name="correctAnswer" id="correctAnswer" class="btn btn-primary dropdown-toggle" required></select>
            </div>
        </section>

        <!--Seção dos enunciados-->
        <section>
            <!--Terceiro título-->
            <h1 class="text-left">Enunciados</h1>

            <!--Enunciado da questão-->
            <div>
                <!--Barra de ferramentas-->
                <div name="toolbar" id="toolbar-container"></div>
                <!--Campo de texto-->
                <div name="editor" id="editor" style="height: 20rem; border: 1px solid black;"></div>
            </div>

            <!--Enunciados das alternativas-->
            <div id="alternatives_container" class="d-flex flex-column"></div>
        </section>

        <!--Seção dos botões-->
        <section>
            <!--Botão para cancelar-->
            <a href="../../views/home.php" type="button" class="btn btn-danger ml-0 mr-1">Cancelar</a>
            <!--Botão para listar questões-->
            <a href="update.php" type="button" class="btn btn-primary ml-0 mr-1">Visualizar questões</a>
            <!--Botão para adicionar-->
            <button name="inputSubmit" id="inputSubmit" type="submit" class="btn btn-success ml-1 mr-0">Adicionar</button>
        </section>
    </form>

    <!--Seção de ajuda-->
    <section>
        <!--Ícone-->
        <div class="d-flex justify-content-end mb-3 mr-3">
            <img src="../../libraries/bootstrap/bootstrap-icons-1.0.0/question-circle-fill.svg" width="40" height="40" data-toggle="modal" data-target="#help" />
        </div>

        <!--Modal que exibe as orientações de ajuda-->
        <div class="modal fade" id="help" tabindex="-1" role="dialog" aria-labelledby="helpModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="helpModalLongTitle">help</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger">Sair</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        //Função get() para realizar a conexão CKEditor-MySQL.
        document.querySelector('#inputSubmit').addEventListener('click', () => {
            let editorData = document.querySelector('#editor').children;

            let string = "";
            for (let i = 0; i < editorData.length; i++) {
                string += editorData[i].outerHTML;
                string += "\n";
            }

            var invisibleInput = document.createElement("input");
            invisibleInput.setAttribute("name", "enunciate");
            invisibleInput.setAttribute("type", "text");
            invisibleInput.setAttribute("value", string);
            invisibleInput.setAttribute("style", "display: none");

            var form = document.getElementById("#questionForm");
            questionForm.appendChild(invisibleInput);
        });

        //Função para gerar o select correctAnswer.
        /* perguntar pro nics -onchange
        $(".dropdown-menu a").click(function() {
            $(this).parents(".dropdown").find('.btn').html(' ' + $(this).text() + ' ');
            $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
        });
    
        document.addEventListener('DOMContentLoaded', updateDisciplines(), false);
        */

        function updateCorrectAnswer_EnunciateFields() {
            var alternativesQuant = document.getElementById("alternativesQuant");
            alternativesQuant = alternativesQuant.value;

            var selectCorrectAnswer = document.getElementById("correctAnswer");
            selectCorrectAnswer.innerHTML = "";

            var option = document.createElement("option");
            selectCorrectAnswer.appendChild(option);

            var alternatives_container = document.getElementById("alternatives_container");
            alternatives_container.innerHTML = "";

            alternatives = ["A", "B", "C", "D", "E"];

            for (let i = 0; i < alternativesQuant; i++) {
                let option = document.createElement("option");
                option.setAttribute("value", alternatives[i]);
                option.setAttribute("label", alternatives[i]);
                selectCorrectAnswer.appendChild(option);

                let div = document.createElement("div");
                div.setAttribute("id", "div_container");
                div.setAttribute("class", "d-flex flex-row");
                alternatives_container.appendChild(div);

                let img = document.createElement("img");
                img.setAttribute("src", `../../images/alternatives/${i}.png`);
                img.setAttribute("alt", alternatives[i]);
                img.setAttribute("class", "rounded-circle mr-1 mb-3");
                img.setAttribute("style", "background-color: powderblue;")
                div.appendChild(img);

                let textarea = document.createElement("textarea");
                textarea.setAttribute("name", `question${i}`);
                textarea.setAttribute("id", `question${i}`);
                textarea.setAttribute("cols", "90");
                textarea.setAttribute("rows", "3");
                textarea.setAttribute("class", "ml-1 mb-3");
                textarea.setAttribute("style", "resize: none;");
                div.appendChild(textarea);
            }
        }
    </script>

    <!--Importações do Bootstrap-->
    <script src="../../libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="../../libraries/bootstrap/bootstrap.bundle.js"></script>

    <!--Importação do CkEditor-->
    <script src="https://cdn.ckeditor.com/ckeditor5/23.1.0/decoupled-document/ckeditor.js"></script>
    <script>
        DecoupledEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                const toolbarContainer = document.querySelector('#toolbar-container');

                toolbarContainer.appendChild(editor.ui.view.toolbar.element);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
</body>

</html>