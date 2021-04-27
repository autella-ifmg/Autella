<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Autella</title>

    <link rel="stylesheet" href="/libraries/bootstrap/bootstrap.css">
    <script src="../../libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="../../libraries/bootstrap/bootstrap.bundle.js"></script>

    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/sessionDebug.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect/discipline.php';
    ?>
</head>

<body>
    <section class="d-flex justify-content-center">
        <div class="d-flex flex-column">
            <div class="w-25 mt-3 mb-3">
                <label for="test">Disciplina:</label>
                <select name="test" id="test" class="form-control" onchange="showSubjectNames()">
                    <?php selectDisciplineNamesToDropdowns(2) ?>
                </select>
            </div>

            <div id="subjectNames"></div>
        </div>
    </section>

    <script>
        function showSubjectNames() {
            var id_discipline = document.getElementById("test");
            id_discipline = id_discipline.value;

            $.ajax({
                type: "POST",
                url: "testSQL.php",
                data: {
                    id_discipline
                },
                success: function(array) {
                    var subjectNames = JSON.parse(array);
                    //console.log(subjectNames);

                    var message = "";
                    for (let i = 0; i < subjectNames.length; i++) {
                        message += subjectNames[i];

                        if (i < (subjectNames.length - 1)) {
                            message += ", ";
                        } else {
                            message += ".";
                        }
                    }

                    $("#subjectNames").html(message).fadeIn;
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script>
</body>

</html>