<?php
require_once("../controller/CtrlRouter.php");
require_once("bibliotecas.php");

function autoload($pg=null){
  $rota = new CtrlRouter();
  switch ($pg) {
    case 'alunos':
    $rota->setPage('alunos');
    $rota->getPage();
    break;
    default:
    $rota->setPage('alunos');
    $rota->getPage();
    break;
  }
}


if(!empty($_GET['end'])){
  autoload($_GET['end']);
}else{
  autoload(null);
}

?>
