

function filterGathering(selected_filter, filter_value) {
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
        default:
            appliedFilters[4] = filter_value;
            break;
    }

    //console.log(appliedFilters);

    if(action_pag == 0) {
        var status = 0;
    } else {
        var status = 1;
    }


    apply(status, null);
}


   

function apply(status, remove) {


    if (infosToBlockSelects != null) {
        //console.log(infosToBlockSelects);

        for (let i = 0; i < 4; i++) {
            if (infosToBlockSelects[i] != "false" && i == remove) {
                //console.log(infosToBlockSelects[i]);
                appliedFilters[i] = "";
                infosToBlockSelects[i] = "false";
            } else if (infosToBlockSelects[i] != "false") {
                appliedFilters[i] = infosToBlockSelects[i][1];
            }
        }
    }

    if (action_pag == 0) {
        url = "http://autella.com/cruds/question/archiveGUI.php?";
    } else {
        console.log("a");
        url = "http://autella.com/cruds/question/readGUI.php?";
    }

    filters_url = `${url}filter=true&id_discipline=${appliedFilters[0]}&id_subject=${appliedFilters[1]}&dificulty=${appliedFilters[2]}&date=${appliedFilters[3]}&status=${status}&`;

    
   

    window.history.pushState({}, "Autella | Visualizar questões", `${filters_url}`);
    window.location.reload(1);
}

function addFilterInList(selected_filter) {
    if (id_role == 1) {
        var discipline_filter = document.getElementById("disciplines");
        discipline_filter = discipline_filter.value;
    }

    var filter_value = document.getElementById(selected_filter);
    filter_value = filter_value.value;

    filterGathering(`${selected_filter}`, filter_value);

    if (filter_value != 'null') {
        switch (selected_filter) {
            case 'disciplines':
                var aux = 0;

                for (let i = 0; i < disciplines.length; i++) {
                    if (disciplines[i][0] == filter_value) {
                        filter_value = disciplines[i][2];
                        //console.log(filter_value);
                    }
                }
                break;
            case 'subjects':
                var aux = 1;

                for (let i = 0; i < subjects.length; i++) {
                    if (subjects[i][0] == filter_value) {
                        filter_value = subjects[i][2];
                        //console.log(filter_value);
                    }
                }
                break;
            case 'dificulty':
                var aux = 2;

                switch (filter_value) {
                    case '1':
                        filter_value = "Fácil";
                        break;
                    case '2':
                        filter_value = "Média";
                        break;
                    case '3':
                        filter_value = "Difícil";
                        break;
                }
                //console.log(filter_value);
                break;
            case 'date':
                var aux = 3;

                var y = filter_value.split("-")[0];
                var m = filter_value.split("-")[1];
                var d = filter_value.split("-")[2];

                filter_value = `${d + "/" + m + "/" + y}`;
                //console.log(filter_value);
                break;
        }
    }
}

function removeFilterFromList(selected_filter) {
    container_filter = document.getElementById(selected_filter);
    container_filter.innerHTML = "";

    container_filter.setAttribute("name", "container_filter");

    selected_filter = selected_filter.split("_")[1];
    select = document.getElementById(selected_filter);
    select.selectedIndex = 0;
    select.removeAttribute("disabled");

    switch (selected_filter) {
        case 'disciplines':
            var remove = 0;
            break;
        case 'subjects':
            var remove = 1;
            break;
        case 'dificulty':
            var remove = 2;
            break;
        case 'date':
            var remove = 3;
            break;
    }

    if(action_pag == 0) {
        var status = 0;
    } else {
        var status = 1;
    }

    apply(status, remove);
}

function blockFilterSelects() {
    

    if (infosToBlockSelects != null) {
        console.log(infosToBlockSelects);
 
        for (let i = 0; i < 4; i++) {
            if (infosToBlockSelects[i] != "false") {
                console.log(infosToBlockSelects[i]);

                var select = document.getElementById(infosToBlockSelects[i][0]);

                select.selectedIndex = infosToBlockSelects[i][1];
                updateSubjects();
                select.setAttribute("disabled", "disabled");
            }
        }

        window.history.pushState({}, "Autella | Visualizar questões", `${url}`);
        
    }
}

