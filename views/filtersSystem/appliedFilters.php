<?php
echo '
    <div class="border border-muted rounded mb-3">
        <div id="container_filters" class="d-flex flex-row mt-2">
            <div class="w-auto mt-1 ml-2 mr-4 mb-1 text-primary">
                <h6 style="width: 69px; font-size: 0.80em; text-align: left;">Filtro(s) selecionado(s):</h6>
            </div>';
//style="width: 69px; font-size: 0.84em; text-align: left;"
if (isset($_GET["filter"])) {
    for ($i = 0; $i < $structuresQuantity; $i++) {
        if ($i != ($structuresQuantity - 1)) {
            echo '
            <div id="' . $select_names[$i] . '" class="' . $class_div . ' form-control">';
        } else {
            echo '
            <div id="' . $select_names[$i] . '" class="' . $mr_exception . ' form-control">';
        }

        if (!empty($_GET[$filter_names[$i]])) {
            switch ($filter_names[$i]) {
                case 'id_discipline':
                    $label_content = selectDisciplineName($_GET[("id_discipline")]);
                    break;
                case 'id_subject':
                    $label_content = selectSubjectName($_GET[("id_subject")]);
                    break;
                case 'dificulty':
                    $label_content = dificultyTratament($_GET[("dificulty")]);
                    break;
                case 'date':
                    $label_content = dateTratament($_GET[("date")]);
                    break;
            }

            $string_array = str_split($label_content);

            if (count($string_array) >= 25) {
                $label_content = "";

                for ($aux = 0; $aux < 22; $aux++) {
                    if ($string_array[21] == " ") {
                        $string_array[21] = "";
                    }

                    $label_content .= $string_array[$aux];
                }

                $label_content .= "...";
                //$aux_array = str_split($label_content);
            }

            echo '
                <label class="float-left">' . $label_content . '</label>
                <img class="float-right mt-1"src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/x-circle-fill.svg" alt="Remover filtro" onclick="removeFilterFromList(\'' . $select_names[$i] . '\')">
            </div>
            ';
        } else {
            $label_content = 'Nenhum';

            echo '
                <label class="text-muted">' . $label_content . '</label>
            </div>
            ';
        }
    }
} else {
    for ($i = 0; $i < $structuresQuantity; $i++) {
        if ($i != ($structuresQuantity - 1)) {
            echo '
                <div class="' . $class_div . ' form-control"><label class="text-muted">Nenhum</label></div>';
        } else {
            echo '
                <div class="' . $mr_exception . ' form-control"><label class="text-muted">Nenhum</label></div>';
        }
    }
}

echo '
        </div>
    </div>
';

//var_dump($aux_array);