<?php
  echo'<!DOCTYPEhtml>
  <html lang="en">
    <head>
      <meta charset="utf-8"/>
  		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  		<meta name="viewpiort" content="width=device-width, initial-scale=1"/>

      <title>Iniciar sesion Administrador</title>

      <link href="../Styles/admin_login.css"  rel="stylesheet" type="text/css">
      <link href="../Resources/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
      <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>

      <div class="container">
        <nav class="navbar navbar-default" id="navegation">
          <div class="container-fluid">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">Cinema Radrica</a>
            </div>
          </div>
        </nav>
        <h1 class="text-center">Ingreso Administrador</h1>
        <form method="POST" action="admin_main.php" class="form-horizontal">
          <div class="form-group">
            <label for="user" class="col-xs-5 col-sm-3 col-md-2 col-lg-2 control-label">Usuario: </label>
            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
              <input type="text" id="user" class="form-control" placeholder="Nombre de usuario" maxlength="20" name="admin_user"/>
            </div>
          </div>
          <div class="form-group">
            <label for="password" class="col-xs-5 col-sm-3 col-md-2 col-lg-2 control-label">Contraseña</label>
            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
              <input type="password" id="password" name="password" placeholder="Contraseña" class="form-control" maxlength="20"/>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-offset-2 col-lg-offset-2 col-xs-12 col-sm-10 col-md-12 col-lg-10">
              <button type="submit" class="btn btn-primary btn-lg btl-block">Entrar</button>
            </div>
          </div>

        </form>
      <div>

      <script src="../Resources/jquery/dist/jquery.js"></script>
      <script src="../Resources/bootstrap/dist/js/bootstrap.min.js"></script>
    </body>
  </html>';
?>
