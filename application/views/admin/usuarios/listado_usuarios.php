
<div class="top-bar" style="width:780px;">
    <a href="<?php echo base_url(); ?>admin/usuarios/crear" class="button nuevo">Nuevo Usuario </a>
    <h1>Usuarios</h1>
    <div class="breadcrumbs"><a href="<?php echo base_url(); ?>admin/admin">Homepage</a> / <a href="<?php echo base_url(); ?>admin/usuarios/index">Usuarios</a></div>
</div>
<div class="select-bar">
    
        <label>
            <?php if( $criterio != ''){ ?>
            <input type="text" name="textfield" value="<?php echo $criterio;?>" id="busqueda" />
            <?php }else{ ?>
            <input type="text" name="textfield"  id="busqueda" />
            <?php } ?>
        </label>
        <label>
            <input type="submit" name="Submit" value="Buscar" class="buscar" />
        </label>
   
</div>
<?php
if ($this->session->flashdata('message')) {
    echo "<div class='message'>" . $this->session->flashdata('message') . "</div> ";
}
?>
<div class="table" style="width:780px;">
    <table class="listing" cellpadding="0" cellspacing="0" style="width:780px;">
        <tr>
            

            <th>Nombre</th>
           
            <th>Email</th>
            <th>Telefono</th>
            <th>Mobil</th>
            
            <th>Barrio</th>
            <th>Lote</th>
            <th>Editar</th>
            <th>Borrar</th>

        </tr>

        <?php
        if (isset($usuarios) && count($usuarios) > 0) {
            foreach ($usuarios as $u) {
                ?>
                <tr>
                    


                    <td><?php echo $u->apellido.', '.$u->nombre;?> </td>
                    
                    <td class="style1"><?php echo $u->email; ?> </td>
                    
                    <td class="style1"><?php echo $u->telefono; ?> </td>
                    <td class="style1"><?php echo $u->mobil; ?> </td>
                    <td class="style1"><?php echo $u->barrio_titulo; ?> </td>
                    <td class="style1"><?php echo $u->lote; ?> </td>
                    
                    <td><a href="<?php echo base_url(); ?>admin/usuarios/editar/<?php echo $u->id; ?>" ><img src="<?php echo base_url(); ?>assets/img/edit-icon.gif" width="16" height="16" alt="" /></td>
                    <td><a href="<?php echo base_url(); ?>admin/usuarios/borrar/<?php echo $u->id; ?>" class="borrausuario"  style="cursor:pointer;"><img src="<?php echo base_url(); ?>assets/img/hr.gif" width="16" height="16" alt="" /></a></td>
                </tr>
    <?php }
} else { ?>
            <tr><td>No Hay usuarios actualmente</td></tr>
        <?php } ?>

    </table>
    <div class="select">
        <strong>Otras P&aacute;ginas: </strong>
           
        <select class="paginador">
            <?php
            $pagina = (int) ceil($cant / 10);

            for ($a = 0; $a < $pagina; $a++) {
                if ($pag_sel == ($a)) {
                    ?>
                    <option value="<?php echo $a; ?>" selected><?php echo $a + 1; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $a; ?>"><?php echo $a + 1; ?></option>
                <?php }
            } ?>
        </select>
    </div>
</div>
