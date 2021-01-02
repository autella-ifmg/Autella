<?php
if (isset($_GET['id'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';
    $id = $_GET['id'];

    $sql = "SELECT user.name, user.email, field.id, discipline.id, role.id
            FROM discipline 
            JOIN field ON discipline.id_field = field.id 
            JOIN user ON user.id_discipline = discipline.id 
            JOIN role ON user.id_role = role.id 
            AND user.id = '$id';";

    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) != 0) {
        $array = mysqli_fetch_array($result);

        $otherProfileName = $array[0];
        $otherProfileEmail = $array[1];
        $otherProfileField = $array[2];
        $otherProfileDiscipline = $array[3];
        $otherProfileRole = $array[4];

        $connection->close();
    } else {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/authentication/404.php';
        die();
    }
} else {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/authentication/404.php';
    die();
}
?>

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
    require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/formValidator.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect/discipline.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect/field.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect/institution.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect/role.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect/user.php';
    ?>
</head>

<body class="h-100 w-100 row align-items-center justify-content-center">
    <div class="col-12 ml-4 col-sm-10 col-lg-8 col-xl-6">
        <h1 class="text-center mb-3 mb-sm-5">Autella <span class="d-none d-sm-inline">| Alterar conta</span></h1>

        <form action="userUpdateSQL.php?id=<?php echo $_GET['id'] ?>" method="POST" novalidate class="needs-validation">
            <div class="form-group">
                <label>Nome</label>
                <input required type="text" class="form-control" name="name" value="<?php echo $otherProfileName ?>">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input required type="email" class="form-control" name="email" value="<?php echo $otherProfileEmail ?>">
            </div>

            <div class="form-group">
                <label>Nova senha</label>
                <input required type="password" class="form-control" id="password" name="password">
            </div>

            <div class="form-group">
                <label>Confirmar nova senha</label>
                <input required type="password" class="form-control" id="confirmPassword" name="confirmPassword">
            </div>

            <div class="row justify-content-between mb-0 mx-1 mb-sm-3">
                <div class="col-12 mt-3 col-sm-8 mt-sm-0 row">
                    <label class="col-12 pl-0">Área</label>
                    <select onchange="updateDisciplines()" class="btn border col-12" id="fieldList">
                        <?php fieldNamesToDropdownItems(); ?>
                    </select>
                </div>

                <div class="col-12 mt-3 col-sm-3 mt-sm-0 row">
                    <label class="col-12 pl-0">Disciplina</label>
                    <select class="btn border col-12" name="disciplineId" id="disciplineList">
                        <!-- Preenchido com <script> -->
                    </select>
                </div>
            </div>

            <div class="row justify-content-between mb-0 mx-1 mb-sm-5">
                <div class="col-12 mt-3 col-sm-8 mt-sm-0  row" <?php
                                                                if (getAccountRole($_SESSION['userData']['id']) != 5) {
                                                                    echo ' style="display:none"';
                                                                }
                                                                ?>>
                    <label class="col-12 pl-0">Instituição</label>

                    <!-- Desabilitar caso não seja o gerenciador do sistema -->
                    <select class="dropdown-toggle btn border col-12" name="institutionId">
                        <?php institutionNamesToDropdownItems() ?>
                    </select>
                </div>

                <div class="col-12 mt-3 col-sm-3 mt-sm-0 row <?php
                                                                if (getAccountRole($_SESSION['userData']['id']) != 5) {
                                                                    echo ' col-sm-8';
                                                                }
                                                                ?>">
                    <label class="col-12 pl-0">Cargo</label>
                    <select class="dropdown-toggle btn border col-12" name="roleId" id="rolesList">
                        <?php roleNamesToDropdownItems(); ?>
                    </select>
                </div>
            </div>

            <div class="d-flex justify-content-between pt-4 pt-sm-0">
                <a class="btn btn-danger btn-lg" href="../../index.php">Cancelar</a>
                <input type="submit" class="btn btn-success btn-lg" name="submit" value="Alterar conta">
            </div>
        </form>
    </div>

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
    <p>a</p>
</body>

</html>