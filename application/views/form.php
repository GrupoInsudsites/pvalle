<?php $this->load->view('header'); 
//date_default_timezone_set('America/Argentina/Buenos_Aires');

?>



<?php
$attributes = array('id' => 'form');
echo form_open_multipart(base_url().'invitaciones/guarda', $attributes );
?>
<div class="container" style="border-top: 1px solid #333;">
	<div class="row row-centered">
			
			<div class="col-md-6" style="border-right: 1px solid #333; background-color:#ccc;">
			<div style="display:none;">
			<?php echo validation_errors(); ?>
			</div>
				<h3 class="titulos">Registro de entradas </h3>
				<div class="form-group">
					<label for='nombre_invitado'>Nombre y Apellido de la Visita:</label>
					<input type="text" id="nombre" name="nombre" value="<?php echo set_value('nombre'); ?>"  class="form-control"/>
				</div>
				<div class="form-group">
					
					<label for='tipovisita'>Tipo de visita:</label>
					<select name="tipovisita" class="form-control">
						<option value="empleado">Empleado</option>
						<option value="visita">Visita</option>
						<option value="contratista">Contratista</option>
						<option value="pasajero">Pasajero</option>

					</select>
					
				</div>

				<div class="form-group">
					<label for='dni'>DNI:</label>
					<input type="text" id="dni" name="dni" value="<?php echo set_value('dni'); ?>" class="form-control"/>
					
				</div>
				<div class="form-group">

					<label for='dominio'>Dominio:</label>
					<input type="text" name="dominio" id="dominio" value="<?php echo set_value('dominio'); ?>" class="form-control"/>
					
				</div>
				<div class="form-group">
				<h4>Unidades de negocio:</h4>
					<input type="hidden" name="vivero" value='0' />
					<input type="hidden" name="forestal" value='0' />
					<input type="hidden" name="ganaderia" value='0' />
					<input type="hidden" name="hotel" value='0' />
					<input type="hidden" name="yacare" value='0' />
					<input type="hidden" name="otros" value='0' />

					<label for='vivero'  class="checkbox-inline">
						<input type="checkbox" id="vivero" name="vivero" value="1" />Vivero 
					</label>
					<label for='forestal'  class="checkbox-inline">
						<input type="checkbox" id="forestal" name="forestal"  value="1" />Forestal 
					</label>
					<label for='ganaderia'  class="checkbox-inline">
						<input type="checkbox" id="ganaderia" name="ganaderia"  value="1" />Ganadería 
					</label>
					<label for='hotel'  class="checkbox-inline">
						<input type="checkbox" id="hotel" name="hotel"  value="1" />Hotel 
					</label>
					<label for='yacare'  class="checkbox-inline">
						<input type="checkbox" id="yacare" name="yacare"  value="1" />Yacaré Porá 
					</label>
					<label for='otros'  class="checkbox-inline">
						<input type="checkbox" id="otros" name="otros"  value="1" />Otro
					</label>
					
				</div>

				<div class="form-group">
					<label for='observaciones'>Observaciones:</label>
					<textarea name="observaciones" class="form-control"></textarea>
					
				</div>
				<div class="form-group">
					<?php echo form_submit('submit','crear visita', ' class="btn btn-primary" '); echo form_close()?>
				</div>
			</div>


			<!-- panel derecho -->

			<div class="col-md-6" style="height:528px; overflow-y:scroll">
				<h3 class="titulos">Visitas activas </h3>
					<table id='example' class='display datatable'>
						<thead>
							<tr>
								<th>Ingreso</th>
								<th>Nombre</th>
								<th>Dominio</th>
								<th>Salida</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							if(isset($activos)){ 
							foreach ($activos as $a) { ?>
								<tr>
									<td><?php 
											$ingreso = date_create($a->ingreso);
											echo date_format($ingreso, 'd-m-Y H:i:s');

									?></td>
									<td><?php echo $a->nombre; ?></td>
									<td><?php echo $a->dominio; ?></td>
									<td>
									<?php if($a->status=='no'){
										$salida = date_create($a->salida);
										echo date_format($salida, 'd-m-Y H:i:s');
										}else{?>
											<a class="btn btn-primary"  data-toggle="modal" data-target="#myModal" title="">Salida</a>
										<?php } ?>
								</tr>

								<div class="modal fade" id="myModal">
								  <div class="modal-dialog">
								    <div class="modal-content">
								      <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								        <h4 class="modal-title">Patente de salida</h4>
								      </div>
								      <?php
										$attributes = array('id' => 'form');
										echo form_open_multipart(base_url().'invitaciones/salida/' . $a->id, $attributes );
										?>
								      <form action="<?php echo base_url(); ?><?php echo $a->id; ?>" method="post">
									      <div class="modal-body">
									        <p>Por favor escriba la patente de salida</p>
									        <input type="text" name="patente_salida" class="form form-control" required>
									      </div>
									      <div class="modal-footer">
									        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
											<?php echo form_submit('submit','Guardar salida', ' class="btn btn-primary" ');
									     	echo form_close();
											?>

									      </div>
								      </form>
								    </div><!-- /.modal-content -->
								  </div><!-- /.modal-dialog -->
								</div><!-- /.modal -->
							<?php } 
							}?>
						</tbody>
						<tr></tr>
					</table>
					
						
					
			</div>
	</div>
	<div class="col-md-12" style="padding:10px;border-top: 1px solid #333;">
		
		
				<h3  class="titulos">Visitas terminadas </h3>
					<table id='example1' class='display datatable'>
						<thead>
							<tr>
								<th>Ingreso</th>
								<th>Nombre</th>
								<th>Dominio</th>
								<th>Patente de salida</th>
								<th>DNI</th>
								<th>Sedes</th>
								<th>Salida</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							if(isset($inactivos)){ 
							foreach ($inactivos as $ia) { ?>
								<tr>
									<td><?php 
											$ingreso = date_create($ia->ingreso);
											echo date_format($ingreso, 'd-m-Y H:i:s');

									?></td>
									<td><?php echo $ia->nombre; ?></td>
									<td><?php echo $ia->dominio; ?></td>
									<td><?php echo $ia->patente_salida; ?></td>
									<td><?php echo $ia->dni; ?></td>
									<td><?php echo $ia->sede; ?></td>
									<td>
									<?php 
										$salida = date_create($ia->salida);
										echo date_format($salida, 'd-m-Y H:i:s');
									?>
									
								</tr>
							<?php } 
							}?>
						</tbody>
						<tr></tr>
					</table>
					
						
					
		

	</div>
</div>
<?php


echo "<div id='panel'>";

?>

<?php


echo "<br><br>";

$this->load->view('footer'); ?>
