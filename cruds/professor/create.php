<?php
if (isset($_POST['inputSubmit'])) {
    require_once '../../utilities/dbConnect.php';

    $email = $_POST['inputEmail'];
    $name = $_POST['inputName'];
    $password = $_POST['inputPassword'];
    $id_discipline = $_POST['inputDisciplineId'];

    // C:\wamp64\tmp\php9799.tmp
    // $image = '/autella.com/images/userDefault.jpg';
    $image = 'C:\wamp64\www\autella.com\images\userDefault.jpg';
    $image = file_get_contents($image);
    $image = mysqli_escape_string($connection, $image);

    $sql = "INSERT INTO professor (email, name, password, picture, id_discipline) VALUES 
    ('$email', '$name', '$password', '$image', '$id_discipline');";

    if ($connection->query($sql) === TRUE) {
        $message = "Conta criada com sucesso!";
    } else {
        $message = "Erro: " . $sql . "<br>" . $connection->error;
    }
    $connection->close();

    $_SESSION['message'] = $message;

    header('Location: ../../index.php');
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/dbSelect.php';

$id_field = 1;
?>

<!DOCTYPE html>
<html lang="en" class="w-100 h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autella | Criar conta</title>
    <link rel="stylesheet" href="../../libraries/bootstrap/bootstrap.css">
</head>

<body class="w-100 h-100" onload="updateDisciplines()">
    <div class="container w-100 h-100 d-flex flex-column align-items-center justify-content-center">

        <h1>Autella | Criar conta</h1>

        <form action="" method="post" class="w-50 mt-5">
            <div class="form-group">
                <label for="inputName">Nome</label>
                <input type="text" class="form-control" id="inputName" name="inputName">
            </div>

            <div class="form-group">
                <label for="inputEmail">Email</label>
                <input type="email" class="form-control" id="inputEmail" name="inputEmail">
            </div>

            <div class="form-group">
                <label for="inputPassword">Nova senha</label>
                <input type="password" class="form-control" id="inputPassword" name="inputPassword">
            </div>

            <div class="form-group">
                <label for="inputConfirmPassword">Confirmar nova senha</label>
                <input type="password" class="form-control" id="inputConfirmPassword" name="inputConfirmPassword">
            </div>

            <div class="d-flex justify-content-between mb-5">
                <select onchange="updateDisciplines()" class="dropdown-toggle btn border" id="fieldList">
                    <?php
                    fieldNamesToDropdownItems();
                    ?>
                </select>

                <select class="dropdown-toggle btn border" name="inputDisciplineId" id="disciplineList">
                    <?php
                    //disciplineNamesToDropdownItems();
                    ?>
                </select>
            </div>

            <div class="d-flex justify-content-between pt-5">
                <a class="btn btn-danger btn-lg" href="../../index.php">Cancelar</a>
                <input type="submit" class="btn btn-success btn-lg" name="inputSubmit" value="Criar conta">
            </div>
        </form>
    </div>

    <script src="../../libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="../../libraries/bootstrap/bootstrap.bundle.js"></script>
    <script>
        $(".dropdown-menu a").click(function() {
            $(this).parents(".dropdown").find('.btn').html(' ' + $(this).text() + ' ');
            $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
        });

        function updateDisciplines() {
            var id_field = document.getElementById("fieldList");
            var id_field = id_field.value;

            var container = document.getElementById("disciplineList");
            container.innerHTML = "";

            <?php
            $php_array = selectDisciplines();
            $js_array = json_encode($php_array);
            echo "var allDisciplines = " . $js_array . ";\n";
            ?>

            for (let i = 0; i < allDisciplines.length; i++) {
                if (allDisciplines[i][1] == id_field) {
                    var op = document.createElement("option");
                    var node = document.createTextNode(allDisciplines[i][2]);
                    op.appendChild(node);
                    op.setAttribute("value", allDisciplines[i][0]);

                    container.appendChild(op);
                }
            }
        };
    </script>
</body>

</html>