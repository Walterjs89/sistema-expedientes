<div class="row">
<!-- left column -->
  <div class="col-md-3">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Ingresar Expediente</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" id="agregarExpediente">
        <div class="box-body">
          <div class="form-group">
            <label for="cliente">CLIENTE : </label>
            <select class="form-control select2" id="cliente" name="cliente" style="width: 100%">
              <?php if (!empty($dcleinte)) { 
                foreach ($dcleinte ->result() as $d){ ?>
              <option value="<?= $d->id_cliente ?>"><?= $d->cliente ?></option>
              <?php } }  ?>
            </select>
          </div>
          <div class="form-group">
            <label for="num_expte">N° EXPEDIENTE : </label>
            <input type="text" class="form-control" name="num_expte" id="num_expte" placeholder="N° de expediente">
          </div>
          <div class="form-group">
            <label for="periodo">PERIODO : </label>
            <input type="text" class="form-control" name="periodo" id="periodo" placeholder="Periodo" required>
          </div>
          <!-- <div class="form-group">
            <label for="periodo">MES : </label>
            <select name="mes[]" id="mes[]" multiple="multiple" data-placeholder="Seleccionar un mes" class="form-control select2" style="width: 100%">
            	<option>Enero</option>	
            	<option>Febrero</option>	
            	<option>Marzo</option>	
            	<option>Abril</option>	
            	<option>Mayo</option>	
            	<option>Junio</option>	
            	<option>Julio</option>	
            	<option>Agosto</option>	
            	<option>Septiembre</option>	
            	<option>Octubre</option>	
            	<option>Noviembre</option>	
            	<option>Diciembre</option>	
            </select>
          </div> -->
          <div class="form-group">
            <label for="monto">MONTO : </label>
            <input type="number" class="form-control" name="monto" step="any" id="monto" placeholder="Monto" required>
          </div>
          <div class="form-group">
            <label for="num_perido">N° PEDIDO DE FONDO : </label>
            <input type="text" class="form-control" name="num_perido" id="num_perido" placeholder="N° pedido de fondo">
          </div>
          <div class="form-group">
            <label for="fecha_expte">FECHA EXPEDIENTE : </label>
            <input type="date" class="form-control" name="fecha_expte" id="fecha_expte" placeholder="Fecha de alta">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">RELACION : </label>
            <select class="form-control select2" name="relacion" id="relacion" style="width: 100%">
              <option value="NO">NO</option>
              <?php if (!empty($datos)) {
                foreach ($datos ->result() as $expte) { ?>
                <option value="<?= $expte->id_expte ?>"><?= $expte->num_expte ?></option>
              <?php } } ?>
            </select>
          </div>
          <div id="msg_agregarexpte"></div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right">Enviar</button>
        </div>
      </form>
    </div>
    <div class="box box-primary">
      <div class="box-body">        
        <p><strong>MONTO TOTAL: </strong>$  <span id="amount_total"><?= number_format($monto->total,2, ",", ".") ?> </span></p>
      </div>
    </div>
  </div>
  <div class="col-md-9">
    <div class="box box-primary">
      <div class="box-body table-responsive">
        <table id="tbl_expediente" class="table table-bordered table-striped">
          <thead>
            <tr style="background: #4C9DBD; color: white">
              <th>CLIENTE</th>
              <th>EXPTE</th>
              <th>PERIODO</th>
              <th>MONTO</th>
              <th>N° PEDIDO DE FONDO</th>
              <th>ESTADO</th>
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
<div class="modal fade editarExpte" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header" style="background: #3C8DBC; color: white">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar Expediente</h4>
      </div>
      <form role="form" id="updateExpte">
        <div class="modal-body">
          <div class="box-body">
            <div class="row">
              <div class="form-group col-md-6">
                <label for="mcliente" style="font-weight: normal">CLIENTE :</label>
                <input type="text" class="form-control" id="mcliente" name="mcliente" placeholder="Articulo" disabled required>
                <input type="hidden" class="form-control" id="mid" name="mid" required>
              </div>
              <div class="form-group col-md-6">
                <label for="mnumero" style="font-weight: normal">N° EXPEDIENTE :</label>
                <input type="text" class="form-control" id="mnumero" name="mnumero" placeholder="Codigo" required>
              </div>
              <div class="form-group col-md-6">
                <label for="mperiodo" style="font-weight: normal">PERIODO :</label>
                <input type="text" class="form-control" id="mperiodo" name="mperiodo" placeholder="Codigo" required>
              </div>   
              <div class="form-group col-md-6">
                <label for="mmonto" style="font-weight: normal">MONTO :</label>
                <input type="text" class="form-control" id="mmonto" name="mmonto" placeholder="Permisos" required>
              </div>
              <div class="form-group col-md-6">
                <label for="mpedido" style="font-weight: normal">PEDIDO :</label>
                <input type="text" class="form-control" id="mpedido" name="mpedido" placeholder="Permisos" required>
              </div>
              <div class="form-group col-md-6">
                <label for="mfecha" style="font-weight: normal">FECHA ALTA :</label>
                <input type="date" class="form-control" id="mfecha" name="mfecha" placeholder="Fecha de alta" required>
              </div>
              <!-- <div class="form-group col-md-6">
                <label for="mestado">Estado :</label>
                <input type="text" class="form-control" id="mestado" name="mestado" placeholder="Estado del expediente" required>
              </div> -->
              <div class="form-group col-md-6">
                <label for="mestado" style="font-weight: normal">ESTADO : </label>
                <select class="form-control" name="mestado" id="mestado" style="width: 100%">
                  <!-- <option value="NO">NO</option> -->
                  <?php if (!empty($destado)) {
                    foreach ($destado ->result() as $dato) { ?>
                    <option value="<?= $dato->estado ?>"><?= $dato->estado ?></option>
                  <?php } } ?>
                </select>
              </div>
            </div>
            <div id="msg_expte"></div>
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
<div class="modal fade eliminarUsuario" id="deleteExpte" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <form id="eliminarExpte">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
              <h4 class="modal-title" id="myModalLabel" style="font-weight: bold;color: #393737">Eliminar Expediente</h4>
            </div>
            <div class="col-md-12" style="margin-top: 20px">
              <div class="alert  alert-dismissible fade in" role="alert" style="background-color: #F7BFB0">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                </button>
                <strong style="font-weight: bold;color: #DC1D0D"><center><i class="fa fa-warning" style="width: 30px"></i> Esta accion eliminara el expediente de este sistema.</center></strong> 
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