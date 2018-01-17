<h1><?php echo $title ?></h1>

<br>

<?php

$data_desde = array('name' => 'fecha_desde', 'id' => 'fecha_desde', 'size' => 30);
$data_hasta = array('name' => 'fecha_hasta', 'id' => 'fecha_hasta', 'size' => 30);
$criterio = array('name' => 'criterio', 'id' => 'criterio', 'size' => 30);
if ($this->session->flashdata('message')) {
    echo "<div class='message'>" . $this->session->flashdata('message') . "</div> ";
}

if ($eventos) {
    ?>
    <hr>
    <span style="font-size:18px; font-weight:bold; color: #222;">Las visitas al llegar</span>
    <hr>
    <table id='example' class='display datatable' border='0' cellspacing='0' cellpadding='0' >

        <thead>
            <tr>
                <th>Nombre empleado</th>
                <th>Nombre Visita</th>
                <th>Interno</th>
                <th>Empresa</th>
                <th>Aclaraciones</th>
                
                <th>Hora</th>
                <th>Llego</th>

                
            </tr>
        </thead>
        <tbody>
            <?php
            
            if($eventos){
                foreach ($eventos as $key => $list) {
                    echo " <tr valign='top'> \n";
                    echo " <td> " . $list->nombre_empleado . " </td> \n";
                    echo " <td> " . $list->nombre_invitado . " </td> \n";
                    echo " <td> " . $list->interno . " </td> \n";
                    echo " <td> " . $list->empresa . " </td> \n";
                    echo " <td> " . $list->aclaracion . " </td> \n";
                    
                    echo " <td> " . $list->hora . " </td> \n";
                    
                    echo "<td><input type='checkbox' class='che' name='llego' onclick='llego(".$list->idi.")'></td>";
                    echo " </tr>\n";
                }
            }
            ?> 
        </tbody>
    </table> 
    <?php
    echo form_close();


   

}else{
    echo "<span style='font-weight:bold;'>No hay invitaciones registradas para el dia de hoy (".date('d/m/Y').")</span>";
}




if ($llegaron) {

    ?>

    <br><br>
    <hr>
    <span style="font-size:18px; font-weight:bold; color: #222;">Las visitas que ya llegaron</span>
    <hr>
    <table id='example' class='display datatable' border='0' cellspacing='0' cellpadding='0' >

        <thead>
            <tr>
                <th>Nombre empleado</th>
                <th>Nombre Invitado</th>
                <th>interno</th>
                <th>Empresa</th>
                <th>Aclaraciones</th>
                
                
                <th>Hora a la que lleg&oacute;</th>

                
            </tr>
        </thead>
        <tbody>
            <?php
            
            if($llegaron){
                foreach ($llegaron as $key1 => $list1) {
                    echo " <tr valign='top'> \n";
                    echo " <td> " . $list1->nombre_empleado . " </td> \n";
                    echo " <td> " . $list1->nombre_invitado . " </td> \n";
                    echo " <td> " . $list1->interno . " </td> \n";
                    echo " <td> " . $list1->empresa . " </td> \n";
                    echo " <td> " . $list1->aclaracion . " </td> \n";
                    
                    
                    echo " <td> " . $list1->llegada . " </td> \n";
                    
                     
                    echo " </tr>\n";
                }
            }
            ?> 
        </tbody>
    </table> 
    <?php
    echo form_close();


   

}
?>


 