<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Autella</title>
    <link rel="stylesheet" href="/libraries/bootstrap/bootstrap.css">

    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/sessionDebug.php'; ?>
</head>

<body>
<script>
        DecoupledEditor
            .create(document.querySelector("#editorUpdate"))
            .then(editorUpdate => {
                const toolbarContainerUpdate = document.querySelector("#toolbarContainerUpdate");

                toolbarContainerUpdate.appendChild(editorUpdate.ui.view.toolbar.element);
            })
            .catch(errorUpdate => {
                console.error1(errorUpdate);
            });
    </script>

    <script src="/libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="/libraries/bootstrap/bootstrap.bundle.js"></script>
</body>

</html>