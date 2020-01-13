<?php
require "conexaodb.class.php";
class EmpresaDAO
{

  private $conexaoEmpresa = null;

  public function __construct()
  {
    $this->conexaoEmpresa = ConexaoDB::getInstance();
  }

  public function __destruct()
  {
  }

  public function cadastrarEmpresa($empresa)
  {
    try {
      $statement = $this->conexaoEmpresa->prepare("insert into empresa(idEmpresa, razaoSocial, cidade, CNPJ, CEP, telefone, email, tipoEmpresa) values(null,?,?,?,?,?,?,?)");
      $statement->bindValue(1,$empresa->razaoSocial);
      $statement->bindValue(2,$empresa->cidade);
      $statement->bindValue(3,$empresa->CNPJ);
      $statement->bindValue(4,$empresa->CEP);
      $statement->bindValue(5,$empresa->telefone);
      $statement->bindValue(6,$empresa->email);
      $statement->bindValue(7,$empresa->tipoEmpresa);
      $statement->execute();

    } catch(PDOException $error) {
      echo "Erro ao cadastrar!".$error;
    }//fecha catch
  }//fecha função

  public function buscarEmpresa()
  {
    try {
      $statement = $this->conexaoEmpresa->query("select * from empresa");
      $array = $statement->fetchAll(PDO::FETCH_CLASS, 'Empresa');
      return $array;
    } catch(PDOException $error) {
        echo "Erro ao buscar Empresas!".$error;
    }//fecha c
  }//fecha função

  public function desvincularEmpresa($id)
  {
    try {
      $statement = $this->conexaoEmpresa->prepare(
        "delete from empresa where idEmpresa = ?");
      $statement->bindValue(1,$id);
      $statement->execute();
    } catch(PDOException $error) {
      echo "Erro ao desvincular Empresa! ".$error;
    }
  }//fecha função

  public function alterar($empresa)
  {
    try {
      $statement = $this->conexaoEmpresa->prepare("update empresa set razaoSocial=?, cidade=?, CNPJ=?, CEP=?, telefone=?, email=?, tipoEmpresa=? where idEmpresa=?");

      $statement->bindValue(1,$empresa->razaoSocial);
      $statement->bindValue(2,$empresa->cidade);
      $statement->bindValue(3,$empresa->CNPJ);
      $statement->bindValue(4,$empresa->CEP);
      $statement->bindValue(5,$empresa->telefone);
      $statement->bindValue(6,$empresa->email);
      $statement->bindValue(7,$empresa->tipoEmpresa);
      $statement->bindValue(8,$empresa->idEmpresa);
      $statement->execute();

    } catch(PDOException $error) {
      echo "Erro alterar dados da Empresa! ".$error;
    }
  }//fecha função

  public function filtrar($procura, $filtro)
  {
    try {
      $query="";
      switch($filtro) {
        case "idEmpresa": $query = "where idEmpresa like '%".$procura."%'";
        break;
        case "razaoSocial": $query = "where razaoSocial like '%".$procura."%'";
        break;
        case "cidade": $query = "where cidade like '%".$procura."%'";
        break;
        case "CNPJ": $query = "where CNPJ like '%".$procura."%'";
        break;
        case "CEP": $query = "where CEP like '%".$procura."%'";
        break;
        case "telefone": $query = "where telefone like '%".$procura."%'";
        break;
        case "email": $query = "where email like '%".$procura."%'";
        break;
        case "tipoEmpresa": $query = "where tipoEmpresa like '%".$procura."%'";
        break;
        default: $query = "";
        break;
      }
      if(empty($procura)) {
        $query = "";
      }
      $statement = $this->conexaoEmpresa->query("select * from empresa {$query}");
      $array = $statement->fetchAll(PDO::FETCH_CLASS, 'empresa');
      return $array;
    } catch(PDOException $error) {
      echo "Erro ao filtrar Empresa! ".$error;
    }
  }//fecha função
}//fecha class
