<div class="container table-responsive my-5 py-5 text-white rounded" style="background: rgba(0,0,0,.8)">
  <!-- Page Heading/Breadcrumbs -->
  <div class="row ">
    <div class="col-lg-12 ">
      <h1 class="page-header" style="text-align:center">Buzon de Entrada</h1>
    </div>
  </div>
  <hr />

  <div class="row d-flex justify-content-center ">
    <div class="col-md-12 ">

      <table id="mytable" class="table table-bordred table-striped table-hover border border-dark">

        <thead>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Email</th>
          <th>Mensaje</th>
        </thead>



        <tbody>
          <?php
$var_prod = new Producto_model();
foreach ($detalle as $row) {

    ?>
            <tr>
              <td> <?php echo $row->nombre ?> </td>
              <td> <?php echo $row->apellido ?> </td>
              <td> <?php echo $row->email ?> </td>
              <td> <?=$row->mensaje?></td>
            </tr>

            <?php }?>

        </tbody>
      </table>
    </div>
  </div>
</div>