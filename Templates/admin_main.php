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
  echo '<div class="container">
    <nav class="navbar navbar-default" id="navegation">
      <div class="container-fluid">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">'.$_SESSION['Nombre_Administrador'].'</a>
        </div>
      </div>
    </nav>
    Bienvenido '.$_SESSION['Nombre_Administrador'].'
    </div>';


    echo '<script src="../Resources/jquery/dist/jquery.js"></script>
    <script src="../Resources/bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>';
?>
