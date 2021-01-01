<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autella | Criar questão</title>
    <link rel="stylesheet" href="../../libraries/bootstrap/bootstrap.css">
    <script src="../../libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="../../libraries/bootstrap/bootstrap.bundle.js"></script>
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/sessionDebug.php';
    ?>
</head>

<body>
    <section class="d-flex justify-content-center mt-3">
        <div class="d-flex flex-column ">
            <div class="d-flex flex-row ">
                <div class="p-2 w-25  border border-dark">Questão - 1</div>
                <div class="p-2 w-25 border border-dark border-left-0">Criada por: Denise Giarola</div>
                <div class="p-2 flex-fill border border-dark border-left-0">Data de criação: 24/11/2020</div>
                <div class="dropdown p-2 w-auto border border-dark border-left-0">
                    <img id="dropdownMenuButton" src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/file-ruled-fill.svg" height="25" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" />
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" ><strong>Questão inclusa em:</strong></a>
                        <a class="dropdown-item" href="#">Prova Simples 1</a>
                        <a class="dropdown-item" href="#">Prova Global 7</a>
                        <a class="dropdown-item" href="#">Prova Simples 3</a>
                    </div>
                </div>
                <div class="p-2 w-auto border border-dark border-left-0"><img src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/pencil-square.svg" height="25" /></div>
                <div class="p-2 w-auto border border-dark border-left-0"><img src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/archive-fill.svg" height="25" /></div>
                <div class="p-2 w-auto border border-dark border-left-0"><img src="../../../libraries/bootstrap/bootstrap-icons-1.0.0/trash-fill.svg" height="25" /></div>
            </div>

            <div class="d-flex flex-row">
                <div class="p-2 w-25 border border-dark border-top-0">Disciplina: Arte</div>
                <div class="p-2 w-25 border border-dark border-left-0 border-top-0">Matéria: Modernismo</div>
                <div class="p-2 w-25 border border-dark border-left-0 border-top-0">Dificuldade: Fácil</div>
                <div class="p-2 w-25 border border-dark border-left-0 border-top-0">Alternativa correta: B</div>
            </div>

            <div name="toolbar0" id="toolbar-container0" class="border border-dark border-top-0 border-bottom-0"></div>
            <div name="editor0" id="editor0" class="border border-dark border-top-0 mb-3" style="min-width: 64rem; max-width: 64rem; min-height: 20rem; max-height: 20rem;">
                <p>Dê-me um cigarro<br>Diz a gramática<br>Do professor e do aluno<br>E do mulato sabido<br>Mas o bom negro e o bom branco<br>Da Nação Brasileira<br>Dizem todos os dias<br>Deixa disso camarada<br>Me dá um cigarro.</p>
                <p>(Pronominais, Oswald de Andrade)</p>
                <p>Oswald de Andrade foi um dos principais autores da primeira fase do modernismo no Brasil. Na poesia acima, o escritor propõe:</p><br><br>A) a busca de uma identidade universal.<br>B) a valorização da linguagem coloquial brasileira.<br>C) uma crítica aos maus hábitos, como o tabagismo.<br>D) enfatizar a relação entre professor e aluno.<br>E) repensar o uso do português do Brasil.
            </div>
        </div>
    </section>

    <footer>
        <p><a href="https://ckeditor.com/ckeditor-5/" target="_blank" rel="noopener">CKEditor 5</a>
            – Rich text editor of tomorrow, available today
        </p>
        <p>Copyright © 2003-2020,
            <a href="https://cksource.com/" target="_blank" rel="noopener">CKSource</a>
            – Frederico Knabben. All rights reserved.
        </p>
    </footer>


    <!--Importações do CKEditor-->
    <script src="../../libraries/ckeditor/ckeditor.js"></script>
    <script>
        DecoupledEditor
            .create(document.querySelector("#editor0"))
            .then(editor0 => {
                const toolbarContainer0 = document.querySelector("#toolbar-container0");

                toolbarContainer0.appendChild(editor0.ui.view.toolbar.element);
            })
            .catch(error0 => {
                console.error0(error0);
            });
    </script>

    <!--<script src="https://ckeditor.com/apps/ckfinder/3.5.0/ckfinder.js"></script>
    <script src="../../libraries/ckeditor - custom/build/ckeditor.js"></script>
    <script>
        const watchdog = new CKSource.Watchdog();

        window.watchdog = watchdog;

        watchdog.setCreator((element, config) => {
            return CKSource.Editor
                .create(element, config)
                .then(editor => {
                    return editor;
                })
        });

        watchdog.setDestructor(editor => {
            return editor.destroy();
        });

        watchdog.on('error', handleError);

        watchdog
            .create(document.querySelector('#editor'), {
                toolbar: {
                    items: [
                        'heading',
                        '|',
                        'fontFamily',
                        'fontSize',
                        'fontColor',
                        'fontBackgroundColor',
                        'highlight',
                        'bold',
                        'italic',
                        'strikethrough',
                        'underline',
                        '|',
                        'subscript',
                        'superscript',
                        'alignment',
                        'indent',
                        'outdent',
                        'removeFormat',
                        '|',
                        'specialCharacters',
                        'MathType',
                        'ChemType',
                        'blockQuote',
                        'link',
                        'horizontalLine',
                        'bulletedList',
                        'numberedList',
                        'insertTable',
                        'CKFinder',
                        '|',
                        'exportPdf',
                        'exportWord',
                        'undo',
                        'redo'
                    ]
                },
                language: 'pt-br',
                table: {
                    contentToolbar: [
                        'tableColumn',
                        'tableRow',
                        'mergeTableCells',
                        'tableCellProperties',
                        'tableProperties'
                    ]
                }
            })
            .catch(handleError);

        function handleError(error) {
            console.error('Oops, something went wrong!');
            console.error('Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:');
            console.warn('Build id: nh8ufpfzmkzv-23v807lh1m7m');
            console.error(error);
        }
    </script>-->
</body>

</html>