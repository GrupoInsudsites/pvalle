<!DOCTYPE html>
<html>
    <head>
        <title>Administrador Invitaciones Grupo Insud</title>
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
        <script src="<?php echo base_url(); ?>assets/js/script1.js"></script>
        <script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/datatables/media/js/jquery.dataTables.js"></script>

        <script>
            $(document).ready(function() {
                
                $('#example').dataTable({
                    "aLengthMenu": [[ 50, -1], [50, "Todas"]],
                    "iDisplayLength": 50
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
                
                $.datepicker.regional['es'] = {
                    closeText: 'Cerrar',
                    prevText: '<anterior',
                    nextText: 'Siguiente>',
                    currentText: 'Actual',
                    monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                    monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','jul','Ago','Sep','Oct','Nov','Dic'],
                    dayNames: ['Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo'],
                    dayNamesShort: ['Lun','Mar','Mie','Jue','Vie','Sab','Dom'],
                    dayNamesMin: ['Lu','Ma','Mi','Ju','Vi','Sa','Do'],
                    weekHeader: 'Не',
                    dateFormat: 'yy-mm-dd',
                    firstDay: 0,
                    isRTL: false,
                    showMonthAfterYear: false,
                    yearSuffix: ''
                };
                $.datepicker.setDefaults($.datepicker.regional['es']);

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
               
                $('#<?php echo $menusel; ?>').addClass('active');


                $('#datos_externo').submit(function() {

                    id_externo = $('#id_externo').val();
                    dni = $('#dni').val();
                    
                   url = base+'admin/eventos/update_externo'
                    $.post(url, $(this).serialize(), function(){
                        alert("DNI Actualizado");
                    });
                    

                    
                    return false;
                });
            });
            
            
            
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
            
           
            
            
            
           

            function timedRefresh(timeoutPeriod) {
                setTimeout("location.reload(true);",timeoutPeriod);
            }
        </script>
    </head>
    <body>
       

        <div id="main">
            <div style="position:relative; margin-left: 320px; text-align: center;height:90px; width:136px;">
                <a href="#" class="logo"><img src="<?php echo base_url(); ?>assets/img/grupoinsud.png"  alt=""   /></a>
            </div>
            <div id="header">
                
                <!--menu top-->
                <?php $this->load->view($menu_top); ?>
            </div>
            <div id="middle" style="width:1120px;">
                
                <div id="center-column" style="width:1040px; margin-left: 35px;">
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
