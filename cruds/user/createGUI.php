<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/dbSelect.php'; ?>

<!DOCTYPE html>

<html class="h-100 w-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="/libraries/bootstrap/bootstrap.css">
    <title>Autella</title>
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/sessionDebug.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/formValidator.php';
    ?>
</head>

<body class="h-100 w-100 row align-items-center justify-content-center">
    <div class="col-12 ml-4    col-sm-10    col-lg-8    col-xl-6">
        <h1 class="text-center mb-3 mb-sm-5">Autella <span class="d-none d-sm-inline">| Criar conta</span></h1>

        <form action="createSQL.php" method="POST" novalidate class="needs-validation">

            <label>Nome</label>
            <input type="text" class="form-control mb-3" name="inputName" required>

            <label>Email</label>
            <input type="email" class="form-control mb-3" name="inputEmail" required>

            <label>Nova senha</label>
            <input type="password" class="form-control mb-3" id="inputPassword" name="inputPassword" required>
            

            <label>Confirmar nova senha</label>
            <input type="password" class="form-control mb-3" id="inputConfirmPassword" name="inputConfirmPassword" required>


            <div class="row justify-content-between mb-0 mx-1    mb-sm-3">
                <div class="col-12 mt-3    col-sm-8 mt-sm-0    row">
                    <label class="col-12 pl-0">Área</label>
                    <select onchange="updateDisciplines()" class="btn border col-12" id="fieldList">
                        <?php fieldNamesToDropdownItems(); ?>
                    </select>
                </div>

                <div class="col-12 mt-3    col-sm-3 mt-sm-0    row">
                    <label class="col-12 pl-0">Disciplina</label>
                    <select class="btn border col-12" name="inputDisciplineId" id="disciplineList">
                        <!-- Preenchido com <script> -->
                    </select>
                </div>
            </div>

            <div class="row justify-content-between mb-0 mx-1    mb-sm-5">
                <div class="col-12 mt-3    col-sm-8 mt-sm-0     row">
                    <label class="col-12 pl-0">Instituição</label>
                    <select class="dropdown-toggle btn border col-10" name="inputInstitutionId">
                        <?php institutionNamesToDropdownItems() ?>
                    </select>
                    <a class="col-2 p-0 pl-4" data-toggle="tooltip" data-placement="bottom" title="Cadastrar instituição" href="../institution/createGUI.php">
                        <img src="../../libraries/bootstrap/bootstrap-icons-1.0.0/plus-circle.svg" width="40" height="40" />
                    </a>
                </div>

                <div class="col-12 mt-3    col-sm-3 mt-sm-0     row">
                    <label class="col-12 pl-0">Cargo</label>
                    <select class="dropdown-toggle btn border col-12" name="inputRoleId" id="rolesList">
                        <?php roleNamesToDropdownItems(); ?>
                    </select>
                </div>
            </div>

            <div class="d-flex justify-content-between pt-4 pt-sm-0">
                <a class="btn btn-danger btn-lg" href="../../index.php">Cancelar</a>
                <input type="submit" class="btn btn-success btn-lg" name="inputSubmit" value="Criar conta">
            </div>
        </form>
    </div>

    <script src="/libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="/libraries/bootstrap/bootstrap.bundle.js"></script>
    <script>
        // Quando trocar a área, exibir apenas as disciplinas correspondentes a ela
        function updateDisciplines() {
            var id_field = document.getElementById("fieldList");
            var id_field = id_field.value;

            var container = document.getElementById("disciplineList");
            container.innerHTML = "";

            // Transforma array do php em array do js
            <?php
            $php_array = selectDisciplines();
            $js_array = json_encode($php_array);
            echo "var allDisciplines = " . $js_array . ";\n";
            ?>

            for (let i = 0; i < allDisciplines.length; i++) {
                if (allDisciplines[i][1] == id_field) {
                    var option = document.createElement("option");
                    option.innerHTML = allDisciplines[i][2];
                    option.setAttribute("value", allDisciplines[i][0]);

                    container.appendChild(option);
                }
            }
        };

        // Quando o documento estiver carregado, executar o método updateDisciplines()
        document.addEventListener('DOMContentLoaded', updateDisciplines(), false);
    </script>


</body>

</html>