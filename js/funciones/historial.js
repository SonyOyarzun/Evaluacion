

function recuperarHistorial(){	
    
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
				url:'./ajax/buscar_historial.php',
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
                    }