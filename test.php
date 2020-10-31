<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="libraries/cropperjs/cropper.css">
</head>

<body>
    <div>
        <img id="image" src="image0.jpg">
    </div>

    <script src="libraries/cropperjs/cropper.js"></script>
    <script>
        //import Cropper from 'cropperjs';

        const image = document.getElementById('image');
        const cropper = new Cropper(image, {
            aspectRatio: 1 / 1, dragMode: 'move', background: false
        });
    </script>
</body>

</html>