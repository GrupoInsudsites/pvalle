<h1><?php echo $title ?></h1>

<p><?php echo anchor(base_url() . "admin/eventos/crear", "Crear invitacion") ?></p>

<?php

$data_desde = array('name' => 'fecha_desde', 'id' => 'fecha_desde', 'size' => 30);
$data_hasta = array('name' => 'fecha_hasta', 'id' => 'fecha_hasta', 'size' => 30);
$criterio = array('name' => 'criterio', 'id' => 'criterio', 'size' => 30);
if ($this->session->flashdata('message')) {
    echo "<div class='message'>" . $this->session->flashdata('message') . "</div> ";
}

if ($eventos) {

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
            echo " <td> <span  class='botFoto' rel='".$list->idi."'> Tomar Foto</span>  </td> \n";
        }
        
       
       
        
        
        
        echo "<td align='center' > ";
        echo anchor(base_url() . 'admin/eventos/edit/' . $list->idi, '<img src="'.base_url().'assets/img/edit-icon.gif" alt="editar evento" width="16" height="16" alt="" />');
        echo " </td><td align='center' > ";
        echo anchor(base_url() . 'admin/eventos/delete_busqueda/' . $list->idi, '<img src="'.base_url().'assets/img/hr.gif" width="16" height="16" alt="borrar evento" />');
        
        echo " </td>\n";
        echo " </tr>\n";
    }
    echo " </table> ";

    echo form_close();


}else{
    echo "<span style='font-weight:bold;'>No hay invitaciones registradas para el dia de hoy (".date('d/m/Y').")</span>";
}
?>
 <div class="paginator"><?php echo $links; ?></div>
