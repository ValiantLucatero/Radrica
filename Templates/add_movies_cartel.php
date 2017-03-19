<?php
  $enlace= mysqli_connect("localhost","root","root","mydb");
  if(!$enlace)
  {
    echo "No se pudo conectar".mysqli_connect_error();
  }
  else
  {
    $tildes = $enlace -> query("SET NAMES 'utf8'");
    $peticion1='SELECT ID_Peliculas,Titulo_Peliculas FROM Peliculas';
    $peticion2='SELECT Titulo_Peliculas FROM Peliculas';
    $pedir1=mysqli_query($enlace,$peticion1);
    $pedir2=mysqli_query($enlace,$peticion2);
    $patabla='<tr><th>ID</th><th>Imagen</th><th>Título</th><th>¿Agregar?</th></tr>';
    $n=0;
    $coso=array();
    while($row=mysqli_fetch_assoc($pedir2))
    {
      foreach($row as $re){
        $coso[]=$re;
      }
    }
    while($row=mysqli_fetch_assoc($pedir1))
    {
      print_r($row);
      $patabla=$patabla."<tr>";
      $patabla=$patabla.'<td>'.$row['ID_Peliculas'].'</td>';
      $patabla=$patabla.'<td><img src="../Resources/'.$row['Titulo_Peliculas'].'.jpg" height="50%"/></td><td>'.$row['Titulo_Peliculas'].'</td><td><button class="btn btn-primary" id="n'.$n.'" onclick="agregar(this)">Agregar</button></td>';
      $n++;
      $patabla=$patabla.'</tr>';
    }
    mysqli_close($enlace);
    echo $patabla;
  }
?>
