<div class="container table-responsive my-5 py-5 text-white pr-0" style="background: rgba(0,0,0,.7)">
	<!-- Page Heading/Breadcrumbs -->
	<div class="row ">
		<div class="col-md-8">
			<h1 class="page-header" style="text-align:center;">Listado de Productos</h1>
		</div>

		<form class="form-inline" method="post" action="<?=base_url('buscarCateg')?>">
            <input class="form-control mr-sm-2 " type="search" placeholder="Ingrese Nombre" aria-label="Search" required name="buscar">
            <button class="btn btn-outline-success my-2 my-sm-0 " type="submit"  >Buscar</button>
        </form>
	</div>
	<br />
	<!-- /.row -->
	<div class=" d-flex justify-content-center align-items-center text-white" >
		<div class="col-md-12 ">
			<table id="mytable" class="table table-bordred table-striped table-hover border border-dark text-white" >

				<thead>
					<th>Codigo</th>
					<th>Nombre</th>
					<th>Precio</th>
					<th>Stock</th>
					<th>Descripcion</th>
					<th>Categoria</th>
					<th>Imagen</th>
					<th>Editar</th>
					<th>Activar/Eliminar</th>

				</thead>

				<tbody>
					<?php foreach ($productos as $row) {
    ?>
					<tr <?php if ($row->estado == 0) {echo 'style="color: red;"';}
    ;?> >
						<td> <?php echo $row->codigo; ?> </td>
						<td> <?php echo $row->nombre; ?> </td>
						<td><b>Arg $</b><?php echo $row->precio; ?></td>
						<td> <?php echo $row->stock ?> </td>
						<td> <?php echo $row->descripcion ?> </td>
						<td> <?php echo $categorias[$row->categoria_id - 1]->descripcion; ?></td>
						<td><img style="width: 3em; height:3em;" src="<?php echo base_url('uploads/imagenes_producto/' . ($row->img)); ?>"></td>
						<td><a class="btn btn-success" href="<?php echo base_url('producto_controller/editar_producto/' . $row->id_producto); ?>" title="Editar"><i class="fa fa-pencil-alt"></i></a></td>

						<?php if (($row->estado) == 1) {?>

						<td><a class="btn btn-danger" href="<?php echo base_url('producto_controller/eliminar_producto/' . $row->id_producto); ?>" title="Eliminar"><i class="fas fa-trash"></i></a></td>

						<?php } else {?>

						<td><a class="btn btn-primary active" aria-pressed="true" title="Activar" href="<?php echo base_url('producto_controller/activar_producto/' . $row->id_producto); ?>" ><span class="fas fa-check"></span></a></td>

						<?php }?>
					</tr>

					<?php }?>
				</tbody>


			</table>

			<div class="float-right">
				<h4><?php echo $this->pagination->create_links(); ?></h4>
			</div>
		</div>
	</div>
</div>