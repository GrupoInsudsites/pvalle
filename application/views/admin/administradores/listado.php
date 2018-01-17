
<div class="top-bar">
    <a href="<?php echo base_url(); ?>admin/administradores/crear" class="button nuevo">Nuevo Administrador </a>
    <h1>Administradores</h1>
    <div class="breadcrumbs"><a href="<?php echo base_url(); ?>admin/admin">Homepage</a> / <a href="<?php echo base_url(); ?>admin/administradores/index">Administradores</a></div>
</div>

<?php
if ($this->session->flashdata('message')) {
    echo "<div class='message'>" . $this->session->flashdata('message') . "</div> ";
}
?>
<div class="table">
    <table class="listing" cellpadding="0" cellspacing="0">
        <tr>
            

            <th>Nombre</th>
           
            <th>Email</th>
            
            <th>Editar</th>
            <th>Borrar</th>

        </tr>

        <?php
        if (isset($items) && count($items) > 0) {
            foreach ($items as $u) {
                ?>
                <tr>
                    


                    <td><?php echo $u->apellido.', '.$u->nombre;?> </td>
                    
                    <td class="style1"><?php echo $u->email; ?> </td>
                    
                   
                    <td><a href="<?php echo base_url(); ?>admin/administradores/editar/<?php echo $u->id; ?>" ><img src="<?php echo base_url(); ?>assets/img/edit-icon.gif" width="16" height="16" alt="" /></td>
                    <td><a href="<?php echo base_url(); ?>admin/administradores/borrar/<?php echo $u->id; ?>" class="borrausuario"  style="cursor:pointer;"><img src="<?php echo base_url(); ?>assets/img/hr.gif" width="16" height="16" alt="" /></a></td>
                </tr>
    <?php }
} else { ?>
            <tr><td>No Hay usuarios actualmente</td></tr>
        <?php } ?>

    </table>
    
</div>
