<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <link  href="<?php echo base_url();?>assets/css/admin.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div id="main">
        <div id="header">
            <a href="#" class="logo1"><img src="<?php echo base_url();?>assets/img/grupoinsud.png"  alt="" /></a>
            <!--menu top-->
            <?php $this->load->view($menu_top); ?>
        </div>
        <div id="middle">
            <div id="left-column">
                &nbsp;
            </div>
           <div id="center-column">
               <!--listado-->
                <!--form tipo-->

                <?php $this->load->view($form_login); ?>
            </div>
            <!--col derecha-->
            <?php //$this->load->view($col_derecha); ?>
        </div>
        <div id="footer"></div>
    </div>
</body>
</html>
