<?php

if (isset($_GET["filter"])) {
    echo '
    <div class="border border-muted rounded mb-3">
        <div id="container_filters" class="d-flex flex-row justify-content-between mt-2">
            <div class="ml-2 mr-3">
                <h6 style="width: 70px; text-align: center;">Filtrar por:</h6>
            </div>';


    if (isset($_GET["id_discipline"])) {

        $discipline_name = selectDisciplineName($_GET["id_discipline"]);

        echo '
                <div class="d-flex justify-content-between w-25 mr-3 form-control">
                    <label>' . $discipline_name . '</label>
                    <img src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/x-circle-fill.svg" alt="Remover filtro">
                </div>
                ';
    }

    if (isset($_GET["id_subject"])) {

        $subject_name = selectSubjectName($_GET["id_subject"]);

        echo '
                <div class="d-flex justify-content-between w-25 mr-3 form-control">
                    <label><nobr>' . $subject_name . '</nobr></label>
                    <img src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/x-circle-fill.svg" alt="Remover filtro">
                </div>
                ';
    }

    if (isset($_GET["dificulty"])) {

        $dificulty = dificultyTratament($_GET["dificulty"]);

        echo '
                <div class="d-flex justify-content-between w-25 mr-3 form-control">
                    <label>' . $dificulty . '</label>
                    <img src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/x-circle-fill.svg" alt="Remover filtro">
                </div>
                ';
    }

    if (isset($_GET["date"])) {

        $date = dateTratament($_GET["date"]);

        echo '
                <div class="d-flex justify-content-between w-25 mr-1 form-control">
                    <label>' . $date . '</label>
                    <img src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/x-circle-fill.svg" alt="Remover filtro">
                </div>
                ';
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
