<?php
	$data = json_decode(file_get_contents("php://input"), true);
	switch($metodo){
		case 'GET':echo json_encode("Te doy los usuarios");
		break;
		case 'POST':echo json_encode("Guardamos un nuevo usuario con el nombre ");
		break;
		case 'PUT':echo json_encode("Actualizar un usuario");	
		break;
		case 'DELETE':echo json_encode("Eliminar un usuario");	
		break;
	}
?>