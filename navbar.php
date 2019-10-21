	<?php
		if (isset($title))
		{
                    include './Clases/Encuesta.php';
                    include './Clases/Usuario.php';
                    
                    $id_usuario     = $_SESSION['id_usuario'];  
                    $nombre         = $_SESSION['nombre_usuario']; 
                    $apellido       = $_SESSION['apellido_usuario']; 
                    $tipo_usuario   = $_SESSION['tipo_usuario'];  
                    
                    $usuario = new Usuario();
                    $usuario ->setId($id_usuario);

                    
                    $result = Encuesta::recuperarEncuestaAsignada($usuario);
                    $notificaciones = mysqli_num_rows($result);
    
	?>
<nav class="navbar navbar-default ">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Owl Evaluation</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
       <?php
            if($tipo_usuario>1){
	?>   
        <li class="<?php if (isset($active_encuestas)){echo $active_encuestas;}?>"><a href="encuestas.php"><i class='glyphicon glyphicon-copy'></i> Encuestas </a></li>
         <?php
            }
            if($tipo_usuario>2){
	?>   
        <li class="<?php if (isset($active_departamentos)){echo $active_departamentos;}?>"><a href="departamentos.php"><i class='glyphicon glyphicon-home'></i> Departamentos </a></li>
		<li class="<?php if (isset($active_usuarios)){echo $active_usuarios;}?>"><a href="usuarios.php"><i  class='glyphicon glyphicon-user'></i> Usuarios</a></li>
                 <?php
        }
	?>   
       </ul>
      <ul class="nav navbar-nav navbar-right">
         
           <li><a class="navbar-brand" ><i class=''></i><?php echo 'Bienvenido:      '.$nombre." ".$apellido ;?></a></li>
            <?php
            if($tipo_usuario>1){
	   ?> 
          <li class="<?php if (isset($active_historial)){echo $active_historial;}?>"><a href="historial.php"><i class='glyphicon glyphicon-tasks'></i> Historial </a></li>
           <?php
            }
	   ?> 
          <li class="<?php if (isset($active_notificaciones)){echo $active_notificaciones;}?>"><a href="notificaciones.php"><i class='glyphicon glyphicon-warning-sign'></i> <?php echo $notificaciones;?> Notificaciones </a></li>
		<li><a href="login.php?logout"><i class='glyphicon glyphicon-off'></i> Salir</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
	<?php
		}
	?>