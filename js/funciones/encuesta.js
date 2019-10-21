	

function eliminarEncuesta(id)
{
    console.log('eliminar encuesta')
    var q = $("#q").val();
    if (confirm("Realmente deseas eliminar la encuesta")) {
        $.ajax({
            type: "GET",
            url: "./ajax/buscar_encuesta.php",
            data: "id=" + id, "q": q,
            beforeSend: function (objeto) {
                $("#resultados2").html("Mensaje: Cargando...");
            },
            success: function (datos) {
                $("#resultados2").html(datos);
                console.log(datos)
                load(1);
            }
        });
    }
}

function registrarEncuesta(){
    var nombre = $("#nombre").val();
    var tipo_encuesta = $("#tipo_encuesta").val();
   
    var parametros = {
        'nombre': nombre,
        'tipo_encuesta': tipo_encuesta,
    }

    $.ajax({
        type: "POST",
        url: "ajax/nueva_encuesta.php",
        data: parametros,
        beforeSend: function (objeto) {
            $("#resultados_ajax_productos").html("Mensaje: Cargando...");
        },
        success: function (datos) {
            $("#resultados_ajax_productos").html(datos);
            $('#guardar_datos').attr("disabled", false);
            load(1);
        }
    });

}
function recuperarEncuesta(){
                        var page=1;
			var q= $("#q").val();
			var fecha_inicio= $("#fecha_inicio").val();
                        var fecha_termino= $("#fecha_termino").val();
                        var tipo_encuesta=$("#tipo_encuesta").val();
			var parametros={
                            'action':'ajax',
                            'page':page,
                            'q':q,
                            'fecha_inicio':fecha_inicio,
                            'fecha_termino':fecha_termino,
                            'tipo_encuesta':tipo_encuesta,
                        };
			$("#loader").fadeIn('slow');
			$.ajax({
				data: parametros,
				url:'./ajax/buscar_encuesta.php',
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
}
 function recuperarEncuestasAsignadas(){
			var q= $("#q").val();
			var fecha_inicio= $("#fecha_inicio").val();
                        var fecha_termino= $("#fecha_termino").val();
			var parametros={
                            'action':'ajax',
                            'page':1,
                            'q':q,
                            'fecha_inicio':fecha_inicio,
                            'fecha_termino':fecha_termino,
                        };
			$("#loader").fadeIn('slow');
			$.ajax({
				data: parametros,
				url:'./ajax/buscar_notificacion.php',
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
}




$( "#guardar_asignar" ).submit(function( event ) { 
  $('#guardar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();

	 $.ajax({
			type: "POST",
			url: "ajax/nuevo_asignarEncuesta.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados").html('<img src="./img/ajax-loader.gif"> Cargando...'); 
			  },
			success: function(datos){   
			$("#resultados_ajax_3").html(datos);
			$('#guardar_datos').attr("disabled", false);
                        $("#resultados").html(''); 
			load(1);
                    
		  }
	});
  event.preventDefault();
})


$( "#guardar_asignar2" ).submit(function( event ) { 
  $('#guardar_datos2').attr("disabled", true);
console.log("asignar jefatura")
 var parametros = $(this).serialize();

	 $.ajax({
			type: "POST",
			url: "ajax/nuevo_asignarEncuesta.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax_2").html('<img src="./img/ajax-loader.gif"> Cargando...'); 
			  },
			success: function(datos){     
			$("#resultados_ajax_1").html(datos);
			$('#guardar_datos_2').attr("disabled", false);
                        $("#resultados_ajax_2").html(''); 
			load(1);
          
		  }
	});
  event.preventDefault();
})