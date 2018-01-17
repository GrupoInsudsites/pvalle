<?php $this->load->view('header'); ?>
<h1><?php echo $title;?> </h1>
<?php
$data_nombre_empleado = array( 'class'=>"input", 'name' => 'nombre_empleado', 'id' => 'nombre_empleado', 'size' => 60, 'value'=>set_value('nombre_empleado'));
$data_nombre_invitado = array('class'=>"input",'name' => 'nombre_invitado', 'id' => 'nombre_invitado', 'size' => 60, 'value'=>set_value('nombre_invitado'));
$data_ingreso = array('class'=>"input",'name' => 'ingreso', 'id' => 'ingreso', 'size' => 30, 'value'=>set_value('ingreso'));
$data_interno = array('class'=>"input",'name' => 'interno', 'id' => 'interno', 'size' => 30, 'value'=>set_value('interno'));

echo validation_errors(); 
$attributes = array('id' => 'form');
echo form_open_multipart(base_url().'admin/eventos/crear', $attributes );
echo "<div id='panel'>";
echo form_fieldset();
echo validation_errors(); 
echo '<div class="field">';
	echo "<label for='nombre_invitado'>Nombre Invitado:</label>";
	echo form_input($data_nombre_invitado);
echo "</div>";

echo '<div class="field">';
	echo "<label for='fecha_inicio'>Ingreso (fecha y hora)</label>";
	echo form_input($data_ingreso);
echo "</div>";

echo '<div class="field">';
	echo "<label for='nombre_empleado'>Nombre Empleado:</label>";
	echo form_input($data_nombre_empleado);
echo "</div>";

echo '<div class="field">';
	echo "<label for='fecha_fin'>Interno del empleado</label>";
	echo form_input($data_interno);
echo "</div>";

echo '<div class="field">';
echo "<label for='estado'>Empresa</label>";

$empresas['Insud']='Insud';
$empresas['Solantu']='Solantu';
$empresas['Cisa']='Cisa';
$empresas['Yacaré Pora']='Yacaré Pora';
$empresas['KS Films']='KS Films';
$empresas['Condor Express']='Condor Express';
$empresas['Romikin']='Romikin';
$empresas['LMD']='LMD';
$empresas['Pharmadn']='Pharmadn';
$empresas['Simposium']='Simposium';
$empresas['FMS']='FMS';
$empresas['Garruchos']='Garruchos';
$empresas['ACAF']='ACAF';
$empresas['Casares']='Casares';

$conf_drop = 'class="estado" id="estado"';
    foreach($empresas as $k=>$v){
        $empresa[$k] = $v;
    }


echo form_dropdown('empresa', $empresa,'', $conf_drop);
echo "</div>";


echo '<div class="field">';
	echo '<div class="field">';
	echo "<label for='estado'>Lo invitaron? </label>";
	echo form_radio('quien', 'insud', TRUE);
	echo "</div>";
	echo '<div class="field">';
	echo "<label for='estado'>o pidio entrevista? </label>";
	echo form_radio('quien', 'pedido');
	echo "</div>";
echo "</div>";


echo "<label for='texto'>Aclaraciones</label>";

echo "<br/>";

echo "<br/>";
$this->ckeditor->editor("aclaracion", set_value('aclaracion'),$config, $conf_drop); 






echo form_submit('submit','crear invitacion', ' class="submit" ');
echo form_close();
echo "<br><br>";

$this->load->view('footer'); ?>
