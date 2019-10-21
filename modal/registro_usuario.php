
    <!-- Modal -->
    <div class="modal fade" id="nuevo_usuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar nuevo usuario</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" id="guardar_usuario" name="guardar_usuario">
                        <div id="resultados_ajax"></div>
                        <div class="form-group">
                            <label for="id" class="col-sm-3 control-label">ID</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="id" name="id" placeholder="ID" required maxlength="12" onkeyup="validar_rut(this.id)">
                                <small class="rut-error"></small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nombre" class="col-sm-3 control-label">Nombres</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombres" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="apellido" class="col-sm-3 control-label">Apellidos</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellidos" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="genero" class="col-sm-3 control-label">Genero</label>
                            <div class="col-sm-8">
                                <select class='form-control' name='genero' id='genero' required>
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
                            <label for="tipo" class="col-sm-3 control-label">Tipo de Usuario</label>
                            <div class="col-sm-8">
                                <select class='form-control' name='tipo' id='tipo' required>
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
                            <label for="departamento" class="col-sm-3 control-label">Departamento</label>
                            <div class="col-sm-8">
                                <select class='form-control' name='departamento' id='departamento' required>
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
                            <label for="email" class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password_nueva" class="col-sm-3 control-label">Contraseña</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="password_nueva" name="password_nueva" placeholder="Contraseña" pattern=".{6,}" title="Contraseña ( min . 6 caracteres)" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password_repetir" class="col-sm-3 control-label">Repite contraseña</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="password_repetir" name="password_repetir" placeholder="Repite contraseña" pattern=".{6,}" required>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary guardar_datos" onclick="registrarUsuario()">Guardar datos</button>
                </div>
                </form>
            </div>
        </div>
    </div>
