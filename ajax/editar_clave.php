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


if (empty($_POST['mod_rut'])) {
    $errors[] = "ID vacío";
} elseif (strlen($_POST['clave-nueva']) < 6) {
    $errors[] = "Contraseña debe contener mas de 6 caracteres ";
} elseif (empty($_POST['clave-nueva']) || empty($_POST['clave-repetir'])) {
    $errors[] = "Contraseña vacía";
} elseif ($_POST['clave-nueva'] !== $_POST['clave-repetir']) {
    $errors[] = "la contraseña y la repetición de la contraseña no son lo mismo";
} elseif (
        !empty($_POST['mod_rut']) && !empty($_POST['clave-nueva']) && !empty($_POST['clave-repetir']) && ($_POST['clave-nueva'] === $_POST['clave-repetir'])
) {
    require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos
    include '../Clases/Usuario.php';
    $con = Conexion::conectar();
    
    $id = mysqli_real_escape_string($con, (strip_tags($_POST['mod_rut'], ENT_QUOTES)));

    $clave = $_POST['clave-nueva'];
    $clave_hash = password_hash($clave, PASSWORD_DEFAULT);

    $usuario = new Usuario();
    
    $usuario->setId($id);
    $usuario->setClave($clave_hash);
    
    $query = Usuario::editarClave($usuario);

    if ($query) {
        $messages[] = "contraseña ha sido modificada con éxito.";
    } else {
        $errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.";
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