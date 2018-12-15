
<!--FORMA PARA LISTAR TODOS LOS USUARIOS DE LA BASE DE DATOS -->
<div class="container table-responsive my-5 py-5 text-white" style="background: rgba(0,0,0,.7)">
  <!-- Page Heading/Breadcrumbs -->
  <div class="row ">
    <div class="col-lg-12 ">
      <h1 class="page-header" style="text-align:center">Listado de Usuarios</h1>
    </div>
  </div>
  <hr />
  <div class="row d-flex justify-content-center align-items-center ">
    <div class="col-md-8 ">
      <table id="mytable" class="table table-bordred table-striped table-hover border border-dark">
        <thead>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Correo</th>
          <th>Alta/Baja</th>
          <th>Admin</th>
        </thead>

        <tbody>
          <?php foreach ($usuarios as $persona) {
    ?>
          <tr <?php if ($persona->estado == 0) {echo 'style="color: red;"';}
    ;?> >
            <td> <?php echo $persona->nombre; ?> </td>
            <td> <?php echo $persona->apellido; ?> </td>
            <td> <?php echo $persona->email; ?> </td>

            <?php if (($persona->estado) == 1) {
        ?>


            <td> <?php $disabled = '';
        if ($persona->id_perfil == 1) {$disabled = 'disabled';}?>
              <form action="<?=base_url('borrar');?>" method="post">
                <button type="submit" name="borrar" value="<?=$persona->id_persona?>" <?=$disabled;?> class="btn btn-danger" title="Dar de Baja">Borrar</button>
              </form>
            </td>

            <td>
              <form action="<?=base_url('admin');?>" method="post">
              <button type="submit" name="admin" value="<?=$persona->id_persona?>" <?=$disabled;?> class="btn btn-primary" title="Hacer Administrador">Admin</button>
              </form>
            </td>

            <?php } else {?>

            <td>
              <form action="<?=base_url('activar');?>" method="post">
                <button type="submit" name="activar" value="<?=$persona->id_persona?>" class="btn btn-success" title="Dar de Alta">Activar</button>
              </form>
            </td>
            <td></td>

            <?php }?>
          </tr>
          <?php }?>
        </tbody>

      </table>

      <div class="floar float-right">
      <p><?php echo $this->pagination->create_links(); ?></p>

      </div>
    </div>
  </div>
</div>