<?php
include('is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos
include '../Clases/Encuesta.php';

$con = Conexion::conectar();

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';
if (isset($_GET['id'])) {
    $id_encuesta = intval($_GET['id']);
    
    $encuesta = new Encuesta();
    $encuesta->setId($id_encuesta);
    $encuesta->setCon($con);
    
    if ($delete = Encuesta::eliminarEncuesta($encuesta)) {
        ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Aviso!</strong> Encuesta eliminada exitosamente.
        </div>
        <meta http-equiv="refresh" content="2;URL='encuesta.php'" />  
        <?php
    } else {
        ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
        </div>
        <?php
    }
}
if ($action == 'ajax') {
    // escaping, additionally removing everything that could be (html/javascript-) code
    $q = mysqli_real_escape_string($con, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
    $fecha_inicio = mysqli_real_escape_string($con, (strip_tags($_REQUEST['fecha_inicio'], ENT_QUOTES)));
    $fecha_termino = mysqli_real_escape_string($con, (strip_tags($_REQUEST['fecha_termino'], ENT_QUOTES)));

    $aColumns = array('nombre_encuesta', 'tipo_encuesta'); //Columnas de busqueda

    $sWhere = "";

    $sWhere .= " AND (";
    for ($i = 0; $i < count($aColumns); $i++) {
        $sWhere .= $aColumns[$i] . " LIKE '%" . $q . "%' OR ";
    }
    $sWhere = substr_replace($sWhere, "", -3);
    $sWhere .= ')';

    if (($fecha_inicio && $fecha_termino) != "") {
        $sWhere .= " AND fecha_agregado BETWEEN '$fecha_inicio' AND '$fecha_termino' ";
    }

    $encuesta = new Encuesta();
    $encuesta->setCondicion($sWhere);
    
    $result = Encuesta::recuperarEncuesta($encuesta);
    $numrows = mysqli_num_rows($result);
 
    //main query to fetch the data

    $query = $result;
    //loop through fetched data
    if ($numrows > 0) {
        ?>

        <?php
        $nums = 1;
        while ($row = mysqli_fetch_array($query)) {
            $id_encuesta = $row['id_encuesta'];
            $nombre_encuesta = $row['nombre_encuesta'];
            $tipo_nombre = $row['nombre_tipo_encuesta'];
            $id_tipo = $row['id_tipo_encuesta'];
            $fecha_agregado = $row['fecha_encuesta'];
            ?>

            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 thumb text-center ng-scope" ng-repeat="item in records">
                <a class="thumbnail" href="pregunta.php?id_encuesta=<?php echo $id_encuesta; ?>&tipo_encuesta=<?php echo $id_tipo; ?>&nombre_encuesta=<?php echo $nombre_encuesta; ?>">

                    <img class="img-responsive" src="img/encuesta.png" alt="<?php echo $comentario_encuesta; ?>">

                </a>
                <span class="thumb-name"><strong><?php echo $nombre_encuesta; ?></strong></span>
                <span class="thumb-code ng-binding"><?php echo $fecha_agregado; ?></span>
                <span class="thumb-name"><?php echo $tipo_nombre; ?></span>
            </div>
            <?php
            if ($nums % 6 == 0) {
                echo "<div class='clearfix'></div>";
            }
            $nums++;
        }
        ?>
        <?php
    }
}
?>
