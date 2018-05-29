<?php
session_start();

if (isset($_SESSION['usuario']) and $_SESSION['usuario']=='Administrador') {

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Usuarios</title>
    <?php require_once "menu.php" ;?>
  </head>
  <body><br>
<div class="container">
  <h1>Administrar usuarios</h1>
  <div class="row">
    <div class="col-sm-4">
      <form id="frmRegistro">
      <label>Nombre</label>
      <input type="text" id="nombre" class="form-control input-sm" name="nombre" value="">
      <label>Apellido</label>
      <input type="text" id="apellido" class="form-control input-sm" name="apellido" value="">
      <label>Usuario</label>
      <input type="text" id="usuario" class="form-control input-sm" name="usuario" value="">
      <label>Password</label>
      <input type="password" id="password" class="form-control input-sm" name="password" value="">
      <p></p>
      <span class="btn btn-primary btn-sm" id="registro">Registrar</span>
      </form>
    </div>
    <div class="col-sm-8">
      <div id="buscador"></div>
      <div id="tablaUsuariosLoad">
      </div>
    </div>
  </div>
</div>

<!-- Inicia Modal-->

<!-- Modal -->
<div class="modal fade" id="actualizaUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Actualizar Usuario</h4>
      </div>
      <div class="modal-body">
        <form id="frmRegistroU">
          <input type="text" id="idUsuario" hidden="" name="idUsuario" value="">
        <label>Nombre</label>
        <input type="text" id="nombreU" class="form-control input-sm" name="nombreU" value="">
        <label>Apellido</label>
        <input type="text" id="apellidoU" class="form-control input-sm" name="apellidoU" value="">
        <label>Usuario</label>
        <input type="text" id="usuarioU" class="form-control input-sm" name="usuarioU" value="">
        </form>
      </div>
      <div class="modal-footer">
        <button id="btnActualizaUsuario" type="button" class="btn btn-warning" data-dismiss="modal">Actualizar</button>
      </div>
    </div>
  </div>
</div>

<!-- Termina Modal-->
  </body>
</html>

<script type="text/javascript">
function agregaDatosUsuario(idusuario){
  $.ajax({
    type:"POST",
    data:"idusuario=" + idusuario,
    url:"../procesos/usuarios/obtenDatoUsuario.php",
    success:function(r){
      dato=jQuery.parseJSON(r);

      $('#idUsuario').val(dato['id_usuario']);
      $('#nombreU').val(dato['nombre']);
      $('#apellidoU').val(dato['apellido']);
      $('#usuarioU').val(dato['email']);
    }
  });

}

function eliminarUsuario(idusuario){
alertify.confirm('¿Desea eliminar este usuario?', function(){
  $.ajax({
    type:"POST",
    data:"idusuario=" + idusuario,
    url:"../procesos/usuarios/eliminarUsuario.php",
    success:function(r){
      if (r==1) {
        $('#tablaUsuariosLoad').load("usuarios/tablaUsuarios.php");
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
    $('#btnActualizaUsuario').click(function(){

  		datos=$('#frmRegistroU').serialize();
  		$.ajax({
  			type:"POST",
  			data:datos,
  			url:"../procesos/usuarios/actualizaUsuario.php",
  			success:function(r){
          if (r==1) {
            $('#tablaUsuariosLoad').load("usuarios/tablaUsuarios.php");
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
  $(document).ready(function(){
    $('#tablaUsuariosLoad').load("usuarios/tablaUsuarios.php");
    $('#buscador').load('../procesos/usuarios/buscador.php');
    $('#registro').click(function(){
      vacios = validarFormVacio('frmRegistro')
      if (vacios >0) {
        alertify.alert("Debes llenar todos los campos");
        return false;
      }
var formData = new FormData(document.getElementById("frmRegistro"));
  		datos=$('#frmRegistro').serialize();
  		$.ajax({
  			type:"POST",
  			data:datos,
  			url:"../procesos/reLogin/registrarUsuario.php",
  			success:function(r){
          if (r==1) {
            $('#frmRegistro')[0].reset();
            $('#tablaUsuariosLoad').load("usuarios/tablaUsuarios.php");
            alertify.success("Agregado con exito");
          }else {
            alertify.error("Fallo al agregar");
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
