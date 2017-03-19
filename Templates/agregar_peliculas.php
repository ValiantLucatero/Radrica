<?php
echo'<!DOCTYPEhtml>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewpiort" content="width=device-width, initial-scale=1"/>

    <title>Agregar películas</title>

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
      </nav>';
        if(isset($_SESSION['creado_peli'])){
          if($_SESSION['creado_peli']==0 || $_SESSION['creado_peli']==2){
            echo '<div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              La película no se logró agregar. Podría haber sido un error de conexión también. Intenta de nuevo.
            </div>';
            $_SESSION['creado_peli']="";
          }
        }
      echo '<h2 class="text-center">Agregar Películas</h2>
        <form method="POST" action="plus_pelicula.php" enctype="multipart/form-data">
          <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" class="form-control" id="titulo" placeholder="Título de la película" name="titulo"/>
          </div>
          <div class="form-group">
            <label for="director">Director</label>
            <input type="text" class="form-control" id="director" placeholder="Director de la película" name="director"/>
          </div>
          <div class="form-group">
            <label for="anio">Año</label>
            <input type="number" min="1895" max="'.date("Y").'" class="form-control" id="anio" placeholder="Año de la película" name="anio"/>
          </div>
          <div class="form-group">
            <label for="duracion">Duración (en minutos)</label>
            <input type="number" min="10" max="500" class="form-control" id="duracion" placeholder="Año de la película" name="duracion"/>
          </div>
          <div class="form-group">
            <label for="subtitulos">Subtítulos</label>
            <div class="radio">
              <label>
                <input type="radio" name="subtitulos" id="subtitulos" value="1"/>Sí
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="subtitulos" id="subtitulos" value="0"/>No
              </label>
            </div>
          </div>

          <div class="form-group">
            <label for="genero">Genero </label>
            <select name="genero" class="form-control">';
              $enlace = mysqli_connect("localhost","root","root","mydb");
              if(!$enlace){
                echo "No se pudo conectar".mysqli_connect_error();
              }
              else{
                $peticion_generos="SELECT * FROM genero ";
                $generos_db = mysqli_query($enlace, $peticion_generos);
                $tildes = $enlace -> query("SET NAMES 'utf8'");
                while($row = mysqli_fetch_assoc($generos_db)){
                  echo '<option value="'.$row['ID_Genero'].'">'.$row['Genero'].'</option>';
                }

                mysqli_close($enlace);
              }
            echo '</select>
          </div>
          <div class="form-group">
            <label for="clasificacion">Clasificación</label>
            <select name="clasificacion" class="form-control">';
              $enlace = mysqli_connect("localhost","root","root","mydb");
              if(!$enlace){
                echo "No se pudo conectar".mysqli_connect_error();
              }
              else{
                $peticion_generos="SELECT * FROM Clasificacion";
                $generos_db = mysqli_query($enlace, $peticion_generos);
                $tildes = $enlace -> query("SET NAMES 'utf8'");
                while($row = mysqli_fetch_assoc($generos_db)){
                  echo '<option value="'.$row['ID_Clasificacion'].'">'.$row['Clasificacion'].'</option>';
                }

                mysqli_close($enlace);
              }
            echo '</select>
          </div>

          <div class="form-group">
            <label for="cast">Actores (separados por comas)</label>
            <input type="text" maxlength="60" class="form-control" id="cast" placeholder="Año de la película" name="cast"/>
          </div>
          <div class="form-group">
            <label for="sinopsis">Sinopsis (separados por comas)</label>
            <textarea name="sinopsis" class="form-control" rows="5" placeholder="Sinopsis de la película"></textarea>
          </div>
          <div class="form-group">
            <label for="foto">Imagen de portada </label>
            <input type="file" name="imagen_peli" id="foto">
          </div>
          <div class="form-group">
              <button type="submit" class="btn btn-primary btn-lg btl-block">Agregar</button>
          </div>

        </form>
      ';
    }
    else {
      header('location:error_ingreso.html');
    }
    echo '</div>
    <script src="../Resources/jquery/dist/jquery.js"></script>
    <script src="../Resources/bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>';
?>
