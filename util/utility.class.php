<?php

class Utility
{

  public static function padronizarNome($valor): string
  {
    return ucwords((strtolower($valor)));
  }

  public static function padronizarCPF($valor): string
  {
    $expressao = "/^[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}$/";
    $confirm = preg_match($expressao,$valor);

    if(!$confirm) {
      $tryD = wordwrap($valor,3,'.',true);
      $array = explode(".",$tryD);
      return $array[0].".".$array[1].".".$array[2]."-".$array[3];
    }
    return $valor;
  }

}
