<div class="table">
    <?php echo form_open_multipart(base_url().'admin/usuarios/crear'); ?>
    <table class="listing form" cellpadding="0" cellspacing="0">
        <tr>
            <th class="full" colspan="2">Registro de Usuarios</th>
            <input type="hidden" name="user[admin]" value="<?php echo $this->session->userdata('nombre').' '.$this->session->userdata('apellido');?>"/>
        </tr>
        
        
        
        <tr>
            <td width="172"><strong>Nombre</strong></td>
            <td><input type="text" name="user[nombre]" class="text" /></td>
        </tr>
        <tr>
            <td width="172"><strong>Apellido</strong></td>
            <td><input type="text" name="user[apellido]" class="text" /></td>
        </tr>
        <tr>
            <td width="172"><strong>Email</strong></td>
            <td><input type="text" name="user[email]" class="text" /></td>
        </tr>
        
        <tr>
            <td width="172"><strong>Tel&eacute;fono</strong></td>
            <td><input type="text" name="user[telefono]" class="text" /></td>
        </tr>
        <tr>
            <td width="172"><strong>Mobil</strong></td>
            <td><input type="text" name="user[mobil]" class="text" /></td>
        </tr>
        
        <tr>
            <td width="172"><strong>Barrio</strong></td>
            <td><?php
                
                
                echo form_dropdown('user[barrio]', $barrios, '');
                ?></td>
        </tr>
        <tr>
            <td width="172"><strong>Lote</strong></td>
            <td><input type="text" name="user[lote]" class="text" /></td>
        </tr>
        
        
       
        
        <tr>
            <td>&nbsp;</td>
            <td><?php echo form_submit('submit', 'Guardar'); ?></td>
        </tr>
    </table>
    <?php echo form_close(); ?>
</div>