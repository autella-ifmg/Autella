//Função que cria a ponte CKEditor-PHP.
document.querySelector("#submit").addEventListener("click", () => {
  var editorData = document.querySelector("#editor").children;

  var data = "";
  for (let i = 0; i < editorData.length; i++) {
    data += editorData[i].outerHTML;
    data += "\n";
  }

  var invisibleInput = document.createElement("input");
  invisibleInput.setAttribute("name", "enunciate");
  invisibleInput.setAttribute("id", "enunciate");
  invisibleInput.setAttribute("type", "text");
  invisibleInput.setAttribute("value", data);
  invisibleInput.setAttribute("style", "display: none");

  var form = document.getElementById("#questionForm");
  questionForm.appendChild(invisibleInput);
});