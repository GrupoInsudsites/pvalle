<h1 class="completo"><?php echo $title ?></h1>

<p><?php 
$atributos = array('id'=>'crear');
echo anchor(base_url() . "admin/eventos/crear", "Crear invitacion", $atributos) ?></p>
<br>

<?php

$data_desde = array('name' => 'fecha_desde', 'id' => 'fecha_desde', 'size' => 30);
$data_hasta = array('name' => 'fecha_hasta', 'id' => 'fecha_hasta', 'size' => 30);
$criterio = array('name' => 'criterio', 'id' => 'criterio', 'size' => 30);
if ($this->session->flashdata('message')) {
    echo "<div class='message'>" . $this->session->flashdata('message') . "</div> ";
}
if (count($eventos)) {
    ?>
    <table id='example' class='display datatable' border='0' cellspacing='0' cellpadding='0' >

        <thead>
            <tr>
                <th>Nombre empleado</th>
                <th>Nombre Visita</th>
                <th>Interno</th>
                <th>Empresa</th>
                <th>Aclaraciones</th>
                <th>Fecha</th>
                <th>Hora</th>
                <?php if ($admin == 1){ ?>
                    <th> Edita </th>
                    
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($eventos as $key => $list) {
                echo " <tr valign='top'> \n";
                echo " <td> " . $list->nombre_empleado . " </td> \n";
                echo " <td> " . $list->nombre_invitado . " </td> \n";
                echo " <td> " . $list->interno . " </td> \n";
                echo " <td> " . $list->empresa . " </td> \n";
                
                echo " <td> " . $list->aclaracion . " </td> \n";
                echo " <td> " . $list->ingreso . " </td> \n";
                echo " <td> " . $list->hora . " </td> \n";
                if ($admin == 1){ 
                    echo "<td align='center' > ";
                    echo anchor(base_url() . 'admin/eventos/edit/' . $list->idi, '<img src="'.base_url().'assets/img/edit-icon.gif" alt="editar evento" width="16" height="16" alt="" />');
                    
                    
                    
                    echo " </td>\n";
                }
                echo " </tr>\n";
            }
            ?>
        </tbody>
    </table> 
    <?php
    echo form_close();


    }
?>
 <div class="paginator"><?php echo $links; ?></div>
<div style="width:230px; height:150px; border:1px solid #000; margin-top:10px; margin-bottom:10px; padding: 10px;">
    <span style="font-weight: bold;margin-left:60px;">Exportar a Excel</span>
<?php
echo form_open_multipart(base_url().'admin/eventos/excel');

    echo "<p><label for='fecha_desde'>Fecha desde </label><br/>";
    echo form_input($data_desde) . "</p>";
    echo "<p><label for='fecha_hasta'>Fecha hasta </label><br/>";
    echo form_input($data_hasta) . "</p>";

    echo form_submit('submit','Exportar excel');
echo form_close();
?>
</div>

<div id="photos"></div>

<div id="camera">
    <span class="tooltip"></span>
    <span class="camTop"></span>
    
    <div id="screen">


    </div>
    <div id ="form_invitado" >
    <?php
        $attrs = array('id'=>'datos_externo');
        echo form_open_multipart('#', $attrs);
        $nombre = array('name' => 'nombre', 'id' => 'nombre', 'size' => 30, 'value'=>'');
        $dni = array('name' => 'dni', 'id' => 'dni', 'size' => 30, 'value'=>'');
       
        echo "<p><label for='nombre'>Nombre </label><br/>";
        echo form_input($nombre). "</p>";
        echo "<br>";

        echo "<p><label for='dni'>DNI </label><br/>";
        echo form_input($dni). "</p>";
        
        echo "<input type='hidden' name='id_externo' id='id_externo' value=''/>";
        echo "<br>";
        echo "<br>";
        echo form_submit('submit','Actualizar');
        echo form_close();
    ?>
    </div>
    <div id="buttons">
        <div class="buttonPane">
            <a id="shootButton" href="" class="blueButton">Tomar Foto!</a>
        </div>
        <div class="buttonPane hidden">
            <a id="cancelButton" href="" class="blueButton">Cancelar</a> <a id="uploadButton" href="" class="greenButton">Confirmar!</a>
        </div>
    </div>
    
    <span class="settings"></span>
</div>