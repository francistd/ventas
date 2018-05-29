<?php
require_once "../../clases/Conexion.php";
require_once "../../clases/Usuarios.php";

$obj = new usuarios();

$pas= sha1($_POST['password']);
$datos= array($_POST['nombre'],
              $_POST['apellido'],
              $_POST['usuario'],
              $pas);

echo $obj->registrarUsuario($datos);
 ?>
