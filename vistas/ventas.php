<?php
session_start();

if (isset($_SESSION['usuario'])) {

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ventas</title>
    <?php require_once "menu.php" ;?>
  </head>
  <body>
<div class="container">
  <h2>Venta de productos</h2>
  <hr>
  <div class="row">
<div class="col-sm-12">
<span class="btn btn-default" id="ventaProductosBtn">Vender productos</span>
<span class="btn btn-default" id="ventasHechasBtn">Ventas hechas</span>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<div id="ventaProductos"></div>
<div id="ventasHechas"></div>
</div>
</div><hr>
</div>
  </body>
</html>

<script type="text/javascript">
  $(document).ready(function(){
    $('#ventaProductosBtn').click(function(){
      esconderSeccionVenta();
      $('#ventaProductos').load("ventas/ventasDeProductos.php");
      $('#ventaProductos').show();
    });

    $('#ventasHechasBtn').click(function(){
      esconderSeccionVenta();
      $('#ventasHechas').load("ventas/ventasyReportes.php");
      $('#ventasHechas').show();
    });
  });

  function esconderSeccionVenta(){
    $('#ventaProductos').hide();
    $('#ventasHechas').hide();
  }
</script>

<?php
}else {
  header("location:../index.php");
}
 ?>
