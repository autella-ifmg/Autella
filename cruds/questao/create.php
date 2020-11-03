<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autella | Criar questão</title>
    <link rel="stylesheet" href="../../libraries/bootstrap/bootstrap.css">
</head>

<body>
    <?php session_start();
    require_once '../../views/navbar.php' ?>

    <!--Campo para selecionar a matéria da questão-->
    <div class="mt-3 d-flex justify-content-around">
        <div class="btn-group dropright">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Selecionar matérias</button>
            <div class="dropdown-menu">

            </div>
        </div>
    </div>

    <!--Editor de texto-->
    <div class="d-flex justify-content-around">
        <div class="mt-3 
                col-8
                col-sm-9
                col-md-9
                col-lg-9">
            <div id="toolbar-container"></div>
            <div id="editor" style="border: 1px solid;">
                <p>Uma locadora possui disponíveis 120 veículos da categoria que um cliente pretende locar.
                    Desses, 20% são da cor branca, 40% são da cor cinza, 16 veículos são da cor vermelha e o restante, de
                    outras cores.
                    O cliente não gosta da cor vermelha e ficaria contente com qualquer outra cor, mas o sistema de controle
                    disponibiliza os veículos sem levar em conta a escolha da cor pelo cliente. Disponibilizando
                    aleatoriamente,
                    qual é a probabilidade de o cliente ficar contente com a cor do veículo?
                </p>
                <p>A 16/120</p>
                <p>B 32/120</p>
                <p>C 72/120</p>
                <p>D 101/120</p>
                <p>E 104/120</p>
            </div>
        </div>
    </div>

    <!--Botões de adicionar e cancelar-->
    <div class="mt-3 d-flex justify-content-center">
        <button type="button" class="btn btn-danger ml-0 mr-1">Cancelar</button>
        <button type="button" class="btn btn-success ml-1 mr-0" data-toggle="modal" data-target="#alternatives">Adicionar</button>
    </div>

    <!--Campo de seleção da alternativa correta-->
    <div class="modal fade" id="alternatives" tabindex="-1" role="dialog" aria-labelledby="alternativeModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="alternativesModalLongTitle">Por favor, informe qual a alternativa correta:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="alternativesRadio" id="alternativesRadio" value="a">
                            <label class="form-check-label" for="alternativesRadio">A</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="alternativesRadio" id="alternativesRadio" value="b">
                            <label class="form-check-label" for="alternativesRadio">B</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="alternativesRadio" id="alternativesRadio" value="c">
                            <label class="form-check-label" for="alternativesRadio">C</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="alternativesRadio" id="alternativesRadio" value="d">
                            <label class="form-check-label" for="alternativesRadio">D</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="alternativesRadio" id="alternativesRadio" value="e">
                            <label class="form-check-label" for="alternativesRadio">E</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success">Concluir</button>
                </div>
            </div>
        </div>
    </div>

    <!--Ícone de ajuda-->
    <div style="position: absolute; bottom: 1rem; right: 1rem;">
        <img src="../../libraries/bootstrap/bootstrap-icons-1.0.0/question-circle-fill.svg" width="40" height="40" data-toggle="modal" data-target="#help" />
    </div>

    <!--Campo que exibe as orientações de ajuda-->
    <div class="modal fade" id="help" tabindex="-1" role="dialog" aria-labelledby="helpModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="helpModalLongTitle">help</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger">Sair</button>
                </div>
            </div>
        </div>
    </div>

    <!--Importações do Bootstrap-->
    <script src="../../libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="../../libraries/bootstrap/bootstrap.bundle.js"></script>
    <script src="../../libraries/ckeditor5/ckeditor.js"></script>

    <!--Importação da barra de ferramentas do CkEditor-->
    <script>
        DecoupledEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                const toolbarContainer = document.querySelector('#toolbar-container');

                toolbarContainer.appendChild(editor.ui.view.toolbar.element);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
</body>

</html>