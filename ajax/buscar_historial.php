<?php
include('is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado

require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos
include '../Clases/Historial.php';

$con = Conexion::conectar();

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';

if ($action == 'ajax') {
    // escaping, additionally removing everything that could be (html/javascript-) code
    $usuario = $_SESSION['id_usuario'];
    $q = mysqli_real_escape_string($con, (strip_tags($_REQUEST['q'], ENT_QUOTES)));

    $aColumns = array('historial.nombre_encuesta'); //Columnas de busqueda
    $sWhere = "";

    $sWhere .= "  AND  (";
    for ($i = 0; $i < count($aColumns); $i++) {
        $sWhere .= $aColumns[$i] . " LIKE '%" . $q . "%' OR ";
    }
    $sWhere = substr_replace($sWhere, "", -3);
    $sWhere .= ')';

    $historial = new Historial();
    $historial->setCondicion($sWhere);

    $result = Historial::recuperarEncuestaHistorial($historial);
    $numrows = mysqli_num_rows($result);

    $query = $result;
    //loop through fetched data
    if ($numrows > 0) {
        ?>

        <?php
        $nums = 1;
        while ($row = mysqli_fetch_array($query)) {
            $id_encuesta = $row['id_encuesta'];
            $nombre_encuesta = $row['nombre_encuesta'];
            $tipo_encuesta = $row['nombre_tipo_encuesta'];
            ?>

            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 thumb text-center ng-scope" ng-repeat="item in records">
                <a class="thumbnail" href="historial2.php?id_encuesta=<?php echo $id_encuesta; ?>&nombre_encuesta=<?php echo $nombre_encuesta; ?>">

                    <img class="img-responsive" src="img/encuesta.png" alt="<?php echo $comentario_encuesta; ?>">

                </a>
                <span class="thumb-name"><strong><?php echo $nombre_encuesta; ?></strong></span>
                <span class="thumb-name"><?php echo $tipo_encuesta; ?></span>

            </div>
            <?php
            if ($nums % 6 == 0) {
                echo "<div class='clearfix'></div>";
            }
            $nums++;
        }
            }
        }
        ?>
