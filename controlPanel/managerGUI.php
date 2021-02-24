<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autella | Visualizar questões</title>
    <link rel="stylesheet" href="../libraries/bootstrap/bootstrap.css">
    <script src="../libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="../libraries/bootstrap/bootstrap.bundle.js"></script>
    <?php session_start(); ?>
</head>

<body>
    <!--Navbar-->
    <?php require_once '../views/navbar.php'; ?>

    <section>
        <h3 class="text-center font-weight-bold text-primary mt-4 mb-2">Selecione a instituição que você deseja explorar:</h3>

        <div class="d-flex align-items-center mx-4">
            <select name="institutions" id="institutions" class="form-control" onchange="selectInstitution()">
                <?php
                require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect/institution.php';
                institutionNamesToDropdownItems(1);
                ?>
            </select>
        </div>
    </section>

    <?php require_once '../views/genericToast.php'; ?>

    <script>
        function selectInstitution() {
            var selectInstitution = document.getElementById("institutions");
            var id_institution = selectInstitution.value;

            var option = document.getElementById(id_institution);
            var institution_name = option.textContent;

            var message = `Instituição \"<strong>${institution_name}</strong>\" selecionada com sucesso!`;

            $.ajax({
                type: "POST",
                url: "managerSQL.php",
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