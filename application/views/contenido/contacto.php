
<section class="container mt-9 centrar">
	<div class="mi_contenedor">

		<div class="row">
			<div class="col-md-12 ">
				<h1 class="text-center"><strong>Envienos</strong> su consulta</h1>

				<div class="mi_descripcion text-center lead">
					Complete a continuación las casillas con sus datos y el mensaje que quiere enviarnos
				</div>
			</div>
		</div>

		<section class="contenedor-form d-flex justify-content-center align-items-center">
			<div class="col-12 col-sm-8">

					<h2>Formulario de contacto</h2>
					<hr />

					<form role="form" action="<?=base_url('envCon');?>" method="post">

						<div class="form_group">
							<label for="form-nombre">Nombre</label>
							<input type="text" placeholder="Nombre..." class="form-control" id="nombreB" name="nombreB"
							       value="<?=set_value('nombreB')?>" required>
							<div class="mensaje_error"><?php echo form_error('nombreB'); ?></div>
							<br />
						</div>
						<div class="form_group">
							<label for="form-apellido">Apellido</label>
							<input type="text" placeholder="Apellido..." class="form-control" id="apellidoB" name="apellidoB" 	    value="<?=set_value('apellidoB')?>" required>
							<div class="mensaje_error"><?php echo form_error('apellidoB'); ?></div>
							<br />
						</div>

						<div class="form_group">
							<label for="form-email">Correo Electrónico</label>
							<input type="text" placeholder="e-mail..." class="form-control" id="emailB" name="emailB"
								   value="<?=set_value('emailB')?>" required onchange="validarEmail()">
							<div id="error-email" class="mensaje_error"><?php echo form_error('emailB'); ?></div>
							<br />
						</div>
						<div class="form-group">
							<label for="exampleFormControlTextarea1">Mensaje</label>
	    					<textarea id="mensaje" class="form-control" name="mensajeB" rows="3" placeholder="Texto..." style="width: 100%" required onchange="validTextArea()" minlength="15" maxlength="160"></textarea >
							<div id="output" class="mensaje_error"><?php echo form_error('mensajeB'); ?></div>
	 					</div>
	 					<button type="submit" class="btn btn-success" name="submit" >Enviar	</button>
	 					<div class="btn btn-success float-right" id="borrar" onclick="borrarForm()" >Limpiar </div>

					</form>
				</div>
			</section>
		<br />
		<div class="banner"></div>
		<hr />
		<div class="container"><h4>Encuentrenos en nuestras sucursales mas cercanas:</h4></div>
		<br />
		<section class="row d-flex justify-content-around">
			<div class="col-sd-4">
				<div class="card" style="width: 18rem;">
				  <iframe class="card-img-top" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3604.4557539728203!2d-57.144801050018614!3d-25.389550637433207!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x945c3255bb06eef1%3A0xe1db3b33ae3b5a3f!2sAlberdi%2C+Caacup%C3%A9%2C+Paraguay!5e0!3m2!1ses!2snl!4v1525481888918" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
				  <div class="card-body">
				    <h5 class="card-title">Planta Fabrica</h5>
				    <p class="card-text">Alberdi 1198 esquina Caballero. Tel: 0511242373 </p>
				    <p class="card-text">Caacupé-Paraguay</p>
				  </div>
				</div>
			</div>

			<div class="col-sd-4">
				<div class="card" style="width: 18rem;">
				  <iframe class="card-img-top" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3607.4294271217414!2d-57.58274915002156!3d-25.28977243348133!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x945da89e8de7c4c1%3A0x504cd3b63b1e4d5!2sMoises+Bertoni%2C+Asunci%C3%B3n%2C+Paraguay!5e0!3m2!1ses!2snl!4v1525482296700" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
				  <div class="card-body">
				    <h5 class="card-title">Sucursal nº1</h5>
				    <p class="card-text">Moises Bertoni 1250, entre Senador Long y Tte. Malutin</p>
				    <p class="card-text">Asunción-Paraguay</p>
				  </div>
				</div>
			</div>

			<div class="col-sd-4">
				<div class="card" style="width: 18rem;">
				  <iframe class="card-img-top" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3607.2627345469737!2d-57.58181468598932!3d-25.29537533731015!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x945da8999bd4ae13%3A0x4e56908dec08d634!2sShopping+Mariscal!5e0!3m2!1ses!2snl!4v1525482382388" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
				  <div class="card-body">
				    <h5 class="card-title">Sucursal nº2</h5>
				    <p class="card-text">Shopping Mariscal, Planta Baja. Tel: 0511242373 </p>
				    <p class="card-text">Asunción-Paraguay</p>
				  </div>
				</div>
			</div>
		 </section>

	</div>


</section>
<br />

<script type="text/javascript">

	function validarEmail () {
		var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    	var email = $('#emailB').val();

    	if (pattern.test(email) == false) {
    		$('#error-email').text('El email no es valido');
    	} else {
    		$('#error-email').text('');
    	}
	}

	function borrarForm() {
		$('.form-control').val('');
	}

	function validTextArea() {
		$(document).ready(function () {
			$('#mensaje').change(function () {
				if ($.trim($('#mensaje').val()).length < 1) {
					$('#output').html('Debe agregar un mensaje');

				} else if ($('#mensaje').val().length < 15){
					$('#output').html('Debe ingresar 15 caracteres como minimo');

				} else if ($('#mensaje').val().length > 160){
					$('#output').html('El mensaje no debe superar los 160 caracteres');
					
				} else {
					$('#output').html('');
				}
			});
		});
	}

</script>
