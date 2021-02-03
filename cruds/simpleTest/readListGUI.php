<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=dev ice-width, initial-scale=1.0">
    <title>Autella | Visualizar Testes</title>
    <link rel="stylesheet" href="../../libraries/bootstrap/bootstrap.css">
    <script src="../../libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="../../libraries/bootstrap/bootstrap.bundle.js"></script>
    <script src="../../libraries/ckeditor5/ckeditor.js"></script>
    <script> 
    <?php
    require_once "readListSQL.php";
    
    $testID = null;
    $testID = $_GET['id'];
    
    if(isset($testID)){
        deletTest($testID);
       
    }
    ?>
    </script>
</head>

<body>


<?php require_once '../../views/navbar.php'; ?>
    <br>
    <div style="text-align: center; margin-right: 3%;margin-left: 3%;"><?php data();?></div>
      <!--Modal genérico-->
      <div name="container" id="none" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 name="header" id="none" class="modal-title">none</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="p0">none</p>
                    <p id="p1">none</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a name="modalButton" id="none" class="btn btn-danger" onclick="none" data-dismiss="modal">Sim, tenho certeza</a>
                </div>
            </div>
        </div>
    </div>
    <script>
         function chooseAction(action, testNumber) {
            var modal = [
                ["deleteModal", "deleteModalLabel", `Deletar a <b>Prova - ${testNumber}</b>?`, "Ao excluir esse teste, ele se perderá permanentemente e se tornará indisponível.", `Você tem certeza que deseja excluir a <b>Prova - ${testNumber}</b>?`, "deleteButton", 'deleteQuestion(']
            ];

            var container = document.getElementsByName("container")[0];
            container.removeAttribute("id");
            container.setAttribute("id", `${modal[action][0]}`);

            var h5 = document.getElementsByName("header")[0];
            h5.removeAttribute("id");
            h5.setAttribute("id", `${modal[action][1]}`)
            h5.innerHTML = `${modal[action][2]}`;

            var p0 = document.getElementById("p0");
            p0.innerHTML = `${modal[action][3]}`;

            var p1 = document.getElementById("p1");
            p1.innerHTML = `${modal[action][4]}`;

            var button = document.getElementsByName("modalButton")[0];
            button.removeAttribute("id")
            button.removeAttribute("onclick");
            button.setAttribute("id", `${modal[action][5]}`);
            button.setAttribute("onclick", `${modal[action][6] + testNumber})`);
            
        }

        function deleteQuestion(id_test){  
            window.location.href = "http://autella.com/cruds/simpleTest/readListGUI.php?id="+id_test;
            
            //deletTest($testID);
  
        }
    </script>
    
</body>
</html>