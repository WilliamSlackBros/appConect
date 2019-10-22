<?php
require_once('bibliotecas.php');
?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
  <style media="screen">
  #Pesquisar{
    display: flex;
    position: relative;

    margin-bottom: -30px;
  }
  .ln-princiapal{
    margin-top: 30px;
  }
  #btnAdd{
    border: 1px solid rgba(0, 0, 0, 0.15);
    background-color:#4CAF50;
    color: white;
    margin-left: 10px;
  }

  #tbTabela{
    display: block;
    overflow-y: scroll;
    height:auto;
    max-height: 400px;
  }
  .btnAcoes{
    margin: 1px;
  }
  .Titulo-a {
    font-weight: 500;
    line-height: 1.2;
  }
  #Mensagens{
    position: relative;
    margin-left: 25%;
    background-color: rgba(255, 255, 255, 1);
  }
  </style>
</head>
<body class="container">
  <div class="row  ln-princiapal">
    <!--mensagens-->
    <?php
    if ($_GET['msgResp']) {
      $isParam =  preg_match("/Sucesso/i", $_GET['msgResp'], $matches);
      if($isParam){
        echo'<div id="Mensagens">
        <div class="alert alert-success" id="MensagensPracasAlert">
        <p style="text-align:center;">';
      }else{
        echo'<div id="Mensagens">
        <div class="alert alert-danger" id="MensagensPracasAlert">
        <p style="text-align:center;">';
      }
      echo '<strong id="MensagensPracasTitulo">Resultado '.$_GET['msgTipoResp'].'</strong>';
      echo '<span id="MensagensPracasTexto">'.$_GET['msgResp'].'</span>';

      echo "</p>
      </div>
      </div>";

    }

    ?>
    <!--fim das mensagens-->
    <div class="col offset-md-4  offset-3 Titulo-a ">
      <b><h3>Cadastro de Alunos</h3></b>
    </div>
  </div>
  <!--tabela inicio-->
  <form class="col form-inline" id="Pesquisar">
    <label class="sr-only" for="inlineFormInputGroupUsername2">Username</label>
    <div class="col input-group mb-2 mr-sm-2">
      <div class="input-group-prepend">
        <div class="input-group-text"><i class="fas fa-search"></i></div>
      </div>
      <input type="search" name="pesq" class="form-control" value="" >
      <button type="button" name="button" class="btn btn-default float-right" id="btnAdd"  data-toggle="modal" data-target="#MdlAdd">
        <i class="fas fa-plus"></i>
      </button>
    </div>
  </form>
  <table class="table table-striped table-hover col col-md-8 offset-md-2 " id="tbTabela" style="margin-top:40px; ">
    <!--
    <thead>
    <tr>
    <th>id</th>
    <th>Nome</th>
    <th>Matricula</th>
    <th>E-Mail</th>
  </tr>
</thead>
-->

<tbody class="" id="tbPracasTbody">

  <?php
  if(!isset($_GET["pesq"])){
    $DadosSelectAll= file_get_contents('http://localhost/aulaFran//appConect/controller/MiddleAlunos.php?funcao=selectAll');

    if ($DadosSelectAll) {

      foreach (json_decode($DadosSelectAll) as $key => $value) {

        echo("<tr>"
        ."<td hidden>".$value->CD_ALUNO."</td>"
        ."<td>".$value->NM_ALUNO."</td>"
        ."<td>".$value->MAT_ALUNO."</td>"
        ."<td>".$value->EMAIL."</td>"
        ."<td class='float-right acoes'>"
        ."<button type='button' name='button' class='btn btn-sm btn-primary btnAcoes ' id='btnEditar'>"
        ."<i class='fas fa-pencil-alt'></i>"
        ."</button>"
        ."<button type='button' name='button' class='btn btn-sm btn-danger btnAcoes' id='btnDeletar'>"
        ."<i class='fas fa-trash-alt'></i>"
        ."</button>"
        ."</td>"
        ."</tr>");
      }
    }else{
      echo "<h2>Não há dados para mostrar!</h2>";
    }

  }else if(isset($_GET["pesq"])){
    $DadosSelectLike= file_get_contents('http://localhost/aulaFran//appConect/controller/MiddleAlunos.php?funcao=selectLike&pesq='.$_GET["pesq"]);
    if ($DadosSelectLike) {
      //var_dump($DadosSelectAll);
      foreach (json_decode($DadosSelectLike) as $key => $value) {

        echo("<tr>"
        ."<td hidden>".$value->CD_ALUNO."</td>"
        ."<td>".$value->NM_ALUNO."</td>"
        ."<td>".$value->MAT_ALUNO."</td>"
        ."<td>".$value->EMAIL."</td>"
        ."<td class='float-right acoes'>"
        ."<button type='button' name='button' class='btn btn-sm btn-primary btnAcoes ' id='btnEditar'>"
        ."<i class='fas fa-pencil-alt'></i>"
        ."</button>"
        ."<button type='button' name='button' class='btn btn-sm btn-danger btnAcoes' id='btnDeletar'>"
        ."<i class='fas fa-trash-alt'></i>"
        ."</button>"
        ."</td>"
        ."</tr>");
      }
    }else{
      echo "<h2>Não há dados para mostrar!</h2>";
    }
  }
  ?>
</tbody>
</table>

<!--fim da tabela-->
<?php
require_once('modaisAluno.php');
?>
<script type="text/javascript">
$(function(){
  $('#Mensagens').css("display", "block").delay(500).fadeTo("slow", 0.0);
});
</script>
</body>
</html>
