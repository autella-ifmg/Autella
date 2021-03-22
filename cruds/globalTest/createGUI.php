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
  <style>
    .split {
      height: 100%;
      width: 50%;
      position: fixed;
      z-index: 1;
      top: 0;
      overflow-x: hidden;
      padding-top: 200px;

    }

    /* Control the left side */
    .left {
      left: 0;

    }

    /* Control the right side */
    .right {
      right: 0;

    }

    /* If you want the content centered horizontally and vertically */
    .centered {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      text-align: center;
    }

    /* Style the image inside the centered container, if needed */
    .centered img {
      width: 150px;
      border-radius: 50%;
    }
  </style>
  <script>
    <?php
    require_once "createSQL.php";

    $testID = null;
    $testID = $_GET['id'];

    if (isset($testID)) {
      deletTest($testID);
    }
    ?>
  </script>
</head>

<body>

  <script>
    var globalListTest = [];

    function globalSend(id) {
      name = document.getElementById("name" + id).outerHTML;
      dataMaking = document.getElementById("dataMaking" + id).outerHTML;
      dataChaging = document.getElementById("dataChanging" + id).outerHTML;
      nameTeacher = document.getElementById("nameTeacher" + id).outerHTML;
      document.getElementById("global").innerHTML += "<tr id =\"globalTest" + id + "\"> " + name + "  " + dataMaking + " " + dataChaging + "  " + nameTeacher + "   <td> <img  src=../../../libraries/bootstrap/bootstrap-icons-1.0.0/x-square.svg alt=Editar height=25 onclick =\"deleteGlobal(" + id + ")\"/> </td> </tr>";
      globalListTest[globalListTest.length] = id;
      document.getElementById("simpleTest" + id).style.display = "none";
    }

    function deleteGlobal(id) {
      for (i = 0; i <= globalListTest.length; i++) {
        if (globalListTest[i] == id) {
          document.getElementById('simpleTest' + id).style.display = 'block';
          document.getElementById('globalTest' + id).remove();
          globalListTest.splice(i, 1);
        }

      }

    }
  </script>

  <?php require_once '../../views/navbar.php'; ?>
  <br>
  
  <div style="text-align: center; margin-right: 3%;margin-left: 3%;"><?php data(); ?></div>

  <!-- NOME DA PROVA GLOBAL FORM-->
  <div class="mb-3" style="width: 20%; margin-left:40% ;">

    <form method="get" action="<?php echo $_SERVER["PHP_SELF"]; ?>">

      <script>
        function convert() {
          var globalListID = document.getElementById("globalList1");
          NEWstring = globalListTest.toString();
          globalListID.value = NEWstring;

        }
      </script>
      <!-- Input PARA PASSAR Js para PHP -->
      <input name="globalList" id="globalList1" type="hidden" value="Lista Global" />
      <label class="form-label" style="font-family: Georgia, 'Times New Roman', Times, serif; ">Nome da prova Global</label>
      <input name="globalName" class="form-control" id="globalName" aria-describedby="emailHelp" value="">
      <button style="margin: 130px;" type="submit" class="btn btn-primary" onclick="convert()" name="BTN">SALVAR PROVA</button>
    </form>
  </div>
  <?php
  $globalName = "";
  $globalList = "";
  if (isset($_GET['BTN'])) {
    $globalName = $_GET["globalName"];
    $globalListString = $_GET["globalList"];
    $globalList = explode(",", $globalListString);
    insertInDatabase($globalList, $globalName);
  }

  ?>
  <div style="width:44%;right:2%;" class="split right ">
    <table id="global" class="table">
      <thead class="thead-dark">
        <tr>
          <th style="width: 20%;"> NOME DA PROVA </th>
          <th style="width: 20%;"> DATA EM QUE FOI FEITA </th>
          <th style="width: 20%;"> DATA DE ULTIMA MODIFICAÇÃO </th>
          <th style="width: 20%;"> PROFESSOR QUE CRIOU </th>
          <th style="width: 20%;">REMOVER DA PROVA GLOBAL </th>
        </tr>
      </thead>

  </div>
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

    function deleteQuestion(id_test) {
      window.location.href = "http://autella.com/cruds/simpleTest/readListGUI.php?id=" + id_test;
      //deletTest($testID);
    }
  </script>

</body>

</html>