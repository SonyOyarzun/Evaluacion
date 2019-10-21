function recuperarEvaluacion() {
    var page = 1;
    var q = $("#q").val();
    var id_encuesta = $("#id_encuesta").val();
    var id_asignacion = $("#id_asignacion").val();
    var nombre_encuesta = $("#nombre_encuesta").val();
    var tipo_encuesta = $("#tipo_encuesta").val();
    var parametros = {
        'action': 'ajax',
        'page': page,
        'q': q,
        'id_asignacion': id_asignacion,
        'id_encuesta': id_encuesta,
        'tipo_encuesta': tipo_encuesta,
        'nombre_encuesta': nombre_encuesta
    };

    console.log('encuesta ' + id_encuesta)
    $("#loader").fadeIn('slow');
    $.ajax({
        url: './ajax/buscar_evaluacion.php?action=ajax&page=' + page + '&q=' + q,
        data: parametros,
        beforeSend: function (objeto) {
            $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success: function (data) {
            $(".outer_div").html(data).fadeIn('slow');
            $('#loader').html('');

        }
    })
}


function recuperarCalificacion() {
    var page = 1;
    var q = $("#q").val();
    var id_encuesta = $("#id_encuesta").val();
    var fecha_inicio = $("#fecha_inicio").val();
    var fecha_termino = $("#fecha_termino").val();


    var parametros = {
        'action': 'ajax',
        'page': page,
        'q': q,
        'fecha_inicio': fecha_inicio,
        'fecha_termino': fecha_termino,
        'id_encuesta': id_encuesta
    };

    console.log("q" + q);
    console.log("fecha_inicio" + fecha_inicio);
    console.log("fecha_termino" + fecha_termino);

    $("#loader").fadeIn('slow');
    $.ajax({
        url: './ajax/buscar_calificacion.php?action=ajax&page=' + page + '&q=' + q,
        data: parametros,
        beforeSend: function (objeto) {
            $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success: function (data) {
            $(".outer_div").html(data).fadeIn('slow');
            $('#loader').html('');

        }
    })
		}