<!doctype html>
<html>
<head>
	<title><?=(isset($this->title)) ? $this->title : 'Salud'  ?> </title>
	<link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/default.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/font-awesome.min.css"/>
	<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.9.1/themes/sunny/jquery-ui.css"/>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?php echo URL; ?>public/js/custom.js"></script>
	<script type="text/javascript" src="<?php echo URL; ?>public/js/bootstrap.js"></script>
	
	<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">

	<?php
		if (isset($this->js)){
			foreach ($this->js as $js) {
				//le mando que busque su javascript de la vista (para el dashboard en js = dashboard/js/default.js)
				echo '<script type="text/javascript" src="'.URL.'views/'.$js.'"></script>';
			}
			
		}

	?>

</head>
<body>
    <div class="container-fluid">
        <?php Session::init(); ?>
        <?php if(Session::get('loggedIn') == false):?>

        <?php endif;?>
        <!--aqi deberia cargar el menu dinamico y comprobar accesos?-->
            <?php if(Session::get('loggedIn') == true):?>
            <div id="header" class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#headerMenu" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="<?php echo URL;?>index" ><span class="logo-brand"></span></a>
                    </div>
                    <div class="collapse navbar-collapse" id="headerMenu">
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="<?php echo URL;?>index" >Inicio</a>
                            </li>
                                <?php Auth::menu();?>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="#">Bienvenido: <strong><?php echo Session::get('nombre'); ?></strong></a>
                            </li>
                            <li>
                                <a href="<?php echo URL;?>dashboard/logout">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div id="content">
            <div class="col-lg-12 contentGeneral-mod">
