//Função para inserir as matérias no selectSubjects.
function updateSubjects() {
  if (id_role == 1) {
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

//Função que coleta o filtro desejado.
function filter(pag, status) {
  var url;

  if (pag == 0) {
    url = "http://autella.com/cruds/question/archiveGUI.php?";
  } else {
    url = "http://autella.com/cruds/question/readGUI.php?";
  }

  if (id_role == 1) {
    var discipline_filter = document.getElementById("disciplines");
    discipline_filter = discipline_filter.value;
  } else {
    var discipline_filter = id_discipline;
  }

  var subject_filter = document.getElementById("subjects");
  subject_filter = subject_filter.value;
  var dificulty_filter = document.getElementById("dificulty");
  dificulty_filter = dificulty_filter.value;
  var date_filter = document.getElementById("date");
  date_filter = date_filter.value;

  filters = `${url}filter=true&id_discipline=${discipline_filter}&id_subject=${subject_filter}&dificulty=${dificulty_filter}&date=${date_filter}&status=${status}&`;

  var filter_btn = document.getElementById("filter");
  filter_btn.setAttribute("href", filters);

  if (action_pag == 0) {
    var unarchive_btn = document.getElementById("unarchive");
    unarchive_btn.setAttribute("href", url);
  } else {
    var archive_btn = document.getElementById("archive");
    archive_btn.setAttribute("href", filters);
  }
}

//Especifica a ação do modal
function defineModalAction(action, questionNumber) {
  console.log("teste");
  var modal = [
    [
      "editModal",
      "editModalLabel",
      `Editar a <strong>Questão - ${questionNumber}</strong>?`,
      "Ao alterar essa questão, todas as provas simples e provas globais que a utilizam também serão alteradas.",
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

//Editar questão.
function editQuestion(questionNumber) {
  var position = convertQuestionNumber(questionNumber);

  var id_question_edit = questions[position][0];
  console.log(id_question_edit);
  var button = document.getElementById("editButton");
  button.setAttribute(
    "href",
    `updateGUI.php?id_question_edit=${id_question_edit}`
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
        alt: "Arquivar",
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
        alt: "Arquivar",
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
        alt: "Desarquivar",
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
        alt: "Desarquivar",
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
        alt: "Deletar",
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
        alt: "Deletar",
      });
      $("#span_toast").text("Erro!");
      $("#result").html(error).fadeIn();
      $("#toast").toast("show");
      //console.log(error);
    },
  });
}

function verifyRole() {
  if (id_role == 1) {
    var div = document.getElementById("container_selectDiscipline");
    div.removeAttribute("hidden");
  } else if (action_pag != 2) {
    var list = document.getElementsByName("container_select");

    for (let i = 0; i < 3; i++) {
      var container = list[`${i}`];
      var mr = (i != 2 ? "mr-3" : "");
      container.setAttribute("class", `w-50 mt-1 ${mr}`);
    }
  }
}

function arrayIsEmpty() {
  if (arrayIsEmpty) {
    $("#container_selectDiscipline").find("*").prop("disabled", true);

    var list = document.getElementsByName("container_select");

    for (let i = 0; i < 3; i++) {
      var container = list[`${i}`];
      $(container).find("*").prop("disabled", true);
    }
  }
}
