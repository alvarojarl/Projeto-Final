<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="vendor/components/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
    <title>Dados</title>
    <style media="screen">
      .jumbotron{
        text-align: center;
        background-image: url(imagens/backg.jpg);
        color: white;
      }
    </style>
  </head>
  <body>
    <h1 class="jumbotron">Cadastro concluido!</h1>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">Sistema</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="index.html">Home</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="cadastroEmpresa.php">Cadastro Empresa</a>
          </li>


          <li class="nav-item">
            <a class="nav-link" href="cadastroPessoa.php">Cadastro Pessoas<span class="sr-only">(current)</span></a>
          </li>

        </ul>
      </div>
    </nav>
    <?php
      if(isset($_SESSION["messageEmpresa"])) {
        include "model/empresa.class.php";
        echo "<table class='table table-striped table-bordered table-hover table-condensed'>";
        echo "<thead>";
          echo "<tr>";
            echo "<th>razaoSocial</th>";
            echo "<th>Cidade</th>";
            echo "<th>CNPJ</th>";
            echo "<th>CEP</th>";
            echo "<th>telefone</th>";
            echo "<th>email</th>";
            echo "<th>T.Empresa</th>";
          echo "</tr>";
        echo "</thead>";
        echo "<tr>";
          echo "<td>".$_SESSION["razaoSocial"]."</td>";
          echo "<td>".$_SESSION["cidade"]."</td>";
          echo "<td>".$_SESSION["CNPJ"]."</td>";
          echo "<td>".$_SESSION["CEP"]."</td>";
          echo "<td>".$_SESSION["telefone"]."</td>";
          echo "<td>".$_SESSION["email"]."</td>";
          echo "<td>".$_SESSION["tipoEmpresa"]."</td>";
        echo "</tr>";
        $empresa = unserialize($_SESSION["empresaPrincipal"]);
        unset($_SESSION["razaoSocial"]);
        unset($_SESSION["cidade"]);
        unset($_SESSION["CNPJ"]);
        unset($_SESSION["CEP"]);
        unset($_SESSION["telefone"]);
        unset($_SESSION["email"]);
        unset($_SESSION["tipoEmpresa"]);
        unset($_SESSION["messageEmpresa"]);
      } else if(isset($_SESSION["messagePessoa"])) {
        include "model/pessoa.class.php";
        echo "<table class='table table-striped table-bordered table-hover table-condensed'>";
        echo "<thead>";
          echo "<tr>";
            echo "<th>nome</th>";
            echo "<th>sobrenome</th>";
            echo "<th>CPF</th>";
            echo "<th>RG</th>";
            echo "<th>comprovanteDeResidencia</th>";
            echo "<th>comprovanteDeRenda</th>";
          echo "</tr>";
        echo "</thead>";
        echo "<tr>";
          echo "<td>".$_SESSION["nome"]."</td>";
          echo "<td>".$_SESSION["sexo"]."</td>";
          echo "<td>".$_SESSION["CPF"]."</td>";
          echo "<td>".$_SESSION["RG"]."</td>";
          echo "<td>".$_SESSION["comprovanteDeResidencia"]."</td>";
          echo "<td>".$_SESSION["tipoEmprestimo"]."</td>";
        echo "</tr>";
        $empresa = unserialize($_SESSION["pessoaPrincipal"]);
        unset($_SESSION["nome"]);
        unset($_SESSION["sexo"]);
        unset($_SESSION["CPF"]);
        unset($_SESSION["RG"]);
        unset($_SESSION["comprovanteDeResidencia"]);
        unset($_SESSION["tipoEmprestimo"]);
        unset($_SESSION["messagePessoa"]);
      } else {
         header("location:index.html");
      }
    ?>
  </body>
</html>
