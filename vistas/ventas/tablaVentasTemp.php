<?php
session_start();
//print_r($_SESSION['tablaComprasTemp']);
?>

<h4>Hacer Venta</h4>
<hr>
<h4> <strong><div id="nombreClienteVenta"></div></strong> </h4>
<hr>
<table class="table table-bordered table-hover table-condensed" style="text-align:center;">
  <caption>
    <span class="btn btn-success" onclick="crearVenta()">Hacer Venta
      <span class="glyphicon glyphicon-usd"></span>
    </span>
    <span class="btn btn-danger" id="btnVaciarVentas">Vaciar Ventas
      <span class="glyphicon glyphicon-trash"></span>
    </span>
  </caption>
  <tr>
    <td>Nombre</td>
    <td>Descripcion</td>
    <td>Precio</td>
    <td>Cantidad</td>
    <td>Quitar</td>
  </tr>
  <?php
  $total=0; //esta variable tendra el total de la compra en dinero
  $cliente=""; //en esta se guarda el nombre del cliente
  $cantidad=1;
  if(isset($_SESSION['tablaComprasTemp'])):
    $i=0;
    foreach (@$_SESSION['tablaComprasTemp'] as $key) {

      $d=explode("||", @$key);
      ?>
      <tr>
        <td><?php echo $d[1] ?></td>
        <td><?php echo $d[2] ?></td>
        <td><?php echo $d[3] ?></td>
        <td><?php echo $cantidad ?></td>
        <td>
          <span class="btn btn-danger btn-xs" onclick="quitarP('<?php echo $i; ?>')">
            <span class="glyphicon glyphicon-remove"></span>
          </span>
        </td>
      </tr>
      <?php
      $total=$total + $d[3];
      $i++;
      $cliente= $d[4];
    }
  endif;
  ?>
  <tr>
    <td>Total de Venta: <?php echo "$".$total; ?></td>
  </tr>
</table>

<script type="text/javascript">
$(document).ready(function(){
  nombre= "<?php echo @$cliente ?>";
  $('#nombreClienteVenta').text("Cliente : " + nombre);
});
</script>

<script type="text/javascript">
$(document).ready(function(){
  $('#btnVaciarVentas').click(function(){
    $.ajax({
      url:"../procesos/ventas/vaciarTemp.php",
      success:function(r){
        $('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
      }
    });
  });
});
</script>
