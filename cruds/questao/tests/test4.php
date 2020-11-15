<?php
//Inicia a sessão.
session_start();

//Inclui a conexão com o banco de dados.
require_once "../../../utilities/dbConnect.php";
//Inclui as funções presentes no arquivo dbSelect.
require_once "../../../utilities/dbSelect.php";

$id_user = $_SESSION["userData"]["id"];
$id_discipline = $_SESSION["userData"]["id_discipline"];

$array = selectUserQuestions($id_user);
var_dump($array);

$sql = "SELECT * from question;";
$result = mysqli_query($connection, $sql);
$row = mysqli_num_rows($result);

var_dump($row);

function letterForNumber($correctAnswer)
{
    switch ($correctAnswer) {
        case "A":
            return 0;
            break;
        case "B":
            return 1;
            break;
        case "C":
            return 2;
            break;
        case "D":
            return 3;
            break;
        default:
            return 4;
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test 4</title>
    <link rel="stylesheet" href="../../../libraries/bootstrap/bootstrap.css">
    <style>
        img {
            background-color: powderblue;
        }

        textarea {
            resize: none;
        }
    </style>
</head>

<body>
    <!--
    <section class="d-flex justify-content-center mt-3">
        <div class="d-flex flex-column">
            <div class="d-flex flex-row bd-highlight">

                <div class="p-2 flex-fill bd-highlight border border-dark">Nº: 1</div>
                <div class="p-2 flex-fill bd-highlight border border-dark border-left-0">
                    <?php echo $array["id"] ?>
                </div>

                <div class="p-2 w-75 bd-highlight border border-dark border-left-0">
                    <?php echo $discipline_subject; ?>
                </div>
            </div>

            <div class="d-flex flex-row">
                <div class="p-2 flex-fill bd-highlight border border-dark border-top-0">
                    <?php
                    echo $date;
                    ?>
                </div>
                <div class="p-2 w-75 bd-highlight border border-dark border-left-0 border-top-0">Inclusa em: Global1, Prova do César, Global3</div>
            </div>

            <div name="toolbar" id="toolbar-container" class="border border-dark border-top-0 border-bottom-0"></div>
            <div name="editor" id="editor" style="height: 20rem; border: 1px solid black;" contenteditable="false"> <?php echo $array["enunciate"] ?> </div>
            <div id="alternatives_container" class="d-flex flex-column"></div>
            <div id="correctAnswer" class="border border-dark border-top-0 mb-5">
                <div class="d-flex flex-row justify-content-center mt-2">
                    <img src="../../images/alternatives/<?php echo letterForNumber($array["correctAnswer"]); ?>.png" alt="A" class="rounded-circle mr-1 mb-3">
                    <textarea name="question<?php echo $array["correctAnswer"]; ?>" id="question<?php echo $array["correctAnswer"]; ?>" cols="90" rows="3" class="ml-1 mb-3" readonly="true"></textarea>
                </div>
            </div>
        </div>
    </section>-->

    <p style="text-align: center;"> aaaaaaaaaaaaaaaaaaTESTEaaaaaaaaaaaaaaaaaaaa </p>

    <section class="d-flex justify-content-center mt-3">
        <div class="d-flex flex-column">
            <?php
            for ($i = 0; $i < $row; $i++) {
                $date = $array[$i]["date"];
                $date = strtotime($date);
                $date = "Data de criação: " . date("d/m/Y", $date);

                $discipline_subject =  disciplineNameToUpdate($id_discipline) . subjectNamesToUpdate($array[$i]["id_subject"]);

                echo
                    '<div class="d-flex flex-row bd-highlight">
                        <div class="p-2 flex-fill bd-highlight border border-dark">Nº: 1</div>
                        <div class="p-2 flex-fill bd-highlight border border-dark border-left-0">' . $array[$i]["id"] . '</div>
                        <div class="p-2 w-75 bd-highlight border border-dark border-left-0">' . $discipline_subject . '</div>
                    </div>

                    <div class="d-flex flex-row">
                        <div class="p-2 flex-fill bd-highlight border border-dark border-top-0">' . $date . '</div>
                        <div class="p-2 w-75 bd-highlight border border-dark border-left-0 border-top-0">Inclusa em: Global1, Prova do César, Global3</div>
                    </div>

                    <div name="toolbar' . $i . '" id="toolbar-container' . $i . '" class="border border-dark border-top-0 border-bottom-0"></div>
                    <div name="editor' . $i . '" id="editor' . $i . '" style="height: 20rem; border: 1px solid black;"> ' . $array[$i]["enunciate"] . '</div>
                    <div id="alternatives_container" class="d-flex flex-column"></div>
                    <div id="correctAnswer" class="border border-dark border-top-0 mb-5">
                        <div class="d-flex flex-row justify-content-center mt-2">
                            <img src="../../../images/alternatives/' . letterForNumber($array[$i]["correctAnswer"]) . '.png" alt="A" class="rounded-circle mr-1 mb-3">
                            <textarea name="question' . $array[$i]["correctAnswer"] . '" id="question' . $array[$i]["correctAnswer"] . '" cols="90" rows="3" class="ml-1 mb-3" readonly="true"></textarea>
                        </div>
                    </div>';
            }
            ?>
        </div>
    </section>;

    <!--Importações do Bootstrap-->
    <script src="../../../libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="../../../libraries/bootstrap/bootstrap.bundle.js"></script>

    <!--Importação do CkEditor-->
    <script src="https://cdn.ckeditor.com/ckeditor5/23.1.0/decoupled-document/ckeditor.js"></script>

    <script>
        <?php
        for ($i = 0; $i < $row; $i++) {
            echo '
                DecoupledEditor
                    .create(document.querySelector("#editor' . $i . '"))
                    .then(editor => {
                        const toolbarContainer = document.querySelector("#toolbar-container' . $i . '");

                        toolbarContainer.appendChild(editor.ui.view.toolbar.element);
                    })
                    .catch(error => {
                        console.error(error);
                    });';
        }
        ?>
    </script>
</body>

</html>