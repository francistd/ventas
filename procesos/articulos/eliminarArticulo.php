<?php
require_once "../../clases/Conexion.php";
require_once "../../clases/articulos.php";

$idart = $_POST['idarticulo'];

$obj= new articulos();

echo $obj->eliminaArticulo($idart);
 ?>
