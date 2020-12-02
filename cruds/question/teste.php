<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <script>
        var questionNumber = 10;
        var position;
        var str = questionNumber.toString();
        console.log(str)
        console.log(str.substr(-1))
        if ((str.substr(-1)) > 5) {
            position = Math.ceil(questionNumber % 5) - 1;
            console.log(position)
        } else if ((str.substr(-1)) == 0) {
            position = 4;
            console.log(position)
        } else {
            questionNumber -= 1;
            str = questionNumber.toString();
            position = Number.parseInt(str.substr(-1));
            console.log(position);
        }
    </script>
</body>

</html>