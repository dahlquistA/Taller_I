<!--Inicio de Barra de navegacion-->
<nav class="navbar sticky-top navbar-expand-xl navbar-dark bg-dark">
  <a class="navbar-brand" href="<?php echo base_url('index'); ?>">Arana & Hijos Orfebres
    <img class="img-responsive "  src="<?php echo base_url('assets/img/logo.png'); ?>" alt="isologo" widht="50" height="50">
  </a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" title="Menú" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto ">
      <li class="nav-item">
        <a class="nav-link " href="<?php echo base_url('index'); ?>">Bienvenido </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="<?php echo base_url('productos'); ?>">Productos </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('quienes_somos'); ?>">Quiénes Somos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('comercializacion'); ?>">Comercialización</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('contacto'); ?>">Contactanos</a>
      </li>
    </ul>

<!--MODAL DE INICIO DE SESION. Vista del navegador para el público en general-->
    <ul class="navbar-nav ">
      <li class="dropdown" >
        <a class="nav-link "  href="" data-toggle="dropdown" ><i class="far fa-user-circle"></i> Iniciar Sesion </a>

        <div class="dropdown-menu contenedor-form" style="padding:30px; padding-bottom: 10px; padding-top:30px; background:rgba(0,0,0,.9) !important; margin-top: 25px ; width:400px;">
          <div class="logo">
            <h1 style="text-align: center; "><i class="icono fas fa-user-circle"></i></h1>
            <h1 class="logo-caption"><span class="tweak">L</span>ogin</h1>
          </div>

          <form action="<?php echo base_url('validInicio'); ?>" method="post" >
            <div class="form-group">
              <input class="form-control " style='text-align:center;' type='email' aria-describedby="emailHelp" name='email' value="<?=set_value('email');?>" required placeholder='email' id="correo" onchange="validarCorreo()">
              
            </div>

            <div class="form-group">
              <input class='form-control large' style='text-align:center;' type='password' name="password" value="<?php set_value('password')?>" required placeholder="Contraseña">
              
            </div>

            <small id="emailHelp" class="form-text text-muted">No se compartirá tu información con nadie mas.</small>
            <br />

            <div class="form-group">
              <button class='btn btn-outline-success' style="width:340px;" type='submit'>INGRESAR</button>
            </div>
          </form>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link " href="<?php echo base_url('registrate'); ?>"><i class="far fa-edit"></i> Registrate</a>
      </li>
    </ul>

    <form class="form-inline my-2 my-lg-0" method="post" action="<?=base_url('busqueda')?>">
      <?php if ($this->session->userdata("buscador")) {
        ?>
        <input class="form-control mr-sm-2" type="text" placeholder="Buscar" required name="buscar" value="<?= $this->session->userdata("buscador")?>">            
        <?php } else {?>
          <input class="form-control mr-sm-2" type="text" placeholder="Buscar" required name="buscar">
        <?php }?>

        <button class="btn btn-outline-success my-2 my-sm-0 " type="submit"> Buscar </button>
    </form>
  </div>
</nav>
<!--Fin de Barra de navegación-->

<!--Inicio del Script de validacion de correo-->
<script type="text/javascript">

  function validarCorreo () {
    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    var email = $('#correo').val();


    if (pattern.test(email) == false) {
       $('#borraremail').text('El email no es valido (Ejemplo: nombre@gmail.com)');
      } else {
        $('#borraremail').text('');
      }
  }
</script>
