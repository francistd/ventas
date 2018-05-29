<?php
require_once "clases/Conexion.php";
$obj = new conectar();
$conexion = $obj->conexion();

$sql ="select * from usuarios where email='Administrador'";
$result = mysqli_query($conexion,$sql);
$validar=0;
if (mysqli_num_rows($result)>0) {
  header("location:index.php");
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Registro</title>
    <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
    <script src="librerias/jquery-3.3.1.min.js"></script>
    <script src="js/funciones.js"></script>
  </head>
  <body style="background-color: grey">
<br><br><br>
<div class="container">
  <div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
      <div class="panel panel-danger">
        <div class="panel panel-heading">registrar Administrador</div>
        <div class="panel panel-body">
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
          <a href="index.php" class="btn btn-default">Regresar Login</a>
        </form>
        </div>
      </div>
    </div>
    <div class="col-sm-4"></div>
  </div>
</div>
  </body>
</html>

<script type="text/javascript">
  $(document).ready(function(){
    $('#registro').click(function(){
      vacios = validarFormVacio('frmRegistro')
      if (vacios >0) {
        alert("Debes llenar todos los campos");
        return false;
      }

  		datos=$('#frmRegistro').serialize();
  		$.ajax({
  			type:"POST",
  			data:datos,
  			url:"procesos/reLogin/registrarUsuario.php",
  			success:function(r){
          if (r==1) {
            alert("Agregado con exito");
          }else {
            alert("Fallo al agregar");
          }
  			}
  		});
  	});
  });
</script>
