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
    <h1 class="jumbotron bg-info">Editar Dados</h1>

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

    <?php
    if(isset($_GET['identity'])) {
      // echo "foi";
      include 'dao/pessoadao.class.php';
      include 'model/pessoa.class.php';

      $pessoaDAO = new PessoaDAO();
      $array = $pessoaDAO->filtrar($_GET['identity'], "idPessoa");
      $pessoa = $array[0];
    }
    ?>
    <form name="cad" method="post" action="editardadospessoa.php">

      <div class="form-group">
        <!-- readonly hidden -->
        <input type="text" name="codigo" placeholder="Código da Pessoa" class="form-control" value="<?php if(isset($pessoa)) echo $pessoa->idPessoa; ?>">
      </div>
      <div class="form-group">
        <input type="text" name="nome" class="form-control" placeholder="nome" autofocus value="<?php if(isset($pessoa))  echo $pessoa->nome; ?>">
      </div>
      <div class="form-group">
        <select class="form-control" name="sexo" value="<?php if(isset($pessoa))  echo $pessoa->sexo; ?>">
          <option value="Masculino">Masculino</option>
          <option value="Feminino">Feminino</option>
          <option value="Outros">Outros</option>
        </select>
      </div>
      <div class="form-group">
        <input type="text" name="CPF" class="form-control" placeholder="CPF" value="<?php  if(isset($pessoa)) echo $pessoa->CPF; ?>">
      </div>

      <div class="form-group">
        <input type="text" name="RG" placeholder="RG" class="form-control" value="<?php if(isset($pessoa)) echo $pessoa->RG; ?>">
      </div>

      <div class="form-group">
        <input type="text" name="comprovanteDeResidencia" placeholder="comprovanteDeResidencia" class="form-control" value="<?php if(isset($pessoa)) echo $pessoa->comprovanteDeResidencia; ?>">
      </div>
      <div class="form-group">
        <label for="mb-2 mr-sm-2">Tipo. de Emprestimo : </label>
        <label class="radio-inline">
          <input type="radio" name="tipoEmprestimo" value="Pessoal" <?php if(isset($pessoa))  if($pessoa->tipoEmprestimo=='Pessoal') echo 'checked';?>>Pessoal
          <input type="radio" name="tipoEmprestimo" value="Consignado" <?php if(isset($pessoa))  if($pessoa->tipoEmprestimo=='Consignado') echo 'checked';?>>Consignado
          <input type="radio" name="tipoEmprestimo" value="Penhor" <?php if(isset($pessoa))  if($pessoa->tipoEmprestimo=='Penhor') echo 'checked';?>>Penhor
        </label>
      </div>
      <div class="form-group">
        <input type="submit" name="alterar" value="Alterar" class="btn btn-primary">
      </div>
    </form>
    <?php
    if(isset($_POST['alterar'])) {
      include 'dao/pessoadao.class.php';
      include 'model/pessoa.class.php';
      include 'util/validacao.class.php';

      $erros = [];
      if(!Validacao::validarNomePessoa($_POST['nome'])) {
        $erros[] = 'nome inválida';
      }

      $erros = [];
      if(!Validacao::validarSexo($_POST['sexo'])) {
        $erros[] = 'sexo inválida';
      }

      $erros = [];
      if(!Validacao::validarCNPJ($_POST['CPF'])) {
        $erros[] = 'CPF inválido';
      }

      $erros = [];
      if(!Validacao::validarCEP($_POST['RG'])) {
        $erros[] = 'RG inválido';
      }

      $erros = [];
      if(!Validacao::validarTelefone($_POST['comprovanteDeResidencia'])) {
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
      $pessoa->idPessoa = $_POST['codigo'];
      $pessoa->nome = $_POST['nome'];
      $pessoa->sexo = $_POST['sexo'];
      $pessoa->CPF = $_POST['CPF'];
      $pessoa->RG = $_POST['RG'];
      $pessoa->comprovanteDeResidencia = $_POST['comprovanteDeResidencia'];
      $pessoa->tipoEmprestimo = $_POST['tipoEmprestimo'];

      $pessoaDAO = new PessoaDAO();
      $pessoaDAO->alterar($pessoa);

      header("location:consultapessoa.php");
    }
    ?>
  </body>
</html>
