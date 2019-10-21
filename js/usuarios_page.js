$(document).ready(function () {
    load(1);
});

function load(page) {
    recuperarUsuarios()
}



	              
$('#editar_usuario').on('show.bs.modal', function (event) {
	  var button        = $(event.relatedTarget) // Button that triggered the modal
          
	  var nombre        = button.data('nombre') 
	  var apellido      = button.data('apellido') 
          var genero        = button.data('genero') 
          var tipo          = button.data('tipo') 
          var departamento  = button.data('departamento') 
          var mail          = button.data('email') 
          var id            = button.data('id') 
          
          console.log(id)
          
	  var modal = $(this)
	  modal.find('.modal-body #mod_nombre')         .val(nombre)
	  modal.find('.modal-body #mod_apellido')       .val(apellido) 
	  modal.find('.modal-body #mod_genero')         .val(genero)
          modal.find('.modal-body #mod_tipo')           .val(tipo)
	  modal.find('.modal-body #mod_departamento')   .val(departamento) 
          modal.find('.modal-body #mod_email')          .val(mail) 
	  modal.find('.modal-body #mod_id')             .val(id)
	})      

$('#cambiar_clave').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget) 
          var rut = button.data('rut') 
         
	  var modal = $(this)
	  modal.find('.modal-body #mod_clave_id').val(rut)
	}) 

		
		

