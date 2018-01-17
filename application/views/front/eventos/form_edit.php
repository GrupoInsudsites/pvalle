<h1><?php echo $title;?></h1>
<?php
$data_titulo = array('name' => 'titulo', 'id' => 'titulo', 'size' => 60,'value' =>$evento['titulo']);
$data_lugar = array('name' => 'lugar', 'id' => 'lugar', 'size' => 60,'value' =>$evento['lugar']);
$data_texto = array('name' => 'texto', 'id' => 'texto' ,'rows'=>10,'cols'=>45,'value' =>$evento['texto']);
$data_fecha_inicio = array('name' => 'fecha_inicio', 'id' => 'fecha_inicio', 'size' => 30,'value' =>$evento['fecha_inicio']);
$data_fecha_fin = array('name' => 'fecha_fin', 'id' => 'fecha_fin', 'size' => 30,'value' =>$evento['fecha_fin']);


echo form_open_multipart(base_url().'admin/eventos/edit');
echo "<div id='panel'>";
            echo form_fieldset();
echo "<p><label for='titulo'>Nombre Empleado</label><br/>";
echo form_input($data_titulo) . "</p>";
echo "<p><label for='lugar'>Nombre Invitado</label><br/>";
echo form_input($data_lugar) . "</p>";
echo "<p><label for='texto'>Aclaraciones</label><br/>";
$this->ckeditor->editor("texto", $evento['texto'],$config) . "</p>";
echo "<p><label for='fecha_inicio'>fecha y hora estimada de ingreso</label><br/>";
echo form_input($data_fecha_inicio) . "</p>";
echo "<p><label for='fecha_fin'>fecha y hora estimada de salida</label><br/>";
echo form_input($data_fecha_fin) . "</p>";
echo "<br><br>";

echo form_hidden('id',$evento['id'] );

echo form_submit('submit','editar invitacion');
echo form_close();
echo "<br><br>";
echo anchor(base_url()."admin/eventos/index","volver");
?>

