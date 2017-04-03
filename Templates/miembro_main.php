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
			</style>';
	  
      while($renglon=mysqli_fetch_assoc($pedir1)){
			echo "<table class='pelis'>";
			echo "<tr>";
			echo "<td  class='titulo' colspan=2>". $renglon['Titulo_Peliculas']. "</td></tr>";
			echo "<tr>";
			echo "<td colspan=2>". $renglon['Genero_ID_Genero']. "</td>";
			echo "<td>". $renglon['Director_Peliculas']. "</td";
			echo "<td>". $renglon['Duracion_Peliculas']. "</td>";
			echo "<td>". $renglon['Anio_Peliculas']. "</td>";
			echo "<td>". $renglon['Sub_Peliculas']. "</td>";
			echo "<td colspan=2>". $renglon['Clasificacion_ID_Clasificacion']. "</td>";
			echo "</tr>";
			echo $imagen=$imagen.'<tr><td colspan=2><img src="../Resources/'.$renglon['Titulo_Peliculas'].'.jpg" height="300" width="200"></td>';
			echo "<td>". $renglon['Sinopsis_Peliculas']. "</td></tr>";
			echo "<tr><td>". $renglon['Cast_Peliculas']. "</td>";
			echo "<td>". $renglon['Votos_Peliculas']. "</td>";
			
			
			echo "</table>";

     }
	}
	echo '</div>';
    echo '<script src="../Resources/jquery/dist/jquery.js"></script>';
    echo '<script src="../Resources/bootstrap/dist/js/bootstrap.min.js"></script>';
	echo '</body> </html>';
?>