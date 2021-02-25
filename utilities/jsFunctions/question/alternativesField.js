//Função para gerar os campos de texto das alternativas.
function alternativesField() {
  var alternatives_container = document.getElementById("alternatives_container");
  letters = ["A", "B", "C", "D", "E"];

  for (let i = 0; i < 5; i++) {
    let div_container = document.createElement("div");
    div_container.setAttribute("id", "div_container");
    div_container.setAttribute("class", "d-flex flex-row");
    alternatives_container.appendChild(div_container);

    let img = document.createElement("img");
    img.setAttribute("src", `../../images/alternatives/${letters[i]}.png`);
    img.setAttribute("alt", letters[i]);
    img.setAttribute("class", "bg-info rounded-circle mr-1 mb-3");
    div_container.appendChild(img);

    let div_editor = document.createElement("div");
    div_editor.setAttribute("name", `editor${i+1}`);
    div_editor.setAttribute("id", `editor${i+1}`);
    div_editor.setAttribute("class", "ml-1 mb-3 rounded");
    div_editor.setAttribute("style", "min-width: 48rem; max-width: 48rem; min-height: 5rem; max-height: 5rem; border: 1px solid gray;");
    div_container.appendChild(div_editor);
  }
}