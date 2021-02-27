<?php

function forCreate()
{
    $letters = ["A", "B", "C", "D", "E"];

    echo '<script>
    const watchdog = new CKSource.Watchdog();

    window.watchdog = watchdog;';

    echo "\n";

    for ($i = 0; $i < 6; $i++) {
        if ($i == 0) {
            $placeholder = 'placeholder: "Enunciado da questão...",';
        } else {
            $placeholder = 'placeholder: "Insira aqui a alternativa ' . $letters[$i-1] . '...",';
        }
        echo '         
    watchdog.setCreator((element' . $i . ', config' . $i . ') => {
        return CKSource.Editor
            .create(element' . $i . ', config' . $i . ')
            .then(editor' . $i . ' => { 
                return editor' . $i . ';
            })
    });

    watchdog.setDestructor(editor' . $i . ' => {
        return editor' . $i . '.destroy();
    });

    watchdog.on("error' . $i . '", handleError);

    watchdog
        .create(document.querySelector("#editor' . $i . '"), {' .
            $placeholder .
            'toolbar: {
                items: [
                    "heading",
                    "|",
                    "fontFamily",
                    "fontSize",
                    "fontColor",
                    "fontBackgroundColor",
                    "|",
                    "bold",
                    "italic",
                    "underline",
                    "strikethrough",
                    "highlight",
                    "|",
                    "subscript",
                    "superscript",
                    "|",
                    "alignment",
                    "indent",
                    "outdent",
                    "|",
                    "removeFormat",
                    "|",
                    "specialCharacters",
                    "MathType",
                    "ChemType",
                    "|",
                    "blockQuote",
                    "insertTable",
                    "numberedList",
                    "bulletedList",
                    "horizontalLine",
                    "|",
                    "CKFinder",
                    "link",
                    "|",
                    "exportPdf",
                    "exportWord",
                    "|",
                    "undo",
                    "redo"
                ]
            },
            language: "pt-br",
            table: {
                contentToolbar: [
                    "tableColumn",
                    "tableRow",
                    "mergeTableCells",
                    "tableCellProperties",
                    "tableProperties"
                ]
            },
            licenseKey: "",
        })
        .catch(handleError);';
    }

    echo "\n";

    echo '
    function handleError(error) {
        console.error("Oops, something went wrong!");
        console.error("Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:");
        console.warn("Build id: yfh0qr9ny5x9-z26bne1l3y69");
        console.error(error);
    }

</script>';

    echo "\n";
}

function forRead($questions)
{
    if (count($questions) > 0) {
        echo '<script>
        const watchdog = new CKSource.Watchdog();

        window.watchdog = watchdog;';

        echo "\n";

        for ($i = 0; $i < count($questions); $i++) {
            echo '         
        watchdog.setCreator((element' . $i . ', config' . $i . ') => {
            return CKSource.Editor
                .create(element' . $i . ', config' . $i . ')
                .then(editor' . $i . ' => {
                    editor' . $i . '.isReadOnly = true;

                    return editor' . $i . ';
                })
        });

        watchdog.setDestructor(editor' . $i . ' => {
            return editor' . $i . '.destroy();
        });

        watchdog.on("error' . $i . '", handleError);

        watchdog
            .create(document.querySelector("#editor' . $i . '"), {
                language: "pt-br",
                licenseKey: "",
            })
            .catch(handleError);';
        }

        echo "\n";

        echo '
        function handleError(error) {
            console.error("Oops, something went wrong!");
            console.error("Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:");
            console.warn("Build id: yfh0qr9ny5x9-z26bne1l3y69");
            console.error(error);
        }
    
    </script>';

        echo "\n";
    }
}

function forUpdate()
{
    echo '<script>
    const watchdog = new CKSource.Watchdog();

    window.watchdog = watchdog;

    watchdog.setCreator((element0, config0) => {
        return CKSource.Editor
            .create(element0, config0)
            .then(editor0 => {
                return editor0;
            })
    });

    watchdog.setDestructor(editor0 => {
        return editor0.destroy();
    });

    watchdog.on("error0", handleError);

    watchdog
        .create(document.querySelector("#editor0"), {
            toolbar: {
                items: [
                    "heading",
                    "|",
                    "fontFamily",
                    "fontSize",
                    "fontColor",
                    "fontBackgroundColor",
                    "|",
                    "bold",
                    "italic",
                    "underline",
                    "strikethrough",
                    "highlight",
                    "|",
                    "subscript",
                    "superscript",
                    "|",
                    "alignment",
                    "indent",
                    "outdent",
                    "|",
                    "removeFormat",
                    "|",
                    "specialCharacters",
                    "MathType",
                    "ChemType",
                    "|",
                    "blockQuote",
                    "insertTable",
                    "numberedList",
                    "bulletedList",
                    "horizontalLine",
                    "|",
                    "CKFinder",
                    "link",
                    "|",
                    "exportPdf",
                    "exportWord",
                    "|",
                    "undo",
                    "redo"
                ]
            },
            language: "pt-br",
            table: {
                contentToolbar: [
                    "tableColumn",
                    "tableRow",
                    "mergeTableCells",
                    "tableCellProperties",
                    "tableProperties"
                ]
            },
            licenseKey: "",

        })
        .catch(handleError);

    function handleError(error) {
        console.error("Oops, something went wrong!");
        console.error("Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:");
        console.warn("Build id: yfh0qr9ny5x9-z26bne1l3y69");
        console.error(error);
    }
    </script>';

    echo "\n";
}
