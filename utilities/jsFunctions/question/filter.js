url = "";
status = -1;
removalIndicator = -1;

function verifyPageAction() {
    if (page_action == 0) {
        var unarchive_btn = document.getElementById("unarchive");
        unarchive_btn.setAttribute("href", "http://autella.com/cruds/question/readGUI.php?");

        url = "http://autella.com/cruds/question/archiveGUI.php?";
        status = 0;
    } else {
        var archive_btn = document.getElementById("archive");
        archive_btn.setAttribute("href", "http://autella.com/cruds/question/archiveGUI.php?filter=true&status=0");

        url = "http://autella.com/cruds/question/readGUI.php?";
        status = 1;
    }
}

function addFilterInList(selected_filter) {
    if (id_role != 1) {
        appliedFilters[0] = id_discipline;
    }

    var filter_value = document.getElementById(selected_filter);
    filter_value = filter_value.value;

    switch (selected_filter) {
        case 'disciplines':
            appliedFilters[0] = filter_value;
            removalIndicator += 1;
            break;
        case 'subjects':
            appliedFilters[1] = filter_value;
            removalIndicator += 2;
            break;
        case 'dificulty':
            appliedFilters[2] = filter_value;
            removalIndicator += 3;
            break;
        case 'date':
            appliedFilters[3] = filter_value;
            removalIndicator += 4;
            break;
    }

    applyFilters();
}

function applyFilters() {
    console.log("deu?");
    if (infosFromFiltrationSystem != null && removalIndicator != - 1) {
        //console.log(infosFromFiltrationSystem);

        for (let i = 0; i < 4; i++) {
            if (infosFromFiltrationSystem[i] != "false" && i == removalIndicator) {
                console.log(i);
                //console.log(infosFromFiltrationSystem[i]);
                appliedFilters[i] = "";
                infosFromFiltrationSystem[i] = "false";
            } else if (infosFromFiltrationSystem[i] != "false") {
                appliedFilters[i] = infosFromFiltrationSystem[i][1];
            }
        }
    }
    updateSubjects();
    filters_url = `${url}filter=true&id_discipline=${appliedFilters[0]}&id_subject=${appliedFilters[1]}&dificulty=${appliedFilters[2]}&date=${appliedFilters[3]}&status=${status}&`;

    window.history.pushState({}, "Autella | Visualizar questões", `${filters_url}`);
    window.location.reload(1);
}

function blockFilterSelects() {
    if (infosFromFiltrationSystem != null) {
        //console.log(infosFromFiltrationSystem);

        for (let i = 0; i < 4; i++) {
            if (infosFromFiltrationSystem[i] != "false") {
                console.log(i);
                console.log(infosFromFiltrationSystem[i]);

                if (i < 3) {
                    var val = infosFromFiltrationSystem[i][1];
                    document.querySelector(`#${infosFromFiltrationSystem[i][0]} [value="${val}"]`).selected = true;

                    if (id_role == 1) {
                        updateSubjects();
                        document.querySelector(`#${infosFromFiltrationSystem[i][0]} [value="${val}"]`).selected = true;
                    }
                } else {
                    var date_picker = document.getElementById(infosFromFiltrationSystem[i][0]);
                    date_picker.setAttribute("value", infosFromFiltrationSystem[i][1]);
                }

                $(`#${infosFromFiltrationSystem[i][0]}`).attr('disabled', 'disabled');


            }
        }

        //window.history.pushState({}, "Autella | Visualizar questões", `${url}`);
    }
}

function removeFilterFromList(selected_filter) {
    container_filter = document.getElementById(selected_filter);
    container_filter.innerHTML = "";

    selected_filter = selected_filter.split("_")[1];
    select = document.getElementById(selected_filter);
    select.selectedIndex = 0;
    select.removeAttribute("disabled");

    applyFilters();
}