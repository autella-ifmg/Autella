<!DOCTYPE html>

<html class="w-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="/libraries/bootstrap/bootstrap.css">

    <link rel="stylesheet" href="/libraries/cropperjs/cropper.css">

    <title>Autella</title>
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/sessionDebug.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/formValidator.php';
    ?>
</head>

<body class="w-100">
    <div class="container w-100 align-items-center">
        <h1 class="text-center" style="margin: 8% 0">Autella | Alterar conta</h1>

        <form action="updateSQL.php" method="POST" enctype="multipart/form-data" class="row justify-content-around needs-validation" novalidate>
            <div class="col-12 col-sm-10 col-md-5" style="max-height: 30rem">
                <img id="userPicture" class="w-100 h-100" src="/images/users/<?php echo $_SESSION['userData']['id'] ?>.jpeg<?php echo '?' . time() ?>" />
                <!-- for="inputImage" -->
                <label class="position-absolute m-0 p-0 pr-3" style="bottom:0; right:-1px" for="inputImage"><img class="p-2" style="width:64px; background-color: white;" src="../../libraries/bootstrap/bootstrap-icons-1.0.0/pencil.svg" alt=""></label>
                <!-- id="inputImage" name="inputImage" -->
                <input class="d-none" type="file" id="inputImage" name="image" accept="image/*">
            </div>

            <div class="col-12 col-sm-10 col-md-5 mt-3">
                <label>Nome</label>
                <input type="text" class="form-control mb-3" name="inputName" value="<?php echo $_SESSION['userData']['name'] ?>" required>

                <label>Email</label>
                <input type="email" class="form-control mb-3" name="inputEmail" value="<?php echo $_SESSION['userData']['email']; ?>" required>

                <label>Senha atual</label>
                <input type="password" class="form-control mb-3" name="inputOldPassword" required>

                <label>Nova senha</label>
                <input type="password" class="form-control mb-3" name="inputPassword" id="inputPassword">

                <label>Confirmar nova senha</label>
                <input type="password" class="form-control mb-3" name="inputConfirmPassword" id="inputConfirmPassword">

                <div class="d-flex flex-row justify-content-between">
                    <a class="btn btn-lg btn-danger" href="../../index.php">Cancelar</a>
                    <input type="submit" class="btn btn-lg btn-success" name="inputSubmit" value="Alterar">
                </div>
            </div>
        </form>
    </div>

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


    <script src="/libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="/libraries/bootstrap/bootstrap.bundle.js"></script>
    <script src="/libraries/cropperjs/cropper.js"></script>

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



    <!-- Preview da imagem antes do CropperJS -->
    <!-- <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#userPicture').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#inputImage").change(function() {
            readURL(this);
        });
    </script> -->
</body>

</html>