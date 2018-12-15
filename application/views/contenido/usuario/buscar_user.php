 <div class="container d-flex justify-content-center align-items-center my-5 py-5" style="background: rgba(0,0,0,.7)">
  <div class="row w-100 py-5 margin-auto">
    <?php if (empty($producto)) {
    ?>
      <div class="container">
        <h3 class="text-center text-white"> No se encontraron resultados para: "<?=$this->input->post('busca')?>"</h3>
        <br />
        <br />
      </div>

      <?php } else {
    ?> <div class="container float-right">
          <h4 class="text-center text-white">Resultados para:<b> "<?=$this->input->post('busca')?>" </b></h4>
       </div>

        <?php foreach ($producto as $row) {
        ?>
          <?php if (!($row->estado == 0) && ($row->stock > 0)) {?>

          <div class="col ml-5 py-5">
            <div class="card" style="width: 18rem;">
              <img class="card-img-top" src="<?=base_url('uploads/imagenes_producto/') . $row->img;?>" alt="Card image cap">
              <div class="card-body">
            <h5 class="card-title"><?php echo $row->descripcion ?></h5>
            <p class="card-text"> </p>
            <p><b>Precio: $</b><?php echo $row->precio; ?> ARS</p>
            <p class="card-text"> </p>
            <p><b>Stock disponible: </b><?php echo $row->stock; ?> unidades</p>
              </div>

            </div>
          </div>
          <?php }?>
        <?php }?>
      <?php }?>
  </div>
  
</div>