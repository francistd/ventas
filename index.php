<?php
require_once "clases/Conexion.php";
$obj = new conectar();
$conexion = $obj->conexion();

$sql ="select * from usuarios where email='Administrador'";
$result = mysqli_query($conexion,$sql);
$validar=0;
if (mysqli_num_rows($result)>0) {
  $validar =1;
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login de usuario</title>
    <?php
    require_once "vistas/dependencias.php";
     ?>
    <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
    <script src="librerias/jquery-3.3.1.min.js"></script>
    <script src="js/funciones.js"></script>
  </head>
  <body style="background-color:grey">
<br><br><br>
<div class="container">
  <div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
      <div class="panel panel-primary">
        <div class="panel panel-heading">Sistema de Venta y almacen</div>
        <div class="panel panel-body">
          <p style="text-align:center">
            <img src="img/carrito.png" height="200" >
          </p>
          <form id="frmLogin" >
            <label>Usuario</label>
            <input type="text" class="form-control input-sm" name="usuario" id="usuario" value="">
            <label>Password</label>
            <input type="password" class="form-control input-sm" name="password" id="password" value="">
            <p></p>
            <span class="btn btn-primary btn-sm" id="entrarSistema">Entrar</span>
            <?php if (!$validar) : ?>
              <a href="registro.php" class="btn btn-danger btn-sm">Registrar</a>
            <?php endif; ?>
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
    $('#entrarSistema').click(function(){
      vacios = validarFormVacio('frmLogin')
      if (vacios >0) {
        alert("Debes llenar todos los campos");
        return false;
      }

  		datos=$('#frmLogin').serialize();
  		$.ajax({
  			type:"POST",
  			data:datos,
  			url:"procesos/reLogin/login.php",
  			success:function(r){
          if (r==1) {
            window.location="vistas/inicio.php";
          }else {
            alert("No se pudo acceder");
          }
  			}
  		});
  	});
  });
</script>
