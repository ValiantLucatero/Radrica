<?php
echo'<!DOCTYPEhtml>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewpiort" content="width=device-width, initial-scale=1"/>

    <title>Cine Radrica</title>

    <link href="../Styles/miembro_main.css"  rel="stylesheet" type="text/css">
    <link href="../Resources/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>';

    /*SESSION_START();
    if(isset($_POST['admin_user']) && isset($_POST['password']))
    {
      $enlace = mysqli_connect("localhost","root","","mydb");
      htmlspecialchars($_POST['admin_user']);
      htmlspecialchars($_POST['password']);
      mysqli_real_escape_string($enlace,$_POST['admin_user']);
      mysqli_real_escape_string($enlace,$_POST['password']);
    if(!$enlace)
    {
      echo "No se pudo conectar".mysqli_connect_error();
    }
    else
    {	
      mysqli_close($enlace);
    }
    if(!empty($arr))
    {
      $_SESSION['correo']=$arr[0];
      $_SESSION['Nombre_Administrador']=$arr[1];
      $_SESSION['A.Pat_Administrador']=$arr[2];
      $_SESSION['A.Mat_Administrador']=$arr[3];
      $_SESSION['Tipo_Administrador']=$arr[5];

    }
  }*/
  echo '<div class="container">';
    //if(isset($_SESSION['ID_Miembro'],$_SESSION['Nombre_Miembro'])){
    echo '<nav class="navbar navbar-default" id="navegation">
      <div class="container-fluid">
        <div class="row">
          <div class="titulo-radrica" class="col-xs-4 col-sm-2">
			<a>Radrica</a>
			<a  href="#">'./*$_SESSION['Nombre_Miembro'].*/'</a>
			<!-- <img src="../Resources/logo.png"> -->
		  </div>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle glyphicon glyphicon-user" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Cambiar Datos</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="miembro_login.php"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Cerrar Sesión</a></li>
              </ul>
            </li>
          </ul>
          </div>
        </div>
    </nav>';
	//}
	
	$enlace= mysqli_connect("localhost","root","","mydb");
    if(!$enlace)
    {
      echo "No se pudo conectar".mysqli_connect_error();
    }
    else
    {
      $tildes = $enlace -> query("SET NAMES ´utf8´");
      $peticion1="SELECT ID_Peliculas, Titulo_Peliculas, Genero_ID_Genero, Director_Peliculas, Duracion_Peliculas, Anio_Peliculas, Sub_Peliculas, Clasificacion_ID_Clasificacion, Sinopsis_Peliculas, Cast_Peliculas, Votos_Peliculas FROM Peliculas";
      $pedir1= mysqli_query( $enlace,$peticion1);
	  $imagen='<td></td>';
	  
	  echo '<style>
				.pelis {
					border: 1px solid #FA2F2F;
					margin:1%;
					background-color: #FA2F2F;
				}
				.pelis td{
					padding: 15px;
				}
				.titulo{
					margin: 10px;
					padding: 15px;
				}
				.imagenpelicula{
					height: 10%;
				}
			</style>';
	  
      while($renglon=mysqli_fetch_assoc($pedir1)){
			echo '<div class="row">
				<div class="row">
					<!--Titulo-->
					<div class="col-md-12">
						<h2>'.$renglon['Titulo_Peliculas'].' <small>('.$renglon['Anio_Peliculas'].')</samll></h2>';
					echo '</div>';
				echo '</div>
				<div class="row">
					<div class="col-md-3">                          <!--Imagen-->
						<div class="imagenpelicula">
							<img class="img-responsive img-thumbnail" src="../Resources/'.$renglon['Titulo_Peliculas'].'.jpg" alt="Imagen '.$renglon['Titulo_Peliculas'].'"/>
						</div>
					</div>
					<div class="col-md-9">
						<div class="row">
							<div class="col-md-3">
								<div class="row">
									<div class="col-md-12">
										<h4>Director:</h4>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										'.$renglon['Director_Peliculas'].'
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="row">
									<div class="col-md-12">
										<h4>Clasificación:</h4>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
									'.$renglon['Clasificacion_ID_Clasificacion'].'
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="row">
									<div class="col-md-12">
										<h4>Subtitulado:</h4>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
									';
									if($renglon['Sub_Peliculas']==1)
									echo "Sí";
									else{
											echo "Nop";
										}
									echo '</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="row">
									<div class="col-md-12">
										<h4>Genero:</h4>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
									'.$renglon['Genero_ID_Genero'].'
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="row">
									<div class="col-md-12">
										<h4>Duración:</h4>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
									'.$renglon['Duracion_Peliculas'].' min.
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<h4>Cast:</h4> '.$renglon['Cast_Peliculas'].'
							</div>
							<div class="col-md-8">
								<h4>Sinopsis:</h4> '.$renglon['Sinopsis_Peliculas'].'
							</div>
						</div>
					</div>
				</div>
			</div>';
			
			echo "</table>";

     }
	}
	echo '</div>';
    echo '<script src="../Resources/jquery/dist/jquery.js"></script>';
    echo '<script src="../Resources/bootstrap/dist/js/bootstrap.min.js"></script>';
	echo '</body> </html>';
?>