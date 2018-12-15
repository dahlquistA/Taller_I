<div class="container my-5 py-5" style="background: rgba(0,0,0,.7) ">
  <h2 class="text-white text-center ">Catalogo de Productos</h2>
  <div class="d-flex justify-content-center align-items-center ">
    <div class="row w-100 py-5 margin-auto">

      <?php foreach ($productos as $row) {

    foreach ($this->cart->contents() as $item) {
        if ($item['id'] == $row->id_producto) {
            $row->stock = $row->stock - $item['qty'];
        }
    }
    ?>
      <?php if (!($row->estado == 0) && ($row->stock > 0)) {
        ?>
        <div class="col ml-5 py-5">
          <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="<?=base_url('uploads/imagenes_producto/') . $row->img;?>" alt="Card image cap">

            <div class="card-body">
              <h5 class="card-title"><?php echo $row->descripcion ?></h5>
              <p class="card-text"> </p>
            <p><b>Precio: $</b><?php echo $row->precio; ?> ARS</p>
            <p class="card-text"> </p>
            <p><b>Stock disponible: </b><?php echo $row->stock; ?> unidades</p>

            <form method="post" action="<?=base_url('agregar_al_carrito');?>">
            <button class="btn" type="submit" name="id" value="<?=$row->id_producto;?>">Agregar al carrito</button>
          </form>
         </div>

        </div>
      </div>
    <?php }?>
    <?php }?>
  </div>
</div>
<div class="paginacion text-center float-right mb-3">
  <h2><?php echo $this->pagination->create_links(); ?></h2>
  </div>
</div>