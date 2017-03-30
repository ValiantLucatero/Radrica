$("button#search").click(function(){
  $.ajax({
    url:"../Templates/add_movies_cartel.php",
    data:{
      tex:"Sólo por enviar"
    },
    type:"POST",
    dataType:"text",
    success:function(data){
      $("table#pelis").html(data);
    }
  });
  var algo=$("table").attr("id");
  console.log(algo);
});

function agregar(x){
  var id_boton= $("span."+x.id+"").html();
  console.log(id_boton);
  $("h3 small").attr("class",'"'+x.id+'"');
  $("h3 small").html('"'+id_boton+'"');
}

$("button#boton_modal").click(function(){
  $.ajax({
    url:"../Templates/agregar_tabla_horarios.php",
    data:{
      sele: $("select#select_horario").val(),
	    idnom: $("h3 small").attr("class").substr(2,1)
    },
    type:"POST",
    dataType:"text",
    success:function(data){
      console.log(data);
    }
  });
  var id_peli=$("h3 small").attr("class").substr(2,1);
  console.log("ID_Peli: "+id_peli);
});
