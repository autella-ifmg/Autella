<?php
function dificultyTratament($dificulty)
{
    switch ($dificulty) {
        case 1:
            return $dificulty = "Dificuldade: Fácil";
            break;
        case 2:
            return $dificulty = "Dificuldade: Média";
            break;
        default:
            return $dificulty = "Dificuldade: Difícil";
            break;
    }
}

function dateTratament($date)
{
    $date = strtotime($date);
    return $date = "Criada em: " . date("d/m/Y", $date);
}

function data($array, $id_role)
{
    $id_user = $_SESSION["userData"]["id"];

    if (!empty($array)) {
        if (count($array) > 0) {
            for ($i = 0; $i < count($array); $i++) {
                $questionNumber = "Questão - " . ($i + 1);
                $dificulty = dificultyTratament($array[$i]["dificulty"]);
                $correctAnswer = "Alternativa correta: " . $array[$i]["correctAnswer"];
                $discipline =  "Disciplina: " . $array[$i][8];
                $subject = "Matéria: " . $array[$i]["name"];
                $date = dateTratament($array[$i]["date"]);
                $enunciate =  $array[$i]["enunciate"];

                echo '
                    <div class="d-flex flex-row bd-highlight">
                        <div class="p-2 w-25 border border-dark">' . $questionNumber . '</div>
                        <div class="p-2 w-25 border border-dark border-left-0">' . $discipline . '</div>
                        <div class="p-2 flex-fill border border-dark border-left-0">' . $subject . '</div>';
                if ($id_role == 1) {
                    echo '
                        <div class="p-2 w-auto border border-dark border-left-0"> <img src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/pencil-square.svg" alt="Editar" height="25" onclick="chooseAction(0, ' . ($i+1) . ')" data-toggle="modal" data-target="#editModal"/></div>';
                } elseif ($array[$i]["id_user"] == $id_user) {
                    echo '
                        <div class="p-2 w-auto border border-dark border-left-0"> <img src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/pencil-square.svg" alt="Editar" height="25" onclick="chooseAction(0, ' . ($i+1) . ')" data-toggle="modal" data-target="#editModal"/></div>';
                }
                echo '
                        <div class="p-2 w-auto border border-dark border-left-0"> <img src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/archive-fill.svg" alt="Arquivar" height="25" onclick="chooseAction(1, ' . ($i+1) . ')" data-toggle="modal" data-target="#archiveModal"/></div>
                        <div class="p-2 w-auto border border-dark border-left-0"> <img src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/trash-fill.svg" alt="Deletar" height="25" onclick="chooseAction(2, ' . ($i+1) . ')" data-toggle="modal" data-target="#deleteModal"/></div>
                    </div>

                    <div class="d-flex flex-row bd-highlight">
                        <div class="p-2 w-25 border border-dark border-top-0">Inclusa em: ...</div>
                        <div class="p-2 w-25 border border-dark border-left-0  border-top-0">' . $date . '</div>
                        <div class="p-2 w-25 border border-dark border-left-0  border-top-0">' . $dificulty . '</div>
                        <div class="p-2 w-25 border border-dark border-left-0  border-top-0">' . $correctAnswer  . '</div>
                    </div>

                    <div name="toolbar' . $i . '" id="toolbar-container' . $i . '" class="border border-dark border-top-0 border-bottom-0" disabled></div>
                    <div name="editor' . $i . '" id="editor' . $i . '" class="border border-dark border-top-0 mb-4" style="min-width: 64rem; max-width: 64rem; min-height: 20rem; max-height: 20rem;">' . $enunciate . '</div>
                 
                    ';
            }
        }
    } else {
        echo '
                    <div class="d-flex flex-row bd-highlight">
                        <div class="p-2 w-25 bd-highlight border border-dark">Nº: </div>
                        <div class="p-2 w-25 bd-highlight border border-dark border-left-0">Data de Criação: </div>
                        <div class="p-2 flex-fill bd-highlight border border-dark border-left-0">Nível: </div>
                        <div class="p-2 flex-fill bd-highlight border border-dark border-left-0">Alternativa correta: </div>
                    </div>
                    <div class="d-flex flex-row">
                        <div class="p-2 w-25 bd-highlight border border-dark border-top-0">Inclusa em: </div>
                        <div class="p-2 flex-fill bd-highlight border border-dark border-left-0">Disciplina - Matéria</div>
                    </div>

                    <div name="editor" id="editor" class="border border-dark border-top-0 mb-3" style="min-width: 65rem; max-width: 65rem; min-height: 20rem; max-height: 20rem;"><p class="font-weight-bold text-center">Ainda não há questões correspondentes ao filtro utilizado. :/<p></div>';
    }
}

function imports($array)
{
    if (count($array) > 0) {
        for ($i = 0; $i < count($array); $i++) {
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
}

function selectControl($id_role)
{
    if ($id_role == 1) {
        echo '
             var div = document.getElementById("container_selectDisciplines");
           
             div.removeAttribute("hidden");
             
             ';
    }
}
