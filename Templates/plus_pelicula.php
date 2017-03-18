<?php
SESSION_START();
if(isset($_POST['titulo'],$_POST['director'],$_POST['anio'],$_POST['duracion'],$_POST['subtitulos'],$_POST['genero'],$_POST['clasificacion'],$_POST['cast'],$_POST['sinopsis'],$_FILES["imagen_peli"]['name'])){
  $enlace = mysqli_connect("localhost","root","root","mydb");
  if(!$enlace){
    echo "No se pudo conectar".mysqli_connect_error();
    $y=2;
  }
  else{
    htmlspecialchars($_POST['titulo']);
    htmlspecialchars($_POST['director']);
    htmlspecialchars($_POST['anio']);
    htmlspecialchars($_POST['duracion']);
    htmlspecialchars($_POST['subtitulos']);
    htmlspecialchars($_POST['genero']);
    htmlspecialchars($_POST['clasificacion']);
    htmlspecialchars($_POST['cast']);
    htmlspecialchars($_POST['sinopsis']);

    mysqli_real_escape_string($enlace, $_POST['titulo']);
    mysqli_real_escape_string($enlace, $_POST['director']);
    mysqli_real_escape_string($enlace, $_POST['cast']);
    mysqli_real_escape_string($enlace, $_POST['sinopsis']);


    $prueba='SELECT * FROM Peliculas WHERE Titulo_Peliculas="'.$_POST['titulo'].'"';
    $checar=mysqli_query($enlace, $prueba);
    $arr=array();
    while($row = mysqli_fetch_assoc($checar)){
      foreach($row as $re){
        $arr[]=$re;
      }
    }
    if($arr==null){
      $comillas=array('"',"'");
      $nuevo_sinopsis=str_replace($comillas,"",$_POST['sinopsis']);
      $agregar_peli =  'INSERT INTO peliculas (Titulo_Peliculas,Genero_ID_Genero,Director_Peliculas,Duracion_Peliculas,Anio_Peliculas,Sub_Peliculas,Clasificacion_ID_Clasificacion,Sinopsis_Peliculas,Cast_Peliculas,Votos_Peliculas) VALUES ("'.$_POST['titulo'].'", '.$_POST['genero'].', "'.$_POST['director'].'", '.$_POST['duracion'].', '.$_POST['anio'].', '.$_POST['subtitulos'].', '.$_POST['clasificacion'].', "'.$nuevo_sinopsis.'", "'.$_POST['cast'].'", 0)';
      mysqli_query($enlace, $agregar_peli);
      $status="";
      $archivo = $_FILES["imagen_peli"]['name'];

      if($archivo!=""){
        $destino="../Resources/".$_POST['titulo'].".jpg"; //Para que tenga el mismo nombre que el titulo
        if (copy($_FILES['imagen_peli']['tmp_name'],$destino)){
          $status="<br/>Archivo subido: <b>".$archivo."</b>";
          $y=1;
        }
        else{
          $status = "Error al subir archivo";
          $y=0;
        }
      }
    }
    mysqli_close($enlace);
  }
}
else{
  $y=0;
}
$_SESSION['creado_peli']=$y;
if($y==1){
  header('location: admin_main.php');
}
else if($y==0 || $y==2){
  header('location: agregar_peliculas.php');
}
?>
