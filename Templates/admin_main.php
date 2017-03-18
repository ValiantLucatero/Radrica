<?php
echo'<!DOCTYPEhtml>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewpiort" content="width=device-width, initial-scale=1"/>

    <title>Página principal administrador</title>

    <link href="../Styles/admin_login.css"  rel="stylesheet" type="text/css">
    <link href="../Resources/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>';

    SESSION_START();
    if(isset($_POST['admin_user']) && isset($_POST['password']))
    {
      $enlace = mysqli_connect("localhost","root","root","mydb");
      htmlspecialchars($_POST['admin_user']);
      htmlspecialchars($_POST['password']);
      mysqli_real_escape_string($enlace,$_POST['admin_user']);
      mysqli_real_escape_string($enlace,$_POST['password']);
    if(!$enlace)
    {
      echo "No se pudo conectar".mysqli_connect_error();
    }
    else
    {	//proceso de codificación de la contraseña
      $contra=$_POST['password'];
      $ch=str_split($contra);
      $contrasena="";
      $carac=0;
      foreach($ch as $p)
      {
        $nu=ord($p);
        $carac+=$nu;
      }
      $contrasena=$contrasena.$carac;
      for($x=0;$x<strlen($contra);$x++)
      {
        $wi=(ord($ch[$x])>>1)-4;
        $contrasena=$contrasena.chr($wi);
      }

      $cad=array();
      $arreglo=array();
      $cont=strlen($contra);
      for($i=0;$i<$cont;$i++)
      {
        $car=substr($contra,$i,1);
        array_push($cad,$car);
      }
      $mul=ceil($cont/5);
      $contadorpal=0;
      for($x=0;$x<$mul;$x++)
      {
        $eje=array();
        for($y=0;$y<5;$y++)
        {
          if($contadorpal<$cont)
            array_push($eje,$cad[$y]);
          else
            array_push($eje,'');
          $contadorpal++;
        }
        array_push($arreglo,$eje);
        for($g=0;$g<5;$g++)
          if($cad!='\0')
            array_shift($cad);
      }
      $grr=array();
      for($y=0;$y<5;$y++)
        for($x=0;$x<$mul;$x++)
          array_push($grr,$arreglo[$x][$y]);
      $grr=implode("",$grr);
      $h='Texto: '.$contra.'<br/>playfair("'.$grr.'",5)';
      $cant=ceil(strlen($grr)/2);
      $contrasena=$contrasena.substr($grr,0,$cant);

      $tildes = $enlace -> query("SET NAMES 'utf8'");

      $confi='SELECT Contra_Administrador FROM Administradores WHERE ID_Administrador="'.$_POST['admin_user'].'"';

      $res = mysqli_query($enlace, $confi);
      $arre = array();
      while($row = mysqli_fetch_assoc($res))
      {
        foreach($row as $re)
        {
          $arre[]=$re;
        }
      }
      //checa si la contraseña que enviaste es la misma que esta en la base de datos
      if($contrasena==substr($arre[0],5))
      {
        $consulta =  'SELECT * FROM Administradores WHERE ID_Administrador="'.$_POST['admin_user'].'"';
        $res = mysqli_query($enlace, $consulta);
        $arr = array();
        while($row = mysqli_fetch_assoc($res))
        {
          foreach($row as $re)
          {
            $arr[]=$re;
          }
        }
      }

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
  }
  echo '<div class="container">';
    if(isset($_SESSION['correo'],$_SESSION['Nombre_Administrador'],$_SESSION['Tipo_Administrador'])){
    echo '<nav class="navbar navbar-default" id="navegation">
      <div class="container-fluid">
        <div class="row">
          <div class="col-xs-4 col-sm-2">
            <a class="navbar-brand" href="#">'.$_SESSION['Nombre_Administrador'].'</a>
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
      if($_SESSION['creado_peli']==1){
        echo '<div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          La película se agregó correctamente.
        </div>';
        $_SESSION['creado_peli']="";
      }
    }
    echo '<h1 class="text-center">Bienvenido '.$_SESSION['Nombre_Administrador'].'</h1>
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
        <div class="thumbnail">
          <div class="caption">
            <h3>Agregar películas</h3>
            <p>Agregar películas a la base de datos.</p>
            <p><a href="agregar_peliculas.php" class="btn btn-primary" role="button">Agregar película</a></p>
          </div>
        </div>
      </div>

      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
        <div class="thumbnail">
          <div class="caption">
            <h3>Eliminar películas</h3>
            <p>Eliminar películas a la base de datos.</p>
            <p><a href="#" class="btn btn-primary" role="button">Eliminar película</a></p>
          </div>
        </div>
      </div>

      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
        <div class="thumbnail">
          <div class="caption">
            <h3>Agregar a Cartelera</h3>
            <p>Agregar películas ya registradas a la cartelera.</p>
            <p><a href="#" class="btn btn-primary" role="button">Agregar a cartelera</a></p>
          </div>
        </div>
      </div>

      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
        <div class="thumbnail">
          <div class="caption">
            <h3>Eliminar de cartelera</h3>
            <p>Eliminar películas de la cartelera.</p>
            <p><a href="#" class="btn btn-primary" role="button">Eliminar</a></p>
          </div>
        </div>
      </div>

      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
        <div class="thumbnail">
          <div class="caption">
            <h3>Agregar funciones</h3>
            <p>Agregar funciones de películas en cartelera.</p>
            <p><a href="#" class="btn btn-primary" role="button">Agregar funciones</a></p>
          </div>
        </div>
      </div>

      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
        <div class="thumbnail">
          <div class="caption">
            <h3>Agregar/Eliminar administradores</h3>
            <p>Agregar otros administradores secundarios.</p>
            <p><a href="#" class="btn btn-primary" role="button">Agregar</a> <a href="#" class="btn btn-danger" role="button">Eliminar</a></p>
          </div>
        </div>
      </div>

    </div>
    ';
    }
    else{
      header('location:error_ingreso.html');
    }
    echo '</div>


    <script src="../Resources/jquery/dist/jquery.js"></script>
    <script src="../Resources/bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>';
?>
