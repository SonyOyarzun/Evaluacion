	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="detalle_fecha_ev" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"> 
            <div class="modal-dialog" role="document">
		<div class="modal-content">
                         <form method="POST">  
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i><label id="etiqueta"></label> </h4>
		  </div>
		  <div class="modal-body">
			<div id="resultados2"></div>
                 
                            
                         <div class="form-group">
				<label for="rut" class="col-sm-3 control-label">Rut</label>
				<div class="col-sm-8">
                                    <input type="text" class="form-control" id="id_evaluado2" name="id_evaluado" placeholder="Rut" readonly="">
				</div>
			  </div>
                        
                        
                        <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Nombre</label>
				<div class="col-sm-8">
                                    <input type="text" class="form-control" id="nombre2" name="nombre" placeholder="nombre" readonly="">
				</div>
			  </div>
                        
                        <div class="form-group">
				<label for="apellido" class="col-sm-3 control-label">Apellido</label>
				<div class="col-sm-8">
                                    <input type="text" class="form-control" id="apellido2" name="apellido" placeholder="apellido" readonly="">
				</div>
			  </div>
                         <div class="form-group">
				<label for="evaluador" class="col-sm-3 control-label">Evaluado Por</label>
				<div class="col-sm-8">
                                    <input type="text" class="form-control" id="evaluador2" name="evaluador" placeholder="evaluador" readonly="">
				</div>
			  </div>
                          <div class="form-group">
				<div class="col-sm-12">
                             <canvas id="densityChart2" width="600" height="400"></canvas>
				</div>
			  </div>
                          <div class="form-group">
				<div class="col-sm-8">
                                    <input type="hidden" name="imagen" id="imagen2">
                                    <input type="hidden" name="nombre_encuesta" id="nombre_encuesta2" value="<?php echo $nombre_encuesta;?>">
				</div>
			  </div>
                         
                        <div class="form-group">
               
				<div class="col-sm-12 control-label">
                             
                                    <table class="table" >
                                            <thead>
                                                <tr>
                                                    <th style="width: 60%">Criterio a Evaluar</th>
                                                    <th>Comentario</th>
                                                </tr>
                                            </thead>
                                            <tbody id="preg_coment" >
                                              
                                            </tbody>
                                        </table>

				</div>
			  </div>
                        
                      <div class="form-group">
                             <label for="comentario" class="col-sm-12 control-label text-center">Comentario General</label>
				<div class="col-sm-12 control-label text-center">
                                    <div id="comentario"></div>
				</div>
			  </div>
                        
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="citar2" onclick="enviarMail(2)">Citar a Trabajador</button>
		  </div>
                    
                    </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>