<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/index.php">Autella</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/cruds/questao/createGUI.php">Criar questão</a>
            </li>
            <li>
                <a class="nav-link" href="/cruds/provaSimples/create.php">Prova Simples</a>
            </li>

            <?php
            if ($_SESSION['userData']['id_role'] == 1) {
                echo '<li>
                    <a class="nav-link" href="/cruds/controlPanel/userReadGUI.php">Painel de controle</a>
                </li>';
            }
            ?>
        </ul>


        <ul class="navbar-nav ml-auto align-items-center">
            <li class="nav-item">
                <a style="color: rgb(124, 124, 124); font-weight: bold" class="nav-link"><?php echo $_SESSION['userData']['name']; ?>&nbsp </a>
                <span style="text-align: right; font-size: 0.8rem; color: rgb(166, 166, 166)" class="nav-link pt-0">
                    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/dbSelect.php';
                    echo idRoleToRoleName($_SESSION['userData']['id_role']); ?>
                </span>
            </li>

            <li class="nav-item pr-3"">
                <div class=" dropdown" style="cursor: pointer;">
                <img data-toggle="dropdown" src="http://autella.com/libraries/bootstrap/bootstrap-icons-1.0.0/chevron-down.svg" alt="">
                <img data-toggle="dropdown" class="rounded-circle d-inline-block" style="width: 64px; height: 64px" src="/images/users/<?php echo $_SESSION['userData']['id'] ?>.jpeg<?php echo '?' . time() ?>" />

                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="position: absolute; left: -4rem">
                    <a class="dropdown-item" href="/cruds/user/readGUI.php?id=<?php echo $_SESSION['userData']['id']; ?>">Sua conta</a>
                    <a class="dropdown-item" href="/cruds/institution/readGUI.php?id=<?php echo $_SESSION['userData']['id_institution'] ?>">Sua instituição</a>
                    <a class="dropdown-item" href="/utilities/logout.php">Logout</a>
                </div>

            </li>
        </ul>
    </div>
</nav>