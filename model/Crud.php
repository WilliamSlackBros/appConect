<?php
require_once("Conexao.php");
class Crud  {

  public function __construct(){
  }

  public function execQuery($NomeConexao,$query){
    self::isVulneravel($query);
    switch (strtoupper($NomeConexao)) {
      case 'PRACA':
      $cxPraca = new Conexao("sqlite.db","bds/","sqlitepdo",$query, self::whereFuncao($query));
      return  $cxPraca->getrspBanco();
      break;
      case 'ACAD':
      $cx = new Conexao("academico","localhost","mysqlpdo",$query, self::whereFuncao($query),'mysql','qwe123');
      return  $cx->getrspBanco();
      break;
      default:
      return'Escolha uma conexão configurada!';
      break;
    }
  }
  public function isVulneravel($query){
    $isNot = array(
      "/1=1/i"
    );
    foreach ($isNot as $regra) {
      $valid =   preg_match_all($regra,$query,$matches);
      if ($valid) {
        die("Erro de Violação da Query! => \"".$query."\"");
      }
    }

  }
  public function whereFuncao($cmd){
    $isExist = array(
      "/select/i",
      "/insert/i",
      "/update/i",
      "/deleta/i"
    );
    foreach ($isExist as $regra) {
      $valid =   preg_match_all($regra,$cmd,$matches);
      if ($valid) {
        $arr = array('/');
        return str_replace($arr,"",substr($regra,0,-1));
      }
    }
  }
}

?>
