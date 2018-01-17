<h1><?php echo $title ?></h1>

<p><?php echo anchor(base_url() . "admin/eventos/crear", "Crear invitacion") ?></p>

<?php

$data_desde = array('name' => 'fecha_desde', 'id' => 'fecha_desde', 'size' => 30);
$data_hasta = array('name' => 'fecha_hasta', 'id' => 'fecha_hasta', 'size' => 30);
$criterio = array('name' => 'criterio', 'id' => 'criterio', 'size' => 30);
if ($this->session->flashdata('message')) {
    echo "<div class='message'>" . $this->session->flashdata('message') . "</div> ";
}
if (count($eventos)) {
    echo "<table border='1' cellspacing='0' cellpadding='4' width='970'>\n";
    echo " <tr valign='top'> \n";
    echo " <th> Nombre empleado</th><th>interno</th><th>Empresa</th><th>Nombre Invitado</th><th>Aclaraciones</th><th>ingreso</th><th>Foto</th><th> Edita </th><th>Borra</th> \n";
    echo " </tr> \n";
    foreach ($eventos as $key => $list) {

        echo " <tr valign='top'> \n";

        echo " <td> " . $list->nombre_empleado . " </td> \n";
        echo " <td> " . $list->interno . " </td> \n";
        echo " <td> " . $list->empresa . " </td> \n";

        echo " <td> " . $list->nombre_invitado . " </td> \n";
        echo " <td> " . $list->aclaracion . " </td> \n";
        echo " <td> " . $list->ingreso . " </td> \n";
        if($list->foto!=''){
            echo " <td> <img src='" .base_url().'assets/fotos_invitados/'.$list->foto. "' width='100' class='inv' />  </td> \n";
        }else{
            echo " <td> <span  class='botFoto' rel='".$list->id."'> Tomar Foto</span>  </td> \n";
        }
        
       
       
        
        
        
        echo "<td align='center' > ";
        echo anchor(base_url() . 'admin/eventos/edit/' . $list->id, '<img src="'.base_url().'assets/img/edit-icon.gif" alt="editar evento" width="16" height="16" alt="" />');
        echo " </td><td align='center' > ";
        echo anchor(base_url() . 'admin/eventos/delete_busqueda/' . $list->id, '<img src="'.base_url().'assets/img/hr.gif" width="16" height="16" alt="borrar evento" />');
        
        echo " </td>\n";
        echo " </tr>\n";
    }
    echo " </table> ";

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
<div style="position:relative;width:230px; height:150px; left: 260px; top: -182px; border:1px solid #000; margin-top:10px; margin-bottom:10px; padding: 10px;">
    <span style="font-weight: bold;margin-left:60px;">B&uacute;squeda</span>
<?php
echo form_open_multipart(base_url().'admin/eventos/busca');

    echo "<p><label for='criterio'>Criterio de busqueda: </label><br/>";
    echo form_input($criterio) . "</p>";
   

    echo form_submit('submit','buscar');
echo form_close();
?>
</div>
<div id="photos"></div>

<div id="camera">
    <span class="tooltip"></span>
    <span class="camTop"></span>
    
    <div id="screen"></div>
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