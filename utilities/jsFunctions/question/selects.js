//Função para inserir as matérias no selectSubjects.
function updateSubjects() {
  var selectDiscipline;
  
  if ((id_role == 1 || id_role == 5) && page_action != 2) {
    selectDiscipline = appliedFilters[0];
  } else if (page_action == 2) {
    selectDiscipline = document.getElementById("disciplines");
    selectDiscipline = selectDiscipline.value;
  } else {
    selectDiscipline = id_discipline;
  }

  var selectSubjects = document.getElementById("subjects");
  selectSubjects.innerHTML = "";

  var option = document.createElement("option");
  option.setAttribute("disabled", "disabled");
  option.setAttribute("selected", "selected");

  if (selectDiscipline.length == 0) {
    var text = "Selecione uma disciplina";
  } else {
    var text = "Escolha...";
  }

  option.setAttribute("label", text);
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

//Função para inserir os dados da questão selecionada nos selects.
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
  var correctAnswerOption = document.getElementById(`option${correctAnswerSelected}`);
  correctAnswerOption.setAttribute("selected", "selected");
}

