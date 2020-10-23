<div class="container h-100 d-flex align-items-center">
    <div class="d-flex justify-content-around">

        <div class="col-4">
            <h1 class="text-success display-4 font-weight-bold">Autella</h1>
            <h3>Crie provas e questões para a sala de aula com Autella</h3>
        </div>

        <div class="card py-3 col-4">
            <form action="professor/login.php" method="post">
                <div class="form-group">
                    <label for="inputEmail">Email</label>
                    <input type="email" class="form-control" id="inputEmail" name="inputEmail">
                </div>

                <div class="form-group">
                    <label for="inputSenha">Senha</label>
                    <input type="password" class="form-control" id="inputPassword" name="inputPassword">
                </div>
                <!-- <input type="submit" class="btn btn-success" name="inputSubmit" value="Entrar"> -->
                <input type="submit" class="btn btn-success w-100" name="inputSubmit" value="Entrar">
            </form>
            <a class="text-center my-3" href="#" data-toggle="modal" data-target="#modalEsqueceuSenha">Esqueceu a senha?</a>
            <hr class="my-0">
            <div class="w-100 text-center mt-4">
                <button class="btn btn-success w-50" data-toggle="modal" data-target="#modalCriarConta">Criar nova conta</button>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalCriarConta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Criar conta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="professor/create.php" method="post">
                        <div class="form-group">
                            <label for="inputNome">Nome</label>
                            <input type="text" class="form-control" id="inputName" name="inputName">
                        </div>

                        <div class="form-group">
                            <label for="inputEmail">Email</label>
                            <input type="email" class="form-control" id="inputEmail" name="inputEmail">
                        </div>

                        <div class="form-group">
                            <label for="inputSenha">Senha</label>
                            <input type="password" class="form-control" id="inputPassword" name="inputPassword">
                        </div>
                        <input type="submit" class="btn btn-success" name="inputSubmit" value="Criar conta">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEsqueceuSenha" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Esqueceu a sua senha?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="professor/esqueceuSenha.php" method="post">
                        <div class="form-group">
                            <label for="inputEmail">Email</label>
                            <input type="email" class="form-control" id="inputEmail" name="inputEmail">
                        </div>
                        <input type="submit" class="btn btn-success" name="inputSubmit" value="Enviar email de redefinição de senha">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>