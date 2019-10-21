
   function recuperarDepartamento(){
    var page=1;    
    var q = $("#q").val();
    $("#loader").fadeIn('slow');
    $.ajax({
        url: './ajax/buscar_departamento.php?action=ajax&page=' + page + '&q=' + q,
        beforeSend: function (objeto) {
            $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success: function (data) {
            $(".outer_div").html(data).fadeIn('slow');
            $('#loader').html('');

        }
    })
    }
    
function registrarDepartamento(){
    var nombre = $("#nombre").val();
    var descripcion = $("#descripcion").val();

    var parametros = {
        'nombre': nombre,
        'descripcion': descripcion,
    }   
    
    $.ajax({
        type: "POST",
        url: "ajax/nuevo_departamento.php",
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


//se llama el form de modal/editar_procesador
function editarDepartamento(){
    
    var mod_id = $("#mod_id").val();
    var nombre = $("#mod_nombre").val();
    var descripcion = $("#mod_descripcion").val();

    var parametros = {
        'mod_id': mod_id,
        'mod_nombre': nombre,
        'mod_descripcion': descripcion,
    }   
    $.ajax({
        type: "POST",
        url: "ajax/editar_departamento.php",
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

function eliminarDepartamento(id)
{
    var q = $("#q").val();
    if (confirm("Realmente deseas eliminar este departamento")) {
        $.ajax({
            type: "GET",
            url: "./ajax/buscar_departamento.php",
            data: "id=" + id, "q": q,
            beforeSend: function (objeto) {
                $("#resultados").html("Mensaje: Cargando...");
            },
            success: function (datos) {
                $("#resultados").html(datos);
                load(1);
            }
        });
    }
}