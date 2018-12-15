<div class="container table-responsive my-5 py-5 text-white pr-0" style="background: rgba(0,0,0,.7)">
	<!-- Page Heading/Breadcrumbs -->
	<div class="row ">
		<div class="col-lg-12">
			<h1 class="page-header" style="text-align:center;">Buzon de Entrada</h1>
		</div>
	</div>
	<br />
	<!-- /.row -->
	<div class="row d-flex justify-content-center align-items-center text-white" >
		<div class="col-lg-12 col-md-offset-2">
			<table id="mytable" class="table table-bordred table-striped table-hover border border-dark" >

				<thead>

					<th>Nombre</th>
					<th>Apellido</th>
					<th>Email</th>
					<th>Mensaje</th>
					<th>Fecha</th>
					<th>Ver</th>
					<th>Eliminar</th>
				</thead>


				<tbody>
					<?php foreach ($buzon as $row) {
    ?>
						<tr <?php if ($row->estado == 1) {echo 'style="color: red;"';}
    ;?> >
						<td> <?php echo $row->nombre; ?> </td>
						<td> <?php echo $row->apellido; ?></td>
						<td> <?php echo $row->email ?> </td>
						<td> <?php if ($row->estado == 1) {echo 'Nuevo mensaje';} else {echo 'Visto';}?> </td>
						<td> <?php echo $row->fecha ?> </td>

						<td>
							<a class="btn btn-success" title="Ver mensaje" onclick="detalle(<?=$row->id_buzon?>)">
							<i class="fa fa-pencil-alt"></i>
							</a>
						</td>

						<td>
							<a class="btn btn-danger"
							   href="<?php echo base_url('admin_controller/eliminar_consulta/' . $row->id_buzon); ?>" title="Eliminar">
							   <i class="fas fa-trash"></i>
							</a>
						</td>

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

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalCenterTitle">Buzon Entrada</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>

      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">


        <form action="<?=base_url('msjVisto');?>" method="post">
        	<button type="submit" name="msjVisto" value="<?=$row->id_buzon?>" class="btn btn-primary" title="Aceptar">Aceptar</button>
         </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function detalle(id){
    $.ajax({
      type: 'post',
      url: "<?=base_url('vista_buzon');?>",
      data: {'id': id},
      success: function(data) {
        $('.modal-body').html(data);
        $('#exampleModalCenter').modal('show');
      },
    });
  }
</script>