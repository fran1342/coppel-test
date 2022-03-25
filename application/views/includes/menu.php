<?php 
    $session=$this->session->userdata('veterinaria_sess');

    switch($session->tipo_usuario){
        case 'Empleado':
            $menu=array(
                array(
                    "menu_icon" => "fas fa-user",
                    "menu_title" => "Empleados",
                    "menu_url" =>"empleados"
                ),
                array(
                    "menu_icon" => "fas fa-user",
                    "menu_title" => "Clientes",
                    "menu_url" => "clientes"
                ),
                array(
                    "menu_icon" => "fas fa-user-md",
                    "menu_title" => "Veterinarios",
                    "menu_url" => "veterinarios"
                ),
                array(
                    "menu_icon" => "fas fa-paw",
                    "menu_title" => "Mascotas",
                    "menu_url" => "mascotas"
                ),
                array(
                    "menu_icon" => "fas fa-calendar-day",
                    "menu_title" => "Citas",
                    "menu_url" => "citas"
                ),
                array(
                    "menu_icon" => "fa fa-cubes",
                    "menu_title" => "Productos",
                    "menu_url" => "productos"
                ),
                array(
                    "menu_icon" => "fa fa-credit-card",
                    "menu_title" => "Vender",
                    "menu_url" => "vender"
                  ),
                  array(
                    "menu_icon" => "fa fa-list-ol",
                    "menu_title" => "Ventas",
                    "menu_url" => "ventas"
                  )
            );
            
            break;
        
        
        default:
        
            break;
    }

?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Men&uacute;</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span><?=$session->nombre_usuario," ",$session->apellidos_usuario?></span></a>
            </li>
            
            <hr class="sidebar-divider my-0">
            
            <?php foreach($menu as $iMenu){ ?>
            <!-- Nav Item - Charts -->
                <li class="nav-item">
                    <a class="nav-link" href="<?=$iMenu['menu_url']?>">
                        <i class="<?=$iMenu['menu_icon']?>"></i>
                        <span><?=$iMenu['menu_title']?></span></a>
                </li>
            <?php } ?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->