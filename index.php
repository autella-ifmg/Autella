<!DOCTYPE html>

<html class="h-100 w-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <link rel="stylesheet" href="/libraries/bootstrap/bootstrap.css">
    <title>Autella</title>
</head>

<body class="h-100 w-100">
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/sessionMessage.php';

    if (isset($_SESSION['userData'])) {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/navbar.php';
    } else {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/loginProfessor.php';
    }
    ?>

    <script src="/libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="/libraries/bootstrap/bootstrap.bundle.js"></script>
    <script>
        $(window).on('load', function() {
            $('#messageModal').modal('show');
            setTimeout(function() {
                $('#messageModal').modal('hide');
            }, 1500);
        });
    </script>
</body>

</html>