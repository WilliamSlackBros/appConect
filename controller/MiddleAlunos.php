<?php
require_once("CtrlAluno.php");
if ($_GET['funcao']=='selectLike') {
  $selectLike = new CtrlAluno();
  $dados = $selectLike->selectLike($_GET['pesq']);
  echo json_encode($dados);
}
if ($_GET['funcao']=='selectAll') {
  $selectall = new CtrlAluno();
  $dados = $selectall->selectAll();
  echo json_encode($dados);
}

if ($_POST['funcao']=="salvar") {
  $salvar = new CtrlAluno();
  $resp= json_encode($salvar->salvar($_POST['NmAlunoAdd'],$_POST['MatriculaAdd'],$_POST['EmailAdd']));
//  die($resp);
  echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL= http://localhost/aulaFran/appConect/view/app.php?msgTipoResp=Salvo,&msgResp=$resp'>";
}

if ($_POST['funcao']=='editar') {
  $editar = new CtrlAluno();
  $resp= json_encode($editar->editar($_POST['idEdt'],$_POST['NmAlunoEdt'],$_POST['MatriculaEdt'],$_POST['EmailEdt']));
  echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL= http://localhost/aulaFran/appConect/view/app.php?msgTipoResp=Atualizado,&msgResp=$resp'>";
}

if ($_POST['funcao']=='deletar') {
  $deletar = new CtrlAluno();
  if(md5($_POST['CRSDelet'])=='d139f9681ad8f971a0136b280f33cc34'){
  $resp= json_encode($deletar->deletar($_POST['idDelet']));
}else{
  $resp= "Não permitido!";
}
echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL= http://localhost/aulaFran/appConect/view/app.php?msgTipoResp=Deletado,&msgResp=$resp'>";
}
if ($_POST['funcao']=='ultMatricula') {
  $ultMatricula = new CtrlAluno();
  echo json_encode($ultMatricula->ultMatricula());
}
?>
