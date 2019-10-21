$(document).ready(function () {
    load(1);
});

function load(page) {
    recuperarEvaluacion()
}

//nombre del formulario en registro_memoria.php
$("#guardar_evaluacion").submit(function (event) {
    $('#guardar_datos').attr("disabled", true);

    console.log('guardar evaluacion');

    var parametros = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "ajax/nueva_evaluacion.php",
        data: parametros,
        beforeSend: function (objeto) {
            $("#resultados_ajax").html("Mensaje: Cargando...");
        },
        success: function (datos) {
            $("#resultados_evaluacion").html(datos);
            $('#guardar_datos').attr("disabled", false);
            load(1);
            console.log('resultado :' + datos)
        }
    });
    event.preventDefault();
})

$('#myModal2').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var nombre = button.data('nombre')
    var descripcion = button.data('descripcion')
    var id = button.data('id')
    var modal = $(this)
    modal.find('.modal-body #mod_nombre').val(nombre)
    modal.find('.modal-body #mod_descripcion').val(descripcion)
    modal.find('.modal-body #mod_id').val(id)
})


