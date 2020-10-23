<?php
if (!isset($_SESSION['userData'])) {
    echo '<div class="jumbotron">
    <h1 class="display-4">Acesso não autorizado!</h1>
    <p class="lead">É preciso fazer login para acessar essa página!</p>
    <hr class="my-4">
    <p class="lead">
      <a class="btn btn-primary btn-lg" href="/autella.com/index.php" role="button">Voltar para a tela inicial</a>
    </p>
  </div>';
    die();
}
