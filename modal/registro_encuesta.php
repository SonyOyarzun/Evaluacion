	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="nueva_encuesta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar nueva encuesta</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="guardar_encuesta" name="guardar_encuesta">
			<div id="resultados_ajax_productos"></div>
                        		  
			  <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Nombre</label>
				<div class="col-sm-8">
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre de Encuesta" maxlength="255" >
				  
				</div>
			  </div> 
                        
                        
                        
                         <div class="form-group">
				<label for="tipo_encuesta" class="col-sm-3 control-label">Tipo de Encuesta</label>
				<div class="col-sm-8">
					<select class='form-control' name='tipo_encuesta' id='tipo_encuesta' required>
						<option value="">Selecciona un tipo</option>
							<?php
                                        $query_genero = mysqli_query($con, "select * from tipoencuesta order by id_tipoencuesta");
                                        while ($rw = mysqli_fetch_array($query_genero)) {
                                            ?>
                                            <option value="<?php echo $rw['id_tipoencuesta']; ?>"><?php echo $rw['nombre_tipoencuesta']; ?></option>			
                                            <?php
                                        }
                                        ?>
					</select>			  
				</div>
			  </div>
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="guardar_datos" onclick="registrarEncuesta()">Guardar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
        

	<?php
		}
	?>