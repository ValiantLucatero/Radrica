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
    $enlace= mysqli_connect("localhost","root","root","mydb");
    if(!$enlace)
    {
      echo "No se pudo conectar".mysqli_connect_error();
    }
    else
    {
      $tildes = $enlace -> query("SET NAMES 'utf8'");
      $peticion1='SELECT ID_Horario, Horario FROM Horario';
      $pedir1=mysqli_query($enlace,$peticion1);
      $horarios_select="<select class='form-control' id='select_horario' name='horario'>";
      $horarios_select="<select class='form-control'>";
      while($row=mysqli_fetch_assoc($pedir1)){
        $horarios_select=$horarios_select."<option value='".$row['ID_Horario']."'>".$row['Horario']."</option>";
      }
      $horarios_select=$horarios_select."</select>";
    }
    echo '<div class="modal fade" id="dar_horario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="modal-title" id="myModalLabel">Agregar Horario <small class="no">Holas</small></h3>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12 col-xs-12">
								<form class="form-horizontal" method="POST" action="#">
									<div class="form-group">
										<label for="cont" class="col-lg-3 control-label">Horario: </label>
										<div class="col-lg-9">'.$horarios_select.'</div>
									</div>
									<button class="btn btn-lg btn-block btn-primary" type="submit" id="boton_modal">Registrarse</button>
								</form>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>';
    echo '</div>
    <script src="../Resources/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="../Resources/agregar_cartelera.js"></script>
    <!-- <script type="text/javascript" src="../Styles/boton_agregar.js"></script> -->
    <script src="../Resources/bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>';
?>
