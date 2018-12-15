<div style="min-height: 500px">
	<div class="container  py-5 text-white rounded" style="margin-top: 100px; background:rgba(0,0,0,.8);">
	<div class="d-flex justify-content-center align-items-center " >
		<div class="col-md-8">
			<h3 class="page-header" style="text-align:center;" >Modificar Contraseña</h3>
			<hr />

			<form action="<?=base_url('actualizarPass/') . $id_persona;?>"  method="post" enctype="multipart/form-data">
				<hr />

	            <div class="form-group">
	                <label for="password">Contraseña</label>
	                <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese nueva contraseña..." required>
	                <div class="mensaje_error"><?php echo form_error('password'); ?></div>
	            </div>

	             <div class="form-group">
	                <label for="passconf">Confirmar Contraseña</label>
	                <input type="password" class="form-control" id="passconf" placeholder="Confirmar contraseña..." name="passconf" required>
	                <div class="mensaje_error"><?php echo form_error('passconf'); ?></div>
	            </div>

           <button type="submit" class="btn btn-success" name="submit" >Modificar</button>
	 	   <a href="<?=site_url('misDatos')?>"><div class="btn btn-success float-right"  >Volver</div></a>
        </form>
    </div>
</div>
<hr />


</div>

</div>
