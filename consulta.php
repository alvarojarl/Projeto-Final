<?php session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Consulta</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="vendor/components/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <style media="screen">
    .jumbotron{
      text-align: center;
      background-image: url(imagens/backg.jpg);
      color: white;
    }
    </style>
  </head>
  <body>
    <div id="app">
    <h1 class="jumbotron">Consultar Empresas</h1>
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
    include 'dao/empresadao.class.php';
    include 'model/empresa.class.php';

    $empresaDAO = new EmpresaDAO();
    $empresas = $empresaDAO->buscarEmpresa();

    if(count($empresas) == 0) {
      echo "<h1>Não há empresas no banco!</h1>";
      return;
    }
    ?>

    <form name="filtrar" method="post" action="consulta.php">
      <div class="row">
        <div class="form-group col-md-6">
          <input type="text" name="txtfiltro"
                 placeholder="Digite a sua pesquisa" class="form-control">
        </div>

        <div class="form-group col-md-6">
          <select name="selfiltro" class="form-control">
            <option value="todos">Todos</option>
            <option value="Código">Código</option>
            <option value="razaoSocial">razaoSocial</option>
            <option value="Edicidadetora">Edicidadetora</option>
            <option value="CNPJ">CNPJ</option>
            <option value="CEP">CEP</option>
            <option value="telefone">telefone</option>
            <option value="email">email</option>
            <option value="tipoEmpresa">T.Empresa</option>
          </select>
        </div>
      </div> <!-- fecha row -->

      <div class="form-group">
        <input type="submit" name="filtrar" value="Filtrar" class="btn btn-primary btn-block">
      </div>
    </form>
    <?php
    if(isset($_POST['filtrar'])){
      $procura = $_POST['txtfiltro'];
      $filtro = $_POST['selfiltro'];

      if(!empty($procura)){
        $EmpDAO = new EmpresaDAO();
        $empresas = $EmpDAO->filtrar($procura,$filtro);

        if(count($empresas) == 0){
          echo "<h3>Sua pesquisa não retornou nada!</h3>";
          return;
        }
      }
    }//fecha if
    ?>

    <?php
      echo "<div class='table-responsive'>";
        echo "<table class='table table-striped table-bordered table-hover table-condensed'>";
        echo "<thead>";
          echo "<tr>";
            echo "<th>Código</th>";
            echo "<th>razaoSocial</th>";
            echo "<th>Cidade</th>";
            echo "<th>CNPJ</th>";
            echo "<th>CEP</th>";
            echo "<th>telefone</th>";
            echo "<th>email</th>";
            echo "<th>T.Empresa</th>";
            echo "<th>Alterar</th>";
            echo "<th>Excluir</th>";
          echo "</tr>";
        echo "</thead>";

        echo "<tfoot>";
          echo "<tr>";
            echo "<th>Código</th>";
            echo "<th>razaoSocial</th>";
            echo "<th>cidade</th>";
            echo "<th>CNPJ</th>";
            echo "<th>CEP</th>";
            echo "<th>telefone</th>";
            echo "<th>email</th>";
            echo "<th>T.Empresa</th>";
            echo "<th>Alterar</th>";
            echo "<th>Excluir</th>";
          echo "</tr>";
        echo "</tfoot>";
        echo "<tbody>";
        foreach($empresas as $empresa) {
          echo "<tr>";
            echo "<td>$empresa->idEmpresa</td>";
            echo "<td>$empresa->razaoSocial</td>";
            echo "<td>$empresa->cidade</td>";
            echo "<td>$empresa->CNPJ</td>";
            echo "<td>$empresa->CEP</td>";
            echo "<td>$empresa->telefone</td>";
            echo "<td>$empresa->email</td>";
            echo "<td>$empresa->tipoEmpresa</td>";
            echo "<td><a class='btn btn-warning' href='editardados.php?identify=$empresa->idEmpresa'>Alterar</a></td>";
            echo "<td><a class='btn btn-danger' href='consulta.php?id=$empresa->idEmpresa'>Excluir</a></td>";
          echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
      echo "</div>"; //table responsive
      ?>
      <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
      <script src="js/vue.js"></script>
    </div>
  </body>
</html>
<?php
if(isset($_GET['id'])) {
  $empresaDAO->desvincularEmpresa($_GET['id']);
  header("location:consulta.php");
  ob_enf_fluch();
}
?>
