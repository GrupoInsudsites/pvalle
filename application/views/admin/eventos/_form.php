<h1><?php echo $title;?> </h1>
<?php
$data_nombre_empleado = array('name' => 'nombre_empleado', 'id' => 'nombre_empleado', 'size' => 60);
$data_nombre_invitado = array('name' => 'nombre_invitado', 'id' => 'nombre_invitado', 'size' => 60);
$data_ingreso = array('name' => 'ingreso', 'id' => 'ingreso', 'size' => 30);
$data_interno = array('name' => 'interno', 'id' => 'interno', 'size' => 30);


echo form_open_multipart(base_url().'admin/eventos/crear');
echo "<div id='panel'>";
echo form_fieldset();
echo "<p><label for='nombre_invitado'>Nombre Invitado:</label><br/>";
echo form_input($data_nombre_invitado) . "</p>";
echo "<p><label for='fecha_inicio'>fecha y hora estimada de ingreso </label><br/>";
echo form_input($data_ingreso) . "</p>";

echo "<p><label for='nombre_empleado'>Nombre Empleado:</label><br/>";
echo form_input($data_nombre_empleado) . "</p>";
echo "<p><label for='fecha_fin'>Interno del empleado</label><br/>";
echo form_input($data_interno) . "</p>";

echo "<p><label for='titulo'>Empresa</label><br/>";

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


echo form_dropdown('empresa', $empresa, '');



echo "</p>";
echo "<p><label for='texto'>Aclaraciones</label><br/>";
$this->ckeditor->editor("aclaracion", "",$config); 





echo form_submit('submit','crear invitacion');
echo form_close();
echo "<br><br>";

?>

