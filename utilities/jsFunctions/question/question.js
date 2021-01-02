//Função para enviar o conteúdo do CKEDitor.
function submitEnunciate() {
  document.querySelector("#submit").addEventListener("click", () => {
    var editorData = document.querySelector("#editor").children;

    var string = "";
    for (let i = 0; i < editorData.length; i++) {
      string += editorData[i].outerHTML;
      string += "\n";
    }

    var invisibleInput = document.createElement("input");
    invisibleInput.setAttribute("name", "enunciate");
    invisibleInput.setAttribute("id", "enunciate");
    invisibleInput.setAttribute("type", "text");
    invisibleInput.setAttribute("value", string);
    invisibleInput.setAttribute("style", "display: none");

    var form = document.getElementById("#questionForm");
    questionForm.appendChild(invisibleInput);
  });
}

//Função para inserir as matérias no selectSubjects.
function updateSubjects() {
  if (id_role == 1 || action_pag == 2) {
    var selectDiscipline = document.getElementById("disciplines");
    selectDiscipline = selectDiscipline.value;
  } else {
    var selectDiscipline = id_discipline;
  }

  var selectSubjects = document.getElementById("subjects");
  selectSubjects.innerHTML = "";

  var option = document.createElement("option");
  option.setAttribute("disabled", "disabled");
  option.setAttribute("selected", "selected");
  option.setAttribute("label", "Escolha...");
  selectSubjects.appendChild(option);

  for (let i = 0; i < subjects.length; i++) {
    if (subjects[i][1] == selectDiscipline) {
      let option = document.createElement("option");
      option.setAttribute("value", `${subjects[i][0]}`);
      option.setAttribute("label", `${subjects[i][2]}`);
      selectSubjects.appendChild(option);
    }
  }
}

//Função para inserir os dados da questão selecionado nos selects.
function updateSelects() {
  //Discipline
  var disciplineOption = document.getElementById(disciplineSelected);
  disciplineOption.setAttribute("selected", "selected");

  var selectDiscipline = document.getElementById("disciplines");
  selectDiscipline = selectDiscipline.value;

  //Subject
  var selectSubjects = document.getElementById("subjects");
  selectSubjects.innerHTML = "";

  for (let i = 0; i < subjects.length; i++) {
    if (subjects[i][1] == selectDiscipline) {
      let option = document.createElement("option");
      option.setAttribute("value", `${subjects[i][0]}`);
      option.setAttribute("label", `${subjects[i][2]}`);

      if (subjects[i][2] == subjectSelected) {
        option.setAttribute("selected", "selected");
      }

      selectSubjects.appendChild(option);
    }
  }

  //Dificulty
  var dificultyOption = document.getElementById(`d${dificultySelected}`);
  dificultyOption.setAttribute("selected", "selected");

  //Correct Answer
  var correctAnswerOption = document.getElementById(
    `option${correctAnswerSelected}`
  );
  correctAnswerOption.setAttribute("selected", "selected");
}

//Especifica a ação do modal
function defineModalAction(action, questionNumber) {
  var modal = [
    [
      "editModal",
      "editModalLabel",
      `Editar a <strong>Questão - ${questionNumber}</strong>?`,
      "Ao editar essa questão, todas as provas simples e provas globais que a utilizam também serão alteradas.",
      `Você tem certeza que deseja fazer alguma modificação na <strong>Questão - ${questionNumber}</strong>?`,
      "editButton",
      "editQuestion(",
    ],
    [
      "archiveModal",
      "archiveModalLabel",
      `Arquivar a <strong>Questão - ${questionNumber}</strong>?`,
      "Ao arquivar essa questão, ela não se perderá, mas, ficará indisponível em todas as provas simples e provas globais onde está inclusa.",
      `Você tem certeza que deseja arquivar a <strong>Questão - ${questionNumber}</strong>?`,
      "archiveButton",
      "archiveQuestion(",
    ],
    [
      "unarchiveModal",
      "unarchiveModalLabel",
      `Desarquivar a <strong>Questão - ${questionNumber}</strong>?`,
      "Ao desarquivar essa questão, ela ficará disponível em todas as provas simples e provas globais onde está inclusa.",
      `Você tem certeza que deseja desarquivar a <strong>Questão - ${questionNumber}</strong>?`,
      "unarchiveButton",
      "unarchiveQuestion(",
    ],
    [
      "deleteModal",
      "deleteModalLabel",
      `Deletar a <strong>Questão - ${questionNumber}</strong>?`,
      "Ao excluir essa questão, ela se perderá permanentemente e se tornará indisponível em todas as provas simples e provas globais onde está inclusa.",
      `Você tem certeza que deseja excluir a <strong>Questão - ${questionNumber}</strong>?`,
      "deleteButton",
      "deleteQuestion(",
    ],
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

  var button = document.getElementsByName("modalButton")[0];
  button.setAttribute("id", `${modal[action][5]}`);
  button.setAttribute("onclick", `${modal[action][6] + questionNumber})`);

  if (action == 0) {
    button.removeAttribute("data-dismiss");
  }
}

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

//Gera os toasts referentes às ações de criar e editar questão.
function genericToastCEQ() {
  if (action_per == 1) {
    $("#img_toast").attr({
      src: "../../../libraries/bootstrap/bootstrap-icons-1.0.0/journal-x.svg",
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
  window.history.pushState({}, "Autella | Visualizar questões", "/cruds/question/readGUI.php?");
  console.log(result);
}

//Autaliza o cabeçalho do dropdown que contém os nomes dos testes.
function updateDropdownHeader() {
  if (action_pag == 0) {
      $("#dropdownHeader").html("Questão estava inclusa em:");
  } else if (action_pag == 1) {
      $("#dropdownHeader").html("Questão inclusa em:");
  }
}

//Editar questão.
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

//Arquivar questão.
function archiveQuestion(questionNumber) {
  var position = convertQuestionNumber(questionNumber);

  var question_archive_unarchive = questions[position];
  //console.log(question_archive_unarchive);

  $.ajax({
    type: "POST",
    url: "updateSQL.php",
    data: {
      question_archive_unarchive,
    },
    success: function (success) {
      $("#img_toast").attr({
        src:
          "../../../libraries/bootstrap/bootstrap-icons-1.0.0/archive-fill.svg",
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
        src:
          "../../../libraries/bootstrap/bootstrap-icons-1.0.0/archive-fill.svg",
        alt: "Arquivar"
      });
      $("#span_toast").text("Erro!");
      $("#result").html(error).fadeIn();
      $("#toast").toast("show");
      //console.log(error);
    },
  });
}

//Desarquivar questão.
function unarchiveQuestion(questionNumber) {
  var position = convertQuestionNumber(questionNumber);

  var question_archive_unarchive = questions[position];
  //console.log(question_archive_unarchive);

  $.ajax({
    type: "POST",
    url: "updateSQL.php",
    data: {
      question_archive_unarchive,
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
    },
  });
}

//Deletar questão.
function deleteQuestion(questionNumber) {
  var position = convertQuestionNumber(questionNumber);

  var question_delete = questions[position];

  $.ajax({
    type: "POST",
    url: "updateSQL.php",
    data: {
      question_delete,
    },
    success: function (success) {
      $("#img_toast").attr({
        src:
          "../../../libraries/bootstrap/bootstrap-icons-1.0.0/trash-fill.svg",
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
        src:
          "../../../libraries/bootstrap/bootstrap-icons-1.0.0/trash-fill.svg",
        alt: "Deletar"
      });
      $("#span_toast").text("Erro!");
      $("#result").html(error).fadeIn();
      $("#toast").toast("show");
      //console.log(error);
    },
  });
}

//Função para gerar os campos de texto das alternativas.
function alternativesField() {
  var alternatives_container = document.getElementById(
    "alternatives_container"
  );
  letters = ["A", "B", "C", "D", "E"];

  for (let i = 0; i < 5; i++) {
    let div = document.createElement("div");
    div.setAttribute("id", "div_container");
    div.setAttribute("class", "d-flex flex-row");
    alternatives_container.appendChild(div);

    let img = document.createElement("img");
    img.setAttribute("src", `../../images/alternatives/${letters[i]}.png`);
    img.setAttribute("alt", letters[i]);
    img.setAttribute("class", "bg-info rounded-circle mr-1 mb-3");
    div.appendChild(img);

    let textarea = document.createElement("textarea");
    textarea.setAttribute("name", `question${i}`);
    textarea.setAttribute("id", `question${i}`);
    textarea.setAttribute("cols", "125");
    textarea.setAttribute("rows", "3");
    textarea.setAttribute("class", "ml-1 mb-3 rounded");
    textarea.setAttribute("style", "resize: none;");
    textarea.setAttribute(
      "placeholder",
      "Insira o enunciado da alternativa..."
    );
    textarea.setAttribute("required", "required");
    div.appendChild(textarea);
  }
}

function verifyRole() {
  if (id_role == 1) {
    //console.log("role");
    var div = document.getElementById("disciplineSelection_container");
    div.removeAttribute("hidden");
  } else if (action_pag < 2) {
    var list = document.getElementsByName("selection_container");

    for (let i = 0; i < 3; i++) {
      var container = list[`${i}`];
      var mr = i != 2 ? "mr-3" : "";
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