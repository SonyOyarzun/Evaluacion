<?php
// Verifica version minima de PHP
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("No puede correr en versiones inferiores a 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // la libreria de contraseña no funciona en versiones inferiores
    require_once("libraries/password_compatibility_library.php");
}

// incluye la la coneccion a BD
require_once("./config/conexion.php");
$con = Conexion::conectar();

// Abre la  clase login en donde se crearan las variables de session
require_once("./Autenticacion/Login.php");

// se crea el objeto login para ingresar y salir de la session de manera simple
$login = new Login();

// evalua si se logea correctamente
if ($login->isUserLoggedIn() == true) {
    //si es que se logea en direcciona a la url
   header("location: notificaciones.php");

} else {
    // si no se logea direcciona envia mensaje de error
    ?>
	<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title> Owl Evaluation | Login </title>
  <?php 
      include './head.php';
  ?>
        <link href="css/login.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
 <div class="container">
        <div class="card card-container">
            <img id="profile-img" class="profile-img-card" src="img/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form method="post" accept-charset="utf-8" action="login.php" name="loginform" autocomplete="off" role="form" class="form-signin">
			<?php
				// muestra posibles errores
				if (isset($login)) {
					if ($login->errors) {
						?>
						<div class="alert alert-danger alert-dismissible" role="alert">
						    <strong>Error!</strong> 
						
						<?php 
						foreach ($login->errors as $error) {
							echo $error;
						}
						?>
						</div>
						<?php
					}
					if ($login->messages) {
						?>
						<div class="alert alert-success alert-dismissible" role="alert">
						    <strong>Aviso!</strong>
						<?php
						foreach ($login->messages as $message) {
							echo $message;
						}
						?>
						</div> 
						<?php 
					}
				}
				?>
                <span id="reauth-email" class="reauth-email"></span>
                <input class="form-control" placeholder="Usuario" name="user_name" id="rut" type="text" value="" autofocus="" required maxlength="12" onkeyup="validar_rut(this.id)">
                <small class="rut-error"></small>
                <input class="form-control" placeholder="Contraseña" name="user_password" id="contraseña" type="password" value="" autocomplete="off" required>
                <button type="submit" class="btn btn-lg btn-success btn-block btn-signin guardar_datos" name="login" id="submit">Iniciar Sesión</button>
            </form><!-- /form -->
            
        </div><!-- /card-container -->
    </div><!-- /container -->
  </body><?php
	include("./footer.php");
	?>
  
  <script type="text/javascript" src="./js/extras/validarRut.js"></script>
</html>

	<?php
}


