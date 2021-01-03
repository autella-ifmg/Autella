<?php
if($id_role == 1) {
    $count = 4;
    $class_alter = "w-25 mr-3";
    $mr_exception = "w-25 mr-1";
} else {
    $count = 3;
    $class_alter = "w-50 mr-3";
    $mr_exception = "w-50 mr-1";
}

if (isset($_GET["filter"])) {
    echo '
    <div class="border border-muted rounded mb-3">
        <div id="container_filters" class="d-flex flex-row justify-content-between mt-2">
            <div class="ml-2 mr-3">
                <h6 style="width: 70px; text-align: center;">Filtros aplicados:</h6>
            </div>';

    for ($i = 0; $i < $count; $i++) {
        if ($i != ($count - 1)) {
            echo '
            <div id="' . $select_names[$i] . '" class="d-flex justify-content-between ' . $class_alter . ' form-control">';
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
            echo '
            </div>
            ';
        }
    }

    echo '
        </div>
    </div>
    ';
} else {
    echo '
    <div class="border border-muted rounded mb-3">
        <div class="d-flex flex-row justify-content-between mt-2">
            <div class="ml-2 mr-3">
                <h6 style="width: 70px; text-align: center;">Filtros aplicados:</h6>
            </div>';

            for ($i = 0; $i < $count; $i++) {
                if ($i != ($count - 1)) {
                    echo '
                    <div name="container_filter" class="d-flex justify-content-between ' . $class_alter . ' form-control text-muted"></div>';
                } else {
                    echo '
                    <div name="container_filter" class="d-flex justify-content-between ' . $mr_exception . ' form-control text-muted"></div>';
                }
            }

    echo '
        </div>
    </div>
    ';
}
