<?php
require_once "../../clases/Conexion.php";
$c = new conectar();
$conexion=$c->conexion();

$sql="SELECT * from usuarios where active=1";
$result = mysqli_query($conexion,$sql);
 ?>
<br><br>
<div class="row">
  <div class="col-sm-8"></div>
  <div class="col-sm-4">
    <label>Buscador</label>

    <select id="buscadorvivo" class="form-control input-sm">
      <option value="0">Selecione--</option>

      <?php while ($ver= mysqli_fetch_row($result)): ?>

        <option value="<?php echo $ver[0] ?>">
        <?php echo $ver[0]."- ".$ver[1]." ".$ver[2] ?>
        </option>

      <?php endwhile; ?>

    </select>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
  $('#buscadorvivo').select2();
  $('#buscadorvivo').change(function(){
    $.ajax({
      type:"post",
      data:'valor='+ $('#buscadorvivo').val(),
      url:'../procesos/crearsession.php',
      success:function(r){
        $('#tablaUsuariosLoad').load("usuarios/tablaUsuarios.php");
        $('#buscador').load('../procesos/usuarios/buscador.php');
      }
    });
  });
});

</script>
