<div class="container  my-5 py-5 text-white rounded" style="background: rgba(0,0,0,.7)">
	<h1 class="text-center">Carrito de compras</h1>
	<br />
	<a href="<?php echo base_url('catalogo'); ?>" class="btn btn-success btn-lg" role="button">Continuar comprando</a>
	<h2 class="text-center"><?=$message?></h2>


	<table id="mytable" class="table table-bordred table-striped">
		<?php if ($cart = $this->cart->contents()): ?>

			<thead>

				<td><b>Nº item</b></td>
				<td><b>Nombre</b></td>
				<td><b>Precio</b></td>
				<td><b>Cantidad</b></td>
				<td><b>Subtotal</b></td>
				<td><b>Acción</b></td>


			</thead>

			<tbody>
				<?php $i = 1;foreach ($cart as $item): ?>

				<tr>
					<td><?php echo $i++; ?></td>

					<td><?php echo $item['name']; ?></td>

					<td>$ <?php echo $this->cart->format_number($item['price'], 2); ?></td>

					<td><?php echo $item['qty']; ?></td>

					<td>$ <?php echo $this->cart->format_number($item['subtotal'], 2); ?></td>

					<td><?php echo anchor('carrito_controller/borrar/' . $item['rowid'], '<i class="far fa-trash-alt"></i>', 'title="Eliminar"'); ?></td>
				</tr>

				<?php endforeach;?>

				<tr>
					<td>Total Compra: $<?php echo number_format($this->cart->total(), 2); ?></td>

					<td><button type="button" class="btn btn-success" onclick="limpiar_carito()">Vaciar carrito</button></td>

					<td>
						<a href="<?php echo base_url('generarCompra');"<script type=\"text/javascript\">alert('Su compra se realizo con exito.');</script>"; ?>" class="btn btn-success" role="button">Ordenar compra</a>
					</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>

				<?php endif;?>

			</tbody>
	</table>


	<script>
		function limpiar_carito() {
			var result = confirm('Desea vaciar el carrito?');

			if(result) {
				window.location = "<?php echo base_url(); ?>carrito_controller/borrar/all";
			}else{
				return false; // cancela al acción
			}
		}
	</script>

	<br />

</div>