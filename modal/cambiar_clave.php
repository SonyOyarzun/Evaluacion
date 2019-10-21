<?php
if (isset($con)) {
    ?>
    <!-- Modal -->
    <div class="modal fade" id="cambiar_clave" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Cambiar clave</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" id="editar_clave">
                        <div id="resultados_ajax_cambiar_clave"></div>

                        <div class="form-group">
                            <label for="clave-nueva" class="col-sm-4 control-label">Nueva clave</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="clave-nueva" placeholder="Nueva clave" pattern=".{6,}" title="Contraseña ( min . 6 caracteres)" required>
                                <input type="hidden" id="mod_clave_rut">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="clave-repetir" class="col-sm-4 control-label">Repite clave</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="clave-repetir"  placeholder="Repite clave" pattern=".{6,}" required>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="actualizar_datos3" onclick="editarClave()">Cambiar contraseña</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php
}
?>	