<div class="row">
<!-- left column -->
  <div class="col-md-4">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Ingresar Usuario</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" id="agregarUsuario">
        <div class="box-body">
          <div class="form-group">
            <label for="nombre">Nombre: </label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del usuario" required>
          </div>
          <div class="form-group">
            <label for="correo">Correo: </label>
            <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo del usuario" required>
          </div>
          <div class="form-group">
            <label for="contrasena">Contraseña: </label>
            <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Contraseña" required>
          </div>
          <div class="form-group">
            <label for="permisos">Permisos: </label>
            <select class="form-control select2" id="permisos" name="permisos" style="width: 100%" required>
            	<option>Admin</option>
            	<option>Usuario</option>
            </select>
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
        <table id="tbl_usuario" class="table table-bordered table-striped">
          <thead>
          <tr style="background: #4C9DBD; color: white">
            <th>NOMBRE</th>
            <th>CORREO</th>
            <th>PERMISOS</th>
            <th>ACCION</th>
          </tr>
          </thead>
          <tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div class="modal fade editarUsuario" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header" style="background: #3C8DBC; color: white">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar Usuario</h4>
      </div>
      <form role="form" id="updateUsuario">
        <div class="modal-body">
          <div class="box-body">
            <div class="row">
              <div class="form-group col-md-6">
                <label for="mnombre">Nombre :</label>
                <input type="text" class="form-control" id="mnombre" name="mnombre" placeholder="Articulo" required>
                <input type="hidden" class="form-control" id="mid" name="mid" required>
              </div>
              <div class="form-group col-md-6">
                <label for="mcorreo">Correo :</label>
                <input type="text" class="form-control" id="mcorreo" name="mcorreo" placeholder="Codigo" required>
              </div>
              <div class="form-group col-md-6">
                <label for="mpassword">Contraseña :</label>
                <input type="text" class="form-control" id="mpassword" name="mpassword" placeholder="Codigo" required>
              </div>   
              <div class="form-group col-md-6">
                <label for="mpermisos">Permisos :</label>
                <input type="text" class="form-control" id="mpermisos" name="mpermisos" placeholder="Permisos" required>
              </div>
            </div>
            <div id="msg_ausuario"></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade eliminarUsuario" id="deleteUsuario" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <form id="eliminarUsuario">
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