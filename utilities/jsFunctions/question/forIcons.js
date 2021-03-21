//Converte o número da questão para sua respectiva posição no array de exibição.
function convertQuestionNumber(questionNumber) {
    var position;
    var str = questionNumber.toString();

    if (str.substr(-1) > 5) {
        position = Math.ceil(questionNumber % 5) - 1;
    } else if (str.substr(-1) == 0) {
        position = 4;
    } else {
        questionNumber -= 1;
        str = questionNumber.toString();
        position = Number.parseInt(str.substr(-1));
    }

    return position;
}

//Autaliza o cabeçalho do dropdown que contém os nomes dos testes.
function updateDropdownHeader() {
    if (page_action == 0) {
        $(".dropdown-header").html("Questão estava inclusa em:");
    } else if (page_action == 1) {
        $(".dropdown-header").html("Questão inclusa em:");
    }
}

//Especifica a ação do modal.
function defineModalAction(action, questionNumber) {
    var modal = [
        [
            "editModal",
            "editModalLabel",
            `Editar a <strong>Questão ${questionNumber}</strong>?`,
            "Ao editar essa questão, todas as provas simples e provas globais que a utilizam também serão alteradas.",
            `Você tem certeza que deseja fazer alguma modificação na <strong>Questão ${questionNumber}</strong>?`,
            "editButton",
            "editQuestion("
        ],
        [
            "archiveModal",
            "archiveModalLabel",
            `Arquivar a <strong>Questão ${questionNumber}</strong>?`,
            "Ao arquivar essa questão, ela não se perderá, mas, ficará indisponível em todas as provas simples e provas globais onde está inclusa.",
            `Você tem certeza que deseja arquivar a <strong>Questão ${questionNumber}</strong>?`,
            "archiveButton",
            "archiveQuestion("
        ],
        [
            "archiveModal",
            "archiveWarningLabel",
            `Impossível arquivar a <strong>Questão ${questionNumber}</strong>!`,
            "Essa questão já está inclusa em uma ou mais provas, logo, você não pode arquivá-la!",
            "Por favor, antes de tentar arquivá-la, remova-a de onde ela estiver inclusa.",
            "",
            ""
        ],
        [
            "unarchiveModal",
            "unarchiveModalLabel",
            `Desarquivar a <strong>Questão ${questionNumber}</strong>?`,
            "Ao desarquivar essa questão, ela ficará disponível em todas as provas simples e provas globais onde está inclusa.",
            `Você tem certeza que deseja desarquivar a <strong>Questão ${questionNumber}</strong>?`,
            "unarchiveButton",
            "unarchiveQuestion("
        ],
        [
            "deleteModal",
            "deleteModalLabel",
            `Deletar a <strong>Questão ${questionNumber}</strong>?`,
            "Ao excluir essa questão, ela se perderá permanentemente e se tornará indisponível em todas as provas simples e provas globais onde está inclusa.",
            `Você tem certeza que deseja excluir a <strong>Questão ${questionNumber}</strong>?`,
            "deleteButton",
            "deleteQuestion("
        ],
        [
            "deleteModal",
            "deleteWarningLabel",
            `Impossível deletar a <strong>Questão ${questionNumber}</strong>!`,
            "Essa questão já está inclusa em uma ou mais provas, logo, você não pode excluí-la!",
            "Por favor, antes de tentar excluí-la, remova-a de onde ela estiver inclusa.",
            "",
            ""
        ]
    ];

    var container = document.getElementsByName("container")[0];
    container.setAttribute("id", `${modal[action][0]}`);

    var h5 = document.getElementsByName("header")[0];
    h5.setAttribute("id", `${modal[action][1]}`);
    h5.innerHTML = `${modal[action][2]}`;

    var p0 = document.getElementById("p0");
    p0.innerHTML = `${modal[action][3]}`;

    var p1 = document.getElementById("p1");
    p1.innerHTML = `${modal[action][4]}`;

    var confirm_button = document.getElementsByName("modalButton")[0];
    confirm_button.setAttribute("id", `${modal[action][5]}`);
    confirm_button.setAttribute("onclick", `${modal[action][6] + questionNumber})`);

    if (action == 0) {
        confirm_button.removeAttribute("data-dismiss");
    }

    cancel_button = document.getElementById("cancel");
    var footer = document.getElementById("footer");

    if (action != 2 && action != 5) {
        cancel_button.setAttribute("class", "btn btn-secondary");

        confirm_button.removeAttribute("hidden");

        footer.setAttribute("class", "modal-footer");
    } else {
        cancel_button.setAttribute("class", "btn btn-secondary w-50");

        confirm_button.setAttribute("hidden", "hidden");

        footer.setAttribute("class", "d-flex justify-content-center modal-footer");
    }
}

//Gera os toasts referentes às ações de criar e editar questão.
function toastForCreationAndEditing() {
    if (action_performed == 1) {
        $("#img_toast").attr({
            src: "../../../libraries/bootstrap/bootstrap-icons-1.0.0/layout-text-window-reverse.svg",
            alt: "Criar questão"
        });

        if (result == "Questão criada com sucesso!") {
            $("#span_toast").text("Sucesso!");
        } else if (result == "Erro ao criar questão!") {
            $("#span_toast").text("Erro!");
        }
    } else {
        $("#img_toast").attr({
            src: "../../../libraries/bootstrap/bootstrap-icons-1.0.0/pencil-square.svg",
            alt: "Editar questão"
        });

        if (result == "Questão editada com sucesso!") {
            $("#span_toast").text("Sucesso!");
        } else if (result == "Erro ao editar questão!") {
            $("#span_toast").text("Erro!");
        }
    }

    $("#result").html(result).fadeIn();
    $("#toast").toast("show");

    //console.log(result);
}

//Edita questão.
function editQuestion(questionNumber) {
    var position = convertQuestionNumber(questionNumber);

    var question_id_update = questions[position][0];
    //console.log(question_id_update);
    var button = document.getElementById("editButton");
    button.setAttribute(
        "href",
        `updateGUI.php?question_id_update=${question_id_update}`
    );
}

//Arquiva questão.
function archiveQuestion(questionNumber) {
    var position = convertQuestionNumber(questionNumber);

    var question_archive_unarchive = questions[position];
    //console.log(question_archive_unarchive);

    $.ajax({
        type: "POST",
        url: "updateSQL.php",
        data: {
            question_archive_unarchive
        },
        success: function (success) {
            $("#img_toast").attr({
                src: "../../../libraries/bootstrap/bootstrap-icons-1.0.0/archive-fill.svg",
                alt: "Arquivar"
            });
            $("#span_toast").text("Sucesso!");
            $("#result").html(success).fadeIn();
            $("#toast").toast("show");
            setTimeout(function () {
                location.reload(1);
            }, 2000);
            //console.log(success);
        },
        error: function (error) {
            $("#img_toast").attr({
                src: "../../../libraries/bootstrap/bootstrap-icons-1.0.0/archive-fill.svg",
                alt: "Arquivar"
            });
            $("#span_toast").text("Erro!");
            $("#result").html(error).fadeIn();
            $("#toast").toast("show");
            //console.log(error);
        }
    });
}

//Desarquiva questão.
function unarchiveQuestion(questionNumber) {
    var position = convertQuestionNumber(questionNumber);

    var question_archive_unarchive = questions[position];
    //console.log(question_archive_unarchive);

    $.ajax({
        type: "POST",
        url: "updateSQL.php",
        data: {
            question_archive_unarchive
        },
        success: function (success) {
            $("#img_toast").attr({
                src: "../../../libraries/bootstrap/bootstrap-icons-1.0.0/archive.svg",
                alt: "Desarquivar"
            });
            $("#span_toast").text("Sucesso!");
            $("#result").html(success).fadeIn();
            $("#toast").toast("show");
            setTimeout(function () {
                window.location.reload(1);
            }, 2000);
            //console.log(success);
        },
        error: function (error) {
            $("#img_toast").attr({
                src: "../../../libraries/bootstrap/bootstrap-icons-1.0.0/archive.svg",
                alt: "Desarquivar"
            });
            $("#span_toast").text("Erro!");
            $("#result").html(error).fadeIn();
            $("#toast").toast("show");
            //console.log(error);
        }
    });
}

//Deleta questão.
function deleteQuestion(questionNumber) {
    var position = convertQuestionNumber(questionNumber);

    var question_delete = questions[position];

    $.ajax({
        type: "POST",
        url: "updateSQL.php",
        data: {
            question_delete
        },
        success: function (success) {
            $("#img_toast").attr({
                src: "../../../libraries/bootstrap/bootstrap-icons-1.0.0/trash-fill.svg",
                alt: "Deletar"
            });
            $("#span_toast").text("Sucesso!");
            $("#result").html(success).fadeIn();
            $("#toast").toast("show");
            setTimeout(function () {
                window.location.reload(1);
            }, 2000);
            //console.log(success);
        },
        error: function (error) {
            $("#img_toast").attr({
                src: "../../../libraries/bootstrap/bootstrap-icons-1.0.0/trash-fill.svg",
                alt: "Deletar"
            });
            $("#span_toast").text("Erro!");
            $("#result").html(error).fadeIn();
            $("#toast").toast("show");
            //console.log(error);
        }
    });
}