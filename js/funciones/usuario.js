
function recuperarUsuarios(){ 

    var page    = 1;
    var q       = $("#q").val();
    
    $("#loader").fadeIn('slow');
    
    $.ajax({
        url: './ajax/buscar_usuarios.php?action=ajax&page=' + page + '&q=' + q,
        beforeSend: function (objeto) {
            $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success: function (data) {
            $(".outer_div").html(data).fadeIn('slow');
            $('#loader').html('');

        }
    })
}

function registrarUsuario() {

    var rut                 = $("#rut")             .val();
    var nombre              = $("#nombre")          .val();
    var apellido            = $("#apellido")        .val();
    var genero              = $("#genero")          .val();
    var tipo                = $("#tipo")            .val();
    var email               = $("#email")           .val();
    var departamento        = $("#departamento")    .val();
    var password_nueva      = $("#password_nueva")  .val();
    var password_repetir    = $("#password_repetir").val();

    var parametros = {
        'rut'               : rut,
        'nombre'            : nombre,
        'apellido'          : apellido,
        'genero'            : genero,
        'tipo'              : tipo,
        'email'             : email,
        'password_nueva'    : password_nueva,
        'password_repetir'  : password_repetir,
        'departamento'      : departamento,
    }

   
    $.ajax({
        type: "POST",
        url: "ajax/nuevo_usuario.php",
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

function editarUsuario() {

    var rut             = $("#mod_rut")         .val();
    var nombre          = $("#mod_nombre")      .val();
    var apellido        = $("#mod_apellido")    .val();
    var genero          = $("#mod_genero")      .val();
    var tipo            = $("#mod_tipo")        .val();
    var email           = $("#mod_email")       .val();
    var departamento    = $("#mod_departamento").val();

    var parametros = {
        'mod_rut'           : rut,
        'mod_nombre'        : nombre,
        'mod_apellido'      : apellido,
        'mod_genero'        : genero,
        'mod_tipo'          : tipo,
        'mod_email'         : email,
        'mod_departamento'  : departamento,
    }

    $.ajax({
        type: "POST",
        url: "ajax/editar_usuario.php",
        data: parametros,
        beforeSend: function (objeto) {
            $("#resultados_ajax2").html("Mensaje: Cargando...");
        },
        success: function (datos) {
            $("#resultados_ajax2").html(datos);
            $('#actualizar_datos2').attr("disabled", false);
            load(1);
        }
    });

}

function editarClave() {

    var mod_rut          = $("#mod_clave_rut")      .val();
    var clave_nueva      = $("#clave-nueva")  .val();
    var clave_repetir    = $("#clave-repetir").val();

    var parametros = {
        'mod_rut'       : mod_rut,
        'clave-nueva'   : clave_nueva,
        'clave-repetir' : clave_repetir,

    }
    $.ajax({
        type: "POST",
        url: "ajax/editar_clave.php",
        data: parametros,
        beforeSend: function (objeto) {
            $("#resultados_ajax_cambiar_clave").html("Mensaje: Cargando...");
        },
        success: function (datos) {
            $("#resultados_ajax_cambiar_clave").html(datos);
            $('#actualizar_datos3').attr("disabled", false);
            load(1);
        }
    });
}


function eliminarUsuario(rut)
{
    if (confirm("Realmente deseas eliminar el usuario")) {
        $.ajax({
            type: "GET",
            url: "./ajax/buscar_usuarios.php",
            data: "rut=" + rut,
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


function recuperarUsuarioDepartamento(id_departamento) {

    $.ajax({
        url: './ajax/buscar_usuarios.php?action=ajax&id_departamento=' + id_departamento,
        beforeSend: function (objeto) {
            $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success: function (data) {
            $(".tabla_asignar").html(data).fadeIn('slow');
            $('#loader').html('');

        }
    })
}