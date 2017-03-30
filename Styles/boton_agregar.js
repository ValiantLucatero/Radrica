function agregar(x){
  var h="hey";
  console.log(h);
  console.log(x.id);
  var id_boton= $("span."+x.id+"").html();
  console.log(id_boton);
  $("h3 small").html('"'+id_boton+'"');
}