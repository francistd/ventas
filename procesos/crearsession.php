<?php
session_start();

$iduser =$_POST['valor'];

$_SESSION['consulta'] = $iduser;

echo $iduser;
 ?>
