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
            <div id="' . $select_names[$i] . '" class="d-flex justify-content-between ' . $class_div . ' form-control">';
        } else {
            echo '
            <div id="' . $select_names[$i] . '" class="d-flex justify-content-between ' . $mr_exception . ' form-control">';
        }

        if (!empty($_GET[$filter_names[$i]])) {
            switch ($filter_names[$i]) {
                case 'id_discipline':
                    $content = selectDisciplineName($_GET[("id_discipline")]);
                    break;
                case 'id_subject':
                    $content = selectSubjectName($_GET[("id_subject")]);
                    break;
                case 'dificulty':
                    $content = dificultyTratament($_GET[("dificulty")]);
                    break;
                case 'date':
                    $content = dateTratament($_GET[("date")]);
                    break;
            }

            echo '
                <label>' . $content . '</label>
                <img src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/x-circle-fill.svg" alt="Remover filtro" onclick="removeFilterFromList(\'' . $select_names[$i] . '\')">
            </div>
            ';
        } else {
            $content = 'Nenhum';

            echo '
                <label class="text-muted">' . $content . '</label>
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
