<?php $nombre = $this->session->userdata('nombre');?>

<nav class="navbar sticky-top navbar-expand-xl navbar-dark bg-dark">

     <a class="navbar-brand" href="<?php echo base_url('index'); ?>">Arana & Hijos Orfebres
     <img class="img-responsive "  src="<?php echo base_url('assets/img/logo.png'); ?>" alt="isologo" widht="50" height="50"></a>

     <button class="navbar-toggler" type="button" data-toggle="collapse" title="Menú" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
     </button>

     <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto ">

            <li class="nav-item">
              <a class="nav-link " href="<?php echo base_url('buzon'); ?>">Buzon de Entrada</a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Gestion Productos </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<?php echo base_url('alta_producto'); ?>">Alta de Producto</a>
                <a class="dropdown-item" href="<?php echo base_url('listar_productos'); ?>">Listar Productos</a>
              </div>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link" href="<?php echo base_url('listar_usuarios'); ?>" >Gestion Usuarios </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url('historialCompras'); ?>">Ventas</a>
            </li>
        </ul>

     <!--Vista del navegador para un Administrador-->
     <ul class="navbar-nav ">
            <li class="nav-item">
              <a class="nav-link">Bienvenido <?=$nombre?></a>
            </li>

             <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="<?php echo base_url('gestion_productos'); ?>" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mi cuenta</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<?php echo base_url('mis_datos'); ?>">Mis datos</a>
                <a class="dropdown-item" href="#">Darme de baja</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo base_url('salir'); ?>">Salir</a>
              </div>
            </li>
        </ul>

    </div>



</nav>
<!--Fin de Barra de navegación-->