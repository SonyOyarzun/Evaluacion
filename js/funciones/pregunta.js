
function recuperarPregunta(){  
    var page = 1
    var q = $("#q").val();
    var id_encuesta = $("#id_encuesta").val();
    console.log('encuesta ' + id_encuesta)
    $("#loader").fadeIn('slow');
    $.ajax({
        url: './ajax/buscar_pregunta.php?action=ajax&page=' + page + '&q=' + q,
        data: "id_encuesta=" + id_encuesta,
        beforeSend: function (objeto) {
            $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success: function (data) {
            $(".outer_div").html(data).fadeIn('slow');
            $('#loader').html('');

        }
    })
}

function eliminarPregunta(id)
{
    var q = $("#q").val();
    if (confirm("Realmente deseas eliminar esta pregunta")) {
        $.ajax({
            type: "GET",
            url: "./ajax/buscar_pregunta.php",
            data: "id=" + id, "q": q,
            beforeSend: function (objeto) {
                $("#resultados").html("Mensaje: Cargando...");
            },
            success: function (datos) {
                $("#resultados2").html(datos);
                load(1);
            }
        });
    }
}

function registrarPregunta(){
    
    var nombre = $("#nombre").val();
    var encuesta = $("#encuesta").val();
    var descripcion = $("#descripcion").val();
   
    var parametros = {
        'nombre': nombre,
        'encuesta': encuesta,
        'descripcion': descripcion,
    } 
      $.ajax({
        type: "POST",
        url: "ajax/nueva_pregunta.php",
        data: parametros,
        beforeSend: function (objeto) {
            $("#resultados_ajax").html("Mensaje: Cargando...");
        },
        success: function (datos) {
            $("#resultados_ajax").html(datos);
            $('#guardar_datos').attr("disabled", false);
            load(1);
        }
    });  
}




function editarPregunta(){
    
    var mod_id = $("#mod_id").val();
    var nombre = $("#mod_nombre").val();
    var encuesta = $("#mod_encuesta").val();
    var descripcion = $("#mod_descripcion").val();
    
   
    var parametros = {
        'mod_id': mod_id,
        'mod_nombre': nombre,
        'mod_encuesta': encuesta,
        'mod_descripcion': descripcion,
    } 
    
    $.ajax({
        type: "POST",
        url: "ajax/editar_pregunta.php",
        data: parametros,
        beforeSend: function (objeto) {
            $("#resultados_ajax2").html("Mensaje: Cargando...");
        },
        success: function (datos) {
            $("#resultados_ajax2").html(datos);
            $('#actualizar_datos').attr("disabled", false);
            load(1);
        }
    });   
}


