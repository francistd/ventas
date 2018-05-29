<?php
session_start();

if (isset($_SESSION['usuario'])) {

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inicio</title>
    <?php require_once "menu.php" ;?>
  </head>
  <body>

  </body>
</html>
<?php
}else {
  header("location:../index.php");
}
 ?>
