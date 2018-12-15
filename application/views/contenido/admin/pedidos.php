<div class="container">
	<!-- Page Heading/Breadcrumbs -->
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header" style="text-align:center;">Listado de pedidos</h1>
		</div>
	</div>
	<!-- /.row -->
	<div class="row">
		<table id="mytable" class="table table-bordred table-striped table-hover">

			<thead>
				<th>Número de factura</th>
				<th>Apellido</th>
				<th>Nombre</th>
				<th>Fecha</th>
				<th>Ver</th>
			</thead>

			<tbody>
				<?php foreach ($pedidos as $row) {?>
				<tr>
					<td> <?php echo $row->id_compra; ?> </td>
					<td> <?php echo $row->apellido; ?> </td>
					<td> <?php echo $row->nombre; ?> </td>
					<td> <?php echo $row->fecha; ?> </td>
					<td> <a class="btn btn-success" href="<?php echo base_url("pedidos_controller/seleccionar_pedidos_por_id/$row->id_compra"); ?>" >
						<span class="glyphicon glyphicon-pencil"></span> </a></td>
					</tr>
					<?php }?>
				</tbody>
			</table>

		</div>
	</div>
</div>