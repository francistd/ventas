<?php
session_start();

if (isset($_SESSION['usuario'])) {

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Clientes</title>
    <?php require_once "menu.php" ;?>
  </head>
  <body>
<div class="container">
  <h1>Clientes</h1>
  <div class="row">
<div class="col-sm-4">
<form id="frmClientes">
  <label>Nombre</label>
  <input type="text" class="form-control input-sm" id="nombre" name="nombre" value="">
  <label>Apellido</label>
  <input type="text" class="form-control input-sm" id="apellido" name="apellido" value="">
  <label>Direccion</label>
  <input type="text" class="form-control input-sm" id="direccion" name="direccion" value="">
  <label>E-mail</label>
  <input type="text" class="form-control input-sm" id="email" name="email" value="">
  <label>Telefono</label>
  <input type="text" class="form-control input-sm" id="telefono" name="telefono" value="">
  <label>RNC</label>
  <input type="text" class="form-control input-sm" id="rnc" name="rnc" value="">
  <p></p>
  <span class="btn btn-primary" id="btnAgregarCliente">Agregar</span>
</form>
</div>
<div class="col-sm-8">
<div id="tablaClientesLoad">

</div>
</div>
  </div>
</div>

<!--Inicia Modal-->

<!-- Modal -->
<div class="modal fade" id="abreModalClientes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Actualizar Cliente</h4>
      </div>
      <div class="modal-body">
        <form id="frmClientesU">
          <input type="text"  id="idclienteU" name="idclienteU" hidden="" value="">
          <label>Nombre</label>
          <input type="text" class="form-control input-sm" id="nombreU" name="nombreU" value="">
          <label>Apellido</label>
          <input type="text" class="form-control input-sm" id="apellidoU" name="apellidoU" value="">
          <label>Direccion</label>
          <input type="text" class="form-control input-sm" id="direccionU" name="direccionU" value="">
          <label>E-mail</label>
          <input type="text" class="form-control input-sm" id="emailU" name="emailU" value="">
          <label>Telefono</label>
          <input type="text" class="form-control input-sm" id="telefonoU" name="telefonoU" value="">
          <label>RNC</label>
          <input type="text" class="form-control input-sm" id="rncU" name="rncU" value="">
        </form>
      </div>
      <div class="modal-footer">
        <button id="btnActualizarClientes" type="button" class="btn btn-primary" data-dismiss="modal">Actualizar</button>
      </div>
    </div>
  </div>
</div>

<!--Termina Modal-->
  </body>
</html>

<script type="text/javascript">

function agregaDatosCliente(idclienteU){
  $.ajax({
    type:"POST",
    data:"idclienteU=" + idclienteU,
    url:"../procesos/clientes/obtenDatoCliente.php",
    success:function(r){
      dato=jQuery.parseJSON(r);

      $('#idclienteU').val(dato['id_cliente']);
      $('#nombreU').val(dato['nombre']);
      $('#apellidoU').val(dato['apellido']);
      $('#direccionU').val(dato['direccion']);
      $('#emailU').val(dato['email']);
      $('#telefonoU').val(dato['telefono']);
      $('#rncU').val(dato['rfc']);
    }
  });

}

function eliminarCliente(idcliente){
alertify.confirm('¿Desea eliminar este cliente?', function(){
  $.ajax({
    type:"POST",
    data:"idcliente=" + idcliente,
    url:"../procesos/clientes/eliminarCliente.php",
    success:function(r){
      if (r==1) {
        $('#tablaClientesLoad').load("clientes/tablaClientes.php");
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

<script type="text/javascript">
  $(document).ready(function(){
    $('#tablaClientesLoad').load("clientes/tablaClientes.php");
    $('#btnAgregarCliente').click(function(){
      vacios = validarFormVacio('frmClientes')
      if (vacios >0) {
        alertify.alert("Debes llenar todos los campos");
        return false;
      }
      datos=$('#frmClientes').serialize();
      $.ajax({
        type:"POST",
        data:datos,
        url:"../procesos/clientes/agregaCliente.php",
        success:function(r){
          if (r==1) {
            $('#frmClientes')[0].reset();
            $('#tablaClientesLoad').load("clientes/tablaClientes.php");
            alertify.success("Cliente agregado con exito");
          }else {
            alertify.error("Fallo al agregar cliente");
          }
        }
      });
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#btnActualizarClientes').click(function(){
      datos=$('#frmClientesU').serialize();
      $.ajax({
        type:"POST",
        data:datos,
        url:"../procesos/clientes/actualizaCliente.php",
        success:function(r){
          if (r==1) {
            $('#frmClientes')[0].reset();
            $('#tablaClientesLoad').load("clientes/tablaClientes.php");
            alertify.success("Actualizado con exito");
          }else {
            alertify.error("Fallo al actualizar");
          }
        }
      });
    });
  });
</script>

<?php
}else {
  header("location:../index.php");
}
 ?>
