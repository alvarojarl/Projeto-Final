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
  </head>
  <body>
    <h1 class="jumbotron bg-info">Gerenciamento de empresas</h1>

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
    if(isset($_GET['identify'])) {
      // echo "foi";
      include 'dao/empresadao.class.php';
      include 'model/empresa.class.php';

      $empresaDAO = new EmpresaDAO();
      $array = $empresaDAO->filtrar($_GET['identify'], "idEmpresa");
      $empresa = $array[0];
      echo $empresa;
    }
    ?>
    <form name="cad" method="post" action="editardados.php">

          <div class="form-group">
            <!-- readonly hidden -->
            <input type="text" name="idEmpresa" placeholder="Código da Empresa" class="form-control" value="<?php if(isset($empresa)) echo $empresa->idEmpresa; ?>">
          </div>
          <div class="form-group">
            <input type="text" name="razaoSocial" class="form-control" placeholder="razaoSocial" autofocus value="<?php if(isset($empresa))  echo $empresa->razaoSocial; ?>">
          </div>
          <div class="form-group">
            <input type="text" name="cidade"class="form-control" placeholder="cidade" value="<?php if(isset($empresa))  echo $empresa->cidade; ?>">
          </div>
          <div class="form-group">
            <input type="text" name="CNPJ" class="form-control" placeholder="CNPJ" value="<?php  if(isset($empresa)) echo $empresa->CNPJ; ?>">
          </div>

          <div class="form-group">
            <input type="text" name="CEP" placeholder="CEP" class="form-control" value="<?php if(isset($empresa)) echo $empresa->CEP; ?>">
          </div>

          <div class="form-group">
            <input type="text" name="telefone" placeholder="telefone" class="form-control" value="<?php if(isset($empresa)) echo $empresa->telefone; ?>">
          </div>
          <div class="form-group">
            <input type="text" name="email" placeholder="email" class="form-control"value="<?php if(isset($empresa)) echo $empresa->email; ?>">
          </div>
          <div class="form-group">
            <select class="form-control" name="tipoEmpresa" value="<?php if(isset($empresa)) echo $empresa->tipoEmpresa; ?>">
              <option value="MEI" <?php if(isset($empresa))  if($empresa->tipoEmpresa=='MEI') echo 'selected=selected';?>>MicroEmprendedor Individual</option>
              <option value="Eireli" <?php if(isset($empresa)) if($empresa->tipoEmpresa=='Eireli') echo 'selected=selected';?>>Sociedade Empresária Limitada</option>
              <option value="SS" <?php if(isset($empresa)) if($empresa->tipoEmpresa=='SS') echo 'selected=selected';?>>Sociedade Simples</option>
              <option value="SA" <?php if(isset($empresa))   if($empresa->tipoEmpresa=='SA') echo 'selected=selected';?>>Sociedade Anonima</option>
            </select>
          </div>
          <div class="form-group">
            <input type="submit" name="alterar" value="Alterar"
            class="btn btn-primary">
          </div>
        </form>
    <?php
    if(isset($_POST['alterar'])) {

      include 'dao/empresadao.class.php';
      include 'model/empresa.class.php';
      include 'util/validacao.class.php';
      include 'util/utility.class.php';

      $erros = [];
      if(!Validacao::validarNome($_POST['razaoSocial'])) {
        $erros[] = 'nome inválida';
      }

      $erros = [];
      if(!Validacao::validarNome($_POST['cidade'])) {
        $erros[] = 'sexo inválida';
      }

      $erros = [];
      if(!Validacao::validarCNPJ($_POST['CNPJ'])) {
        $erros[] = 'CPF inválido';
      }

      $erros = [];
      if(!Validacao::validarCEP($_POST['CEP'])) {
        $erros[] = 'RG inválido';
      }

      $erros = [];
      if(!Validacao::validarTelefone($_POST['telefone'])) {
        $erros[] = 'comprovanteDeResidencia inválido';
      }

      $erros = [];
      if(!Validacao::validarEmail($_POST['email'])) {
        $pessoa = new Pessoa();
        $erros[] = 'Tipo de Emprestimo inválido';
      }

      $erros = [];
      if(!Validacao::validartipoEmpresa($_POST['tipoEmpresa'])) {
        $pessoa = new Pessoa();
        $erros[] = 'Tipo de Emprestimo inválido';
      }

      if(count($erros) != 0) {
        $_SESSION['erros'] = serialize($erros);
        header("location:cadastroPessoa.php");
        die();
      }

      $empresa = new Empresa();
      $empresa->idEmpresa = $_POST['idEmpresa'];
      $empresa->razaoSocial = $_POST['razaoSocial'];
      $empresa->cidade = $_POST['cidade'];
      $empresa->CNPJ = $_POST['CNPJ'];
      $empresa->CEP = $_POST['CEP'];
      $empresa->telefone = $_POST['telefone'];
      $empresa->email = $_POST['email'];
      $empresa->tipoEmpresa = $_POST['tipoEmpresa'];

      $empresaDAO = new EmpresaDAO();
      $empresaDAO->alterar($empresa);

      header("location:consulta.php");
    }
    ?>
  </body>
</html>
