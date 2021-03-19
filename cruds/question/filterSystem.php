<?php

function filterArray($id_role, $id_discipline)
{
    $filter = [];

    //Verifica quais filtros foram setados.
    if (isset($_GET["filter"])) {
        $filter[0] = (isset($_GET["id_discipline"]) ? $_GET["id_discipline"] : null);
        $filter[1] = (isset($_GET["id_subject"]) ? $_GET["id_subject"] : null);
        $filter[2] = (isset($_GET["dificulty"]) ? $_GET["dificulty"] : null);
        $filter[3] = (isset($_GET["date"]) ? $_GET["date"] : null);
        $filter[4] = (isset($_GET["status"]) ? $_GET["status"] : null);
    } else if ($id_role != 1  && $id_role != 5) {
        $filter[0] = $id_discipline;
        $filter[1] = null;
        $filter[2] = null;
        $filter[3] = null;
        $filter[4] = (isset($_GET["status"]) ? $_GET["status"] : null);
    }
    //var_dump($filter);

    return $filter;
}

function gatheringInfoForFiltersSystem()
{
    global $filter_names, $structuresQuantity, $id_role, $id_discipline;
    $php_array = [
        0 => ["false"],
        1 => ["false"],
        2 => ["false"],
        3 => ["false"]
    ];
    $js_array = [];
    $result = "filtersSystemData = null;\n";

    if (isset($_GET['filter'])) {
        for ($i = 0; $i < $structuresQuantity; $i++) {
            if (!empty($_GET[$filter_names[$i]])) {
                switch ($filter_names[$i]) {
                    case 'id_discipline':
                        $php_array[0] = [$_GET[$filter_names[$i]], "disciplines"];
                        break;
                    case 'id_subject':
                        $php_array[1] = [$_GET[$filter_names[$i]], "subjects"];
                        break;
                    case 'dificulty':
                        $php_array[2] = [$_GET[$filter_names[$i]], "dificulty"];
                        break;
                    case 'date':
                        $php_array[3] = [$_GET[$filter_names[$i]], "date"];
                        break;
                }
            } else if ($id_role != 1 && $id_role != 5) {
                $php_array[0] = [$id_discipline, "disciplines"];
            }
        }

        $js_array = json_encode($php_array);
        $result = "filtersSystemData = " . $js_array . ";\n";
    }

    return $result;
}
