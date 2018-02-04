<?php
function VerificacionLOG($user, $pass)
{
  $html ='<div >';
  $reg='/^[a-zA-Z0-9\-_ñÑ][a-zA-Z0-9\-_ñÑ][a-zA-Z0-9\-_ñÑ][a-zA-Z0-9\-_ñÑ][a-zA-Z0-9\-_ñÑ]*$/';
  if($user != "" && $pass != "") {
    if(preg_match($reg, $user) && preg_match($reg, $pass)) {
      return true;
    } else {
      $html.= "<p>Introduzca Usuario y contraseña de mayor tamaño.</p>";
      //echo "Introduzca Usuario y contraseña de mayor tamaño.";
      $html.= "<p>Solo se admiten números, letras y -, _</p>";
      //echo "Solo se admiten números, letras y -, _";
      $html.="</div></html>";
      echo $html;
      header('Refresh: 3; URL= ../index.html');
      return false;
    }
  }else {
    echo "Introduzca Usuario y contraseña.";
    header('Refresh: 2; URL= ../index.html');
    return false;
  }

}
?>
