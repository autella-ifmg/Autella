<?php

$filter_name = ["id_discipline", "id_subject", "dificulty", "date"];

if (isset($_GET["filter"])) {
    echo '
    <div class="border border-muted rounded mb-3">
        <div id="container_filters" class="d-flex flex-row justify-content-between mt-2">
            <div class="ml-2 mr-3">
                <h6 style="width: 70px; text-align: center;">Filtrar por:</h6>
            </div>';

    for ($i = 0; $i < 4; $i++) {
        if ($i != 3) {
            echo '
            <div class="d-flex justify-content-between w-25 mr-3 form-control">';
        } else {
            echo '
            <div class="d-flex justify-content-between w-25 mr-1 form-control">';
        }

        if ($_GET[$filter_name[$i]]!= "") {
            switch ($filter_name[$i]) {
                case 0:
                    $content = selectDisciplineName($_GET[("id_discipline")]);
                    break;
                case 1:
                    $content = selectSubjectName($_GET[("id_subject")]);
                    break;
                case 2:
                    $content = dificultyTratament($_GET[("dificulty")]);
                    break;
                case 3:
                    $content = dateTratament($_GET[("date")]);
                    break;
            }

            echo '
                <label>' . $content . '</label>
                <img src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/x-circle-fill.svg" alt="Remover filtro">
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
                <h6 style="width: 70px; text-align: center;">Filtrar por:</h6>
            </div>

            <div name="container_filter" class="d-flex justify-content-between w-25 mr-3 form-control"></div>

            <div name="container_filter" class="d-flex justify-content-between w-25 mr-3 form-control"></div>

            <div name="container_filter" class="d-flex justify-content-between w-25 mr-3 form-control"></div>

            <div name="container_filter" class="d-flex justify-content-between w-25 mr-1 form-control"></div>
        </div>
    </div>
    ';
}
