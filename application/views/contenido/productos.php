<div class="container my-5 py-5" style="background: rgba(0,0,0,.7)"> 

  <div class="align-items-center row d-flex mx-5 ">

    <div class="p-0 m-0 col-md-6 text-left">
       <div class="h3 text-white ">Catálogo de Productos</div>
    </div>

    <div class="col-md-6 text-right ">
      <div class="btn-group btn-group-lg" role="group" aria-label="Button group with nested dropdown">

        <button type="button" class="btn btn-secondary">Todo</button>
        <button type="button" class="btn btn-secondary">Mates</button>
        <button type="button" class="btn btn-secondary">Bombillas</button>

        
     </div>
    </div>
      
    
   
  </div>

  <div class="row d-flex justify-content-around px-5">

      <?php foreach ($productos as $row) {
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
  
  </div>
    <?php echo $pagination ?>
</div>
