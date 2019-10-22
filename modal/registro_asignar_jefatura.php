
<!-- Modal -->
<div class="modal fade" id="asignar_encuesta_jefatura" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form class="form-horizontal" method="post" id="guardar_asignar2" name="guardar_asignar2">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2"><i class='glyphicon glyphicon-edit'></i> Asignar Encuesta</h4>
                </div>
                <div class="modal-body">

                    <div id="resultados_ajax_2"></div><!-- Carga respuestas ajax -->
                    <input type="hidden" name="id_encuesta" id="id_encuesta" value="<?php echo $id_encuesta; ?>">	
                    <input type="hidden" name="nombre_encuesta" id="nombre_encuesta" value="<?php echo $nombre_encuesta; ?>">


                    <div id="resultados_ajax_1"></div><!-- Carga los datos ajax -->
                    <div class='tabla_asignar'></div><!-- Carga los datos ajax -->


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" id="guardar_datos_2">Guardar datos</button>
                </div>
            </form>

        </div>
    </div>
</div>
