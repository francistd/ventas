<?php
require_once "../../clases/Conexion.php";
$c= new conectar();
$conexion=$c->conexion();
//$sql="SELECT id_usuario,nombre,apellido,email FROM usuarios where active=1";

//$result=mysqli_query($conexion,$sql);

 ?>

<table class="table table-hover table-condensed table-bordered" style="text-align:center;">
  <caption><label>Usuarios</label></caption>
<tr>
  <td>Nombre</td>
  <td>Apellido</td>
  <td>Usuario</td>
  <td>Editar</td>
  <td>Eliminar</td>
</tr>

<?php
if (isset($_SESSION['consulta'])) {
        if ($_SESSION['consulta'] > 0) {
          $idp = $_SESSION['consulta'];
          $sql="SELECT * from usuarios  where id='$idp' and active=1";
        }else {
          $sql="SELECT * from usuarios where active=1";
        }
      }else {
        $sql="SELECT * from usuarios where active=1";
      }
      $result = mysqli_query($conexion,$sql);

 while($ver=mysqli_fetch_row($result)): ?>

<tr>
  <td><?php echo $ver[1] ?></td>
  <td><?php echo $ver[2] ?></td>
  <td><?php echo $ver[3] ?></td>
  <td>
    <span data-toggle="modal" data-target="#actualizaUsuarioModal" class="btn btn-warning btn-xs" onclick="agregaDatosUsuario('<?php echo $ver[0]; ?>')">
      <span class="glyphicon glyphicon-pencil"></span>
    </span>
  </td>
  <td>
    <span class="btn btn-danger btn-xs" onclick="eliminarUsuario('<?php echo $ver[0]; ?>')">
      <span class="glyphicon glyphicon-remove"></span>
    </span>
  </td>
</tr>
<?php endwhile ?>
</table>
