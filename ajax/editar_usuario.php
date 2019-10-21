<?php
include('is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once("../libraries/password_compatibility_library.php");
}
if (empty($_POST['mod_nombre'])) {
    $errors[] = "Nombres vacíos";
} elseif (empty($_POST['mod_apellido'])) {
    $errors[] = "Apellidos vacíos";
} elseif (empty($_POST['mod_genero'])) {
    $errors[] = "Genero vacío"; 
} elseif (empty($_POST['mod_tipo'])) {
    $errors[] = "Tipo de usuario vacío";
} elseif (empty($_POST['mod_departamento'])) {
    $errors[] = "Departamento vacío";
} elseif (empty($_POST['mod_email'])) {
    $errors[] = "Email vacio";
} elseif (strlen($_POST['mod_email']) > 64 || strlen($_POST['mod_email']) < 2) {
    $errors[] = "Email de usuario no puede ser inferior a 2 o más de 64 caracteres";
} elseif (empty($_POST['mod_email'])) {
    $errors[] = "El correo electrónico no puede estar vacío";
} elseif (strlen($_POST['mod_email']) > 64) {
    $errors[] = "El correo electrónico no puede ser superior a 64 caracteres";
} elseif (!filter_var($_POST['mod_email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Su dirección de correo electrónico no está en un formato de correo electrónico válida";
} elseif (
        !empty($_POST['mod_email']) && !empty($_POST['mod_nombre']) && !empty($_POST['mod_apellido']) && strlen($_POST['mod_email']) <= 64 && strlen($_POST['mod_email']) >= 2 && !empty($_POST['mod_email']) && strlen($_POST['mod_email']) <= 64 && filter_var($_POST['mod_email'], FILTER_VALIDATE_EMAIL)
) {
    require_once ("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
    require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos
    include '../Clases/Usuario.php'; // clase con metodos para usuario

    $rut = mysqli_real_escape_string($con, (strip_tags($_POST['mod_rut'], ENT_QUOTES)));
    $nombre = mysqli_real_escape_string($con, (strip_tags($_POST["mod_nombre"], ENT_QUOTES)));
    $apellido = mysqli_real_escape_string($con, (strip_tags($_POST["mod_apellido"], ENT_QUOTES)));
    $email = mysqli_real_escape_string($con, (strip_tags($_POST["mod_email"], ENT_QUOTES)));
    $tipo = intval($_POST["mod_tipo"]);
    $genero = intval($_POST["mod_genero"]);
    $departamento = intval($_POST["mod_departamento"]);

    
    if ($_SESSION['id_usuario'] == $rut) {
        $errors[] = "El administrador no puede ser modificado.";
    } else {
        
        $usuario = new Usuario();
        $usuario->setRut($rut);
        $usuario->setNombre($nombre);
        $usuario->setApellido($apellido);
        $usuario->setMail($email);
        $usuario->setTipo_usuario($tipo);
        $usuario->setGenero($genero);
        $usuario->setDepartamento($departamento);
        $usuario->setCon($con);
        
        $update = Usuario::editarUsuario($usuario);

        if ($update) {
            $messages[] = "La cuenta ha sido modificada con éxito.";
        } else {
            $errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.";
        }
    }

} else {
    $errors[] = "Un error desconocido ocurrió.";
}

if (isset($errors)) {
    ?>
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Error!</strong> 
    <?php
    foreach ($errors as $error) {
        echo $error;
    }
    ?>
    </div>
    <?php
}
if (isset($messages)) {
    ?>
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>¡Bien hecho!</strong>
        <?php
        foreach ($messages as $message) {
            echo $message;
        }
        ?>
    </div>
    <?php
}
?>