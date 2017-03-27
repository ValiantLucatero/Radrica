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
  var h="hey";
  console.log('hola');
}
