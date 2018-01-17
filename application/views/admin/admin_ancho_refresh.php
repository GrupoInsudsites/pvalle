<!DOCTYPE html>
<html>
    <head>
        <title>Administrador Visitas</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <link  href="<?php echo base_url(); ?>assets/css/admin.css" rel="stylesheet" type="text/css" />
        
        <link  href="<?php echo base_url(); ?>assets/css/jquery-ui-1.8.14.custom.css" rel="stylesheet" type="text/css" />
        <link  href="<?php echo base_url(); ?>assets/datatables/media/css/demo_table.css" rel="stylesheet" type="text/css" />
        
         <link  href="<?php echo base_url(); ?>assets/css/form_style.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo base_url(); ?>assets/js/jquery-1.6.2.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery-ui-1.8.14.custom.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery-ui-timepicker-addon.js"></script>
        
        <script src="<?php echo base_url(); ?>assets/js/ui.dropslide.js"></script>
        <script src="<?php echo base_url();?>assets/ckeditor/ckeditor.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/styles.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/fancybox/jquery.fancybox-1.3.4.css" />
        <script src="<?php echo base_url(); ?>assets/fancybox/jquery.easing-1.3.pack.js"></script>
        <script src="<?php echo base_url(); ?>assets/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
        <script src="<?php echo base_url(); ?>assets/webcam/webcam.js"></script>
        <script> 
            base = "<?php echo base_url();?>";
        </script>
        <script src="<?php echo base_url(); ?>assets/js/script.js"></script>

        <script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/datatables/media/js/jquery.dataTables.js"></script>
        <script>
           
            $(document).ready(function() {
               
                
                $('.datatable').dataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": false
                });
                $( "#ingreso" ).datetimepicker({
                    dateFormat: 'yy-mm-dd',
                    timeFormat: 'hh:mm:ss',
                    changeMonth: true
                });
               $( "#fecha_desde" ).datetimepicker({
                    dateFormat: 'yy-mm-dd',
                    timeFormat: 'hh:mm:ss',
                    changeMonth: true
                });
                $( "#fecha_hasta" ).datetimepicker({
                    dateFormat: 'yy-mm-dd',
                    timeFormat: 'hh:mm:ss',
                    changeMonth: true
                }); 
               
                $.datepicker.setDefaults({
                    
                    dateFormat: 'dd/mm/yy'
                    
                });

                $('#datos_externo').submit(function() {

                    id_externo = $('#id_externo').val();
                    dni = $('#dni').val();
                    
                   url = base+'admin/eventos/update_externo'
                    $.post(url, $(this).serialize(), function(){
                        alert("DNI Actualizado");
                    });
                    

                    
                    return false;
                });

                var dates = $( "#from, #to" ).datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			numberOfMonths: 1,
			onSelect: function( selectedDate ) {
				var option = this.id == "from" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
			}
		});
                if($('#ciaSel')){
                    chequeaTipo();
                }
                $('#<?php echo $menusel; ?>').addClass('active');
                
            });
            
            function chequeaTipo(){
                valor = $('#ciaSel').val();
                //alert(valor);
                if(valor=='0'){
                    $('#selTipo').val(2);
                }
            };
            
            function checkAdmin(){
                valor = $('#selTipo').val();
                if(valor==1 || valor==10){
                    $('#trSelCia').css('visibility','hidden');
                    $('#passBlock').css('visibility','visible');
                
                }else if(valor==3){
                    $('#trSelCia').css('visibility','visible');
                    $('#passBlock').css('visibility','hidden');
                }else{
                    $('#trSelCia').css('visibility','hidden');
                    $('#passBlock').css('visibility','hidden');
                }
            }
            
            
            
            function llego(id){
                $.post("<?php echo base_url(); ?>admin/eventos/llego/"+id, function(data){
                    
                });

            }
            
            function sale(id,tipo){
                precio = $('#bar'+id).val();
                 $.post("<?php echo base_url(); ?>admin/ventas/sale/"+id+"/"+precio+"/"+tipo, 
                 function(data) {
                     alert("cantidad actualizada"); 
                  
                  
                 }, "json");
            }
            
            

            

            function timedRefresh(timeoutPeriod) {
                timer = setTimeout("location.reload(true);",timeoutPeriod);
            }
        </script>
         
    </head>
    <body onload="JavaScript:timedRefresh(15000);">
        

        <div id="main">
            <div style="position:relative; margin-left: 320px; text-align: center;height:90px; width:136px;">
                <a href="#" class="logo"><img src="<?php echo base_url(); ?>assets/img/grupoinsud.png"  alt=""   /></a>
            </div>
            <div id="header">
                
                <!--menu top-->
                <?php $this->load->view($menu_top); ?>
            </div>
            <div id="middle" style="width:1040px;">
                
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
    <script>

        
        $(".buscar").click(function(e) {
            criterio = $('#busqueda').val();
            
            window.location.href = "<?php echo base_url(); ?>admin/usuarios/index/0/"+criterio;
        })
        
        
        
        
        
        
        
       
        
    </script>
</html>
