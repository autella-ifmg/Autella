function verifyRole() {
    if (id_role == 1 || id_role == 5) {
        var div = document.getElementById("disciplineSelection_container");
        div.removeAttribute("hidden");

    } else if (page_action < 2) {
        var list = document.getElementsByName("selection_container");

        for (let i = 0; i < 3; i++) {
            var container = list[`${i}`];
            var mr = i != 2 ? "mr-3" : "mr-1";
            container.setAttribute("class", `w-50 mt-1 ${mr}`);
        }
    }
}

function arrayIsEmpty() {
    if (arrayIsEmpty) {
        $("#disciplineSelection_container").find("*").prop("disabled", true);

        var list = document.getElementsByName("selection_container");

        for (let i = 0; i < 3; i++) {
            var container = list[`${i}`];
            $(container).find("*").prop("disabled", true);
        }
    }
}