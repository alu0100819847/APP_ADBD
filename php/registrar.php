<?php

include "./conexion/connbd.php";
include "./conexion/verifica.php";

$db_server = CrearConexion();

if ($db_server->connect_error) die("Fallo!!" . $db_server->connect_error);
//else echo "Conexión efectuada correctamente";

$user = $_POST['form_username'];
$pass = $_POST['form_password'];
if($db_server) {

  if(VerificacionLOG($user, $pass))
  {
    $pass= md5($pass);
    $SQL = "select * from USUARIO where USER = '$user' and PASSWORD = '$pass'";
    $result = mysqli_query($db_server, $SQL);

    if(!$result) {

      echo "Error: " . mysqli_error($db_server);

    } else  {

      $tupla = mysqli_fetch_array($result, MYSQLI_ASSOC);

      if($tupla["USER"] == $user) {

        echo "Usuario ya existente";
        header('Refresh: 3; URL= ../index.html');

      } else {

        $SQL = "insert into USUARIO ";
        $SQL .= " (USER, PASSWORD) values ('";
        $SQL .= $user;
        $SQL .= "' , '";
        $SQL .= $pass;
        $SQL .= "' )";

        if(!mysqli_query($db_server, $SQL)) {

          echo "Error: " . mysqli_error($db_server);

        } else  {

          echo "Valores insertados correctamente";

        }

        header('Refresh: 3; URL= ../index.html');
      }
    }
  }
}

 mysqli_close($db_server);
?>
