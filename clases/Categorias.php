<?php
/**
 *
 */
class categoria{
public function agregaCategoria($datos){
  $c= new conectar();
  $conexion = $c->conexion();

  $sql="INSERT INTO categorias (id_usuario,nombreCategoria,fechaCaptura,active) values ('$datos[0]','$datos[1]','$datos[2]','$datos[3]')";

  return mysqli_query($conexion,$sql);
}

public function actualizaCategoria($datos){
  $c= new conectar();
  $conexion = $c->conexion();

  $sql="UPDATE categorias set nombreCategoria='$datos[1]' where id_categoria='$datos[0]'";

  echo mysqli_query($conexion,$sql);
}

public function eliminaCategoria($idcategoria){
  $c= new conectar();
  $conexion = $c->conexion();
  $sql = "UPDATE categorias SET active=0 where id_categoria='$idcategoria'";

  return mysqli_query($conexion,$sql);

}

}
 ?>
