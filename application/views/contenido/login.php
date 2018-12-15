<div class="container my-5 py-5" style="background:rgba(0,0,0,.6)">



<div class="d-flex justify-content-center align-items-center contenedor-form">

    <div class="col-md-8 ">
      <h2>Iniciar Sesión</h2>

      <form action="<?php echo base_url('validInicio'); ?>" method="post" >

        <div class="form-group">
          <label for="exampleInputEmail1">Correo electrónico</label>

          <input type="email" class="form-control" id="correo" aria-describedby="emailHelp" placeholder="Ingrese email" name="email" value="<?=set_value('email')?>" required onchange="validarCorreo()">
          <div id="borraremail" class="mensaje_error" ><?php echo form_error('email') ?></div>
        </div>

        <div class="form-group login">
          <label for="exampleInputPassword1">Contraseña</label>
          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Ingrese su contraseña" name="password"
          value="<?php set_value('password')?>" required>
          <div class="mensaje_error">
            <?php echo form_error('password') ?>
          </div>
        </div>

        <small id="emailHelp" class="form-text text-muted">No se compartirá tu email con nadie mas.</small><br />

        <button type="submit" class="btn btn-success btn-block">Iniciar Sesión</button>
      </form>
    </div>
</div>
</div>

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