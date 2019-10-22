<?php
class Conexao {
  private static $rspBanco;
  public function __construct($database,$path,$driver,$query,$acao,$user=null, $passwd=null){

    switch(strtoupper($driver)){

      case 'SQLITEPDO':

      if(file_exists(dirname(__FILE__).'/'.$path.$database)){
        $conexao = new PDO("sqlite:".dirname(__FILE__).'/'.$path.$database);

        $prepare =$conexao->prepare($query);

        $prepare->execute();
        if ($acao=='select') {

          self::$rspBanco= $prepare->fetchAll(PDO::FETCH_ASSOC);
        }else{
          self::$rspBanco= "Realizado com Sucesso!";
        }
      }else{

        self::$rspBanco="Erro de conexão Sqlite PDO";
      }
      break;
      case 'MYSQLPDO':
      $conexao = new PDO( 'mysql:host='.$path.';dbname=' . $database.';charset=utf8', $user, $passwd );
      if($conexao){
        $prepare =$conexao->prepare($query);

        $prepare->execute();
        if ($acao=='select') {

          self::$rspBanco= $prepare->fetchAll(PDO::FETCH_ASSOC);
        }else{
          self::$rspBanco= "Realizado com Sucesso!";
        }
      }else{

        self::$rspBanco="Erro de conexão Mysql PDO";
      }
      break;
      case 'POSTPDO':
      $conexao = new PDO( 'pgsql:host='.$path.';dbname=' . $database.';charset=utf8', $user, $passwd );
      if($conexao){
        $prepare =$conexao->prepare($query);

        $prepare->execute();
        if ($acao=='select') {

          self::$rspBanco= $prepare->fetchAll(PDO::FETCH_ASSOC);
        }else{
          self::$rspBanco= "Realizado com Sucesso!";
        }
      }else{

        self::$rspBanco="Erro de conexão PostgreSql PDO";
      }
      break;
      case 'MYSQLNATIVO':
      //$conexao = new PDO( 'mysql:host='.$path.';dbname=' . $database.';charset=utf8', $user, $passwd );

      $conexao =  new mysqli($path, $username, $password, $database);
      if($conexao){
        $prepare =$conexao->prepare($query);

        $prepare->execute();
        if ($acao=='select') {

          self::$rspBanco= $prepare->fetch();
          $prepare->close();
          $conexao->close();
        }else{
          self::$rspBanco= "Realizado com Sucesso!";
        }
      }else{

        self::$rspBanco="Erro de conexão Mysql Driver Nativo";
      }

      break;

    }
  }
  public function getrspBanco(){
    return self::$rspBanco;
  }


}

?>
