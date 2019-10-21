$(document).ready(function () {
    load(1);
});

function load(page) {
    
    recuperarPregunta()
    
}

$('#editar_pregunta').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var nombre = button.data('nombre')
    var descripcion = button.data('descripcion')
    var id = button.data('id')
    var modal = $(this)
    modal.find('.modal-body #mod_nombre').val(nombre)
    modal.find('.modal-body #mod_descripcion').val(descripcion)
    modal.find('.modal-body #mod_id').val(id)
})
		

