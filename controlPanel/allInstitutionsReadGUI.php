<!DOCTYPE html>

<html class="h-100 w-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Autella</title>

    <link rel="stylesheet" href="/libraries/bootstrap/bootstrap.css">
    <script src="/libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="/libraries/bootstrap/bootstrap.bundle.js"></script>

    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/sessionDebug.php'; ?>
</head>

<body class="h-100 w-100">
    <header>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/views/navbar.php'; ?>
    </header>

    <h3 class="text-center font-weight-bold text-secondary mt-3 mb-2">Selecione a instituição que você deseja explorar:</h3>

    <div class="d-flex align-items-center mx-4">
        <select name="institutions" id="institutions" class="form-control" onchange="selectInstitution()">
            <?php
            require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect/institution.php';
            institutionNamesToDropdownItems(1);
            ?>
        </select>
    </div>

    <hr class="mx-4">

    <main class="d-flex flex-column align-items-center flex-grow-1">
        <a class="btn btn-success mb-3" href="../cruds/institution/createGUI.php">Cadastrar instituição</a>
        <div class="d-inline-block border" style="width: 95%">
            <h3 class="text-center col-12 mt-3">Instituições</h3>
            <table class="table col-12">
                <thead class="thead-dark">
                    <th scope="col">Ver</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Conta ativa</th>
                    <!-- <th scope="col">Editar</th> -->
                </thead>

                <tbody>
                    <?php
                    require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect/institution.php';
                    institutionsToRows();
                    ?>
                </tbody>
            </table>
        </div>
    </main>

    <?php require_once '../views/genericToast.php'; ?>

    <script>
        function changeInstitutionStatus(id) {
            window.location.href = "../cruds/institution/activateDeactivateSQL.php?id=" + id;
        }

        function selectInstitution() {
            var selectInstitution = document.getElementById("institutions");
            var id_institution = selectInstitution.value;

            var option = document.getElementById(id_institution);
            var institution_name = option.textContent;

            var message = `Instituição \"<strong>${institution_name}</strong>\" selecionada com sucesso!`;

            $.ajax({
                type: "POST",
                url: "allInstitutionsReadSQL.php",
                data: {
                    id_institution
                },
                success: function() {
                    $("#img_toast").attr({
                        src: "../../../libraries/bootstrap/bootstrap-icons-1.0.0/house-fill.svg",
                        alt: "Instituição selecionada"
                    });
                    $("#span_toast").text("Instituição selecionada!");
                    $("#result").html(message).fadeIn();
                    $("#toast").toast("show");
                }
            });
        }
    </script>
</body>

</html>