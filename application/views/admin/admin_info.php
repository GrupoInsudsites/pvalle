<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
	$base = base_url();
	$js = $base.'assets/js/';
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Entrada Puerto Valle</title>
<link rel="stylesheet" href="<?php echo $base;?>assets/css/screen.css" type="text/css" media="screen" title="default" />
<link rel="stylesheet" href="<?php echo $base;?>assets/bootstrap/css/bootstrap.min.css" type="text/css" media="screen" title="default" />

<!--[if IE]>
<link rel="stylesheet" media="all" type="text/css" href="css/pro_dropline_ie.css" />
<![endif]-->

<!--  jquery core -->
<script src="<?php echo $js;?>jquery-1.4.1.min.js" type="text/javascript"></script>
<!--  checkbox styling script -->
<script src="<?php echo $js;?>ui.core.js" type="text/javascript"></script>
<script src="<?php echo $js;?>jquery.bind.js" type="text/javascript"></script>
<![if !IE 7]>
<!--  styled select box script version 1 -->
<script src="<?php echo $js;?>jquery.selectbox-0.5.js" type="text/javascript"></script>
<![endif]>
<!--  styled select box script version 2 -->
<script src="<?php echo $js;?>jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>
<!--  styled file upload script -->
<script src="<?php echo $js;?>jquery.filestyle.js" type="text/javascript"></script>
<!-- Custom jquery scripts -->
<script src="<?php echo $js;?>custom_jquery.js" type="text/javascript"></script>
<!-- Tooltips -->
<script src="<?php echo $js;?>jquery.tooltip.js" type="text/javascript"></script>
<script src="<?php echo $js;?>jquery.dimensions.js" type="text/javascript"></script>
<!--  date picker script -->
<link rel="stylesheet" href="<?php echo $base;?>assets/css/datePicker.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $base;?>assets/jqplot/jquery.jqplot.min.css" type="text/css" />
<script src="<?php echo $js;?>date.js" type="text/javascript"></script>
<script src="<?php echo $js;?>jquery.datePicker.js" type="text/javascript"></script>
<!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
<script src="<?php echo $js;?>jquery.pngFix.pack.js" type="text/javascript"></script>
<link  href="<?php echo $base; ?>assets/js/ui-lightness/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css" />
<link  href="<?php echo $base; ?>assets/datatables/media/css/demo_table.css" rel="stylesheet" type="text/css" />
<script src="<?php echo $base; ?>assets/js/jquery-1.9.1.js"></script>
<script src="<?php echo $base; ?>assets/js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="<?php echo $base; ?>assets/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="<?php echo $base; ?>assets/js/jquery-ui-timepicker-addon.js"></script>
<script src="<?php echo $base; ?>assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo $base; ?>assets/datatables/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo $base; ?>assets/js/scripts.js"></script>
<script src="<?php echo $base; ?>assets/jqplot/jquery.jqplot.min.js"></script>
<script class="include" language="javascript" type="text/javascript" src="<?php echo $base; ?>assets/jqplot/plugins/jqplot.pieRenderer.min.js"></script>
  <script class="include" language="javascript" type="text/javascript" src="<?php echo $base; ?>assets/jqplot/plugins/jqplot.donutRenderer.min.js"></script>
<script>
            var baseurl = "<?php print base_url(); ?>";
            $(document).ready(function() {
                $('#example1').dataTable();
                $.datepicker.setDefaults({
                    dateFormat: 'dd/mm/yy'
                });

                if($( "#desde" )){
                    $( "#desde" ).datepicker({
                        dateFormat: 'yy-mm-dd',
                        changeMonth: true,
                        onClose: function( selectedDate ) {
                            $( "#hasta" ).datepicker( "option", "minDate", selectedDate );
                        }
                    });
                }
                if($( "#hasta" )){
                    $( "#hasta" ).datepicker({
                        dateFormat: 'yy-mm-dd',
                        changeMonth: true,
                    });
                }

                /**/
                <?php 
                switch ($select) {
                    case 1:
                        # Ganaderia, Forestal, Casa principal, Otros
                        ?>
                        var data = [ 
                               
                                ['Forestal ( '+<?php echo $emp['forestal']; ?> +' visitas)', <?php echo $emp['forestal']; ?>], 
                                ['Ganadería ( '+<?php echo $emp['ganaderia']; ?>+ ' visitas)', <?php echo $emp['ganaderia']; ?>], 
                               
                                ['Casa Principal ('+<?php echo $emp['yacare']; ?>+' visitas)', <?php echo $emp['yacare']; ?>], 
                                ['Otros ('+<?php echo $emp['otros']; ?>+' visitas)', <?php echo $emp['otros']; ?> ] 
                            ]
                        <?php 
                        break;
                     case 2:
                        # Gafosa
                        # Forestal, Ganaderia, recursos humanos, Administracion
                        ?>
                        var data = [ 
                               
                                ['Forestal ( '+<?php echo $emp['forestal']; ?> +' visitas)', <?php echo $emp['forestal']; ?>], 
                                ['Ganadería ( '+<?php echo $emp['ganaderia']; ?>+ ' visitas)', <?php echo $emp['ganaderia']; ?>], 
                                ['Recursos Humanos ( '+<?php echo $emp['yacare']; ?>+ ' visitas)', <?php echo $emp['yacare']; ?>], 
                                ['Administracion ( '+<?php echo $emp['hotel']; ?>+ ' visitas)', <?php echo $emp['hotel']; ?>], 
                                ['Ganadería ( '+<?php echo $emp['ganaderia']; ?>+ ' visitas)', <?php echo $emp['ganaderia']; ?>], 
                               
                               
                                ['Otros ('+<?php echo $emp['otros']; ?>+' visitas)', <?php echo $emp['otros']; ?> ] 
                            ]
                        <?php 
                        break;
                     case 3:
                        # igual
                        ?>
                        var data = [ ['Vivero ( ' + <?php echo $emp['vivero']; ?> + ' visitas)', <?php echo $emp['vivero']; ?>],
                            ['Forestal ( '+<?php echo $emp['forestal']; ?> +' visitas)', <?php echo $emp['forestal']; ?>], 
                            ['Ganadería ( '+<?php echo $emp['ganaderia']; ?>+ ' visitas)', <?php echo $emp['ganaderia']; ?>], 
                            ['Hotel ('+<?php echo $emp['hotel']; ?>+' visitas)', <?php echo $emp['hotel']; ?>],
                            ['Yacaré Porá ('+<?php echo $emp['yacare']; ?>+' visitas)', <?php echo $emp['yacare']; ?>], 
                            ['Otros ('+<?php echo $emp['otros']; ?>+' visitas)', <?php echo $emp['otros']; ?> ] ]
                        <?php 
                        break;
                     case 4:
                        # Forestal
                        ?>
                         var data = [ 
                               
                                ['Forestal ( '+<?php echo $emp['forestal']; ?> +' visitas)', <?php echo $emp['forestal']; ?>], 

                               
                               
                                ['Otros ('+<?php echo $emp['otros']; ?>+' visitas)', <?php echo $emp['otros']; ?> ] 
                            ]
                        <?php 
                        break;
                     case 5:
                        # Forestal, Imprgnadora, FRESA,

                        ?>
                        var data = [ 
                              
                                ['Forestal ( '+<?php echo $emp['forestal']; ?> +' visitas)', <?php echo $emp['forestal']; ?>], 
                                ['Fresa ( '+<?php echo $emp['ganaderia']; ?>+ ' visitas)', <?php echo $emp['ganaderia']; ?>], 
                                ['Impregnadora ('+<?php echo $emp['hotel']; ?>+' visitas)', <?php echo $emp['hotel']; ?>],
                                ['Otros ('+<?php echo $emp['otros']; ?>+' visitas)', <?php echo $emp['otros']; ?> ] 
                            ]
                        <?php 
                        break;
                    
                    default:
                        # code...
                        ?>

                        <?php 

                        break;
                }

                 ?>
               
                          var plot1 = jQuery.jqplot ('grafico', [data], 
                            { 
                              seriesDefaults: {
                                // Make this a pie chart.
                                renderer: jQuery.jqplot.PieRenderer, 
                                rendererOptions: {
                                  // Put data labels on the pie slices.
                                  // By default, labels show the percentage of the slice.
                                  showDataLabels: true,
                                  // Add a margin to seperate the slices.
                                    sliceMargin: 4,
                                    
                                },

                              }, 
                              legend: {
                                        show: true,
                                        fontSize: '20px',
                                        
                                        location: 'e'
                                    }
                            }
                          );

                /**/

                });

           
        </script>

</head>
<body>
<!-- Start: page-top-outer -->
<div id="page-top-outer">
    <div id="page-top">
	   <div id="logo" style="margin-top:5px;">
	       <img width="200"src="<?php echo base_url(); ?>assets/img/logoGi.png" alt="" />
	   </div>
       <div class="clear"></div>
    </div>

</div>
<div id="header">
                
                <!--menu top-->
                <?php $this->load->view($menu_top); ?>
            </div>
<div class="clear">&nbsp;</div>



<div class="clear"></div>
<div id="content-outer">
<div id="content">
	<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
	<tr>
		<th rowspan="3" class="sized"><img src="<?php echo $base; ?>assets/images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
		<th class="topleft"></th>
		<td id="tbl-border-top">&nbsp;</td>
		<th class="topright"></th>
		<th rowspan="3" class="sized"><img src="<?php echo $base; ?>assets/images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
	</tr>
	<tr>
		<td id="tbl-border-left"></td>
		<td>
	       	<div id="content-table-inner">
    		  <table border="0" width="100%" cellpadding="0" cellspacing="0">
		          <tr valign="top">
		              <td>
			             <?php if (isset($listado)) { ?>
                            <!--listado-->
                            <?php $this->load->view($listado); ?>
                         <?php } ?>
			             <div class="clear">&nbsp;</div>

		              </td>
		          </tr>
		          <tr>
		              <td><img src="<?php echo $base; ?>assets/images/shared/blank.gif" width="695" height="1" alt="blank" /></td>
		              <td></td>
		          </tr>
		      </table>
		      <div class="clear"></div>
              <div class="clear"></div>
		  </div>
		</td>
		<td id="tbl-border-right"></td>
	</tr>
	<tr>
		<th class="sized bottomleft"></th>
		<td id="tbl-border-bottom">&nbsp;</td>
		<th class="sized bottomright"></th>
	</tr>
		</table>
</div>
<div class="clear">&nbsp;</div>
</div>
<div class="clear">&nbsp;</div>
<div id="footer">
	<div class="clear">&nbsp;</div>
</div>



</body>
</html>