<div class="d-flex justify-content-center align-items-center contenedor-form" >
    <div class="col-md-8">
        <h1 class="page-header" style="text-align:center;">Edicion del Producto</h1>
        <hr />

        <form action="<?=base_url('actualizar/') . $id_producto;?>"  method="post" enctype="multipart/form-data">

            <div class="card " style="width: 23.9rem;">
                <img class="card-img-top" src="<?=base_url('uploads/imagenes_producto/') . $imagen;?>" alt="Card image cap">
            </div>

             <div class="form-group pb-4 float-right">
                <a href="<?php echo base_url('producto_controller/editar_imagen/' . $id_producto); ?>" >Cambiar imagen</a>
            </div>
            <hr />

            <div class="form-group">
                <label for="codigo">Codigo del Producto</label>
                <input type="text" class="form-control" style="background: rgba(0,0,0,.7);" id="codigo" name="codigo" value="<?=($codigo);?>" disabled>
            </div>

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?=($nombre);?>" required>
                <div class="mensaje_error"><?php echo form_error('nombre'); ?></div>
            </div>

            <div class="form-group">
                <label for="descripcion">Precio (Ejemplo 00.00)</label>
                <input type="text" class="form-control" id="descripcion" name="precio" value="<?=($precio);?>" >
                <div class="mensaje_error"><?php echo form_error('precio'); ?></div>
            </div>

            <div class="form-group">
                <label for="stock">Stock (unidades)</label>
                <input type="text" class="form-control" id="stock" name="stock" value="<?=($stock)?>" required>
                <div class="mensaje_error"><?php echo form_error('stock'); ?></div>
            </div>

             <div class="form-group">
                <label for="categoria">Categoria</label>
                <select class="form-control" id="categoria" name="categoria">
                <option value="" selected > Seleccionar </option>

                <?php
foreach ($categoria as $row) {
    $selected = '';

    if ($row->categoria_id == $cat_select) {$selected = 'selected';}
    echo "
                          <option value='$row->categoria_id' $selected> $row->descripcion </option>";
}?>

                </select>
                <span class="text-danger"><?php echo form_error('categoria'); ?> </span>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripcion</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion"
                value="<?=($descripcion)?>" required>
                <div class="mensaje_error"><?php echo form_error('descripcion'); ?></div>
            </div>


            <!--- FIN SECCION QUE SELECCIONA LA IMAGEN PARA AGREGAR-->

            <button type="submit" class="btn btn-success" name="submit" >Modificar Producto</button>
           <a href="<?=site_url('listar_productos')?>"><div class="btn btn-success float-right"  >Volver</div></a>
        </form>
    </div>
</div>