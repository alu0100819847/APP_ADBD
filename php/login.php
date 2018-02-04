<?php
include "./conexion/connbd.php";
include "./conexion/verifica.php";

session_start();
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

      if($tupla["USER"] == $user && $tupla["PASSWORD"] == $pass) {

        echo "Usuario correcto";
        $_SESSION['USER'] = $user;
        header("Refresh: 3; URL= ../view/items.php?user=$user");

      } else {
        echo "Usuario incorrecto";
        header('Refresh: 3; URL= ../index.html');
      }
    }

  }
}
 mysqli_close($db_server);
?>
