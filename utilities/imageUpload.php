<?php
function uploadProfileImage($image)
{
    //Stores the filetype e.g image/jpeg
    // $imageType = explode("/", $_FILES['inputImage']['type'])[1];

    //The path you wish to upload the image to
    $imagePath = "../../images/users/";

    if (is_uploaded_file($image)) {
        if (move_uploaded_file($image, $imagePath . $_SESSION['userData']['id'] . '.jpeg')) {
            $message =  "Imagem enviada com sucesso!";
        } else {
            $message = "Erro 1 ao enviar imagem!";
        }
    } else {
        $message = "Erro 2 ao enviar imagem!";
    }
    array_push($_SESSION['debug'], $message);
}
