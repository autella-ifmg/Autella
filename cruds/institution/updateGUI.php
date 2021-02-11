<!DOCTYPE html>

<html class="h-100 w-100">

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
    require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect/institution.php';
    ?>
</head>

<body class="h-100 w-100 row align-items-center justify-content-center">
    <div class="col-12 ml-4    col-sm-10    col-lg-8    col-xl-6">
        <h1 class="text-center mb-3 mt-5 mb-sm-5">Autella <span class="d-none d-sm-inline">| Alterar dados da instituição</span></h1>

        <form action="updateSQL.php" method="POST" novalidate class="needs-validation row">
            <div class="w-100 px-3 mb-5" style="position:relative">
                <img id="institutionPicture" style="width:100%; height:auto" src="../../images/institutions/<?php echo $_SESSION['userInstitutionData']['id']; ?>.jpeg<?php echo '?' . time() ?>" />
                <label class="position-absolute m-0 p-0 mr-3 border" style="bottom:0; right:0" for="inputImage"><img class="p-2" style="width:64px; background-color: white;" src="../../libraries/bootstrap/bootstrap-icons-1.0.0/upload.svg" alt=""></label>
                <input class="d-none" type="file" id="inputImage" name="image" accept="image/*">
            </div>

            <div class="form-group col-12 ">
                <label>Nome completo</label>
                <input required type="text" class="form-control" name="fullName" value="<?php echo $_SESSION['userInstitutionData']['full_name'] ?>">
            </div>

            <div class="form-group col-12 col-md-6 ">
                <label>Abreviação</label>
                <input required type="text" class="form-control" name="abbreviation" value="<?php echo $_SESSION['userInstitutionData']['abbreviation'] ?>">
            </div>

            <div class="form-group col-12 col-md-6 ">
                <label>Telefone</label>
                <input required type="text" class="form-control" name="phone" value="<?php echo $_SESSION['userInstitutionData']['phone'] ?>">
            </div>

            <div class="form-group col-12 col-md-6 ">
                <label>Email institucional</label>
                <input required type="text" class="form-control" name="email" value="<?php echo $_SESSION['userInstitutionData']['email'] ?>">
            </div>

            <div class="form-group col-12 col-md-6 ">
                <label>CEP</label>
                <input required type="text" class="form-control" name="cep" value="<?php echo $_SESSION['userInstitutionData']['cep'] ?>">
            </div>

            <div class="form-group col-12">
                <label>Rua/Avenida</label>
                <input required type="text" class="form-control" name="street" value="<?php echo $_SESSION['userInstitutionData']['street'] ?>">
            </div>

            <div class="form-group col-12 col-md-6 ">
                <label>Número</label>
                <input required type="text" class="form-control" name="number" value="<?php echo $_SESSION['userInstitutionData']['number'] ?>">
            </div>

            <div class="form-group col-12 col-md-6 ">
                <label>Bairro</label>
                <input required type="text" class="form-control" name="neighborhood" value="<?php echo $_SESSION['userInstitutionData']['neighborhood'] ?>">
            </div>

            <div class="form-group col-12 col-md-6 ">
                <label>Cidade</label>
                <input required type="text" class="form-control" name="city" value="<?php echo $_SESSION['userInstitutionData']['city'] ?>">
            </div>

            <div class="form-group col-12 col-md-6 ">
                <label>Estado</label>
                <input required type="text" class="form-control" name="state" value="<?php echo $_SESSION['userInstitutionData']['state'] ?>">
            </div>

            <div class="d-flex justify-content-between pt-4 pt-sm-0 w-100 mx-3 mb-5">
                <a class="btn btn-danger btn-lg" href="../../index.php">Cancelar</a>
                
                <?php
                if(getInstitutionStatus($_SESSION['userData']['id_institution']) == 1){
                    echo '<a class="btn btn-warning btn-lg" href="activateDeactivateGUI.php">Desativar</a>';
                } else {
                    echo '<a class="btn btn-warning btn-lg" href="activateDeactivateGUI.php">Ativar</a>';
                }
                ?>
                <input type="submit" class="btn btn-success btn-lg" name="submit" value="Alterar dados">
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
                                <img class="w-100 h-100" id="sample_image" />
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
                    aspectRatio: 3 / 1,
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
                                $('#institutionPicture').attr('src', $('#institutionPicture').attr('src') + 1);
                            }
                        });
                    };
                });
            });

        });
    </script>
</body>

</html>