<!DOCTYPE html>

<html class="h-100 w-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Autella</title>

    <link rel="stylesheet" href="/libraries/bootstrap/bootstrap.css">
    <script src="/libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="/libraries/bootstrap/bootstrap.bundle.js"></script>
    <script src="/libraries/p5js/p5.js"></script>
    <script src="/libraries/p5js/p5.dom.js"></script>
    <script src="/libraries/p5js/p5.sound.js"></script>

    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/sessionDebug.php'; ?>
</head>

<body class="h-100 w-100 d-flex flex-column">
    <header>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/views/navbar.php'; ?>
    </header>

    <script>
        let increment = 0.01;
        let start = 0;

        function setup() {
            createCanvas(1280, 700);
            let canvas = document.getElementById("defaultCanvas0");
            canvas.classList.add("flex-grow-1");
            canvas.classList.add("w-100");


            time = 0;
            background(0);
            time = 0;
        }

        function draw() {
            background(0);
            stroke(255);
            strokeWeight(3);



            textSize(100);
            text("Autella", width/2 - 150, height/2);
            // Comment line for interesting effect
            //noFill();

            beginShape();
            let xOffset = start;
            for (let i = 0; i < width; i++) {
                let x = i;
                let y = map(noise(xOffset), 0, 1, 0, height);
                vertex(x, y);

                xOffset += increment;
            }
            endShape();

            start += increment;

            // Diminui velocidade do gráfico
            //start += increment / 8;

            // Aumenta velocidade do gráfico
            // start += increment * 8;

        }
    </script>


</body>

</html>