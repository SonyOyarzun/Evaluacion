
<!-- Modal -->
<div class="modal fade" id="detalle_evaluacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"> 
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Promedio Por Pregunta</h4>
                </div>
                <div class="modal-body">
                    <div id="resultados"></div>

                    <div class="form-group">
                        <label for="id_evaluado1" class="col-sm-3 control-label">ID</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="id_evaluado1" name="id_evaluado" placeholder="ID" readonly="">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="nombre" class="col-sm-3 control-label">Nombre</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nombre1" name="nombre" placeholder="nombre" readonly="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="apellido" class="col-sm-3 control-label">Apellido</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="apellido1" name="apellido" placeholder="apellido" readonly="">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <canvas id="densityChart" width="600" height="400"></canvas>
                            <input type="hidden" name="imagen" id="imagen">
                            <input type="hidden" name="nombre_encuesta" id="nombre_encuesta" value="<?php echo $nombre_encuesta . " PROMEDIO "; ?>">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="citar" onclick="enviarMail(1)">Citar a Trabajador</button>
                </div>
            </form>  
        </div>
    </div>
</div>
