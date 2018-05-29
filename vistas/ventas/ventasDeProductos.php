<?php
require_once "../../clases/Conexion.php";
$c= new conectar();
$conexion= $c->conexion();
?>

<h4>Vender Producto</h4>
<div class="row">
  <div class="col-sm-4">
    <form id="frmventasProductos">
      <label>Selecciona cliente</label>
      <select class="form-control input-sm" id="clienteVenta" name="clienteVenta">
        <option value="A">Selecciona Cliente</option>
        <option value="0">Sin Cliente</option>
        <?php
        $sql="SELECT id_cliente,nombre,apellido from clientes where active =1";
        $result= mysqli_query($conexion,$sql);

        while($cliente=mysqli_fetch_row($result)):
          ?>
          <option value="<?php echo $cliente[0] ?>"><?php echo $cliente[2]." ".$cliente[1] ?></option>
        <?php endwhile; ?>
      </select>

      <label>Producto</label>
      <select class="form-control input-sm" id="productoVenta" name="productoVenta">
        <option value="A">Selecciona producto</option>
        <?php
        $sql="SELECT id_producto,nombre from articulos where active =1";
        $result= mysqli_query($conexion,$sql);

        while($producto=mysqli_fetch_row($result)):
          ?>
          <option value="<?php echo $producto[0] ?>"><?php echo $producto[1] ?></option>
        <?php endwhile; ?>
      </select>
      <label>Descripcion</label>
      <textarea id="descripcionV" readonly="" name="descripcionV" class="form-control input-sm"></textarea>
      <label>Cantidad</label>
      <input type="text" readonly="" class="form-control input-sm" id="cantidadV" name="cantidadV" value="">
      <label>Precio</label>
      <input type="text" readonly="" class="form-control input-sm" id="precioV" name="precioV" value="">
      <p></p>
      <span class="btn btn-primary" id="btnAgregaVenta">Agregar</span>
    </form>
  </div>
  <div class="col-sm-3">
    <div id="imgProducto"></div>
  </div>
  <div class="col-sm-4">
    <div id="tablaVentasTempLoad"></div>
  </div>
</div>

<!--Llenamos el formulario de Productos-->
<script type="text/javascript">
$(document).ready(function(){

  $('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");

  $('#productoVenta').change(function(){
    $.ajax({
      type:"POST",
      data:"idproducto=" + $('#productoVenta').val(),
      url:"../procesos/ventas/llenarFormProducto.php",
      success:function(r){
        dato=jQuery.parseJSON(r);

        $('#descripcionV').val(dato['descripcion']);
        $('#cantidadV').val(dato['cantidad']);
        $('#precioV').val(dato['precio']);

        $('#imgProducto').prepend('<img class="img-thumbnail" id="imgp" src="' + dato['ruta'] + '" />');
      }
    });
  });

  $('#btnAgregaVenta').click(function(){
    vacios = validarFormVacio('frmventasProductos')
    if (vacios >0) {
      alertify.alert("Debes llenar todos los campos");
      return false;
    }

    datos=$('#frmventasProductos').serialize();
    $.ajax({
      type:"POST",
      data:datos,
      url:"../procesos/ventas/agregaProductoTemp.php",
      success:function(r){
        $('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
      }
    });
  });

});
</script>

<script type="text/javascript">

function quitarP(index){
  $.ajax({
    type:"POST",
    data:"ind=" + index,
    url:"../procesos/ventas/quitarProducto.php",
    success:function(r){
      $('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
      alertify.success("Quitado con exito");
    }
  });
}

function crearVenta(){
  $.ajax({
    url:"../procesos/ventas/crearVenta.php",
    success:function(r){
      if (r > 0) {
        $('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
        $('#frmventasProductos')[0].reset();
        alertify.alert("Venta creada con exito, consulte en Ventas hechas.");
      }else if (r==0) {
        alertify.alert("No hay lista de ventas");
      }else {
        alertify.error("Fallo al crear venta");
      }
    }
  });
}

</script>

<script type="text/javascript">
$(document).ready(function(){
  $('#clienteVenta').select2();
  $('#productoVenta').select2();
});
</script>
