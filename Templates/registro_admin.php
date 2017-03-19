<?php
$correo=$_POST['correo'];
$nombre=$_POST['nombre'];
$paterno=$_POST['paterno'];
$materno=$_POST['materno'];
$contrasena=$_POST['cntrsn'];
$password=$_POST['password'];

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


if($cntrsn==$password)
{
	$link=MySQLi_connect("localhost","root","","mydb");
	$SQL="INSERT INTO `administradores`(`ID_Administrador`,`Nombre_Administrador`,`A.Pat_Administrador`,`A.Mat_Administrador`,`Contra_Administrador`,`Tipo_Administrador`)
	values ('$correo','$nombre','$paterno','$materno','$contrasena',2);";
	$resultado=MySQL_query($link,$SQL);
	header('location:-----');
}
else
{
	header('location:-----');
}
}
?>
