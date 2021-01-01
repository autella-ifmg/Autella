<?php
function secure($data)
{
    global $connection;
    $data = mysqli_escape_string($connection, $data);
    $data = htmlspecialchars($data);
    return $data;
}

// Fazer função que recebe um inteiro e checa autorização
// Ex.: se passar 0, permite todo mundo
// se passar 1, só permite professores
// se passar 2, só permite professores e coordenadores
// se passar 3, só permite administradores do site


// $option == 1
// if account desactivated, allow only for account owner, coordinator and system manager
function securePage($option, $aux1)
{
    switch ($option) {
        case 1: {
                require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect/user.php';
                if (getAccountRole($aux1) == 5) {
                    // O usuário é um gerenciador do sistema, acesso proibido
                    require_once $_SERVER['DOCUMENT_ROOT'] . '/authentication/403.php';
                    die();
                } else {
                    // O usuário NÃO é um gerenciador do sistema
                    if (
                        $_SESSION['userData']['id'] == $aux1  || $_SESSION['userData']['id_role'] == 5
                        || ($_SESSION['userData']['id_role'] == 1 && getAccountCoordinator($aux1) == $_SESSION['userData']['id'])
                    ) {
                        // Essa página está sendo acessada pelo próprio usuário ou pelo coordenador ou pelo gerenciador do sistema
                    } else {
                        // Essa página NÃO está sendo acessada pelo próprio usuário
                        // Verificar se conta está ativa
                        if (getAccountStatus($aux1) == 1) {
                            // Conta ativa
                        } else {
                            // Conta inativa
                            // Redirecionar para página de "Essa conta encontra-se desativada" e bloquear restante da exibição
                            require_once $_SERVER['DOCUMENT_ROOT'] . '/authentication/innactiveAccount.php';
                            die();
                        }
                    }
                }
            }
    }
}
