 <div class="container my-5 py-5" style="background: rgba(0,0,0,.7)">
  <div class="row d-flex justify-content-around px-5">

    <?php if (empty($producto)) {
    ?>
      <div class="container">
        <h3 class="text-center text-white"> No se encontraron resultados para: "<?= $this->session->userdata("buscador")?>"</h3>
        <br />
        <br />
      </div>

      <?php } else { 
    ?>
    
      <div class="container float-right">
        <h4 class="text-center text-white">Resultados para:<b> "<?= $this->session->userdata("buscador")?>" </b></h4>
      </div>

        <?php foreach ($producto as $row) {
        ?>
          <?php if (!($row->estado == 0) && ($row->stock > 0)) {?>
          
          <div class="col-xs-2 pt-5 mr-2">
            <div class="card card_galeria text-white"  >
              <img class="galeria_img " src="<?=base_url('uploads/imagenes_producto/') . $row->img;?>" alt="Card image cap" >
              <div class="card-body">
                <p class="card-title text-center"><?php echo $row->descripcion ?></p>
                <p class="card-text"> </p>
                <p><b>Precio: $</b><?php echo $row->precio; ?> ARS</p>
                <p class="card-text"> </p>
                <p><b>Stock: </b><?php echo $row->stock; ?> unidades</p>
              </div>
            </div>
          </div>
        
          <?php }?>
        <?php }?>
      <?php }?>
   </div>
    <?php echo $pagination ?>
</div>
