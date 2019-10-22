<?php
include('is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado

require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos
include '../Clases/Historial.php';
include '../Clases/Calificacion.php';
include '../Clases/Encuesta.php';
include '../Clases/Usuario.php';

$con = Conexion::conectar();

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';



if ($action == 'ajax') {

    $usuario = $_SESSION['id_usuario'];



    if (isset($_GET['id_encuesta'])) {
        $id_encuesta = intval($_GET['id_encuesta']);

        if (!isset($q)) {

            $aColumns = array('historial.id_evaluado'); //Columnas de busqueda
            $q = mysqli_real_escape_string($con, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
            $fecha_inicio = mysqli_real_escape_string($con, (strip_tags($_REQUEST['fecha_inicio'], ENT_QUOTES)));
            $fecha_termino = mysqli_real_escape_string($con, (strip_tags($_REQUEST['fecha_termino'], ENT_QUOTES)));

            $sWhere = "";
            $sWhere .= "  AND (";
            for ($i = 0; $i < count($aColumns); $i++) {
                $sWhere .= $aColumns[$i] . " LIKE '%" . $q . "%' OR ";
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ')';



            if (($fecha_inicio && $fecha_termino) != "") {
                $sWhere .= " AND historial.fecha_historial BETWEEN '$fecha_inicio' "
                        . " AND '$fecha_termino' ";
            }
        }
    
        $historial = new Historial();
        $historial->setEncuesta($id_encuesta);
        $historial->setCondicion($sWhere);
     
        
        $result = Historial::recuperarHistorial($historial);
        $numrows = mysqli_num_rows($result);
        
        $query = $result;



        if ($numrows > 0) {
            ?>
            <div class="table-responsive">

                <table class="table text-center">
                    <tr  class="success">
                        <th class="text-center">ID Evaluado</th>
                        <th class="text-center">Evaluado</th>
                        <th class="text-center">Cargo Evaluado</th>
                        <th class="text-center">ID Evaluador</th>
                        <th class="text-center">Evaluador</th>
                        <th class="text-center">Cargo Evaluador</th>
                        <th class="text-center">Fecha Evaluacion</th>


                    </tr>
            <?php
            while ($row = mysqli_fetch_array($query)) {

                $id_evaluado  = $row['id_evaluado'];
                $id_evaluador = $row['id_usuario'];
                $cargo = $row['nombre_tipo_encuesta'];
                $fecha = $row['fecha_historial'];

                //obtener datos evaluador  
                $usuario = new Usuario();
                $usuario->setId($id_evaluador);
   
                $recuperar_evaluador = Usuario::recuperarUsuario($usuario);
                $cargo_evaluador = "";
                $nombre_evaluador = "";
                $apellido_evaluador = "";
                while ($row = mysqli_fetch_array($recuperar_evaluador)) {
                    $cargo_evaluador = $row['nombre_tipo_usuario'];
                    $nombre_evaluador = $row['nombre_usuario'];
                    $apellido_evaluador = $row['apellido_usuario'];
                }
                  //obtener datos evaluado  
                $usuario = new Usuario();
                $usuario->setId($id_evaluado);
                
                $recuperar_evaluado = Usuario::recuperarUsuario($usuario);
                $cargo_evaluado = "";
                $nombre_evaluado = "";
                $apellido_evaluado = "";
                while ($row = mysqli_fetch_array($recuperar_evaluado)) {
                    $cargo_evaluado = $row['nombre_tipo_usuario'];
                    $nombre_evaluado = $row['nombre_usuario'];
                    $apellido_evaluado = $row['apellido_usuario'];
                }
                ?>
                        <tr>
                            <td class='bg-warning'><h5><?php echo $id_evaluado; ?></h4></td>
                            <td class='bg-warning'><h5><a data-toggle="modal" href="#detalle_evaluacion" data-id="<?php echo $id_evaluado; ?>" data-nombre="<?php echo $nombre_evaluado; ?>" data-apellido="<?php echo $apellido_evaluado; ?>" data-encuesta="<?php echo $_GET['id_encuesta']; ?>"><?php echo $nombre_evaluado . " " . $apellido_evaluado; ?></a></h4></td>
                            <th class='bg-warning'><h5><?php echo $cargo; ?></h4></th>
                            <td><h5><?php echo $id_evaluador; ?></h4></td>
                            <td><h5><?php echo $nombre_evaluador . " " . $apellido_evaluador ?></h4></td>
                            <th><h5><?php echo $cargo_evaluador; ?></h4></th>
                            <td  class='bg-warning'><a data-toggle="modal" href="#detalle_fecha_ev" data-id="<?php echo $id_evaluado; ?>" data-nombre="<?php echo $nombre_evaluado; ?>" data-apellido="<?php echo $apellido_evaluado; ?>" data-id_evaluador="<?php echo $id_evaluador; ?>" data-nomb_evaluador="<?php echo $nombre_evaluador . " " . $apellido_evaluador; ?>" data-fecha="<?php echo $fecha; ?>"><h5><?php echo $fecha; ?></h4></a></td>

                            <td>

                            </td>


                        </tr>
                <?php
            }
            ?>
                </table>
            </div>
                                <?php
                            }
                        }


                        if (isset($_GET['id_evaluado']) && (isset($_GET['id_enc']))) {
                            $id_enc = intval($_GET['id_enc']);
                            $id_evaluado = mysqli_real_escape_string($con, (strip_tags($_REQUEST['id_evaluado'], ENT_QUOTES)));

                            $calificacion = new Calificacion();
                            $calificacion->setEvaluado($id_evaluado);
                        
                            $encuesta = new Encuesta();
                            $encuesta->setId($id_enc);
                            
                            $query = Historial::recuperarPromedio($calificacion,$encuesta);

                            $i = 0;
                            while ($row = mysqli_fetch_array($query)) {

                                $json[$i] = $row['avg(nota_calificacion)'];
                                $json2[$i] = $row['nombre_pregunta'];
                                $i++;
                            }

                            echo '[{"notas":' . json_encode($json) . ',';
                            echo ' "preguntas":' . json_encode($json2) . '}]';
                        }

                        if (isset($_GET['fecha']) && (isset($_GET['id_evaluador']))) {

                            $id_evaluado = mysqli_real_escape_string($con, (strip_tags($_REQUEST['id_evaluado'], ENT_QUOTES)));
                            $id_evaluador = mysqli_real_escape_string($con, (strip_tags($_REQUEST['id_evaluador'], ENT_QUOTES)));
                            $fecha = mysqli_real_escape_string($con, (strip_tags($_REQUEST['fecha'], ENT_QUOTES)));

                            $historial = new Historial();
                            $historial->setUsuario($id_evaluador);
                            $historial->setEvaluado($id_evaluado);
                            $historial->setFecha($fecha);

                            $query = Historial::recuperarDetallePorFecha($historial);

                            $i = 0;
                            while ($row = mysqli_fetch_array($query)) {
                                $json_notas[$i]         = $row['nota_calificacion'];
                                $json_preguntas[$i]     = $row['nombre_pregunta'];
                                $json_preg_descrip[$i]  = $row['descripcion_pregunta'];
                                $json_preg_coment[$i]   = $row['comentario_calificacion'];
                                $i++;
                            }

                            $historial = new Historial();
                            $historial->setEvaluado($id_evaluado);
                            $historial->setUsuario($id_evaluador);
                            $historial->setFecha($fecha);

                            $query = Historial::recuperarComentarioGeneral($historial);

                            $i = 0;
                            while ($row = mysqli_fetch_array($query)) {
                                $json_com_gen[$i] = $row['descripcion_comentario_general'];
                                $i++;
                            }
                            echo '[{"notas":'       . json_encode($json_notas) . ',';
                            echo ' "preguntas":'    . json_encode($json_preguntas) . ',';
                            echo ' "preg_desc":'    . json_encode($json_preg_descrip) . ',';
                            echo ' "preg_coment":'  . json_encode($json_preg_coment) . ',';
                            echo ' "comentarios":'  . json_encode($json_com_gen) . '}]';
                        }
                    }
                    ?>

