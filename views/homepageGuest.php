<div class="container h-100 d-flex align-items-center">
    <div class="d-flex justify-content-around">

        <div class="col-4">
            <h1 class="text-success display-4 font-weight-bold">Autella</h1>
            <h3>Crie provas e questões para a sala de aula com Autella</h3>
        </div>

        <div class="card py-3 col-4">
            <form action="cruds/professor/login.php" method="post">
                <div class="form-group">
                    <label for="inputEmail">Email</label>
                    <input type="email" class="form-control" id="inputEmail" name="inputEmail">
                </div>

                <div class="form-group">
                    <label for="inputSenha">Senha</label>
                    <input type="password" class="form-control" id="inputPassword" name="inputPassword">
                </div>
                <input type="submit" class="btn btn-success w-100" name="inputSubmit" value="Entrar">
            </form>
            <a class="text-center my-3" >Esqueceu a senha?</a>
            <hr class="my-0">
            <div class="w-100 text-center mt-4">
                <a class="btn btn-success w-50" href="cruds/professor/create.php">Criar nova conta</a>
            </div>
        </div>
    </div>
</div>