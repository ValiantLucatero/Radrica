<?php
  $enlace= mysqli_connect("localhost","root","root","mydb");
  if(!$enlace)
  {
    echo "No se pudo conectar".mysqli_connect_error();
  }
  else
  {
    $tildes = $enlace -> query("SET NAMES 'utf8'");
    $peticion1='SELECT ID_Peliculas,Titulo_Peliculas,Sub_Peliculas FROM Peliculas';
    $pedir1=mysqli_query($enlace,$peticion1);
    $patabla='<tr><th>ID</th><th>Imagen</th><th>Título</th><th>Subtitulos</th><th>¿Agregar horario?</th></tr>';
    $n=0;
    while($row=mysqli_fetch_assoc($pedir1))
    {
      $patabla=$patabla."<tr>";
      $patabla=$patabla.'<td>'.$row['ID_Peliculas'].'</td>';
      $patabla=$patabla.'<td><img src="../Resources/'.$row['Titulo_Peliculas'].'.jpg" height="30%"/></td><td><span class="n'.$row['ID_Peliculas'].'">'.$row['Titulo_Peliculas'].'</span></td>';
      if($row['Sub_Peliculas']==1)
        $sub='Sí';
      else {
          $sub='No';
      }
      $patabla=$patabla.'<td>'.$sub.'</td><td><button class="btn btn-primary" id="n'.$row['ID_Peliculas'].'" onclick="agregar(this)" data-toggle="modal" data-target="#dar_horario">Agregar</button></td>';
      $n++;
      $patabla=$patabla.'</tr>';
    }
    mysqli_close($enlace);
    echo $patabla;
  }
?>
