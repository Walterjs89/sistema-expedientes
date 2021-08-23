<div class="row">
<!-- left column -->
  <div class="col-md-4">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Ingresar Cliente</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" id="agregarCliente">
        <div class="box-body">
          <div class="form-group">
            <label for="cliente">NOMBRE: </label>
            <input type="text" class="form-control" id="cliente" name="cliente" placeholder="Nombre del cliente" required>
          </div>
          <div class="form-group">
            <label for="correo">CORREO: </label>
            <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo del cliente" required>
          </div>
          <div class="form-group">
            <label for="telefono">TELEFONO: </label>
            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Telefono del cliente" data-inputmask='"mask": "(999) 999-9999"' data-mask required>
          </div>
          <div class="form-group">
            <label for="direccion">DIRECCION: </label>
            <textarea class="form-control" id="direccion" name="direccion" placeholder="Direccion..." required></textarea>
            <!-- <input type="text" > -->
          </div>
        </div>
        <div id="msg_cliente"></div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right">Agregar</button>
        </div>
      </form>
    </div>
  </div>
  <div class="col-md-8">
    <div class="box box-primary">
      <div class="box-body table-responsive">
        <table id="tbl_cliente" class="table table-bordered table-striped">
          <thead>
          <tr style="background: #4C9DBD; color: white">
            <th>NOMBRE</th>
            <th>TELEFONO</th>
            <th>CORREO</th>
            <th>ACCION</th>
          </tr>
          </thead>
          <tbody>            
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>