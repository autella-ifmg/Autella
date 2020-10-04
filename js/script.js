function modalCadastro(){
    var modal = document.getElementById("modal-cadastro");

    if(modal.style.display == "flex"){
        modal.style.display = "none";
    } else {
        modal.style.display = "flex";
    }
}

function modalRecuperacao(){
    var modal = document.getElementById("modal-recuperacao");

    if(modal.style.display == "flex"){
        modal.style.display = "none";
    } else {
        modal.style.display = "flex";
    }
}

// When the user clicks on the button, toggle between hiding and showing the dropdown content
function dropdown_disciplina(){
    var links = document.getElementById('dropdown-disciplina-links');
    links.style.display = "block";
}

function dropdown_assunto(){
    var links = document.getElementById('dropdown-assunto-links');
    links.style.display = "block";
}
function dropdown_dificuldade(){
    var links = document.getElementById('dropdown-dificuldade-links');
    links.style.display = "block";
}

//Close the dropdown menu if the user clicks outside of it
window.onclick = function(event){
    var links_disciplina = document.getElementById("dropdown-disciplina-links");
    var links_assunto = document.getElementById("dropdown-assunto-links");
    var links_dificuldade = document.getElementById("dropdown-dificuldade-links");

    // event.target.matches -> só retorna true se for o elemento exato do retorno no event.target
    // event.target.closest -> retorna true se for o elemento exato do retorno no event.target ou um de seus filhos

    // Disciplina
    if(event.target.closest("#dropdown-disciplina-title") || event.target.closest("#dropdown-disciplina-links")){
        
    } else {
        links_disciplina.style.display = "none";
    }

    // Assunto
    if(event.target.closest("#dropdown-assunto-title") || event.target.closest("#dropdown-assunto-links")){
        
    } else {
        links_assunto.style.display = "none";
    }

    // Dificuldade
    if(event.target.closest("#dropdown-dificuldade-title") || event.target.closest("#dropdown-dificuldade-links")){
        
    } else {
        links_dificuldade.style.display = "none";
    }
}