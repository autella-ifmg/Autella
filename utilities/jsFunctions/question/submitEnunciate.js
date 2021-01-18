//Função que cria a ponte CKEditor-PHP.
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