<?php
require_once("..//model//Crud.php");

class CtrlAluno extends Crud
{

  function __construct()
  {
    // code...
  }
  public function selectLike($pesq){
    return self::execQuery("acad","select * from academico.ALUNOS where nm_aluno like '%".$pesq."%'");
  }
  public function selectAll(){
    return self::execQuery("acad",'select * from academico.ALUNOS order by 1 desc');
  }
  public function salvar($nmAluno,$matricula,$email){
    $sql="insert into ALUNOS(NM_ALUNO,MAT_ALUNO,EMAIL) values('".$nmAluno."','".$matricula."','".$email."')";
    //echo $sql;
    return self::execQuery('acad',strtoupper($sql));
  }
  public function editar($id,$nmAluno,$matricula,$email){
    $sql="update ALUNOS set  NM_ALUNO='".$nmAluno."', MAT_ALUNO='".$matricula."', EMAIL='".$email."' where  CD_ALUNO=".$id;
    return self::execQuery('acad',strtoupper($sql));
  }
  public function deletar($id){
    $sql="delete from ALUNOS where CD_ALUNO=".$id;
    return self::execQuery('acad',strtoupper($sql));
    return "Por favor, crie, escolha outro registro para deletar!";
  }
  public function ultMatricula(){
    $sql="select  MAX(MAT_ALUNO) as ultMAtricula from academico.ALUNOS";
    return self::execQuery('acad',$sql);
  }
}

?>
