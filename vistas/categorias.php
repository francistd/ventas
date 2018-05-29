<?php
session_start();

if (isset($_SESSION['usuario'])) {

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Categorias</title>
    <?php require_once "menu.php" ;?>
  </head>
  <body>
<div class="container">
  <h1>Categorias</h1>
<div class="row">
<div class="col-sm-4">
<form id="frmCategorias" >
<label>Categoria</label>
<input type="text" class="form-control input-sm" name="categoria" id="categoria" value="">
<p></p>
<span class="btn btn-primary" id="btnAgregaCategoria">Agregar</span>
</form>
</div>
<div class="col-sm-6">
<div id="tablaCategoriaLoad">

</div>
</div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="actualizaCategoria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Actualiza categoria</h4>
      </div>
      <div class="modal-body">
        <form id="frmCategoriaU">
          <input type="text" hidden="" id="idcategoria" name="idcategoria" value="">
          <label>Categoria</label>
          <input type="text" id="categoriaU" name="categoriaU" value="" class="form-control input-sm">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnActualizaCategoria" class="btn btn-warning" data-dismiss="modal">Guardar</button>

      </div>
    </div>
  </div>
</div>
<!-- Modal end -->

  </body>
</html>

<script type="text/javascript">
  $(document).ready(function(){
    $('#tablaCategoriaLoad').load("categorias/tablaCategorias.php");
    $('#btnAgregaCategoria').click(function(){
      vacios = validarFormVacio('frmCategorias')
      if (vacios >0) {
        alertify.alert("Debes llenar todos los campos");
        return false;
      }
      datos=$('#frmCategorias').serialize();
      $.ajax({
        type:"POST",
        data:datos,
        url:"../procesos/categorias/agregaCategoria.php",
        success:function(r){
          if (r==1) {
            //Esta linea permite limpiar el formulario al insertar un registro
            $('#frmCategorias')[0].reset();

            $('#tablaCategoriaLoad').load("categorias/tablaCategorias.php");
            alertify.success("Categoria agregada con exito");
          }else {
            alertify.error("Fallo al agregar categoria");
          }
        }
      });
    });
  });
</script>

<script type="text/javascript">
$(document).ready(function(){
  $('#btnActualizaCategoria').click(function(){

    datos=$('#frmCategoriaU').serialize();
    $.ajax({
      type:"POST",
      data:datos,
      url:"../procesos/categorias/actualizaCategoria.php",
      success:function(r){
        if (r==1) {
          $('#tablaCategoriaLoad').load("categorias/tablaCategorias.php");
          alertify.success("Actualizado con exito");
        }else {
          alertify.error("Fallo al actualizar");
        }
      }
    });
  });
});
</script>

<script type="text/javascript">
function agregadato(idcategoria,categoria){
$('#idcategoria').val(idcategoria);
$('#categoriaU').val(categoria);
}

function eliminarCategoria(idcategoria){
alertify.confirm('¿Desea eliminar esta categoria?', function(){
  $.ajax({
    type:"POST",
    data:"idcategoria=" + idcategoria,
    url:"../procesos/categorias/eliminarCategoria.php",
    success:function(r){
      if (r==1) {
        $('#tablaCategoriaLoad').load("categorias/tablaCategorias.php");
        alertify.success("Eliminado con exito");
      }else {
        alertify.error("Fallo al eliminar");
      }
    }
  });
 }, function(){
   alertify.error('Cancelado')
 });
}
</script>

<?php
}else {
  header("location:../index.php");
}
 ?>
