<!--modais-->

<!-- Modal Adicionar-->

<div class="modal" id="MdlAdd" ><!--style="display:block;"-->
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">

        <h4 class="modal-title">Adicionar Aluno</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <form  method="post" action="../controller/MiddleAlunos.php">
        <div class="modal-body">

          <div class="form-group ">
            <input type="text" class="form-control form-control-sm"   name="funcao" value="salvar" hidden>
            <label for="nmAluno" class="form-control-sm">Nome do Aluno:</label>
            <input type="text" class="form-control form-control-sm" id="txtNmAlunoAdd"  placeholder="Entre com o Nome" name="NmAlunoAdd" required>
          </div>
          <div class="form-group"><!-- form-inline-->
            <label for="txtPrimNomeAdd" class="form-control-sm">Matricula:</label>
            <input type="text" class="form-control form-control-sm" id="txtMatriculaAdd" placeholder="Matricula..." name="MatriculaAdd" readonly>
          </div>
          <div class="form-group">
            <label for="txtEmailAdd" class="form-control-sm">E-Mail:</label>
            <input type="text" class="form-control form-control-sm" id="txtEmailAdd" placeholder="E-Mail..." name="EmailAdd" required>
          </div>

        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-sm btn-success"  id="btnSalvarAdd">Salvar</button><!--data-dismiss="modal"-->
          <button type="Cancel" class="btn btn-sm btn-danger" data-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!--fim do modal adicionar -->
<!--modal editar -->
<div class="modal" id="MdlEditar" ><!--style="display:block;"-->
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Editar Aluno</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <form  method="post" action="../controller/MiddleAlunos.php">
        <div class="modal-body" >

          <div class="form-group ">
            <input type="text" class="form-control form-control-sm"  value="editar" name="funcao" hidden >
            <label for="txtIdEdt" class="form-control-sm" hidden>Código do Aluno:</label>
            <input type="text" class="form-control form-control-sm" id="txtIdEdt" placeholder="Código da aluno" value="" name="idEdt" hidden >
            <label for="txtNmAlunoEdt" class="form-control-sm">Nome da Aluno:</label>
            <input type="text" class="form-control form-control-sm" id="txtNmAlunoEdt"  placeholder="Nome Completo" value="" name="NmAlunoEdt" >
          </div>
          <div class="form-group "><!--form-inline-->
            <label for="txtPrimNomeEdt" class="form-control-sm">Matricula:</label>
            <input type="text" class="form-control form-control-sm " id="txtMatriculaEdt" placeholder="Matricula..." name="MatriculaEdt" readonly>
            <label for="txtEmailEdt" class="form-control-sm">E-Mail:</label>
            <input type="text" class="form-control form-control-sm txtSiglas" id="txtEmailEdt" placeholder="E-Mail..." name="EmailEdt" required>
          </div>

        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-sm btn-success"  id="btnSalvarMdlEditar">Salvar</button><!-- data-dismiss="modal"-->
          <button type="Cancel" class="btn btn-sm btn-danger" data-dismiss="modal" id="btnCancelarMdlEditar">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--fim do modal editar-->
<!--modal deletar -->
<div class="modal" id="MdlDeletar">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Deletar Aluno</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->

      <div class="modal-body">
        <form  method="post" action="../controller/MiddleAlunos.php">
          <div class="form-group ">
            <input type="text" name="funcao" value="deletar" hidden>

            <label for="" class="form-control-sm">Senha:</label>
            <input type="text" id="CRSDelet" name="CRSDelet"  >
              <div class="form-group ">
            <label for="" class="form-control-sm">Deseja deletar Aluno(a):</label>

            <input type="text" id="idDelet" name="idDelet"  hidden>
            <input type="text" id="nmDelet" name="nmDelet" readonly  style="border:0px;">
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-sm btn-success"  id="btnExcluirMdlDelete">Deletar</button><!--data-dismiss="modal"-->
            <button type="Cancel" class="btn btn-sm btn-danger" data-dismiss="modal" >Cancelar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--fim do modal deletar-->
  <!--fim dos modais-->
  <script type="text/javascript">

  $(document).on('click','#btnAdd',function(e){
    $('#btnSalvarAdd').attr('disabled','disabled');
    $.ajax({
      url:"../controller/MiddleAlunos.php",
      type:"post",
      data:{
        funcao:"ultMatricula"
      },
      success:function(resultado,status){
        JSON.parse(resultado).forEach(function (registro){
          let dados = registro.ultMAtricula;
          $('#txtMatriculaAdd').val(dados.substr(0, 3)+(parseInt(dados.replace(dados.substr(0, 3),""))+1));
        });
      }
    });
  });

  $(document).on("click",'#btnEditar',function(e){
    e.preventDefault;
    let dadosLinha = $(this).closest('tr').find('td');
    let setDados= new Array();
    $( dadosLinha ).each(function( index ) {
      setDados[index]=$( this ).text();
    });
    $('#MdlEditar').modal('show');
    $('#txtIdEdt').val(setDados[0]);
    $('#txtNmAlunoEdt').val(setDados[1]);
    $('#txtMatriculaEdt').val(setDados[2]);
    $('#txtEmailEdt').val(setDados[3]);

  });
  $(document).on("click",'#btnDeletar',function(e){
    e.preventDefault;
    let dadosLinha = $(this).closest('tr').find('td');
    let setDados= new Array();
    $( dadosLinha ).each(function( index ) {
      setDados[index]=$( this ).text();
    });
    //console.log(setDados[0]+" "+setDados[1]);
    $('#MdlDeletar').modal('show');
    $('#idDelet').val(setDados[0]);
    $('#nmDelet').val(setDados[1]);


  });

  //validações:
  function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
  $(document).on("keyup",'#txtEmailAdd',function(e){//keyup
      if(isEmail($(this).val())){
        $('#btnSalvarAdd').removeAttr('disabled');
      }else{
        $('#btnSalvarAdd').attr('disabled','disabled');
      }
  });
</script>
