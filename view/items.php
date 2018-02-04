<?php
session_start();
$user=$_GET["user"];
if($_SESSION['USER'] == $user){

      $order = 0;


      if(isset($_GET["order"])){
        $order = $_GET["order"];
      }
      echo $order;
      $begin = '
              <html>
              <title> Formulario </title>
              <head>
                <link href="https://fonts.googleapis.com/css?family=Oxygen" rel="stylesheet">
                <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css">
                <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
                <link rel="stylesheet" href="../css/style.css">
                <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">

              </head>
      ';
      $body = '
        <body>
        <nav class="navbar navbar-toggleable-md navbar-light bg-faded" id="navbar-page">
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
           </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a data-toggle="modal" href="#CrearItem" class="nav-link" id="crear-evento-boton" data-backdrop="static" data-keyboard="false"><i class="fa fa-plus" aria-hidden="true"></i> Crear Item</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="items.php?user='.$user.'&order=1" style="font-family: "Oxygen", sans-serif; margin-left:100px;">Orden Alfabético</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="items.php?user='.$user.'&order=2" style="font-family: "Oxygen", sans-serif; margin-left:100px;">Orden Inverso</a>
              </li>
            </ul>
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
                <a class="nav-link" href="items.php?user='.$user.'" style="font-family: "Oxygen", sans-serif; margin-right:100px;">' . $user . '</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="../php/logout.php" style="font-family: "Oxygen", sans-serif; margin-right:100px;">Log Out</a>
              </li>
            </ul>
          </div>
        </nav>';

        $CrearItem = '

          <div class="modal fade" id="CrearItem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h2 class="modal-title">Nuevo Item</h2></br>
                </div>
                <div class="modal-body">
                  <form role="form" method="post" action ="../php/Item/regItem.php">
                    <div class="row">
                      <div class="form-group col-md-8">
                        <input type="text" name="form_user" value= ' . $user . ' HIDDEN>
                        <label for="Item" class ="label_item" >Item</label>
                        <input class ="form_item" type="text" name="form_item" placeholder="Item">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="fecha" class ="label_item">URL</label>
                        <input class ="form_item" type="text" name="form_url" placeholder="URL" size= 40px >
                      </div>

                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary" >
                      <i class="fa fa-plus-circle" aria-hidden="true"></i> Añadir Item
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                      <i class="fa fa-times" aria-hidden="true"></i> Cerrar
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>';
          $items = '
          ';
          $fin= '
          <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
          <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.1/js/tether.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" crossorigin="anonymous"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/qtip2/3.0.3/jquery.qtip.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
        </body>
      </html>
      ';
      include "../php/conexion/connbd.php";

      $SQL ="";
      if($order == 0) $SQL = "select * from ITEM where USER = '$user'";
      if($order == 1) $SQL = "select * from ITEM where USER = '$user' order by ITEM asc";
      if($order == 2) $SQL = "select * from ITEM where USER = '$user' order by ITEM desc";
      $db_server = CrearConexion();

      $result = mysqli_query($db_server, $SQL);
      $tupla = mysqli_fetch_array($result, MYSQLI_ASSOC);
        while($tupla){
        /*  $items .= "
            <tr><td>" . $tupla["ITEM"] . "</td> <td>" . $tupla["URL"] . "</tr></td>
            <td><a href= 'delItem.php?ID=".$tupla["ID"]."&USER=".$user."'>Eliminar</a></td>
            <td><a href= 'upItem.php?ID=".$tupla["ID"]."&USER=".$user."'>Editar</a></td>
            <br/>
          ";*/
          $myurl = "http://".$tupla["URL"];
          $items .= '
          <div class="cd-timeline-content ">
            <h2 name="ShowItem" style="font-family: "Oxygen", sans-serif; color: black">'.$tupla["ITEM"].'</h2>
            <p name="ShowURL" class ="label_item" style="font-family: "Oxygen", sans-serif; color: black;">URL: <a style="color:blue"; href="'.$myurl.'">'.$tupla["URL"].'</a></p>
            <br/>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#EditItem'.$tupla["ID"].'">
              <i class="fa fa-wrench" aria-hidden="true"> </i>
            </button>

            <form role="form" id="item'.$tupla["ID"].'" method="post" action ="../php/Item/delItem.php" HIDDEN>
                  <input type="text" name="item_user" value= ' . $user . ' HIDDEN>
                  <input type="text" name="item_id" value= ' . $tupla["ID"] . ' HIDDEN>
            </form>
            <button type="submit" form="item'.$tupla["ID"].'" class="btn btn-danger btn-sm"  data-toggle="modal">
            <i class="fa fa-trash" aria-hidden="true"></i>
            </buton>
          </div>

          ' .
          '
          <div class="modal fade" id="EditItem'.$tupla["ID"].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h2 class="modal-title">Editar Item</h2></br>
                </div>
                <div class="modal-body">
                  <form role="form" method="post" action="../php/Item/upItem.php">

                    <div class="row">
                      <div class="form-group col-md-8">
                        <input type="text" name="item_user" value= ' . $user . ' HIDDEN>
                        <input type="text" name="item_id" value= ' . $tupla["ID"] . ' HIDDEN>
                        <label for="Item" class ="label_item" >Item</label>
                        <input class ="form_item" type="text" name="item_item" placeholder="Item" value= "'.$tupla["ITEM"].'" >
                      </div>
                      <div class="form-group col-md-6">
                        <label for="fecha" class ="label_item">URL</label>
                        <input class ="form_item" type="text" name="item_url" placeholder="URL" size= 40px value= "'.$tupla["URL"].'">
                      </div>

                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">
                      <i class="fa fa-plus-circle" aria-hidden="true"></i> Editar Item
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                      <i class="fa fa-times" aria-hidden="true"></i> Cerrar
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          ';




      $tupla = mysqli_fetch_array($result, MYSQLI_ASSOC);
        }
      mysqli_close($db_server);
      $html = $begin . $body . $CrearItem . $items. $fin;
      echo $html;
    }
    else {
      header('Refresh: 0; URL= ../index.html');
    }
?>
