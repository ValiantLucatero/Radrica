<?php
  $enlace= mysqli_connect("localhost","root","root","mydb");
  if(!$enlace)
  {
    echo "No se pudo conectar".mysqli_connect_error();
  }
  else
  {
	  $id_horario=$_POST['sele'];
	  $peticion= "SELECT horario FROM horario WHERE ID_Horario='".$id_horario."'";
    $peti1=mysqli_query($enlace, $peticion);
    while($row = mysqli_fetch_assoc($peti1)){
      if($row==null){
        echo 'Está vacio';
      }
      else{
        print_r($row);
      }
    }
	  mysqli_close($enlace);
  }
?>
