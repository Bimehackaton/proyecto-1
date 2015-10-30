<!DOCTYPE html>

<html lang="es">
    <head>
        <meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="Ivan Merino">
        <meta name="description" content="Desarrollador de Aplicaciones Web." />
        
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo $_layoutParams['ruta_img']; ?>icon.ico" />
        
        <title><?php echo APP_NAME; ?></title>
        
        <link href="<?php echo $_layoutParams['ruta_css']; ?>bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $_layoutParams['ruta_css']; ?>plugins/metisMenu/metisMenu.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $_layoutParams['ruta_css']; ?>plugins/timeline.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $_layoutParams['ruta_css']; ?>sb-admin-2.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $_layoutParams['ruta_css']; ?>plugins/morris.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $_layoutParams['ruta_css']; ?>personal.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $_layoutParams['ruta_tmp']; ?>font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        
		
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		
    </head>

    <body id="cuerpo">
        
        
        
         <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo BASE_URL; ?>"><?php echo APP_NAME; ?></a>
            </div>
            <!-- /.navbar-header -->

			<ul class="nav navbar-top-links navbar-right">
                <li>
                    <a class="dropdown-toggle" href="<?php echo BASE_URL; ?>index/cuenta">
                        <?php 
						if(Session::get('email')){
							echo Session::get('email');
						}
						else{
							echo "Seleccionar cuenta";
						}
					?>
                    </a>
                </li>
				<?php
				if(Session::get('email')):
					?>
					<li>
						<a class="dropdown-toggle" href="<?php echo BASE_URL; ?>index/salir">Salir</a>
					</li>
					<?php
				endif;
				?>
            </ul>
			

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <!--<li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Buscar...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                        </li>-->
						
						<!--
						<li>
                            <a <?php if($this->opcion == 'dashboard'){ ?> class="active" <?php } ?> href="<?php echo BASE_URL; ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
						-->
						
                        <li <?php if($this->opcion == 'capturar' OR $this->opcion == 'conciertos' OR $this->opcion == 'cancelados' OR $this->opcion == 'modificados' OR $this->opcion == 'pendientes' OR $this->opcion == 'asignacion' OR $this->opcion == 'asignados'){ ?> class="active" <?php } ?>>
                            <!-- fa-edit -->
							<a href="#" <?php if($this->opcion == 'capturar' OR $this->opcion == 'conciertos' OR $this->opcion == 'cancelados' OR $this->opcion == 'modificados' OR $this->opcion == 'pendientes' OR $this->opcion == 'asignacion' OR $this->opcion == 'asignados'){ ?> class="active" <?php } ?>><i class="fa fa-music fa-fw"></i> Musica<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a <?php if($this->opcion == 'conciertos'){ ?> class="active" <?php } ?> href="<?php echo BASE_URL; ?>musica/conciertos">Ver Conciertos</a>
                                </li>
                                <li>
                                    <a <?php if($this->opcion == 'capturar'){ ?> class="active" <?php } ?> href="<?php echo BASE_URL; ?>musica/capturar">Capturar Conciertos</a>
                                </li>
                                <li>
                                    <a <?php if($this->opcion == 'cancelados'){ ?> class="active" <?php } ?> href="<?php echo BASE_URL; ?>musica/cancelados">Cancelados<?php if(Controller::checkCandelado($id) > 0): ?><span class="badge pull-right" style="background: #d9534f;"><?php echo Controller::checkCandelado($id); ?></span><?php endif; ?></a>
                                </li>
                                <li>
                                    <a <?php if($this->opcion == 'modificados'){ ?> class="active" <?php } ?> href="<?php echo BASE_URL; ?>musica/modificados">Modificados<?php if(Controller::checkModificado($id) > 0): ?><span class="badge pull-right" style="background: #f0ad4e;"><?php echo Controller::checkModificado($id); ?></span><?php endif; ?></a>
                                </li>
                                <li>
                                    <a <?php if($this->opcion == 'pendientes'){ ?> class="active" <?php } ?> href="<?php echo BASE_URL; ?>musica/pendientes">Pendientes<?php if(Controller::checkPendientes($id) > 0): ?><span class="badge pull-right" style="background: #5bc0de;"><?php echo Controller::checkPendientes($id); ?></span><?php endif; ?></a>
                                </li>
                                <li>
                                    <a <?php if($this->opcion == 'asignados'){ ?> class="active" <?php } ?> href="<?php echo BASE_URL; ?>musica/asignados">Asignados<?php if(Controller::checkAsignados() > 0): ?><span class="badge pull-right" style="background: #428bca;"><?php echo Controller::checkAsignados(); ?></span><?php endif; ?></a>
                                </li>
								<?php
								if(Session::get('admin')):
									?>
										<li>
											<a <?php if($this->opcion == 'asignacion'){ ?> class="active" <?php } ?> href="<?php echo BASE_URL; ?>musica/asignacion">Asignacion<?php if(Controller::checkPorAsignar() > 0): ?><span class="badge pull-right" style="background: #333;"><?php echo Controller::checkPorAsignar(); ?></span><?php endif; ?></a>
										</li>
									<?php
								endif;
								?>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
			
            <?php if(isset($this->_error)){ ?>
				<div class="row" style="padding: 20px 20px 0 20px;">
					<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<strong>Error!</strong> <?php echo $this->_error; ?>
					</div>
				</div>
			<?php } ?>
			
            <?php if(isset($this->_mensaje)){ ?>
				<div class="row" style="padding: 20px 20px 0 20px;">
					<div class="alert alert-warning alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<strong>Warning!</strong> <?php echo $this->_mensaje; ?>
					</div>
				</div>
			<?php } ?>
			
            <?php if(isset($this->_confirmado)){ ?>
				<div class="row" style="padding: 20px 20px 0 20px;">
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<strong>Okey!</strong> <?php echo $this->_confirmado; ?>
					</div>
				</div>
			<?php } ?>