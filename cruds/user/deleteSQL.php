<?php
if (isset($_POST['submit'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';

    function secure($data)
    {
        global $connection;
        $data = mysqli_escape_string($connection, $data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $oldPassword = secure($_POST['oldPassword']);

    if ($oldPassword == $_SESSION['userData']['password']) {
        date_default_timezone_set('America/Sao_Paulo');

        $sql = "UPDATE user SET email='[Conta deletada]', name='[Conta deletada em " . date('d-m-Y h:i:s A') . "]', password='" . rand() . "' 
                    WHERE id=" . $_SESSION['userData']['id'];

        if ($connection->query($sql) === TRUE) {
            array_push($_SESSION['debug'], "Conta excluída com sucesso!");

            // Remover imagem de perfil
            $path = "../../images/userDefault.jpeg";
            $data = file_get_contents($path);
            $image_name = '../../images/users/' . $_SESSION['userData']['id'] . '.jpeg';
            file_put_contents($image_name, $data);

            // Logout
            require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/logout.php';
        } else {
            array_push($_SESSION['debug'], "Erro ao excluir conta!");
        }
    } else {
        array_push($_SESSION['debug'], "Senha atual incorreta!");
    }

    $connection->close();

    header("Location: ../../index.php");
}
