
<!-- Modal -->
<div class="modal fade" id="asignar_encuesta_general" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Asignar Encuesta</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" id="guardar_asignar" name="guardar_asignar">
                    <div id="resultados_ajax_3"></div><!-- Carga respuestas ajax -->
                    <input type="hidden" name="id_encuesta" id="id_encuesta" value="<?php echo $id_encuesta; ?>">
                    <input type="hidden" name="nombre_encuesta" id="nombre_encuesta" value="<?php echo $nombre_encuesta; ?>">

                    <div class="form-group">
                        <label for="asinarDepartamento" class="col-sm-3 control-label">Departamento</label>
                        <div class="col-sm-8">
                            <select class='form-control' name='asinarDepartamento' id='asinarDepartamento' required onchange="recuperarUsuarioDepartamento(this.value)">
                                <option value="0">Selecciona un Departamento</option>

                              <?php                                  
                                    $departamento = new Departamento();
                                    $query_departamento = Departamento::recuperarDepartamento($departamento);
                                    while ($rw = mysqli_fetch_array($query_departamento)) {
                                        ?>
                                        <option value="<?php echo $rw['id_departamento']; ?>"><?php echo $rw['nombre_departamento']; ?></option>			
                                        <?php
                                    }
                                    ?>

                            </select>			  
                        </div>
                    </div>




                    <div id="resultados"></div><!-- Carga los datos ajax  icono -->
                    <div class='tabla_asignar'></div><!-- Carga los datos ajax -->


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" id="guardar_datos">Guardar datos</button>
            </div>
            </form>
        </div>
    </div>
</div>
