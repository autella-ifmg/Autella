<?php require_once 'utilities/navbar.php' ?>

<div class=" modal fade" id="modalEditarConta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar conta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="professor/update.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputNome">Nome</label>
                        <input type="text" class="form-control" id="inputName" name="inputName" value="<?php echo $_SESSION['userData']['name'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" id="inputEmail" name="inputEmail" value="<?php echo $_SESSION['userData']['email']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="inputOldPassword">Senha atual</label>
                        <input type="password" class="form-control" id="inputOldPassword" name="inputOldPassword">
                    </div>

                    <div class="form-group">
                        <label for="inputNewPassword">Nova Senha</label>
                        <input type="password" class="form-control" id="inputNewPassword" name="inputNewPassword">
                    </div>

                    <div class="form-group">
                        <label for="inputImage">Imagem de perfil</label>
                        <input type="file" class="form-control" id="inputImage" name="inputImage">
                    </div>

                    <input type="submit" class="btn btn-primary" name="inputSubmit" value="Alterar dados">
                </form>
            </div>
        </div>
    </div>
</div>