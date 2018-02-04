<?php

include "../conexion/connbd.php";
include "../conexion/verifica.php";
$db_server = CrearConexion();

if ($db_server->connect_error) die("Fallo!!" . $db_server->connect_error);
else echo "Conexión efectuada correctamente";

$user = $_POST['form_user'];
$item = $_POST['form_item'];
$url = $_POST['form_url'];
$id = 0;

if($db_server) {

  if($item == "") {
    echo "Introduce un Item";
    header("Refresh: 3; URL= ../../view/items.php?user=$user");
  } else {

    $SQL = "select MAX(ID) from ITEM";
    $result = mysqli_query($db_server, $SQL);
    $tupla = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if($tupla["MAX(ID)"] != ""){
      $id = $tupla["MAX(ID)"] + 1;
    }
    $SQL = "insert into ITEM " . " (ID, USER, ITEM, URL) values ('";
    $SQL .= $id . "' , '" ;
    $SQL .= $user . "' , '" ;
    $SQL .= $item . "' , '" ;
    $SQL .= $url . "' )";

    if(!mysqli_query($db_server, $SQL)) {

      echo "Error: " . mysqli_error($db_server);

    } else  {

      echo "Valores insertados correctamente";
      header("Refresh: 3; URL= ../../view/items.php?user=$user");
    }

  }

}

mysqli_close($db_server);
?>
