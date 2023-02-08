<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>appmlinemoney.com</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <!-- IE -->
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
    <!-- other browsers -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico" />

  <link rel="stylesheet" href="../public/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="../public/dist/css/bootstrap-select.min.css">
   <link rel="stylesheet" href="../public/dist/css/bootstrap-datepicker.min.css">
   <link rel="stylesheet" href="../public/dist/css/daterangepicker.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../public/dist/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../public/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue  -->
  <link rel="stylesheet" href="../public/dist/css/skins/skin-blue.min.css">
 <!-- DATATABLES -->
    <link rel="stylesheet" href="../public/dist/datatables/jquery.dataTables.min.css">    
    <link rel="stylesheet" href="../public/dist/datatables/buttons.dataTables.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../public/dist/datatables/responsive.dataTables.min.css" rel="stylesheet"/>

 

</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
    <img src="../public/dist/img/logo2.png" class="logo-mini" alt="Imagen Usuario">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>M</b>LN</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>M_</b>Line</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Deslizar navegación</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <!-- Menu toggle button -->
            <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
            <script type="text/javascript">
                $(document).ready(function() {
                    const pNode = document.getElementById("saldoCaja");
                    function ponerNCPySaldo() {

                              $.post("../ajax/ajax_cajas.php?op=ponerNCPySaldo", { }, function(data, status) {
                              data = JSON.parse(data);
                              $("#ncpUsuario").val(data.numerocuenta);
                              $("#saldoReal").val(data.saldo);
                              pNode.innerText = data.saldo;

                          });
                      }

                    setInterval(ponerNCPySaldo, 20000);
                });
            </script>

            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-money"> 
                <form name="formularioSaldo" id="formularioSaldo" method="post">
                <input type="hidden" name="saldoReal" id="saldoReal" >
                <input type="hidden" name="ncpUsuario" id="ncpUsuario">

                </form>
             </i> <i id="saldoCaja" >   </i> 
              <span class="label label-success">XAF</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Tiene 4 mensajes</li>
              <li>
                <!-- inner menu: contains the messages -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <!-- User Image -->
                        <img src="../public/dist/img/logo1.png" class="img-circle" alt="Imagen Usuario">
                      </div>
                      <!-- Message title and timestamp -->
                      <h4>
                        Soporte Tecnico
                        <small><i class="fa fa-clock-o"></i> 5 minutos</small>
                      </h4>
                      <!-- The message -->
                      <p>Por que no adquirir una aplicación a medida?</p>
                    </a>
                  </li>
                  <!-- end message -->
                </ul>
                <!-- /.menu -->
              </li>
              <li class="footer"><a href="#">Ver todos los mensajes</a></li>
            </ul>
          </li>
          <!-- /.messages-menu -->

          <!-- Notifications Menu -->
          <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Tienes 10 notificaciones</li>
              <li>
                <!-- Inner Menu: contains the notifications -->
                <ul class="menu">
                  <li><!-- start notification -->
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 nuevas agencias establecidas
                    </a>
                  </li>
                  <!-- end notification -->
                </ul>
              </li>
              <li class="footer"><a href="#">Ver todos</a></li>
            </ul>
          </li>
          <!-- Tasks Menu -->
          <li class="dropdown tasks-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Tienes 9 tareas</li>
              <li>
                <!-- Inner menu: contains the tasks -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <!-- Task title and progress text -->
                      <h3>
                        Diseño de los colores
                        <small class="pull-right">20%</small>
                      </h3>
                      <!-- The progress bar -->
                      <div class="progress xs">
                        <!-- Change the css width attribute to simulate progress -->
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Completado</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">Ver todas las tarreas</a>
              </li>
            </ul>
          </li>
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="../public/dist/img/logo1.png" class="user-image" alt="Imagen Usuario">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php echo $_SESSION['nomcompleto']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="../public/dist/img/logo1.png" class="img-circle" alt="Imagen Usuario">

                <p>
                  <?php echo $_SESSION['nomcompleto']; ?> - <?php echo $_SESSION['cargo']; ?>
                  <small><?php echo $_SESSION['direccion']. ' . ' .date("M").'. '.date("Y"); ?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Wallet</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Envios</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Retiros</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="perfil.php" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="../ajax/ajax_usuarios.php?op=salir" class="btn bg-orange btn-flat">Salir</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../public/dist/img/logo1.png" class="img-circle" alt="Imagen Usuario">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['rol']; ?></p>
          <!-- Status -->
          <a href="#"> <i class="fa fa-circle text-success">  </i> Conectado</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="POST" id="formulariobuscar" class="sidebar-form">
        <div class="input-group">
          <input autocomplete="on" data-live-search="true" id="buscar" type="text" name="buscar" class="form-control selectpicker" placeholder="Buscar ...">
          <input type="hidden" name="rolConnect" id="rolConnect" value="<?php echo $_SESSION['rol']; ?>">
          <span class="input-group-btn">
              <button type="submit"  name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" id="menu" data-widget="tree">
        <li class="header">MENU</li>
        <!-- Optionally, you can add icons to the links -->
        <li class=""><a href="escritorio.php"><i class="fa fa-laptop"></i> <span>Escritorio</span></a></li>
        <li class=""><a href="envios.php"><i class="fa fa-send"></i> <span>Envios</span></a></li>
        <li><a href="recibos.php"><i class="fa fa-arrow-circle-o-down"></i> <span>Retiros</span></a></li>
       <!-- <li class=""><a href="billetes.php"><i class="fa fa-plane"></i> <span>Billetes</span></a></li> -->
        <li class=""><a href="empleados.php"><i class="fa fa-users"></i> <span>Empleados</span></a></li>
        <li class=""><a href="#"><i class="fa fa-plane"></i> <span>Transacciones UV</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-cubes"></i> <span>Administracion</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
           <li><a href="bancos.php"><i class="fa fa-bank"></i>Banco</a></li>
           <li><a href="banco_comercial.php"><i class="fa fa-cc-mastercard"></i> Comercial</a></li>
            <li><a href="clientes.php"><i class="fa fa-group "></i>Clientes</a></li>
            <li><a href="agencias.php"><i class="fa fa-home"></i>Agencias</a></li>
            <li><a href="cuentas.php"><i class="fa fa-bank"></i>Cuentas</a></li>
            <li><a href="cajas.php"><i class="fa fa-briefcase"></i>Cajas</a></li>
            <li><a href="tasas.php"><i class="fa fa-circle-o"></i>Tarifario envios</a></li>
            <li><a href="contabilidad.php"><i class="fa fa-file-excel-o"></i>Contabilidad</a></li>
            <!-- <li><a href="rutas.php"><i class="fa fa-circle-o"></i>Rutas de vuelos</a></li> -->
            <li><a href="solicitudes.php"><i class="fa fa-envelope-o"></i>Solicitudes</a></li>
            <li><a href="paises.php"><i class="fa fa-map-signs"></i>Paises</a></li>
            <li><a href="usuarios.php"><i class="fa fa-user"></i>Usuarios</a></li>
			      <li><a href="permiso.php"><i class="fa fa-lock"></i>Permisos</a></li>
          </ul>
        </li>
                <li class="treeview">
          <a href="#"><i class="fa fa-bar-chart"></i> <span>Consultas</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="consultas_envios.php"><i class="fa fa-send"></i>Envios</a></li>
            <li><a href="consultas_recibos.php"><i class="fa fa-arrow-circle-o-down"></i>Retiros</a></li>
            <li><a href="consultas_operaciones.php"><i class="fa fa-book"></i>Operaciones</a></li>
          </ul>
        </li>
        <li><a href="javascript:alert('Contacte con el Soporte tecnico desarrolladores de la aplicación')"><i class="fa fa-plus-square"></i> <span>Ayuda</span><small class="label pull-right bg-red">PDF</small></a></li>
        <li>
              <a href="#">
                <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                <small class="label pull-right bg-yellow">M_LINE</small>
              </a>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
