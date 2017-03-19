<?php
echo'<!DOCTYPEhtml>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewpiort" content="width=device-width, initial-scale=1"/>

    <title>Agregar a cartelera</title>

    <link href="../Styles/admin_login.css"  rel="stylesheet" type="text/css">
    <link href="../Resources/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>';

    SESSION_START();
    echo '<div class="container">';
    if(isset($_SESSION['correo'],$_SESSION['Nombre_Administrador'],$_SESSION['Tipo_Administrador'])){
      echo '<nav class="navbar navbar-default" id="navegation">
        <div class="container-fluid">
          <div class="row">
            <div class="col-xs-4 col-sm-2">
              <a class="navbar-brand" href="admin_main.php">'.$_SESSION['Nombre_Administrador'].'</a>
            </div>
            <div class="col-xs-offset-5 col-sm-offset-8 col-xs-3 col-sm-2">
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle glyphicon glyphicon-user" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Cambiar Datos</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="admin_login.php"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Cerrar Sesión</a></li>
                </ul>
              </li>
            </ul>
            </div>
          </div>
        </div>
      </nav>
      <form class="form-horizontal">
        <div class="form-group">
          <label for="titulo" class="col-xs-4 col-sm-3 col-md-3 col-lg-3 control-label">Buscar por título: </label>
          <div class="col-xs-6 col-sm-8 col-md-8 col-lg-8">
            <input type="text" maxlength="40" class="form-control" id="titulo" placeholder="Título de la película">
          </div>
          <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
            <button type="button" class="btn btn-default" id="search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
          </div>
        </div>
      </form>
      <table class="table table-hover table-bordered table-condensed" id="pelis">
      </table>
      ';

    }
    else {
      header('location:error_ingreso.html');
    }
    echo '</div>
    <script src="../Resources/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="../Styles/agregar_cartelera.js"></script>
    <script src="../Resources/bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>';
?>
