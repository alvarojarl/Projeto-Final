<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="vendor/components/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
    <style media="screen">
    .jumbotron{
      text-align: center;
      background-image: url(imagens/backg.jpg);
      color: white;
    }
    </style>
    <title>Cadastro de Pessoa</title>
  </head>
  <body>
    <h1 class="jumbotron">Cadastrar Pessoa</h1>
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
            <a class="nav-link" href="consulta.php">Consultar Empresa<span class="sr-only">(current)</span></a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="cadastroPessoa.php">Cadastro Pessoas<span class="sr-only">(current)</span></a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="consultapessoa.php">Consultar Pessoas<span class="sr-only">(current)</span></a>
          </li>
        </ul>
      </div>
    </nav>
    <?php
      if(isset($_SESSION['erros'])) {
        $erros = unserialize($_SESSION['erros']);
        foreach($erros as $erro) {
          echo "<br>".$erro;
        }
        unset($_SESSION['erros']);
      }
    ?>
    <div class="">
      <form class="form form-group" action="cadastroPessoa.php" method="post">
        <div class="form form-group">
          <label for="mb-2 mr-sm-2">nome</label>
          <input  class="form-control mb-2 mr-sm-2" type="text" name="nome" value="" placeholder="nome" autofocus pattern="^[A-Za-zÁ-Ôá-ô]{2,20} [d]{0,1}[eauo]{0,1}[ ]{0,1}[A-Za-zÁ-Ôá-ô]{2,20}$|^[A-Za-zÁ-Ôá-ô]{2,20} [d]{0,1}[eauo]{0,1}[ ]{0,1}[A-Za-zÁ-Ôá-ô]{2,20} [d]{0,1}[eauo]{0,1}[ ]{0,1}[A-Za-zÁ-Ôá-ô]{2,20}$|^[A-Za-zÁ-Ôá-ô]{2,10}$">
        </div>
        <div class="form form-group">
          <label for="mb-2 mr-sm-2">sexo</label>
          <select class="form-control" name="sexo">
            <option value="Masculino">Masculino</option>
            <option value="Feminino">Feminino</option>
            <option value="Outros">Outros</option>
          </select>
        </div>
        <div class="form form-group">
          <label for="mb-2 mr-sm-2">CPF</label>
          <input  class="form-control mb-2 mr-sm-2" type="text" name="CPF" value="" placeholder="CPF" pattern="^[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}$|^[0-9]{11}">
        </div>
        <div class="form form-group">
          <label for="mb-2 mr-sm-2">RG</label>
          <input  class="form-control mb-2 mr-sm-2" type="text" name="RG" value="" placeholder="RG" pattern="^[0-9]{10}$">
        </div>
        <div class="form form-group">
          <label for="mb-2 mr-sm-2">Comp. de Residencia</label>
          <input  class="form-control mb-2 mr-sm-2" type="number" name="comprovanteDeResidencia" value="" placeholder="Comp. de Residencia" pattern="^[0-9]{10,20}">
        </div>
        <div class="form form-group">
          <label for="mb-2 mr-sm-2">Tipo. de Emprestimo : </label>
          <label class="radio-inline">
            <input type="radio" name="tipoEmprestimo" value="Pessoal" checked>Pessoal
          </label>
          <label class="radio-inline">
            <input type="radio" name="tipoEmprestimo" value="Consignado">Consignado
          </label>
          <label class="radio-inline">
            <input type="radio" name="tipoEmprestimo" value="Penhor">Penhor
          </label>
        </div>
        <div class="">
          <button class="btn btn-success" name="CadastrarPessoa" type="submit">cadastrar</button>
        </div>
      </form>
    </div>
  </body>
  <?php
    if(isset($_POST['CadastrarPessoa'])) {

      include "model/pessoa.class.php";
      include "dao/pessoadao.class.php";
      include "util/validacao.class.php";
      include "util/utility.class.php";

      $erros = [];
      if(!Validacao::validarNomePessoa($_POST['nome'])) {
        $erros[] = 'nome inválida';
      }

      $erros = [];
      if(!Validacao::validarSexo($_POST['sexo'])) {
        $erros[] = 'sexo inválida';
      }

      $erros = [];
      if(!Validacao::validarCPF($_POST['CPF'])) {
        $erros[] = 'CPF inválido';
      }

      $erros = [];
      if(!Validacao::validarRG($_POST['RG'])) {
        $erros[] = 'RG inválido';
      }

      $erros = [];
      if(!Validacao::validarComprovanteResidencial($_POST['comprovanteDeResidencia'])) {
        $erros[] = 'comprovanteDeResidencia inválido';
      }

      $erros = [];
      if(!Validacao::validarEmprestimo($_POST['tipoEmprestimo'])) {
        $pessoa = new Pessoa();
        $erros[] = 'Tipo de Emprestimo inválido';
      }

      if(count($erros) != 0) {
        $_SESSION['erros'] = serialize($erros);
        header("location:cadastroPessoa.php");
        die();
      }

      $pessoa = new Pessoa();
      $pessoa->nome = Utility::padronizarNome($_POST["nome"]);
      $pessoa->sexo = $_POST["sexo"];
      $pessoa->CPF = Utility::padronizarCPF($_POST["CPF"]);
      $pessoa->RG = $_POST["RG"];
      $pessoa->comprovanteDeResidencia = $_POST["comprovanteDeResidencia"];
      $pessoa->tipoEmprestimo = $_POST["tipoEmprestimo"];
      $_SESSION["messagePessoa"] = "Xiah";
      $_SESSION["nome"] = $pessoa->nome;
      $_SESSION["sexo"] = $pessoa->sexo;
      $_SESSION["CPF"] = $pessoa->CPF;
      $_SESSION["RG"] = $pessoa->RG;
      $_SESSION["comprovanteDeResidencia"] = $pessoa->comprovanteDeResidencia;
      $_SESSION["tipoEmprestimo"] = $pessoa->tipoEmprestimo;
      $_SESSION["pessoaPrincipal"] = serialize($pessoa);
      $pessoaDAO = new PessoaDAO();
      $pessoaDAO->cadastrarPessoa($pessoa);

      echo $pessoa->CPF;
      header("location:resposta.php");
      ob_enf_fluch();
    }
   ?>
</html>
