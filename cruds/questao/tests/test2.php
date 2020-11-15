<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test 2</title>
    <link rel="stylesheet" href="../../../libraries/bootstrap/bootstrap.css">
</head>

<body>
    <!--Select do número de alternativas-->
    <div class="form-group">
        <label for="teste">Número de alternativas:</label>
        <select name="teste" id="teste" class="btn btn-primary dropdown-toggle" onchange="updateCorrectAnswer()" required>
            <option></option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    </div>

    <!--Select da alternativa correta-->
    <div class="form-group">
        <label for="correctAnswer">Alternativa correta:</label>
        <select name="correctAnswer" id="correctAnswer" class="btn btn-primary dropdown-toggle" required></select>
    </div>
    </section>

    <script>
        document.querySelector("#answers").addEventListener("click", () => {
            let answers = document.getElementById("answers");
            let optionValue = answers.options[answers.selectedIndex].value;
            console.log(optionValue);
        });
    </script>

    <!--Importações do Bootstrap-->
    <script src="../../../libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="../../../libraries/bootstrap/bootstrap.bundle.js"></script>

    <script>
        /*
        $(".dropdown-menu a").click(function() {
            $(this).parents(".dropdown").find('.btn').html(' ' + $(this).text() + ' ');
            $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
        });
        */
        function updateCorrectAnswer() {
            var id_field = document.getElementById("teste");
            var id_field = id_field.value;

            var container = document.getElementById("correctAnswer");
            container.innerHTML = "";

            var option = document.createElement("option");
            container.appendChild(option);

            array = ["A", "B", "C", "D", "E"];

            for (let i = 0; i < id_field; i++) {
                var option = document.createElement("option");
                option.setAttribute("value", array[i]);
                option.setAttribute("label", array[i]);
                container.appendChild(option);
            }
        };
        /*
               function updateCorrectAnswer() {
                   var testeQuant = document.getElementById("teste");
                   var testeQuant = testeQuant.value;

                   var selectCorrectAnswer = document.getElementById("correctAnswer");
                   selectCorrectAnswer.innerHTML = "";

                   var option = document.createElement("option");
                   selectCorrectAnswer.appendChild(option);

                   teste = ["A", "B", "C", "D", "E"];

                   for (let i = 0; i < testeQuant; i++) {
                       var option = document.createElement("option");
                       option.setAttribute("value", teste[i]);
                       option.setAttribute("label", teste[i]);
                       selectCorrectAnswer.appendChild(option);
                   }
               };

               //document.addEventListener('DOMContentLoaded', updateDisciplines(), false);
               */
    </script>
</body>

</html>