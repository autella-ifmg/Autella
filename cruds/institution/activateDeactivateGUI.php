<!DOCTYPE html>

<html class="h-100 w-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Autella</title>

    <link rel="stylesheet" href="/libraries/bootstrap/bootstrap.css">
    <script src="/libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="/libraries/bootstrap/bootstrap.bundle.js"></script>

    <?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/sessionDebug.php'; 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect/institution.php'; 
    ?>
</head>

<body class="h-100 w-100">
    <div class="row mt-5 mx-5 justify-content-around">
        <h1 class="col-12 col-lg-8">TEM CERTEZA QUE DESEJA
        <?php
            if(getInstitutionStatus($_SESSION['userData']['id_institution']) == 1){
                echo "DESATIVAR";
            } else {
                echo "ATIVAR";
            }
        ?>    
        A INSTITUIÇÃO?</h1>
        <form class="col-12 col-lg-8" action="activateDeactivateSQL.php?id=<?php echo $_SESSION['userData']['id_institution'] ?>" method="post">
            <div class="d-flex justify-content-between pt-4 pt-sm-0 mt-5">
                <a class="btn btn-success btn-lg" href="../../index.php">Não</a>
                <input type="submit" class="btn btn-danger  btn-lg" name="submit" value="Sim">
            </div>
        </form>
    </div>
</body>

</html>