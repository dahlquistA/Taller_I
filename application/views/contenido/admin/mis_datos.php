<div class="d-flex justify-content-center align-items-center contenedor-form" >
    <div class="col-md-8">
        <h1 class="page-header" style="text-align:center;">Mis Datos</h1>
        <hr />

        <form action="<?=base_url('actualizar_usuario/') . $id_persona;?>"  method="post" enctype="multipart/form-data">
            <hr />

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?=($nombre);?>" required>
                <div class="mensaje_error"><?php echo form_error('nombre'); ?></div>
            </div>

            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" value="<?=($apellido);?>" required>
                <div class="mensaje_error"><?php echo form_error('apellido'); ?></div>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="<?=($email);?>" required>
                <div class="mensaje_error"><?php echo form_error('email'); ?></div>
            </div>

            <div class="form-group">
                <label for="telefono">Telefono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" value="<?=($telefono)?>" required>
                <div class="mensaje_error"><?php echo form_error('telefono'); ?></div>
            </div>

            <div class="form-group pb-4">
                <a  class="float-right" href="<?=base_url('modifClave')?>" >Modificar contraseña</a>
            </div>


            <button type="submit" class="btn btn-success btn-block">Modificar</button>
        </form>
    </div>
</div>