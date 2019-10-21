<?php
include('is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado

require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos
include '../Clases/Usuario.php';

$con = Conexion::conectar();

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';

if (isset($_GET['rut'])) {
    $rut        = mysqli_real_escape_string($con, (strip_tags($_GET['rut'], ENT_QUOTES)));
    
    $usuario    = new Usuario();
    $usuario    ->setRut($rut);
    $usuario    ->setCon($con);
    
    $query = Usuario::recuperarUsuario($usuario);
    
    $rw_usuario = mysqli_fetch_array($query);
    
    $excep = $rw_usuario['id_usuario'];
    //si usuario es el administrador, no se podra eliminar
    if ($excep != '00.000.000-0') {
        if ($delete = Usuario::eliminarUsuario($usuario)) {
            ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Aviso!</strong> Usuario eliminado exitosamente.
            </div>
            <?php
        } else {
            ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
            </div>
            <?php
        }
    } else {
        ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Error!</strong> No se puede borrar el usuario administrador. 
        </div>
        <?php
    }
}
if ($action == 'ajax') {

//Columnas de busqueda
    $aColumns = array('nombre_usuario', 'apellido_usuario');

//Condiciones de busqueda
    $sWhere = "";

    if (isset($_GET['id_departamento'])) {
        $id = intval($_GET['id_departamento']);
        if ($id > 0) {
            $sWhere .= " AND usuario.departamento_usuario = $id ";
        } else {
            $sWhere .= " AND usuario.tipo_usuario > 1 ";
        }
    }


    if (isset($_GET['q'])) {
        $q = mysqli_real_escape_string($con, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
        $sWhere .= " AND (";
        for ($i = 0; $i < count($aColumns); $i++) {
            $sWhere .= $aColumns[$i] . " LIKE '%" . $q . "%' OR ";
        }
        $sWhere = substr_replace($sWhere, "", -3);
        $sWhere .= ')';
    }

//objeto usuario y variables    

    $usuario = new Usuario();
    $usuario->setCondicion($sWhere);
    
    $result = Usuario::recuperarUsuario($usuario);

    $numrows = mysqli_num_rows($result);

    if ($numrows > 0) {
        ?>
        <div class="table-responsive">
            <table class="table">
                <tr  class="success">
                    <?php
                    if (isset($_GET['id_departamento'])) {
                        ?> 
                        <th>Rut</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Genero</th> 
                        <th>Tipo Usuario</th>
                        <th>Seleccion</th>

                        <?php
                    } else {
                        ?>
                        <th>Rut</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Genero</th>
                        <th>Departamento</th>
                        <th>Mail</th>
                        <th>Tipo Usuario</th>
                        <th>Agregado</th>
                        <th><span class="pull-right">Acciones</span></th>
                        <?php
                    }
                    ?>
                </tr>
                <?php
                while ($row = mysqli_fetch_array($result)) {
                    $rut = $row['id_usuario'];
                    $nombre = $row['nombre_usuario'];
                    $apellido = $row['apellido_usuario'];
                    $id_genero = $row['id_genero'];
                    $genero = $row['nombre_genero'];
                    $id_departamento = $row['id_departamento'];
                    $departamento = $row['nombre_departamento'];
                    $mail = $row['mail_usuario'];
                    $id_tipo = $row['id_tipo_usuario'];
                    $tipo = $row['nombre_tipo_usuario'];
                    $fecha = date('d/m/Y', strtotime($row['fecha_usuario']));
                    ?>

                    <input type="hidden" value="<?php echo $row['nombre_usuario']; ?>" id="nombres<?php echo $rut; ?>">
                    <input type="hidden" value="<?php echo $row['apellido_usuario']; ?>" id="apellidos<?php echo $rut; ?>">
                    <input type="hidden" value="<?php echo $rut; ?>" id="usuario<?php echo $rut; ?>">
                    <input type="hidden" value="<?php echo $mail; ?>" id="email<?php echo $rut; ?>">

                    <tr>
                        <?php
                        if (isset($_GET['id_departamento'])) {
                            ?>                         
                            <td><?php echo $rut; ?></td>
                            <td><?php echo $nombre; ?></td>
                            <td ><?php echo $apellido; ?></td>
                            <td ><?php echo $genero; ?></td>
                            <td ><?php echo $tipo; ?></td>
                            <td ><input class="form-control" type="checkbox" name="seleccion[]" checked="" id="seleccion" value="<?php echo $rut . "," . $mail ?>"></td>

                            <?php
                        } else {
                            ?>
                            <td><?php echo $rut; ?></td>
                            <td><?php echo $nombre; ?></td>
                            <td ><?php echo $apellido; ?></td>
                            <td ><?php echo $genero; ?></td>
                            <td ><?php echo $departamento; ?></td>
                            <td ><?php echo $mail; ?></td>
                            <td ><?php echo $tipo; ?></td>
                            <td ><?php echo $fecha; ?></td>


                            <td ><span class="pull-right">
                                    <a href="#" class='btn btn-default' title='Editar usuario' data-id="<?php echo $rut; ?>" data-nombre="<?php echo $nombre; ?>" data-apellido="<?php echo $apellido; ?>" data-genero="<?php echo $id_genero; ?>" data-tipo="<?php echo $id_tipo; ?>" data-departamento="<?php echo $id_departamento; ?>" data-email="<?php echo $mail; ?>" data-toggle="modal" data-target="#editar_usuario"><i class="glyphicon glyphicon-edit"></i></a> 
                                    <a href="#" class='btn btn-default' title='Cambiar contraseña' data-rut="<?php echo $rut; ?>" data-toggle="modal" data-target="#cambiar_clave"><i class="glyphicon glyphicon-cog"></i></a>
                                    <a href="#" class='btn btn-default' title='Borrar usuario' onclick="eliminarUsuario('<?php echo $rut; ?>')"><i class="glyphicon glyphicon-trash"></i> </a></span></td>

                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </div>
        <?php
    }
}
?>