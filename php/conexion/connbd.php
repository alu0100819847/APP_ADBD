<?php
function CrearConexion()
{
  $servidor = "localhost";
  $usuario = "trabajo";
  $clave = "";
  $bd = "PRACADBD";

  return new mysqli($servidor, $usuario, $clave, $bd);

}
?>
