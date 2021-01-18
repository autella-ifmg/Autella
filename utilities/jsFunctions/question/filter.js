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
    var filter_value = document.getElementById(selected_filter);
    filter_value = filter_value.value;

    switch (selected_filter) {
        case 'disciplines':
            appliedFilters[0] = filter_value;
            break;
        case 'subjects':
            appliedFilters[1] = filter_value;
            break;
        case 'dificulty':
            appliedFilters[2] = filter_value;
            break;
        case 'date':
            appliedFilters[3] = filter_value;
            break;
    }

    applySelectedFilters();
}

function applySelectedFilters() {
    filters_url = `${url}filter=true&id_discipline=${appliedFilters[0]}&id_subject=${appliedFilters[1]}&dificulty=${appliedFilters[2]}&date=${appliedFilters[3]}&status=${status}&`;

    window.history.pushState({}, "Autella | Visualizar questões", filters_url);
    window.location.reload(1);
}

function blockFilterSelects() {
    if (id_role != 1) {
        appliedFilters[0] = id_discipline;
    }

    if (filtersSystemData != null) {
        for (let i = 0; i < 4; i++) {
            if (filtersSystemData[i] != "false") {
                if (id_role == 1 || i > 0) {
                    appliedFilters[i] = filtersSystemData[i][0];

                    if (i < 3) {
                        var value = filtersSystemData[i][0];
                        document.querySelector(`#${filtersSystemData[i][1]} [value="${value}"]`).selected = true;

                        if (id_role == 1) {
                            updateSubjects();
                            if (i == 0) {
                                document.querySelector(`#${filtersSystemData[i][1]} [value="${value}"]`).selected = true;
                            } else {
                                document.querySelector(`#${filtersSystemData[1][1]} [value="${filtersSystemData[1][0]}"]`).selected = true;

                            }
                        }
                    } else {
                        var date_picker = document.getElementById(filtersSystemData[i][1]);
                        date_picker.setAttribute("value", filtersSystemData[i][0]);
                    }

                    $(`#${filtersSystemData[i][1]}`).attr('disabled', 'disabled');
                }
            }
        }

        window.history.pushState({}, "Autella | Visualizar questões", `${url}`);
    }
}

function removeFilterFromList(selected_filter) {
    container_filter = document.getElementById(selected_filter);
    container_filter.innerHTML = "";

    selected_filter = selected_filter.split("_")[1];
    var select = document.getElementById(selected_filter);
    select.selectedIndex = 0;
    select.removeAttribute("disabled");

    if (selected_filter == 'disciplines') {
        container_filter = document.getElementById('container_subjects');
        container_filter.innerHTML = "";

        var select = document.getElementById('subjects');
        select.selectedIndex = 0;
        select.removeAttribute("disabled");

        appliedFilters[1] = "";

        filtersSystemData[1] = "false";

    }

    switch (selected_filter) {
        case 'disciplines':
            removalIndicator += 1;
            break;
        case 'subjects':
            removalIndicator += 2;
            break;
        case 'dificulty':
            removalIndicator += 3;
            break;
        case 'date':
            removalIndicator += 4;
            break;
    }

    appliedFilters[removalIndicator] = "";

    filtersSystemData[removalIndicator] = "false";

    applySelectedFilters();
}