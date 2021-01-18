//Função para gerar os campos de texto das alternativas.
function alternativesField() {
  var alternatives_container = document.getElementById("alternatives_container");
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