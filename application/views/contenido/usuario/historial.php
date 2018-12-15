
<!--FORMA PARA LISTAR TODOS LOS USUARIOS DE LA BASE DE DATOS -->
<div class="container table-responsive my-5 py-5 text-white rounded" style="background: rgba(0,0,0,.7)">
  <!-- Page Heading/Breadcrumbs -->
  <div class="row ">
    <div class="col-lg-12 ">
      <h1 class="page-header" style="text-align:center">Historial de compras</h1>
    </div>
  </div>
  <hr />
  <div class="row d-flex justify-content-center align-items-center ">
    <div class="col-md-6 ">

      <table id="mytable" class="table table-bordred table-striped table-hover border border-dark rounded">

        <thead>

          <th><b>Fecha y Hora</b></th>
          <th><b>Detalle</b></th>
        </thead>

        <tbody>
          <?php foreach ($compras as $row) {
    ?>
          <tr>
            <td> <?php echo $row->fecha; ?> </td>
            <td> <button class="btn btn-success" onclick="detalle(<?=$row->id_compra?>)"> Ver </button></td>
          </tr>

          <?php }?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalCenterTitle">Mis Compras</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>

      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function detalle(id){
    $.ajax({
      type: 'post',
      url: "<?=base_url('vista_detalle');?>",
      data: {'id': id},
      success: function(data) {
        $('.modal-body').html(data);
        $('#exampleModalCenter').modal('show');
      },
    });
  }
</script>