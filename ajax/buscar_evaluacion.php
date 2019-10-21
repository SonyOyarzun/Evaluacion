<?php
include('is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado

require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos
include '../Clases/Pregunta.php';
include '../Clases/Usuario.php';
include '../Clases/Historial.php';
include '../Clases/Departamento.php';
include '../Clases/Encuesta.php';
$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';

if ($action == 'ajax') {
    // escaping, additionally removing everything that could be (html/javascript-) code
    $id_asignacion = intval($_REQUEST['id_asignacion']);
    $id_encuesta = intval($_REQUEST['id_encuesta']);
    $tipo = intval($_REQUEST['tipo_encuesta']);
    $id_departamento = $_SESSION['departamento_usuario'];
    $sWhere = "";

    $pregunta = new Pregunta();
    $pregunta->setEncuesta($id_encuesta);
    $pregunta->setCondicion($sWhere);

    $result = Pregunta::recuperarPregunta($pregunta);

    $numrows = mysqli_num_rows($result);
   
    $query = $result;
    //loop through fetched data
    if ($numrows > 0) {
        ?>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <td colspan="2" style="text-align: center"><strong class="form-control">Evaluador : <?php echo $_SESSION['nombre_usuario'] . " " . $_SESSION['apellido_usuario'];
        ; ?></strong></td>
                        <td colspan="3" style="text-align: center"><strong class="form-control">A Evaluar</strong></td>
                        <td colspan="1" style="text-align: center">
                            <select id="t_evaluar" name="t_evaluar" class="form-control">
                                <?php
                                $historial = new Historial();
                                $historial->setId_asignacion($id_asignacion);

                                $departamento = new Departamento();
                                $departamento->setId($id_departamento);

                                $encuesta = new Encuesta();
                                $encuesta->setTipo($tipo);
                                $encuesta->setCon($con);

                                $query_tipo = Usuario::verificarUsuarioPorEvaluar($historial, $departamento, $encuesta);
                                while ($rw = mysqli_fetch_array($query_tipo)) {

                                    $id = $rw['id_usuario'];
                                    $nombre = $rw['nombre_usuario'];
                                    $apellido = $rw['apellido_usuario'];

                                    if ($rw['id_usuario'] == $_SESSION['id_usuario']) {
                                        $nombre = "auto";
                                        $apellido = "evaluacion";
                                    }
                                    ?>
                                    <option value="<?php echo $id; ?>"><?php echo "[" . $id . "] - " . $nombre . " " . $apellido ?></option>			
                                    <?php
                                }
                                ?>
                            </select></td> 
                    </tr>

                </thead>
                <tr  class="success">
                    <th>Criterio a Evaluar</th>
                    <th style="text-align: center">Nivel 1</th>
                    <th style="text-align: center">Nivel 2</th>
                    <th style="text-align: center">Nivel 3</th>
                    <th style="text-align: center">Nivel 4</th>
                    <th>Comentario</th>


                </tr>
        <?php
        $id_dinamico = 0;
        while ($row = mysqli_fetch_array($query)) {

            $id_pregunta = $row['id_pregunta'];
            $nombre_pregunta = $row['nombre_pregunta'];
            $descripcion_pregunta = $row['descripcion_pregunta'];
            ?>
                    <tr>

                        <td><input type="hidden" name="id_pregunta[]" id="id_pregunta" value="<?php echo $id_pregunta; ?>"> <strong><?php echo $nombre_pregunta; ?></strong><br><?php echo $descripcion_pregunta; ?></td>
                        <td ><input class="form-control" type="radio" name="calificacion<?php echo $id_dinamico ?>" value="1" required ></td>
                        <td ><input class="form-control" type="radio" name="calificacion<?php echo $id_dinamico ?>" value="2" required ></td>
                        <td ><input class="form-control" type="radio" name="calificacion<?php echo $id_dinamico ?>" value="3" required ></td>
                        <td ><input class="form-control" type="radio" name="calificacion<?php echo $id_dinamico ?>" value="4" required ></td>
                        <td ><textarea class="form-control" type="text" name="comentario_pregunta[]" id="comentario_pregunta"></textarea></td>


                    </tr>

            <?php
            $id_dinamico++;
        }
        ?>
                <tr>
                <input type="hidden" name="dinamico" id="dinamico" value="<?php echo $id_dinamico ?>">
                <td colspan=4><span class="pull-right">
                <?php
                echo paginate($reload, $page, $total_pages, $adjacents);
                ?></span></td>
                </tr>
                <tfoot>
                    <tr>
                        <td colspan="8" style="text-align: center">   Comentario General </td>  

                    </tr>  
                    <tr>

                        <td colspan="8"><textarea class="form-control" type="text" name="comentario_final" id="comentario_final" required ></textarea></td>    
                    </tr> 
                    <tr>
                        <td colspan="8" style="text-align: center">
                            <button id="guardar_datos" class="btn btn-primary btn-lg">Enviar</button>       
                        </td>    

                    </tr>
                    
                </tfoot>
            </table>
        </div>
        <?php
    }
}
?>