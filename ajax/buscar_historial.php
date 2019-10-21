<?php
include('is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database */
require_once ("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos
include '../Clases/Historial.php';

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


    include 'pagination.php'; //include pagination file
    //pagination variables
    $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
    $per_page = 18; //how much records you want to show
    $adjacents = 4; //gap between pages after number of adjacents
    $offset = ($page - 1) * $per_page;
    //Count the total number of row in your table*/

    $historial = new Historial();
    $historial->setCondicion($sWhere);
    $historial->setOffset($offset);
    $historial->setPer_page($per_page);
    $historial->setCon($con);
    
    $result = Historial::recuperarEncuestaHistorial($historial);
    $numrows = mysqli_num_rows($result);
    $total_pages = ceil($numrows / $per_page);
    $reload = 'notificacion.php';

    $query = $result;
    //loop through fetched data
    if ($numrows > 0) {
        ?>

        <?php
        $nums = 1;
        while ($row = mysqli_fetch_array($query)) {
            $id_encuesta = $row['id_encuesta'];
            $nombre_encuesta = $row['nombre_encuesta'];
            $tipo_encuesta = $row['nombre_tipoencuesta'];
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
        ?>
        <div class="clearfix"></div>
        <div class='row text-center'>
            <div ><?php
        echo paginate($reload, $page, $total_pages, $adjacents);
        ?></div>
        </div>

                <?php
            }
        }
        ?>
