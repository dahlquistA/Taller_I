<!--Inicio de Barra de navegacion-->
<?php $nombre = $this->session->userdata('nombre');?>
<?php $id     = $this->session->userdata('id');?>

<nav class="navbar sticky-top navbar-expand-xl navbar-dark bg-dark">
  <a class="navbar-brand" href="<?php echo base_url('inicio_user'); ?>">Arana & Hijos Orfebres
  <img class="img-responsive"  src="<?php echo base_url('assets/img/logo.png'); ?>" alt="isologo" widht="50" height="50"></a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" title="Menú" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto ">
        <li class="nav-item">
          <a class="nav-link " href="<?php echo base_url('inicio_user'); ?>">Bienvenido </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="<?php echo base_url('catalogo'); ?>">Productos </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('quienesSomos_user'); ?>">Quiénes Somos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('comer_user'); ?>">Comercialización</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('consulta'); ?>">Contactanos</a>
        </li>
      </ul>

      <ul class="navbar-nav ">
        <li  class="nav-item">
          <a class="nav-link"><i class="icono fas fa-user-circle"></i> <?=$nombre?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="<?php echo base_url('miCarrito'); ?>"> <i class="fas fa-cart-arrow-down"></i> Ver carrito</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fas fa-address-book"></i> Mi cuenta</a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="<?php echo base_url('historialMisCompras'); ?>"><i class="fas fa-history"></i> Mis compras</a>
            <a class="dropdown-item" href="<?php echo base_url('misDatos'); ?>"><i class="fas fa-address-book"></i> Mis datos</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo base_url('salir'); ?>"><i class="fas fa-sign-out-alt"></i> Salir</a>
          </div>
        </li>
      </ul>

       <form class="form-inline my-2 my-lg-0" method="post" action="<?=base_url('buscarProducto')?>">
            <input class="form-control mr-sm-2 " type="search" placeholder="Buscar" aria-label="Search" required name="busca">
            <button class="btn btn-outline-success my-2 my-sm-0 " type="submit"  >Buscar</button>
       </form>
      </div>
</nav>