<?php

include "../conexion/connbd.php";
$db_server = CrearConexion();

if ($db_server->connect_error) die("Fallo!!" . $db_server->connect_error);
else echo "Conexión efectuada correctamente";

$user= $_POST['item_user'];
$id = $_POST['item_id'];
if($db_server) {

  $SQL = "delete from ITEM where ID = $id";
  $result = mysqli_query($db_server, $SQL);
  if(!$result) echo "Error: " . mysqli_error($db_server);
  header("Refresh: 3; URL= ../../view/items.php?user=$user");
}

mysqli_close($db_server);
?>
