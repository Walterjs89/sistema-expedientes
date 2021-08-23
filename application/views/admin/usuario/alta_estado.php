<div class="row">
<!-- left column -->
  <div class="col-md-4">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Ingresar Estado</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" id="agregarEstado">
        <div class="box-body">
          <div class="form-group">
            <label for="estado">Estado: </label>
            <input type="text" class="form-control" id="estado" name="estado" placeholder="Nombre del usuario" required>
          </div>
        </div>
        <div id="msg_usuario"></div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right">Agregar</button>
        </div>
      </form>
    </div>
  </div>
  <div class="col-md-8">
    <div class="box box-primary">
      <div class="box-body table-responsive">
        <table id="tbl_estado" class="table table-bordered table-striped">
          <thead>
          <tr style="background: #4C9DBD; color: white">
            <th>FECHA</th>
            <th>ESTADO</th>
            <th>ACCION</th>
          </tr>
          </thead>
          <tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div class="modal fade eliminarEstado" id="deleteUsuario" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <form id="eliminarEstado">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
              <h4 class="modal-title" id="myModalLabel" style="font-weight: bold;color: #393737">Eliminar Usuario</h4>
            </div>
            <div class="col-md-12" style="margin-top: 20px">
              <div class="alert  alert-dismissible fade in" role="alert" style="background-color: #F7BFB0">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                </button>
                <strong style="font-weight: bold;color: #DC1D0D"><center><i class="fa fa-warning" style="width: 30px"></i> Esta accion eliminara el usuario de este sistema.</center></strong> 
              </div>
              <input type="hidden" name="meid" id="meid" required>
            </div>
          </div>
          <div id="msg_eusuario"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary" id="btn-eliminar" style="background-color:#DC1D0D;border: 0">Eliminar</button>
        </div>
      </form>
    </div>
  </div>
</div>