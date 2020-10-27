<!DOCTYPE html>

<!-- <html> -->
<html class="h-100 w-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <title>Autella</title>
</head>

<!-- <body> -->

<body class="h-100">
    <?php
    require_once 'utilities/sessionMessage.php';
    if (isset($_SESSION['userData'])) {
        require_once 'views/homepageUser.php';
    } else {
        require_once 'views/homepageGuest.php';
    }
    ?>

    <script src="bootstrap/jquery-3.5.1.js"></script>
    <script src="bootstrap/bootstrap.bundle.js"></script>
    <script>
        $('.toast').toast('show');
    </script>
</body>

</html>