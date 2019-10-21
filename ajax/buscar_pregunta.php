<?php
include('is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database */
require_once ("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos
include '../Clases/Pregunta.php';

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';
if (isset($_GET['id'])) {
    $id_pregunta = intval($_GET['id']);
    
    $pregunta = new Pregunta();
    $pregunta->setId($id_pregunta);
    $pregunta->setCon($con);
    
    $query = Pregunta::recuperarPregunta($pregunta);
    
    $count = mysqli_num_rows($query);
    
    if ($count > 0) { 
        if ($delete = Pregunta::eliminarPregunta($pregunta)) {
            ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Aviso!</strong> Pregunta eliminada exitosamente.
            </div>
            <?php
        } else {
            ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Error!</strong> La pregunta ya tiene respuestas asociadas
            </div>
            <?php
        }
    } else {
        ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Error!</strong>Algo sucedio!!! Intente nuevamente.
        </div>
        <?php
    }
}
if ($action == 'ajax') {
    // escaping, additionally removing everything that could be (html/javascript-) code
    $q = mysqli_real_escape_string($con, (strip_tags($_REQUEST['q'], ENT_QUOTES)));

    $aColumns = array('nombre_pregunta'); //Columnas de busqueda

    $sWhere = "";

    if (isset($_GET['id_encuesta'])) {
        $id_encuesta = mysqli_real_escape_string($con, (strip_tags($_REQUEST['id_encuesta'], ENT_QUOTES)));
        $sWhere = " AND pregunta.id_encuesta=$id_encuesta ";
    }

    if ($_GET['q'] != "") {
        $sWhere = "WHERE (";
        for ($i = 0; $i < count($aColumns); $i++) {
            $sWhere .= $aColumns[$i] . " LIKE '%" . $q . "%' OR ";
        }
        $sWhere = substr_replace($sWhere, "", -3);
        $sWhere .= ')';
    }

    include 'pagination.php'; //include pagination file
    //pagination variables
    $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
    $per_page = 10; //how much records you want to show
    $adjacents = 4; //gap between pages after number of adjacents
    $offset = ($page - 1) * $per_page;
    
    
    $pregunta = new Pregunta();
    $pregunta->setCondicion($sWhere);
    $pregunta->setOffset($offset);
    $pregunta->setPer_page($per_page);
    $pregunta->setCon($con);
    
    $result = Pregunta::recuperarPregunta($pregunta);

    $numrows = mysqli_num_rows($result);
    $total_pages = ceil($numrows / $per_page);
    $reload = './pregunta.php';
    //main query to fetch the data
    $query = $result;
    //loop through fetched data
    if ($numrows > 0) {
        ?>
        <div class="table-responsive">

            <table class="table">
                <tr  class="success">
                    <th>Nombre</th>
                    <th>Descripción</th>

                    <th class='text-right'>Acciones</th>

                </tr>
        <?php
        while ($row = mysqli_fetch_array($query)) {
            $id_pregunta = $row['id_pregunta'];
            $nombre_pregunta = $row['nombre_pregunta'];
            $descripcion_pregunta = $row['descripcion_pregunta'];
            ?>
                    <tr>

                        <td><strong><?php echo $nombre_pregunta; ?></strong></td>
                        <td ><?php echo $descripcion_pregunta; ?></td>


                        <td class='text-right'>
                            <a href="#" class='btn btn-default' title='Editar pregunta' data-nombre='<?php echo $nombre_pregunta; ?>' data-descripcion='<?php echo $descripcion_pregunta ?>' data-id='<?php echo $id_pregunta; ?>' data-toggle="modal" data-target="#editar_pregunta"><i class="glyphicon glyphicon-edit"></i></a> 
                            <a href="#" class='btn btn-default' title='Borrar pregunta' onclick="eliminarPregunta('<?php echo $id_pregunta; ?>')"><i class="glyphicon glyphicon-trash"></i> </a>
                        </td>

                    </tr>
            <?php
        }
        ?>
                <tr>
                    <td colspan=4><span class="pull-right">
        <?php
        echo paginate($reload, $page, $total_pages, $adjacents);
        ?></span></td>
                </tr>
            </table>
        </div>
                <?php
            }
        }
        ?>