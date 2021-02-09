<?php

function forEditing()
{
    echo '<script>
    const watchdog = new CKSource.Watchdog();

    window.watchdog = watchdog;

    watchdog.setCreator((element, config) => {
        return CKSource.Editor
            .create(element, config)
            .then(editor => {
                document.querySelector("#toolbar").appendChild(editor.ui.view.toolbar.element);
                document.querySelector(".ck-toolbar").classList.add("ck-reset_all");

                return editor;
            })
    });

    watchdog.setDestructor(editor => {
        document.querySelector("#toolbar").removeChild(editor.ui.view.toolbar.element);

        return editor.destroy();
    });

    watchdog.on("error", handleError);

    watchdog
        .create(document.querySelector("#editor"), {
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
                    document.querySelector("#toolbar' . $i . '").appendChild(editor' . $i . '.ui.view.toolbar.element);
                    document.querySelector(".ck-toolbar").classList.add("ck-reset_all");
                    editor' . $i . '.isReadOnly = true;

                    return editor' . $i . ';
                })
        });

        watchdog.setDestructor(editor' . $i . ' => {
            document.querySelector("#toolbar' . $i . '").removeChild(editor' . $i . '.ui.view.toolbar.element);

            return editor' . $i . '.destroy();
        });

        watchdog.on("error' . $i . '", handleError);

        watchdog
            .create(document.querySelector("#editor' . $i . '"), {
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
}
