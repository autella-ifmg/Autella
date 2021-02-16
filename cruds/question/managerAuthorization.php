<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autella | Visualizar questões</title>
    <link rel="stylesheet" href="../../libraries/bootstrap/bootstrap.css">
    <script src="../../libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="../../libraries/bootstrap/bootstrap.bundle.js"></script>
    <?php session_start(); ?>
</head>

<body>
    <!--Navbar-->
    <?php require_once '../../views/navbar.php'; ?>

    <h1 class="text-center font-weight-bold text-primary mt-4 mb-2">Selecione a instituição que você deseja explorar:</h1>
    
    <div class="d-flex align-items-center mx-4">
        <select name="institutions" id="institutions" class="form-control" onchange="roleIsManager()">
            <?php
            require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect/institution.php';
            institutionNamesToDropdownItems();
            ?>
        </select>
    </div>

    <script src="../../utilities/jsFunctions/question/verifications.js"></script>
    <script src="../../utilities/jsFunctions/question/filtersSystem.js"></script>
    <script>
        id_institution = 0;

        appliedFilters = [
            [],
            [],
            [],
            []
        ];
    </script>
</body>

</html>