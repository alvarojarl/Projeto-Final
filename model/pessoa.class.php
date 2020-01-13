<?php

class Pessoa
{
  private $idPessoa;
  private $nome;
  private $sexo;
  private $CPF;
  private $RG;
  private $comprovanteDeResidencia;
  private $tipoEmprestimo;

  public function __construct()
  {
  }

  public function __destruct()
  {
  }

  public function __get($attribute)
  {
    return $this->$attribute;
  }

  public function __set($attribute, $value)
  {
    $this->$attribute = $value;
  }

  public function __toString(): string
  {
    return nl2br("Código :$this->idPessoa
    Nome :$this->nome
    Sobrenome :$this->sexo
    CPF :$this->CPF
    RG :$this->RG
    Comprovante de residencia :$this->comprovanteDeResidencia
    Comprovante de renda :$this->tipoEmprestimo");
  }
}
