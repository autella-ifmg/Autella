//Função que cria a ponte CKEditor-PHP.
document.querySelector("#submit").addEventListener("click", () => {
  var data = "";
  var letters = ["A", "B", "C", "D", "E"];

  for (let i = 0; i < 6; i++) {
    var editorData = document.querySelector(page_action == 2 ? `#editor${i}` : "#editor0").children;

    for (let aux = 0; aux < editorData.length; aux++) {
      if (i == 0) {
        data += editorData[aux].outerHTML;
        data += "<br>";
      }

      if (page_action == 2) {
        if (i != 0) {
          data += `${letters[i-1]}) ${editorData[aux].outerHTML} <br>`;
        } else {
          data += "<br>";
        }
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