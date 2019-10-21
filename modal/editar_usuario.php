
<!-- Modal -->
    <div class="modal fade" id="editar_usuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Editar usuario</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" id="editar_usuario" name="editar_usuario">
                        <div id="resultados_ajax2"></div>

                        <div class="form-group">

                            <div class="col-sm-8"> 
                                <input type="hidden" id="mod_id" name="mod_id">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mod_nombre" class="col-sm-3 control-label">Nombres</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="mod_nombre" name="mod_nombre" placeholder="Nombres" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="mod_apellido" class="col-sm-3 control-label">Apellidos</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="mod_apellido" name="mod_apellido" placeholder="Apellidos" required>
                            </div>
                        </div>




                        <div class="form-group">
                            <label for="mod_genero" class="col-sm-3 control-label">Genero</label>
                            <div class="col-sm-8">
                                <select class='form-control' name='mod_genero' id='mod_genero' required>
                                    <option value="">Selecciona un Genero</option>
                                    <?php
                                    $query_genero = Genero::recuperarGenero();
                                    while ($rw = mysqli_fetch_array($query_genero)) {
                                        ?>
                                        <option value="<?php echo $rw['id_genero']; ?>"><?php echo $rw['nombre_genero']; ?></option>			
                                        <?php
                                    }
                                    ?>
                                </select>			  
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mod_tipo" class="col-sm-3 control-label">Tipo de Usuario</label>
                            <div class="col-sm-8">
                                <select class='form-control' name='mod_tipo' id='mod_tipo' required>
                                    <option value="">Selecciona un Tipo</option>
                                    <?php
                                    $query_tipo = TipoUsuario::recuperarTipoUsuario();
                                    while ($rw = mysqli_fetch_array($query_tipo)) {
                                        ?>
                                        <option value="<?php echo $rw['id_tipo_usuario']; ?>"><?php echo $rw['nombre_tipo_usuario']; ?></option>			
                                        <?php
                                    }
                                    ?>
                                </select>			  
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mod_departamento" class="col-sm-3 control-label">Departamento</label>
                            <div class="col-sm-8">
                                <select class='form-control' name='mod_departamento' id='mod_departamento' required>
                                    <option value="">Selecciona un Departamento</option>
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

                        <div class="form-group">
                            <label for="mod_email" class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="mod_email" name="mod_email" placeholder="Correo electrónico" required>
                            </div>
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="actualizar_datos" onclick="editarUsuario()">Actualizar datos</button>
                </div>
                </form>
            </div>
        </div>
    </div>
