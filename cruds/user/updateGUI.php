<!DOCTYPE html>

<html class="w-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Autella</title>

    <link rel="stylesheet" href="/libraries/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="/libraries/cropperjs/cropper.css">
    <script src="/libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="/libraries/bootstrap/bootstrap.bundle.js"></script>
    <script src="/libraries/cropperjs/cropper.js"></script>

    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/sessionDebug.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/formValidator.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect/user.php';
    ?>
</head>

<body class="w-100">
    <div class="container w-100 align-items-center">
        <h1 class="text-center" style="margin: 8% 0">Autella | Alterar conta</h1>

        <form action="updateSQL.php" method="POST" class="row justify-content-around needs-validation" novalidate>
            <div class="col-12 col-sm-10 col-md-5" style="max-height: 30rem">
                <img id="userPicture" class="w-100" src="/images/users/<?php echo $_SESSION['userData']['id'] ?>.jpeg<?php echo '?' . time() ?>" />
                <label class="position-absolute m-0 p-0 pr-3" style="bottom:2rem; right:-1px; cursor: pointer" for="inputImage"><img class="p-2" style="width:64px; background-color: white;" src="../../libraries/bootstrap/bootstrap-icons-1.0.0/pencil.svg" alt=""></label>
                <input class="d-none" type="file" id="inputImage" name="image" accept="image/*">
            </div>

            <div class="col-12 col-sm-10 col-md-5 mt-3">
                <div class="form-group">
                    <label>Nome</label>
                    <input required type="text" class="form-control" name="name" value="<?php echo $_SESSION['userData']['name'] ?>">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input required type="email" class="form-control" name="email" value="<?php echo $_SESSION['userData']['email'] ?>">
                </div>

                <div class="form-group">
                    <label>Senha atual</label>
                    <input required type="password" class="form-control" name="oldPassword">
                </div>

                <div class="form-group">
                    <label>Nova senha</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>


                <div class="form-group">
                    <label>Confirmar nova senha</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
                </div>

                <div class="d-flex flex-row justify-content-between">
                <?php
                if(getAccountStatus($_SESSION['userData']['id']) == 1){
                    // Conta ativa
                    echo '<a class="btn btn-lg btn-danger" href="deactivateGUI.php">Desativar conta</a>';
                } else {
                    // Conta foi desativada
                    echo '<a class="btn btn-lg btn-danger" href="activateGUI.php">Ativar conta</a>';
                }
                    
                ?>
                    <a class="btn btn-lg btn-danger" href="../../index.php">Cancelar</a>
                    <input type="submit" class="btn btn-lg btn-success" name="submit" value="Alterar">
                </div>
            </div>
        </form>
    </div>





    <!-- CropperJS -->
    <!-- CropperJS Modal -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Recorte a sua imagem</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row w-100">
                            <div class="col-12 col-md-7">
                                <img class="w-100 h-100" src="" id="sample_image" />
                            </div>
                            <div class="col-md-4 mx-3 d-none   d-md-block">
                                <div style="overflow: hidden; width: 160px; height: 160px;" class="border" id="cropperjspreview"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="crop" class="btn btn-success">Atualizar imagem</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- CropperJS Script -->
    <script>
        $(document).ready(function() {

            var $modal = $('#modal');

            var image = document.getElementById('sample_image');

            var cropper;

            $('#inputImage').change(function(event) {
                var files = event.target.files;

                var done = function(url) {
                    image.src = url;
                    $modal.modal('show');
                };

                if (files && files.length > 0) {
                    reader = new FileReader();
                    reader.onload = function(event) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(files[0]);
                }
            });

            $modal.on('shown.bs.modal', function() {
                cropper = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 3,
                    preview: "#cropperjspreview"
                });
            }).on('hidden.bs.modal', function() {
                cropper.destroy();
                cropper = null;
            });

            $('#crop').click(function() {
                canvas = cropper.getCroppedCanvas({
                    width: 720,
                    height: 720
                });

                canvas.toBlob(function(blob) {
                    url = URL.createObjectURL(blob);
                    var reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function() {
                        var base64data = reader.result;
                        $.ajax({
                            url: 'updateSQL.php',
                            method: 'POST',
                            data: {
                                image: base64data
                            },
                            success: function(data) {
                                $modal.modal('hide');

                                // Preview da imagem com CropperJS
                                // Adiciona 1 no final do src da imagem, porque o time() não funciona, porque o html faz cache até do time()
                                // Poderia ser qualquer outra coisa no lugar do 1
                                $('#userPicture').attr('src', $('#userPicture').attr('src') + 1);
                            }
                        });
                    };
                });
            });

        });
    </script>
</body>

</html>