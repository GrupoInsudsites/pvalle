<!DOCTYPE html>
<html>
    <head>
        
        <meta charset="UTF-8">
        <title>Administrador Invitaciones Grupo Insud</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <link  href="<?php echo base_url(); ?>assets/css/admin.css" rel="stylesheet" type="text/css" />
        
        
        <link  href="<?php echo base_url(); ?>assets/css/jquery-ui-1.10.2.custom.css" rel="stylesheet" type="text/css" />
        <link  href="<?php echo base_url(); ?>assets/css/jquery.ui.timepicker.css" rel="stylesheet" type="text/css" />
 <link  href="<?php echo base_url(); ?>assets/datatables/media/css/demo_table.css" rel="stylesheet" type="text/css" />
        
        <link  href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

       
        <script src="<?php echo base_url(); ?>assets/js/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>assets/ckeditor/ckeditor.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery-ui-1.10.2.custom.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.ui.timepicker.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/validation-rules.js"></script>
        <script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/datatables/media/js/jquery.dataTables.js"></script>

        <script src="<?php echo base_url(); ?>assets/js/ui.dropslide.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
       
        <script> 
            base = "<?php echo base_url();?>";
        </script>
        <style>
        .error{
            color:#f00;
            padding:4px;
            border: 1px solid #f00;
            
        }
        </style>
        <script>
            
            $(document).ready(function() {
                $('#example').dataTable({
                    "aaSorting": [[ 0, 'desc' ]],
                    "aLengthMenu": [[ 50, -1], [10, 50, "Todas"]],
                    "iDisplayLength": 10,
                    

                });

                $('#example1').dataTable({
                    "aaSorting": [[ 0, 'desc' ]],
                    "aLengthMenu": [[ 50, -1], [10, 50, "Todas"]],
                    "iDisplayLength": 10,
                    
                    
                });
                
                // check keyup on quantity inputs to update totals field
                
                
               
                
                


               


                $( "#nombre" ).autocomplete({
                    minLength: 2,
                    source: '<?php echo base_url(); ?>invitaciones/get_invitados1',
                    focus: function( event, ui ) {
                        $( "#nombre" ).val( ui.item.nombre );
                        return false;
                    },
                    select: function( event, ui ) {
                        $( "#nombre" ).val( ui.item.nombre );
                        $( "#dni" ).val( ui.item.dni );
                        
                       
                        return false;
                    }
                })
                .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
                   
                        return $( "<li>" )
                        .append( "<a>" + item.nombre + "</a>" )
                        .appendTo( ul );
                    
                };
  
              
            });

        </script>
    </head>
    <body>
        

        <div id="main">
            <div style="position:relative; margin-left: 320px; text-align: center;height:90px; width:136px;">
                <a href="#" class="logo1"><img src="<?php echo base_url(); ?>assets/img/logo2.png"  alt=""   /></a>
            </div>
            
            