<h1><?php echo $title;?></h1>
<?php


$data_nombre_empleado = array('class'=>"input",'name' => 'nombre_empleado', 'id' => 'nombre_empleado', 'size' => 60,'value' =>$evento['nombre_empleado']);
$data_nombre_invitado = array('class'=>"input",'name' => 'nombre_invitado', 'id' => 'nombre_invitado', 'size' => 60,'value' =>$evento['nombre_invitado']);
$data_ingreso = array('class'=>"input",'name' => 'ingreso', 'id' => 'ingreso' ,'rows'=>10,'cols'=>45,'value' =>$evento['ingreso']);
$data_interno = array('class'=>"input",'name' => 'interno', 'id' => 'interno', 'size' => 30,'value' =>$evento['interno']);

$attributes = array('id' => 'form');

echo form_open_multipart(base_url().'admin/eventos/edit',$attributes);
echo "<div id='panel'>";
echo form_fieldset();

echo '<div class="field">';
	echo "<label for='lugar'>Nombre Invitado</label>";
	echo form_input($data_nombre_invitado);
echo '</div>';

echo '<div class="field">';
	echo "<label for='fecha_inicio'>Ingreso (fecha y hora)</label>";
	echo form_input($data_ingreso);
echo '</div>';

echo '<div class="field">';
	echo "<label for='titulo'>Nombre Empleado</label>";
	echo form_input($data_nombre_empleado);
echo '</div>';

echo '<div class="field">';
	echo "<label for='fecha_fin'>Interno del empleado</label>";
	echo form_input($data_interno);
echo '</div>';

echo '<div class="field">';
echo "<label for='titulo'>Empresa</label>";

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


    foreach($empresas as $k=>$v){
        $empresa[$k] = $v;
    }
$conf_drop = 'class="drop_edit" id="estado"';



echo form_multiselect('empresa', $empresa, $evento['empresa'],$conf_drop);

echo '</div>';

echo '<div class="field">';
	echo '<div class="field">';
	echo "<label for='estado'>Lo invitaron? </label>";
	if($evento['quien']=='insud'){
		echo form_radio('quien', 'insud', TRUE);
	}else{
		echo form_radio('quien', 'insud');
	}
	echo "</div>";
	echo '<div class="field">';
	echo "<label for='estado'>o pidio entrevista? </label>";
	if($evento['quien']=='pedido'){
		echo form_radio('quien', 'pedido', TRUE);
	}else{
		echo form_radio('quien', 'pedido');
	}
	
	echo "</div>";
echo "</div>";

echo '<div class="field">';
	echo "<label for='texto'>Aclaraciones</label><br/>";
	echo "<br><br>";
	$this->ckeditor->editor("aclaracion", $evento['aclaracion'],$config) . "</p>";
echo '</div>';

echo "<br>";

echo form_hidden('id',$evento['id'] );

echo form_submit('submit','editar invitacion');
echo form_close();
echo "<br><br>";
echo anchor(base_url()."admin/eventos/index","volver");
?>







