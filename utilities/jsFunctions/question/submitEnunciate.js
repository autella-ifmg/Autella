//Função que cria a ponte CKEditor-PHP.
document.querySelector("#submit").addEventListener("click", () => {
  var data = "";
  var letters = ["A", "B", "C", "D", "E"];

  for (let i = 0; i < 6; i++) {
    var editorData = document.querySelector(`#editor${i}`).children;

    for (let aux = 0; aux < editorData.length; aux++) {
      if (i == 0) {
        data += editorData[aux].outerHTML;
        data += "\n";
      }

      if (i != 0) {
        data += `${letters[i-1]}) ${editorData[aux].outerHTML}\n`;
      } else {
        data += "\n";
      }
    }
  }

  //console.log(data);

  var invisibleInput = document.createElement("input");
  invisibleInput.setAttribute("name", "enunciate");
  invisibleInput.setAttribute("id", "enunciate");
  invisibleInput.setAttribute("type", "text");
  invisibleInput.setAttribute("value", data);
  invisibleInput.setAttribute("style", "display: none");

  var form = document.getElementById("#questionForm");
  questionForm.appendChild(invisibleInput);
});