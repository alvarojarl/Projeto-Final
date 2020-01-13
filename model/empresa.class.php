<?php

class Empresa
{
  private $idEmpresa;
  private $razaoSocial;
  private $cidade;
  private $CNPJ;
  private $CEP;
  private $telefone;
  private $email;
  private $tipoEmpresa;

  public function __constract()
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
    return nl2br("Razão Social :$this->razaoSocial
    Cidade :$this->cidade
    CNPJ :$this->CNPJ
    CEP :$this->CEP
    Telefone :$this->telefone
    Email :$this->email
    Tipo Empresa :$this->tipoEmpresa");
  }
}//fecha class
