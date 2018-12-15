<div class="d-flex justify-content-center align-items-center contenedor-form">
    <div class="col-md-8">
        <h2>Alta de Productos</h2>
        <hr />
        <form action="<?php echo base_url('validarProducto'); ?>"  method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="codigo">Codigo del producto</label>
                <input type="text" class="form-control" id="codigo" placeholder="Codigo..." name="codigo" value="<?=set_value('codigo');?>" required >
                <div id="error-codigo" class="mensaje_error"><?php echo form_error('codigo'); ?></div>
            </div>

            <div class="form-group">
                <label for="validationCustum02">Nombre</label>
                <input type="text" class="form-control" id="validationCustum02" placeholder="Nombre..." name="nombre" value="<?=set_value('nombre')?>" required>
                <div class="mensaje_error"><?php echo form_error('nombre'); ?></div>
            </div>

            <div class="form-group">
                <label for="validationCustom03">Precio (Ejemplo: 00.00)</label>
                <input type="text" class="form-control" id="validationCustom03" placeholder="00.00" name="precio" value="<?=set_value('precio')?>" required>
                <span class="mensaje_error"><?php echo form_error('precio'); ?></span>
            </div>

            <div class="form-group">
                <label for="validationCustom04">Stock</label>
                 <input type="text" class="form-control" id="validationCustom04" placeholder="Stock..." name="stock"
                            value="<?=set_value('stock')?>" required>
                 <div class="mensaje_error"><?php echo form_error('stock'); ?></div>
            </div>

            <div class="form-group">
                <label for="categoria">Categoria</label>
                <select class="form-control" id="categoria" name="categoria">
                <option value="" selected>Seleccionar</option>

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
                <input type="text" class="form-control" id="descripcion" placeholder="Descripcion..." name="descripcion"
                       value="<?=set_value('descripcion')?>" required>
                 <span class="mensaje_error"><?php echo form_error('descripcion'); ?></span>
            </div>

            <!---SECCION QUE SELECCIONA LA IMAGEN PARA AGREGAR-->
            <div class="form-group">
                <label for="imagen">Imagen</label>
                <?php echo form_input(['name' => 'imagen', 'id' => 'imagen', 'type' => 'file', 'value' => set_value('imagen')]); ?>
            </div>
            <span class="text-danger"><?php echo form_error('imagen'); ?> </span>
            <!--- FIN SECCION QUE SELECCIONA LA IMAGEN PARA AGREGAR-->

            <button type="submit" class="btn btn-success btn-block">Agregar Producto</button>
            <div class="btn btn-success btn-block" id="borrar" onclick="borrarForm()" >Limpiar </div>

        </form>
    </div>
</div>

<script type="text/javascript">
    function borrarForm() {
        $('.form-control').val('');
    }

</script>
