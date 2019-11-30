<?php
include('is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
require_once("../libraries/password_compatibility_library.php");
}

require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos
include '../Clases/Usuario.php';

if (!empty($_POST['id'])) {
//habilitado=1
//deshabilitado=2

$id = $_POST['id'];


//busca usuarios habilitados
$usuario_hab = new Usuario();
$usuario_hab->setId($id);
$condicion = "AND estado_usuario = '1'";
$usuario_hab->setCondicion($condicion);
$result_hab = Usuario::recuperarUsuario($usuario_hab);
$verifica_hab = mysqli_num_rows($result_hab);

if ($verifica_hab == 1) {
$errors[] = "Lo sentimos , el ID de usuario ya está en uso.";

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

exit;
}

//busca usuarios deshabilitados
$usuario_des = new Usuario();
$condicion = "AND estado_usuario = '2'";
$usuario_des->setId($id);
$usuario_des->setCondicion($condicion);
$result_des = Usuario::recuperarUsuario($usuario_des);
$verifica_des = mysqli_num_rows($result_des);

if ($verifica_des==1) {
$habilitar = Usuario::habilitarUsuario($usuario_des);
$messages[] = "El usuario ha sido habilitado";

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
exit;
}


}

if (empty($_POST['id'])) {
$errors[] = "Rut vacío ";
}elseif (empty($_POST['nombre'])) {
$errors[] = "Nombres vacíos ";
} elseif (empty($_POST['apellido'])) {
$errors[] = "Apellidos vacíos";
} elseif (empty(intval($_POST['genero']))) {
$errors[] = "Genero vacío";
} elseif (empty(intval($_POST['tipo']))) {
$errors[] = "Tipo de usuario vacío";
} elseif (empty(intval($_POST['departamento']))) {
$errors[] = "Departamento vacío";
} elseif (empty($_POST['email'])) {
$errors[] = "El correo electrónico no puede estar vacío";
} elseif (strlen($_POST['email']) > 64) {
$errors[] = "El correo electrónico no puede ser superior a 64 caracteres";
} elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
$errors[] = "Su correo electrónico no está en un formato válido";
} elseif (empty($_POST['password_nueva']) || empty($_POST['password_repetir'])) {
$errors[] = "Contraseña vacía";
} elseif ($_POST['password_nueva'] !== $_POST['password_repetir']) {
$errors[] = "la contraseña y la repetición de la contraseña no son lo mismo";
} elseif (strlen($_POST['password_nueva']) < 6) {
$errors[] = "La contraseña debe tener como mínimo 6 caracteres";
} elseif (strlen($_POST['id']) > 13 || strlen($_POST['id']) < 2) {
$errors[] = "ID no puede ser inferior a 2 o más de 13 caracteres";
} elseif (
!empty($_POST['id']) &&!empty($_POST['nombre']) &&!empty($_POST['apellido']) && strlen($_POST['id']) <= 64 && strlen($_POST['id']) >= 2 &&!empty($_POST['email']) && strlen($_POST['email']) <= 64 && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) &&!empty($_POST['password_nueva']) &&!empty($_POST['password_repetir']) && ($_POST['password_nueva'] === $_POST['password_repetir'])
) {


$con = Conexion::conectar();

$id = mysqli_real_escape_string($con, (strip_tags($_POST["id"], ENT_QUOTES)));
$nombre = mysqli_real_escape_string($con, (strip_tags($_POST["nombre"], ENT_QUOTES)));
$apellido = mysqli_real_escape_string($con, (strip_tags($_POST["apellido"], ENT_QUOTES)));
$email = mysqli_real_escape_string($con, (strip_tags($_POST["email"], ENT_QUOTES)));
$tipo = mysqli_real_escape_string($con, (strip_tags($_POST["tipo"], ENT_QUOTES)));
$genero = mysqli_real_escape_string($con, (strip_tags($_POST["genero"], ENT_QUOTES)));
$departamento = mysqli_real_escape_string($con, (strip_tags($_POST["departamento"], ENT_QUOTES)));

//codifica la clave
$clave = $_POST['password_nueva'];
$clave_hash = password_hash($clave, PASSWORD_DEFAULT);

//objeto recibe variables
$usuario = new Usuario();

$usuario->setId($id);
$usuario->setNombre($nombre);
$usuario->setApellido($apellido);
$usuario->setMail($email);
$usuario->setTipo($tipo);
$usuario->setGenero($genero);
$usuario->setDepartamento($departamento);
$usuario->setClave($clave_hash);

//verificar si el usuario ya existe
$result = Usuario::recuperarUsuario($usuario);
$verifica = mysqli_num_rows($result);
if ($verifica == 0) {

$insert = Usuario::registrarUsuario($usuario);

if ($insert) {
$messages[] = "La cuenta ha sido creada con éxito.";
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