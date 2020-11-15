<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test 3</title>
    <link rel="stylesheet" href="../../../libraries/bootstrap/bootstrap.css">
    <style>
        img {
            background-color: powderblue;
        }

        textarea {
            resize: none;
        }
    </style>
</head>

<body>

    <section class="d-flex flex-column">
        <div class="d-flex flex-row">
            <img src="../../../images/alternatives/0.png" alt="A" class="rounded-circle mr-1 mb-3">
            <textarea name="questionA" id="questionA" cols="90" rows="3" class="ml-1 mb-3"></textarea>
        </div>

        <div class="d-flex flex-row">
            <img src="../../../images/alternatives/1.png" alt="B" class="rounded-circle mr-1 mb-3">
            <textarea name="questionB" id="questionB" cols="90" rows="3" class="ml-1 mb-3"></textarea>
        </div>

        <div class="d-flex flex-row">
            <img src="../../../images/alternatives/2.png" alt="C" class="rounded-circle mr-1 mb-3">
            <textarea name="questionC" id="questionC" cols="90" rows="3" class="ml-1 mb-3"></textarea>
        </div>

        <div class="d-flex flex-row">
            <img src="../../../images/alternatives/3.png" alt="D" class="rounded-circle mr-1 mb-3">
            <textarea name="questionD" id="questionD" cols="90" rows="3" class="ml-1 mb-3"></textarea>
        </div>

        <div class="d-flex flex-row">
            <img src="../../../images/alternatives/4.png" alt="E" class="rounded-circle mr-1 mb-3">
            <textarea name="questionE" id="questionE" cols="90" rows="3" class="ml-1 mb-3"></textarea>
        </div>
    </section>


    <form method="post">
        <div class="form-group">
            <label for="alternatives">Número de alternativas:</label>
            <select name="alternatives" id="alternatives" class="btn btn-primary dropdown-toggle" onchange="updateEnunciateFields()" required>
                <option></option>
                <option value=4>4</option>
                <option value=5>5</option>
            </select>
        </div>


        <section id="container_section" class="d-flex flex-column"></section>

    </form>

    <script>
        function updateEnunciateFields() {
            var alternativesQuant = document.getElementById("alternatives");
            alternativesQuant = alternativesQuant.value;

            var section = document.getElementById("container_section");
            section.innerHTML = "";

            alternatives = ["A", "B", "C", "D", "E"];

            for (let i = 0; i < alternativesQuant; i++) {
                let div = document.createElement("div");
                div.setAttribute("id", "container_div");
                div.setAttribute("class", "d-flex flex-row");
                section.appendChild(div);

                let img = document.createElement("img");
                img.setAttribute("src", `../../../images/alternatives/${i}.png`);
                img.setAttribute("alt", alternatives[i]);
                img.setAttribute("class", "rounded-circle mr-1 mb-3");
                img.setAttribute("style", "background-color: powderblue;")
                div.appendChild(img);

                let textarea = document.createElement("textarea");
                textarea.setAttribute("name", `question${alternatives[i]}`);
                textarea.setAttribute("id", `question${alternatives[i]}`);
                textarea.setAttribute("cols", "90");
                textarea.setAttribute("rows", "3");
                textarea.setAttribute("class", "ml-1 mb-3");
                textarea.setAttribute("style", "resize: none;");
                div.appendChild(textarea);
            }
        }
    </script>

    <!--Importações do Bootstrap-->
    <script src="../../../libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="../../../libraries/bootstrap/bootstrap.bundle.js"></script>
</body>

</html>