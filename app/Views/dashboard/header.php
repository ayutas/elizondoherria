<!DOCTYPE html>
<html lang="es">

<head>    
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ELIZONDOKO HILERRIA</title>
    <script
			  src="https://code.jquery.com/jquery-3.5.1.js"
			  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
			  crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= base_url() ?>/assets/coreui/dist/css/coreui.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/coreui/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/coreui/css/perfect-scrollbar.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url() ?>/assets/coreui/css/chartjs.css">
    <link href="<?= base_url() ?>/assets/fontawesome/css/all.css" rel="stylesheet"> <!--load all styles -->    
    <link href="<?=base_url()?>/assets/css/styles.css" rel="stylesheet" />
    <link href="<?=base_url()?>/assets/css/utils.css" rel="stylesheet" />    
    <link href="https://cdn.jsdelivr.net/css-toggle-switch/latest/toggle-switch.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.1/css/buttons.dataTables.min.css">
    <script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.2.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" language="javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.2.1/js/dataTables.buttons.min.js"></script> -->
    <link href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css" rel="stylesheet">

    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="<?=base_url()?>/assets/select2/dist/css/select2.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="<?=base_url()?>/assets/select2/dist/js/select2.full.min.js"></script>

</head>
<?php $uri = service('uri');
// return var_dump($uri) 
?>

<body class="c-app c-dark-theme">
    <!-- Menu Izq - Inicio -->
    <div class="c-sidebar c-sidebar-fixed c-sidebar-lg-show c-sidebar-unfoldable" id="sidebar">
        <div class="c-sidebar-brand d-md-down-none">
            <!-- <span class="c-sidebar-brand-full" style="font-size:2rem;">EA</span> -->
            <span class="c-sidebar-brand-minimized" style="font-size:1rem;">EH</span>

            <img class="c-sidebar-brand-full" height="50" alt="Logo" src="<?= base_url() ?>/assets/images/Logo.png">
                <!-- <img src="/assets/images/LogoBlanco.png" alt="ELABORADOS NATURALES"> -->

            </img>
            <!-- <svg class="c-sidebar-brand-minimized" width="46" height="46" alt="CoreUI Logo">
                <use xlink:href="<?= base_url() ?>/assets/icons/svg/brand.svg#cib-coreui-c"></use>
            </svg> -->
        </div>
        <ul class="c-sidebar-nav ps ps--active-y">
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="<?= base_url() ?>/dashboard">
                    <svg class="c-sidebar-nav-icon" >
                        <use xlink:href="<?= base_url() ?>/assets/icons/svg/free.svg#cil-speedometer"></use>
                    </svg> Inicio</a></li>
            <li class="c-sidebar-nav-title">Menu</li>
            
            <?php 


            ?>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="<?= base_url() ?>/recibos">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="<?= base_url() ?>/assets/icons/svg/free.svg#cil-clipboard"></use>
                </svg> Recibos</a>
            </li>
            <?php if(session()->get('admin')==1){?>
                <!-- <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="<?= base_url() ?>/consultas">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="<?= base_url() ?>/assets/icons/svg/free.svg#cil-search"></use>
                    </svg> Consultas</a>
                </li>             -->
                <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">                
                    <svg class="c-sidebar-nav-icon">                        
                        <use xlink:href="<?= base_url() ?>/assets/icons/svg/brand.svg#cib-trello"></use>
                    </svg> Mantenimiento Tablas</a>
                    <ul class="c-sidebar-nav-dropdown-items">
                        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="<?= base_url() ?>/clientes">
                        Clientes</a>
                        </li>
                        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="<?= base_url() ?>/articulos">
                        Articulos</a>
                        </li> 
                        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="<?= base_url() ?>/bancos">
                        Bancos</a>
                        </li> 
                        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="<?= base_url() ?>/categorias">
                        Categorias</a>
                        </li>
                        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="<?= base_url() ?>/usuarios">
                        Usuarios</a>
                        </li> 
                    </ul>
                </li>
            <?php }?>
            
            <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
            </div>
            <div class="ps__rail-y" style="top: 0px; height: 548px; right: 0px;">
                <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 233px;"></div>
            </div>
        </ul>
        <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
            data-class="c-sidebar-unfoldable"></button>
    </div>
    <!-- Menu Izq - Fin -->
        
    <div class="c-wrapper">
    <!-- Menu Superior + Breadcum - Inicio -->
    <header class="c-header c-header-dark c-header-fixed ">
        <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar"
            data-class="c-sidebar-show">
            <svg class="c-icon c-icon-lg">
                <use xlink:href="<?= base_url() ?>/assets/icons/svg/free.svg#cil-menu"></use>
            </svg>
        </button><a class="c-header-brand d-lg-none c-header-brand-sm-up-center" href="<?= base_url() ?>/#">
            <svg width="118" height="46" alt="CoreUI Logo">
                <use xlink:href="<?= base_url() ?>/assets/icons/svg/brand.svg#cib-coreui"></use>
            </svg></a>
        <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar"
            data-class="c-sidebar-lg-show" responsive="true">
            <svg class="c-icon c-icon-lg">
                <use xlink:href="<?= base_url() ?>/assets/icons/svg/free.svg#cil-menu"></use>
            </svg>
        </button>
        <!-- <ul class="c-header-nav d-md-down-none">
            <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="<?= base_url() ?>/chequeo">Chequeo</a></li>
            <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="<?= base_url() ?>/consultas">Consultas</a></li>
            <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="<?= base_url() ?>/tablas">Tablas</a></li>
            <!-- <li class="c-header-nav-item px-3"><a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="<?= base_url() ?>/">Tablas</a>
            <div class="dropdown-menu"> 
                <a class="dropdown-item" href="<?= base_url() ?>/delegaciones">Delegaciones</a>
                <a class="dropdown-item" href="">Personal</a>
                <a class="dropdown-item" href="">Articulos</a>
                <a class="dropdown-item" href="">Formularios</a>
                <a class="dropdown-item" href="">Motivos</a>
                <a class="dropdown-item" href="">Grupos</a>
                <a class="dropdown-item" href="">Items</a>                
            </div>
        </li> 
        </ul> -->
        <ul class="c-header-nav mfs-auto">
            <li class="c-header-nav-item px-3 c-d-legacy-none">
                
            </li>
        </ul>
        <ul class="c-header-nav">
            <li class="c-header-nav-item dropdown"><a class="c-header-nav-link" data-toggle="dropdown" 
                    role="button" aria-haspopup="true" aria-expanded="false">
                    <div class="c-avatar"><img class="c-avatar-img" src="<?=base_url()?>/assets/img/avatars/6.jpg" alt="user@email.com">
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right pt-0">
                        <!-- <svg class="c-icon mfe-2" href="<?= base_url() ?>/logout"> -->
                            <use xlink:href="<?= base_url() ?>/assets/icons/svg/free.svg#cil-account-logout"></use>
                        <!-- </svg>  -->
                        <a class="btn btn-primary mt-2 ml-2" href="<?= base_url() ?>/logout"> Cerrar Sesión</a>                        
                </div>
                
            </li>
        </ul>
        <!-- Menú Superior - Inicio -->

        <!-- Breadcum - Inicio -->
        <div class="c-subheader c-subheader-dark justify-content-between px-3 ">
            
            <!-- Breadcum - Inicio -->
            <ol class="breadcrumb border-0 m-0 px-0 px-md-3">
                <li class="breadcrumb-item">INICIO</li>
                
                <li class="breadcrumb-item"><a href="<?= base_url() ?>/<?php echo $uri->getSegment(1) ?>"><?php echo strtoupper($uri->getSegment(1)) ?></a></li>
                <!-- <li class="breadcrumb-item active">Dashboard</li> -->
            </ol>
            <!-- Breadcum - Inicio -->

        </div>
        <!-- Breadcum - Fin -->

    </header>
    <!-- Menu Superior + Breadcum - Fin -->