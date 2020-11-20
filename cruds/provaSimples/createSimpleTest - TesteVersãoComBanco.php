<?php
require_once '../question/getQuestions.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link  > 
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <style>
    body{
        background-color :white;  
}
   
</style>
</head>

<body>
  <!-- Barra de navegação e verificação de login-->
  <?php require_once '../utilities/userVerify.php'; require_once '../utilities/navbar.php' ?>
  <br>
  <br>
  <!-- Table com as questões do banco-->
  <div style="float: left;width: 45%; margin: 10px;">
    <table  class="table table-dark" id = "table" >
      <CAPtion style=" font-size: x-large;"><I> <b>QUESTÕES DENTRO DO BANCO </b> </i></CAPtion>

      <tr>
      <th >Área</th>
      <th >Professor</th>
      <th >Questão</th>
      <th>Matéria</th>
    </tr>

       <?php


      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["area"]. "</td><td>" . $row["professor"]. "</td><td>"  .$row["question"]. "</td><td>"  .$row["materia"]."</tr>";
        }
        
          
        }
        
        $connection->close();
       ?> 
      
    </table>
  </div>
  <!-- Icone - seta -->
  
<button type="button" class="btn btn-outline-success" style="margin: 15px;">Remover</button> 
  <!-- Table com as questões que vão para a prova-->
  <div style="float: right; width: 45%; margin: 10px;">
  <table class="table table-dark" id = "tableSimpleTest" >
  <CAPtion style=" font-size: x-large; text-align: right;" ><I> <b>QUESTÕES DA PROVA </b> </i></CAPtion>
    <tr>
      <th >Área</th>
      <th >Professor</th>
      <th >Questão</th>
      <th>Matéria</th>
    </tr>

    <tr >
      <td >EXATAS</td>
      <td >Professor 2</td>
      <td >Dizemos que um número natural<i> n </i>é um cubo perfeito se existe um número natural<i> a </i>tal que <i>n</i>=<i>a</i>³. Determine o subconjunto dos números primos que podem ser escritos como soma de dois cubos perfeitos</td>
      <td>Trigonometria</td>
    </tr>

    <tr>
      <td >EXATAS</td>
      <td >Professor 1</td>
      <td >Seja λ a circunferência que passa pelos pontos P= (1,1), Q= (13,1) e R= (7,9).
          Determine: <br>a)A equação de λ. <br> b)Os vértices do quadrado ABCD circunscrito a λ, sabendo queRé o ponto médio deAB.</td>
      <td>Geometria Plana</td>
  </tr>

  </table>
</div>
<img src="Icons/right-arrow.png" alt="icon from Kiranshastry" style="width: 100px; height: 100px; margin: 15px;">
  <br>
  <button type="button" class="btn btn-outline-success" style="margin: 15px;" >Adicionar</button>
  
</body>
</html>
