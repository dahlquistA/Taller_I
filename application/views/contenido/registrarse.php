<div class="d-flex justify-content-center align-items-center contenedor-form">
	<div class="col-md-8">
		<h2>Registro de usuario</h2>
		<hr />
		<form action="<?php echo base_url('validar_registro'); ?>" method="post">

			<div class="form-group">
				<label for="validationCustum01">Nombre/s</label>
				<input type="text" class="form-control" id="validationCustom01" placeholder="Nombre..." name="nombre" value="<?=set_value('nombre');?>" required>
			 	<div class="mensaje_error"><?php echo form_error('nombre'); ?></div>
			</div>

			<div class="form-group">
				<label for="validationCustum02">Apellido/s</label>
				<input type="text" class="form-control" id="validationCustum02" placeholder="Apellido..." name="apellido"
					   value="<?=set_value('apellido')?>" required>

			 	<div class="mensaje_error"><?php echo form_error('apellido'); ?></div>
			 </div>

			 <div class="form-group">
			 	<label for="emailB">Email</label>
				<input type="emailB" class="form-control" id="emailB" placeholder="E-mail..." name="emailB" value="<?=set_value('emailB')?>" required onchange="validEmail()">

			 	<div id="error-email" class="mensaje_error"><?php echo form_error('emailB'); ?></div>
			 </div>


			 <div class="form-group">
			 	<label for="telefono">Telefono</label>
				<input type="text" class="form-control" id="telefono" placeholder="Teléfono..." name="telefono" value="<?=set_value('telefono')?>" required onblur="validarTel()">

			 	<div id="error-tel" class="mensaje_error"><?php echo form_error('telefono'); ?></div>
			 </div>

			<div class="form-group">
				<label for="password">Contraseña</label>
				<input type="password" class="form-control" id="password" placeholder="Contraseña..." name="password"
						value="<?=set_value('password')?>" required>

				 <div class="mensaje_error"><?php echo form_error('password'); ?></div>
			</div>

			<div class="form-group">
				<label for="validationCustom05">Confirmar Contraseña</label>
				<input type="password" class="form-control" id="validationCustom05" placeholder="Contraseña..." name="passconf"
					   value="<?=set_value('passconf')?>" required>

				 <div class="mensaje_error"><?php echo form_error('passconf'); ?></div>
			</div>
			<hr />

			<button type="submit" class="btn btn-success" name="submit" >Registrarme</button>
	 		<div class="btn btn-success float-right" id="borrar" onclick="borrarFormu()" >Limpiar </div>

		</form>
	</div>
</div>

<script type="text/javascript">
	function validEmail () {
		var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    	var email = $('#emailB').val();


    	if (pattern.test(email) == false) {
    		$('#error-email').text('El email no es valido (Ejemplo: nombre@gmail.com)');
    	} else {
    		$('#error-email').text('');
    	}
	}

	function validarTel () {
		var numeroTelefono=document.getElementById('telefono');
		var expresionRegular1=/^([0-9]+){9}$/;//<--- con esto vamos a validar el numero
		var expresionRegular2=/\s/;//<--- con esto vamos a validar que no tenga espacios en blanco

		if(numeroTelefono.value=='') {
			$('#error-tel').text('El campo es obligatorio');
		} else if(expresionRegular2.test(numeroTelefono.value)) {
			$('#error-tel').text('Error: existen espacios en blanco');
		} else if (numeroTelefono.value.length < 9) {
			$('#error-tel').text('Escribe un Minimo de 9 Digitos como Teléfono');
		}else if(!(expresionRegular1.test(numeroTelefono.value))) {
			$('#error-tel').text('Numero de telefono incorrecto (Ejemplo 11 62452823)');
		} else {
    		$('#error-tel').text('');
    	}
	}

	function borrarFormu() {
		$('.form-control').val('');
	}
</script>
