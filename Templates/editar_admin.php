<?php
echo'<!DOCTYPEhtml>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewpiort" content="width=device-width, initial-scale=1"/>

    <title>Editar Administradores</title>

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

      //Tabla de administradores
      echo'
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>ID</th>
            <th>Nombre</th>
            <th>A. Paterno</th>
            <th>A. Materno</th>
            <th></th>
          </tr>
        </thead>
        <tbody>';
        //Conecta a BD
        $con=mysqli_connect("localhost","root","","mydb");
        // Checa conexion
        if (mysqli_connect_errno())
        {
          echo "No se pudo conectar a MySQL: " . mysqli_connect_error();
        }
        // Pedido de informacion
        $i=1;
        $cont="SELECT COUNT(*) FROM Administradores WHERE Tipo_Administrador=2";
        $petinf="SELECT * FROM Administradores WHERE Tipo_Administrador=2";
        $num=mysqli_query($con, $cont);
        $inf=mysqli_query($con, $petinf);
        //Agrupacion de la informacion
        while($row = mysqli_fetch_assoc($inf)&& $i==$num)
        {
          echo'
          <tr>
            <td>'.$i.'</td>
            <td>'.$row['ID_Administrador'].'</td>
            <td>'.$row['Nombre_Administrador'].'</td>
            <td>'.$row['A.Pat_Administrador'].'</td>
            <td>'.$row['A.Mat_Administrador'].'</td>
            <td><button id='.$row['ID_Administrador'].'class="btn btn-danger" role="button" data-toggle="modal" data-target="#">Eliminar</button></td>
          </tr>';//seleccion de que mostrar
          $i++;
        }
        //Cierra conexion
        mysqli_close($con);
        echo'
        </tbody>
      </table>';
      }
        else
        {
          header('location:error_ingreso.html');
        }
        echo '</div>
        <script src="../Resources/jquery/dist/jquery.js"></script>
        <script src="../Resources/bootstrap/dist/js/bootstrap.min.js"></script>
      </body>
    </html>';
    ?>
