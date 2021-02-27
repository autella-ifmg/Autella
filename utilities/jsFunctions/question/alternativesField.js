//Função para gerar os campos de texto das alternativas.
function alternativesField() {
  var alternatives_container = document.getElementById("alternatives_container");
  letters = ["A", "B", "C", "D", "E"];

  for (let i = 0; i < 5; i++) {
    let span_container = document.createElement("span");
    span_container.setAttribute("id", `alternative_popover${i+1}`);
    span_container.setAttribute("class", "d-flex flex-row");
    span_container.setAttribute("data-toggle", "popover");
    span_container.setAttribute("data-placement", "top");
    span_container.setAttribute("data-html", "true");
    span_container.setAttribute("data-content", '<img class="p-1 w-auto h-auto" src="../../images/question/warning.png" alt="Atenção!"> Preencha este campo.')
    alternatives_container.appendChild(span_container);

    let img = document.createElement("img");
    img.setAttribute("src", `../../images/question/alternatives/${letters[i]}.png`);
    img.setAttribute("alt", letters[i]);
    img.setAttribute("class", "bg-info rounded-circle mr-1 mb-3");
    span_container.appendChild(img);

    let div_editor = document.createElement("div");
    div_editor.setAttribute("name", `editor${i+1}`);
    div_editor.setAttribute("id", `editor${i+1}`);
    div_editor.setAttribute("class", "ml-1 mb-3 rounded");
    div_editor.setAttribute("style", "min-width: 48rem; max-width: 48rem; min-height: 5rem; max-height: 5rem; border: 1px solid gray;");
    div_editor.setAttribute("onclick", `disablePopover('#alternative_popover${i+1}')`);
    span_container.appendChild(div_editor);
  }
}