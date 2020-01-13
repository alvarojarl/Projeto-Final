<?php
require "conexaoDB.class.php";
class PessoaDAO
{

  private $conexaoPessoa = null;

  public function __construct()
  {
    $this->conexaoPessoa = ConexaoDB::getInstance();
  }

  public function __destruct()
  {
  }

  public function cadastrarPessoa($pessoa)
  {
    try {
      $statement = $this->conexaoPessoa->prepare("insert into pessoa(idPessoa, nome, sexo, CPF, RG, comprovanteDeResidencia, tipoEmprestimo) values(null,?,?,?,?,?,?)");
      $statement->bindValue(1,$pessoa->nome);
      $statement->bindValue(2,$pessoa->sexo);
      $statement->bindValue(3,$pessoa->CPF);
      $statement->bindValue(4,$pessoa->RG);
      $statement->bindValue(5,$pessoa->comprovanteDeResidencia);
      $statement->bindValue(6,$pessoa->tipoEmprestimo);
      $statement->execute();

    } catch(PDOException $error) {
      echo "Erro ao cadastrar!".$error;
    }//fecha catch
  }//fecha função
  public function buscarPessoa()
  {
    try {
      $statement = $this->conexaoPessoa->query("select * from pessoa");
      $array = $statement->fetchAll(PDO::FETCH_CLASS, 'Pessoa');
      return $array;
    } catch(PDOException $error) {
        echo "Erro ao buscar Pmpresas!".$error;
    }//fecha c
  }//fecha função

  public function desvincularPessoa($id)
  {
    try {
      $statement = $this->conexaoPessoa->prepare(
        "delete from pessoa where idPessoa = ?");
      $statement->bindValue(1,$id);
      $statement->execute();
    } catch(PDOException $error) {
      echo "Erro ao desvincular Pessoa! ".$error;
    }
  }//fecha função
  public function alterar($pessoa)
  {
    try {
      $statement = $this->conexaoPessoa->prepare("update pessoa set nome=?, sexo=?, CPF=?, RG=?, comprovanteDeResidencia=?, tipoEmprestimo=? where idPessoa=?");

      $statement->bindValue(1,$pessoa->nome);
      $statement->bindValue(2,$pessoa->sexo);
      $statement->bindValue(3,$pessoa->CPF);
      $statement->bindValue(4,$pessoa->RG);
      $statement->bindValue(5,$pessoa->comprovanteDeResidencia);
      $statement->bindValue(6,$pessoa->tipoEmprestimo);
      $statement->bindValue(7,$pessoa->idPessoa);
      $statement->execute();

    } catch(PDOException $error) {
      echo "Erro alterar dados da Pessoa! ".$error;
    }
  }//fecha função

  public function filtrar($procura, $filtro)
  {
    try {
      $query="";
      switch($filtro) {
        case "idPessoa": $query = "where idPessoa like '%".$procura."%'";
        break;
        case "nome": $query = "where nome like '%".$procura."%'";
        break;
        case "sexo": $query = "where sexo like '%".$procura."%'";
        break;
        case "CPF": $query = "where CPF like '%".$procura."%'";
        break;
        case "RG": $query = "where RG like '%".$procura."%'";
        break;
        case "comprovanteDeResidencia": $query = "where comprovanteDeResidencia like '%".$procura."%'";
        break;
        case "tipoEmprestimo": $query = "where tipoEmprestimo like '%".$procura."%'";
        break;
        default: $query = "";
        break;
      }
      if(empty($procura)) {
        $query = "";
      }
      $statement = $this->conexaoPessoa->query("select * from pessoa {$query}");
      $array = $statement->fetchAll(PDO::FETCH_CLASS, 'pessoa');
      return $array;
    } catch(PDOException $error) {
      echo "Erro ao filtrar pessoa! ".$error;
    }
  }//fecha função
}//fecha class
