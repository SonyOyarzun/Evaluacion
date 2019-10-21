$(document).ready(function () {
    load(1);
});

function load(page) {
    recuperarCalificacion()
}

$('#detalle_evaluacion').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('id')
    var nombre = button.data('nombre')
    var apellido = button.data('apellido')

    var modal = $(this)
    modal.find('.modal-body #id_evaluado1').val(id)
    modal.find('.modal-body #nombre1').val(nombre)
    modal.find('.modal-body #apellido1').val(apellido)

})



$("#detalle_evaluacion").on('hidden.bs.modal', function () {
         location.reload(true);
     //       $(this).removeData('modal');
});

$("#detalle_fecha_ev").on('hidden.bs.modal', function () {
       location.reload(true);
   //     $(this).removeData('modal');
});

