<?php
session_start();
require_once "../../clases/Conexion.php";
require_once "../../clases/Categorias.php";
$active = 1;
$fecha= date("Y-m-d");
$idusuario = $_SESSION['iduser'];
$categoria = $_POST['categoria'];

$datos=array($idusuario,$categoria,$fecha,$active);

$obj=new categoria();
echo $obj->agregaCategoria($datos);

 ?>
