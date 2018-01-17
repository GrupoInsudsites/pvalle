<!DOCTYPE html>
<html>
    <head>
        <title>Administrador Invitaciones Grupo Insud</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <link  href="<?php echo base_url(); ?>assets/css/admin.css" rel="stylesheet" type="text/css" />
        
        <link  href="<?php echo base_url(); ?>assets/css/jquery-ui-1.8.14.custom.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo base_url(); ?>assets/js/jquery-1.6.2.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery-ui-1.8.14.custom.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery-ui-timepicker-addon.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
        
        <script src="<?php echo base_url(); ?>assets/js/ui.dropslide.js"></script>
        <script src="<?php echo base_url();?>assets/ckeditor/ckeditor.js" type="text/javascript"></script>
        

        <script>
            $(document).ready(function() {
                $( "#ingreso" ).datetimepicker({
                    dateFormat: 'yy-mm-dd',
                    timeFormat: 'hh:mm:ss',
                    changeMonth: true
                });
              
                $.datepicker.setDefaults({
                    
                    dateFormat: 'dd/mm/yy'
                    
                });
                $('#<?php echo $menusel; ?>').addClass('active');
                
            });

        </script>
    </head>
    <body>
        

        <div id="main">
            <div style="position:relative; margin-left: 320px; text-align: center;height:90px; width:136px;">
                <a href="#" class="logo"><img src="<?php echo base_url(); ?>assets/img/grupoinsud.png"  alt=""   /></a>
            </div>
            
            <div id="middle" style="width:900px;">
                
                <div id="center-column" style="width:800px; margin-left: 35px;">
                    <?php if (isset($listado)) { ?>
                        <!--listado-->
                        <?php $this->load->view($listado); ?>
                    <?php } ?>
                    <!--form tipo-->
                </div>
                
            </div>
            <div id="footer"></div>
        </div>
    </body>
    
</html>
