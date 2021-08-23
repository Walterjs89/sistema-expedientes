<div class="row">
  <div class="col-md-4">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Datos Cliente</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" id="updateCliente">
        <div class="box-body">
          <div class="form-group">
            <label for="nombre">NOMBRE: </label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $cliente->cliente ?>" placeholder="Nombre" required>
            <input type="hidden" id="id_cliente" name="id_cliente" value="<?= $cliente->id_cliente ?>" required>
          </div>
          <div class="form-group">
            <label for="correo">CORREO: </label>
            <input type="email" class="form-control" id="correo" name="correo" value="<?= $cliente->correo ?>" placeholder="Correo" required>
          </div>
          <div class="form-group">
            <label for="telefono">TELEFONO: </label>
            <input type="text" class="form-control" id="telefono" name="telefono" data-inputmask='"mask": "(999) 999-9999"' data-mask value="<?= $cliente->telefono ?>" placeholder="Telefono" required>
          </div>
          <div class="form-group">
            <label for="direccion">DIRECCION: </label>
            <textarea class="form-control" id="direccion" name="direccion" placeholder="Direccion" required><?= $cliente->direccion ?></textarea>
          </div>
        </div>
        <div id="msg_ucliente"></div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right">Actualizar</button>
        </div>
      </form>
    </div>
  </div>
  <div class="col-md-8">
    <div class="box box-primary">
      <div class="box-body table-responsive">
        <table id="tbl_expte" class="table table-bordered table-striped">
          <thead>
          <tr style="background: #4C9DBD; color: white">
            <th>EXPTE</th>
            <th>PERIODO</th>
            <th>MONTO</th>
            <th>N° PEDIDO</th>
            <th>ACCION</th>
          </tr>
          </thead>
          <tbody>
            <?php if (!empty($dcliente)) {
                foreach ($dcliente ->result() as $datos) { ?>
                  <tr>
                    <td><?= $datos->num_expte ?></td>
                    <td><?= $datos->periodo ?></td>
                    <td><?= number_format($datos->monto, ",", ".") ?></td>
                    <td><?= $datos->num_pedido ?></td>
                    <td>
                      <a href="<?= base_url() ?>expediente/perfil/<?= $datos->id_expte ?>" class="btn btn-primary btn-block btn-xs">Perfil</a>
                    </td>
                  </tr>
            <?php } } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>  
</div>