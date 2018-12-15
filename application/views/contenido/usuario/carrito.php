<?php
if (empty($this->cart->contents())) {
    ?>
    <div>
      carrito vacio
    </div>

    <?php
} else {
    ?>

<div class="container table-responsive  py-5" style="background: rgba(0,0,0,.7)">
  <!-- Page Heading/Breadcrumbs -->

  <div class="row">
    <div class="col-lg-12 ">
      <h1 class="page-header" style="text-align:center">Mi Carrito</h1>
    </div>
  </div>
  <div class="row d-flex justify-content-center align-items-center " style="background: rgba(0,0,0,.7)">
    <div class="col-md-8 ">
      <table id="mytable" class="table table-bordred table-striped table-hover border border-dark">

        <thead>
          <th>Codigo</th>
          <th>Descripcion</th>
          <th>Cantidad</th>
          <th>Precio/unidad</th>
          <th>Subtotal</th>
          <th>Eliminar</th>
        </thead>

        <tbody>
          <?php
foreach ($this->cart->contents() as $producto) {
        ?>

          <tr>
            <td> <?php echo $producto['options']['codigo']; ?> </td>
            <td> <?php echo $producto['name']; ?> </td>
            <td> <?php echo $producto['qty']; ?> </td>
            <td> <?php echo $producto['price']; ?> </td>
            <td> <?php echo $producto['subtotal']; ?> </td>
            <td>

            <form action="<?=base_url('eliminar_del_carrito');?>" method="post">
                <button type="submit" name="id" value="<?=$producto['rowid'];?>" class="btn btn-danger">Borrar</button>
              </form>
            </td>

            <td></td>
            <?php
}
    ?>
          </tr>

        </tbody>
      </table>
      <div><?=$this->cart->total()?></div>
    </div>
  </div>
</div>
<?php
}
?>