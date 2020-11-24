<?php
//Função que remove conteúdos indejados dos inputs.
function secure($input)
{
    global $connection;

    $aux = mysqli_escape_string($connection, $input);

    $aux = htmlspecialchars($aux);

    return $aux;
}

if (isset($_POST["submit"])) {
    require_once "../../utilities/dbConnect.php";

    date_default_timezone_set("America/Sao_Paulo");
    $date = date("Y-m-d");
    $id_user = $_SESSION["userData"]["id"];
    $id_subject = secure($_POST["subjects"]);
    $dificulty = secure($_POST["dificulty"]);
    $enunciate = $_POST["enunciate"];
    $correctAnswer = secure($_POST["correctAnswer"]);

    //Obtém cada uma das alternativas e agrega elas no enunciado da questão.
    $alternativesQuant = secure($_POST["alternativesQuant"]);
    $answersEnunciate = "";
    $letter = ["A", "B", "C", "D", "E"];

    for ($i = 0; $i < $alternativesQuant; $i++) {
        $answersEnunciate .= "<br>" . "$letter[$i]) " . secure($_POST["question$i"]);
    }
    $enunciate .= "<br>" . $answersEnunciate;

    $sql = "INSERT INTO question (date, id_user, id_subject, dificulty, enunciate, correctAnswer) VALUES ('$date', '$id_user', '$id_subject', '$dificulty', '$enunciate', '$correctAnswer');";

    if ($connection->query($sql) === TRUE) {
        //array_push($_SESSION['debug'], "Questão criada com sucesso!");
    } else {
        array_push($_SESSION['debug'], "Erro ao criar questão!");
    }

    $connection->close();

    header('Location: createGUI.php');
}

//Função para atualizar o select correctAnswer e gerar o campo de texto das alternativas.
function updateCorrectAnswerSelect_AlternativesField()
{
    echo '
        function updateCorrectAnswerSelect_AlternativesField() {
            var alternativesQuant = document.getElementById("alternativesQuant");
            alternativesQuant = alternativesQuant.value;

            var selectCorrectAnswer = document.getElementById("correctAnswer");
            selectCorrectAnswer.removeAttribute("disabled");

            var optionE = document.getElementById("optionE");

            if (alternativesQuant == 4) {
                optionE.setAttribute("hidden", "true");
            } else if (alternativesQuant == 5) {
                optionE.removeAttribute("hidden");
            } else {
                selectCorrectAnswer.setAttribute("disabled", "true");
            }

            var alternatives_container = document.getElementById("alternatives_container");
            alternatives_container.innerHTML = "";

            alternatives = ["A", "B", "C", "D", "E"];

            for (let i = 0; i < alternativesQuant; i++) {
                let div = document.createElement("div");
                div.setAttribute("id", "div_container");
                div.setAttribute("class", "d-flex flex-row");
                alternatives_container.appendChild(div);

                let img = document.createElement("img");
                img.setAttribute("src", `../../images/alternatives/${alternatives[i]}.png`);
                img.setAttribute("alt", alternatives[i]);
                img.setAttribute("class", "bg-info rounded-circle mr-1 mb-3");
                div.appendChild(img);

                let textarea = document.createElement("textarea");
                textarea.setAttribute("name", `question${i}`);
                textarea.setAttribute("id", `question${i}`);
                textarea.setAttribute("cols", "120");
                textarea.setAttribute("rows", "3");
                textarea.setAttribute("class", "ml-1 mb-3");
                textarea.setAttribute("style", "resize: none;");
                textarea.setAttribute("placeholder", "Insira o enunciado da alternativa...");
                textarea.setAttribute("required", "true");
                div.appendChild(textarea);
            }
        }
    ';
}

//Função para realizar a conexão CKEditor-MySQL.
function invisibleInput()
{
    echo '
        document.querySelector("#submit").addEventListener("click", () => {
            var editorData = document.querySelector("#editor").children;

            var string = "";
            for (let i = 0; i < editorData.length; i++) {
                string += editorData[i].outerHTML;
                string += "\n";
            }

            var invisibleInput = document.createElement("input");
            invisibleInput.setAttribute("name", "enunciate");
            invisibleInput.setAttribute("id", "enunciate");
            invisibleInput.setAttribute("type", "text");
            invisibleInput.setAttribute("value", string);
            invisibleInput.setAttribute("style", "display: none");

            var form = document.getElementById("#questionForm");
            questionForm.appendChild(invisibleInput);
        });
    ';
}

function selectControl($id_role)
{
    if ($id_role == 1) {
        echo '
             var div = document.getElementById("selectDiscipline_container");
           
             div.removeAttribute("hidden");';
    }
}
