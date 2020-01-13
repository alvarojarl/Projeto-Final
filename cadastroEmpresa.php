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
    <title>Cadastro de Empresa</title>
  </head>
  <body>
    <h1 class="jumbotron">Cadastrar Empresa</h1>
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
      <form class="form form-group" action="cadastroEmpresa.php" method="post">
        <div class="form form-group">
          <label for="mb-2 mr-sm-2">Razao Social</label>
          <input  class="form-control mb-2 mr-sm-2" type="text" name="razaoSocial" value="" placeholder="Razao Social" autofocus pattern="^[A-Za-zÁ-Ôá-ô]{2,20} [d]{0,1}[eauo]{0,1}[ ]{0,1}[A-Za-zÁ-Ôá-ô]{2,20}$|^[A-Za-zÁ-Ôá-ô]{2,20} [d]{0,1}[eauo]{0,1}[ ]{0,1}[A-Za-zÁ-Ôá-ô]{2,20} [d]{0,1}[eauo]{0,1}[ ]{0,1}[A-Za-zÁ-Ôá-ô]{2,20}$|^[A-Za-zÁ-Ôá-ô]{2,10}$">
        </div>
        <div class="form form-group">
          <label for="mb-2 mr-sm-2">Cidade</label>
          <input  class="form-control mb-2 mr-sm-2" type="text" name="cidade" value="" placeholder="Cidade" pattern="^[A-Za-zÁ-Ôá-ô]{2,20} [d]{0,1}[eauo]{0,1}[ ]{0,1}[A-Za-zÁ-Ôá-ô]{2,20}$|^[A-Za-zÁ-Ôá-ô]{2,20} [d]{0,1}[eauo]{0,1}[ ]{0,1}[A-Za-zÁ-Ôá-ô]{2,20} [d]{0,1}[eauo]{0,1}[ ]{0,1}[A-Za-zÁ-Ôá-ô]{2,20}$|^[A-Za-zÁ-Ôá-ô]{2,10}$">
        </div>
        <div class="form form-group">
          <label for="mb-2 mr-sm-2">CNPJ</label>
          <input  class="form-control mb-2 mr-sm-2" type="text" name="CNPJ" value="" placeholder="CNPJ" pattern="^[0-9]{2}.[0-9]{3}.[0-9]{3}/[0-9]{4}-[0-9]{2}$|^[0-9]{14}$">
        </div>
        <div class="form form-group">
          <label for="mb-2 mr-sm-2">CEP</label>
          <input  class="form-control mb-2 mr-sm-2" type="text" name="CEP" value="" placeholder="CEP" pattern="^[0-9]{5}-[0-9]{3}$|^[0-9]{8}$|^[0-9]{7}$/">
        </div>
        <div class="form form-group">
          <label for="mb-2 mr-sm-2">Telefone</label>
          <input  class="form-control mb-2 mr-sm-2" type="text" name="telefone" value="" placeholder="Telefone" pattern="^[+]{1}[0-9]{2} [0-9]{2} [0-9]{4,5}.[0-9]{4}$|^[0-9]{8,9,10,12}$">
        </div>
        <div class="form form-group">
          <label for="mb-2 mr-sm-2">E-mail</label>
          <input  class="form-control mb-2 mr-sm-2" type="text" name="email" value="" placeholder="E-mail" pattern="^([0-9a-zA-Z]+([_.-]?[0-9a-zA-Z]+)*@[0-9a-zA-Z]+[0-9,a-z,A-Z,.,-]*(.){1}[a-zA-Z]{2,4})+$">
        </div>
        <div class="form form-group">
          <label for="mb-2 mr-sm-2">Tipo de Empresa</label>
          <select class="form-control" name="tipoEmpresa">
            <option value="MEI">Micro Emprendedor Individual</option>
            <option value="Eireli">Sociedade Empresária Limitada</option>
            <option value="SS">Sociedade Simples</option>
            <option value="SA">Sociedade Anonima</option>
          </select>
        </div>
        <div class="">
          <button class="btn btn-success" name="CadastrarEmpresa" type="submit">cadastrar</button>
        </div>
      </form>
    </div>
  </body>
  <?php
    if(isset($_POST["CadastrarEmpresa"])) {


      include "model/empresa.class.php";
      include "dao/empresadao.class.php";
      include "util/utility.class.php";
      include "util/validacao.class.php";

      $error = [];

      if(!Validacao::validarNome($_POST['razaoSocial'])) {
        $erros[] = 'Nome da Razao Social Inválida';
      }

      $erros = [];
      if(!Validacao::validarNome($_POST['cidade'])) {
        $erros[] = 'Cidade inválida';
      }

      $erros = [];
      if(!Validacao::validarCNPJ($_POST['CNPJ'])) {
        $erros[] = 'CNPJ inválida';
      }

      $erros = [];
      if(!Validacao::validarCEP($_POST['CEP'])) {
        $erros[] = 'CPF inválido';
      }

      $erros = [];
      if(!Validacao::validarTelefone($_POST['telefone'])) {
        $erros[] = 'RG inválido';
      }

      $erros = [];
      if(!Validacao::validarEmail($_POST['email'])) {
        $erros[] = 'comprovanteDeResidencia inválido';
      }

      $erros = [];
      if(!Validacao::validarTipoEmpresa($_POST['tipoEmpresa'])) {
        $Empresa = new Empresa();
        $erros[] = 'Tipo de Empresarial inválido';
      }

      if(count($erros) != 0) {
        $_SESSION['erros'] = serialize($erros);
        header("location:cadastroEmpresa.php");
        die();
      }

      $empresa = new Empresa();
      $empresa->razaoSocial = Utility::padronizarNome($_POST['razaoSocial']);
      $empresa->cidade = Utility::padronizarNome($_POST["cidade"]);
      $empresa->CNPJ = $_POST["CNPJ"];
      $empresa->CEP = $_POST["CEP"];
      $empresa->telefone = $_POST["telefone"];
      $empresa->email = $_POST["email"];
      $empresa->tipoEmpresa = $_POST["tipoEmpresa"];

      $empresaDAO = new EmpresaDAO();
      $empresaDAO->CadastrarEmpresa($empresa);

      $_SESSION["messageEmpresa"] = "Plea";
      $_SESSION["razaoSocial"] = $empresa->razaoSocial;
      $_SESSION["cidade"] = $empresa->cidade;
      $_SESSION["CNPJ"] = $empresa->CNPJ;
      $_SESSION["CEP"] = $empresa->CEP;
      $_SESSION["telefone"] = $empresa->telefone;
      $_SESSION["email"] = $empresa->email;
      $_SESSION["tipoEmpresa"] = $empresa->tipoEmpresa;
      $_SESSION["empresaPrincipal"] = serialize($empresa);

      header("location:resposta.php");
      ob_enf_fluch();
    }
   ?>
</html>
