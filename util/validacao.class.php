<?php

class Validacao
{
  public static function validarNome($valor): string
  {
    $expressao = "/^[A-Za-zÁ-Ôá-ô]{2,10} [d]{0,1}[eauo]{0,1}[ ]{0,1}[A-Za-zÁ-Ôá-ô]{2,20}$|^[A-Za-zÁ-Ôá-ô]{2,10}$/";
    return preg_match($expressao,$valor);
  }

  public static function validarNomeEmpresa($valor): string
  {
    $expressao = "/^[A-Za-zÁ-Ôá-ô]{2,20} [d]{0,1}[eauo]{0,1}[ ]{0,1}[A-Za-zÁ-Ôá-ô]{2,20}$|^[A-Za-zÁ-Ôá-ô]{2,20} [d]{0,1}[eauo]{0,1}[ ]{0,1}[A-Za-zÁ-Ôá-ô]{2,20} [d]{0,1}[eauo]{0,1}[ ]{0,1}[A-Za-zÁ-Ôá-ô]{2,20}$|^[A-Za-zÁ-Ôá-ô]{2,10}$/";
    return preg_match($expressao,$valor);
  }

  public static function validarCNPJ($valor): string
  {
    $expressao = "/^[0-9]{2}.[0-9]{3}.[0-9]{3}[0-9]{4}-[0-9]{2}$|^[0-9]{14}$/";
    return preg_match($expressao,$valor);
  }

  public static function validarCEP($valor): string
  {
    $expressao = "/^[0-9]{5}-[0-9]{3}$|^[0-9]{8}$|^[0-9]{7}$/";
    return preg_match($expressao,$valor);
  }

  public static function validarTelefone($valor): string
  {
    $expressao = "/^[+]{1}[0-9]{2} [0-9]{2} [0-9]{4,5}.[0-9]{4}$|^[0-9]{12}$|^[0-9]{10,11}$/";
    return preg_match($expressao,$valor);
  }

  public static function validarEmail($valor): string
  {
    $expressao = "/^([0-9a-zA-Z]+([_.-]?[0-9a-zA-Z]+)*@[0-9a-zA-Z]+[0-9,a-z,A-Z,.,-]*(.){1}[a-zA-Z]{2,4})+$/";
    return preg_match($expressao,$valor);
  }

  public static function validarNomePessoa($valor): string
  {
    $expressao = "/^[A-Za-zÁ-Ôá-ô]{2,10}$/";
    return preg_match($expressao,$valor);
  }

  public static function validarSexo($valor): string
  {
    $expressao = "/(Masculino,Feminino,Outros)/";
    return preg_match($expressao,$valor);
  }

  public static function validarRG($valor): int
  {
    $expressao = "/^[0-9]{10}/";
    return preg_match($expressao,$valor);
  }

  public static function validarCPF($valor): string
  {
    $expressao = "/^[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}$|^[0-9]{11}$/";
    return preg_match($expressao,$valor);
  }

  public static function validarEmprestimo($valor): string
  {
    $expressao = "/^Pessoal$|^Consignado$|^Penhor$/";
    return preg_match($expressao,$valor);
  }

  public static function validarTipoEmpresa($valor): string
  {
    $expressao = "/^MEI$|^Eireli$|^SS$|^SA$/";
    return preg_match($expressao,$valor);
  }

  public static function validarComprovanteResidencial($valor): string
  {
    $expressao = "/^[0-9]{3,11}$/";
    return preg_match($expressao,$valor);
  }

}
