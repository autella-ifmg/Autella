//Função que cria a ponte CKEditor-PHP.
document.querySelector("#submit").addEventListener("click", (event) => {
  var data = "";
  var letters = ["A", "B", "C", "D", "E"];

  for (let i = 0; i < 6; i++) {
    var editorData = document.querySelector(page_action == 2 ? `#editor${i}` : "#editor0").children;

    for (let aux = 0; aux < editorData.length; aux++) {
      if (page_action == 2) {
        if (i == 0 && editorData[aux].outerHTML != '<p class="ck-placeholder" data-placeholder="Insira aqui o enunciado da questão..."><br data-cke-filler="true"></p>' && editorData[aux].outerHTML != '<p data-placeholder="Insira aqui o enunciado da questão..." class="ck-placeholder"><br data-cke-filler="true"></p>') {
          data += editorData[aux].outerHTML;
          data = data.replace(' data-placeholder="Insira aqui o enunciado da questão..."', "");
        } else if (i == 0) {
          alert(`Por favor, insira o enunciado da questão!`);
        }

        if (data) {
          if (i != 0 && editorData[aux].outerHTML != '<p class="ck-placeholder" data-placeholder="Insira aqui o enunciado da alternativa..."><br data-cke-filler="true"></p>' && editorData[aux].outerHTML != '<p data-placeholder="Insira aqui o enunciado da alternativa..." class="ck-placeholder"><br data-cke-filler="true"></p>') {
            data += `${letters[i-1]}) ${editorData[aux].outerHTML}`;
            data = data.replace(' data-placeholder="Insira aqui o enunciado da alternativa..."', "");

            console.log(editorData[aux].outerHTML);
            console.log("here!")
          } else if (i != 0) {
            alert(`Por favor, preencha o campo da alternativa ${letters[i-1]}!`);
            data = "";
          }
        }
      } else {
        if (i == 0 && editorData[aux].outerHTML != '<p class="ck-placeholder" data-placeholder="Insira aqui o enunciado da questão..."><br data-cke-filler="true"></p>' && editorData[aux].outerHTML != '<p data-placeholder="Insira aqui o enunciado da questão..." class="ck-placeholder"><br data-cke-filler="true"></p>' && editorData[aux].outerHTML != '<p><br data-cke-filler="true"></p>') {
          data += editorData[aux].outerHTML;
          data = data.replace(' data-placeholder="Insira aqui o enunciado da questão..."', "");
        } else if (i == 0) {
          alert(`Ops, você não pode retirar o enunciado de uma questão.`);
        }
      }
    }
  }

  //console.log(data);

  if (!data || /^\s*$/.test(data)) {
    event.preventDefault();
    //alert("Submit cancelado!");
  } else {
    var invisibleInput = document.createElement("input");
    invisibleInput.setAttribute("name", "enunciate");
    invisibleInput.setAttribute("id", "enunciate");
    invisibleInput.setAttribute("type", "text");
    invisibleInput.setAttribute("value", data);
    invisibleInput.setAttribute("style", "display: none");

    var form = document.getElementById("#questionForm");
    questionForm.appendChild(invisibleInput);
  }

});