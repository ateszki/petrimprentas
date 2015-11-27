//archivos.js
$(function() {
  // Handler for .ready() called.
  $("form").submit(function(e){
  	$("#archivos").val("");
  	$("li.active > a > label > input[type='checkbox']").each(function(){
  		valor = $("#archivos").val()+$(this).val()+",";
  		$("#archivos").val(valor); 	
  	});

  });
});