<?php
function dificultyTratament($dificulty)
{
    switch ($dificulty) {
        case 1:
            return $dificulty = "Nível: Fácil";
            break;
        case 2:
            return $dificulty = "Nível: Média";
            break;
        default:
            return $dificulty = "Nível: Difícil";
            break;
    }
}

function dateTratament($date)
{
    $date = strtotime($date);
    return $date = "Data de criação: " . date("d/m/Y", $date);
}

function data($array, $id_discipline, $id_role)
{
    //Obtém o id do usuário que está logado no momento.
    $id_user = $_SESSION["userData"]["id"];

    if (!empty($array)) {
        if (count($array) > 0) {
            for ($i = 0; $i < count($array); $i++) {
                $questionNumber = "Nº: " . ($i + 1);
                $dificulty = dificultyTratament($array[$i]["dificulty"]);
                $correctAnswer = "Alternativa correta: " . $array[$i]["correctAnswer"];
                $discipline_subject =  disciplineNames($id_discipline, 1) . $array[$i]["name"];
                $date = dateTratament($array[$i]["date"]);
                $enunciate =  $array[$i]["enunciate"];


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
                 <div name="editor' . $i . '" id="editor' . $i . '" class="border border-dark border-top-0 mb-3" style="min-width: 65rem; max-width: 65rem; min-height: 20rem; max-height: 20rem;">' . $enunciate . '</div>';
            }
        }
    } else {
        echo "Não há questões!";
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
        echo
            'var div = document.getElementById("container_selectDisciplines");
           
            div.removeAttribute("hidden");';
    }
}
