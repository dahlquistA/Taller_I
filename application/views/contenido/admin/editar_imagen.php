<div class="d-flex justify-content-center align-items-center contenedor-form" >
    <div class="col-md-8">
        <h1 class="page-header" style="text-align:center;">Edicion del Producto</h1>
        <hr />

        <form action="<?=base_url('actualizarImg/') . $id_producto;?>"  method="post" enctype="multipart/form-data">

            <div class="card " style="width: 23.9rem;">
                <img class="card-img-top" src="<?=base_url('uploads/imagenes_producto/') . $imagen;?>" alt="Card image cap">
            </div>


            <!---SECCION QUE SELECCIONA LA IMAGEN PARA AGREGAR-->
            <div class="form-group">
                <label for="imagen">Imagen</label>
                <?php echo form_input(['name' => 'imagen', 'id' => 'imagen', 'type' => 'file', 'value' => set_value('imagen')]); ?>
            </div>
            <div class="mensaje_error"><?php echo form_error('imagen'); ?></div>

            <!--- FIN SECCION QUE SELECCIONA LA IMAGEN PARA AGREGAR-->

            <button type="submit" class="btn btn-success" name="submit" >Modificar</button>
           <a href="<?=base_url('actualizar/') . $id_producto;?>"><div class="btn btn-success float-right" >Atras</div></a>
        </form>
    </div>
</div>