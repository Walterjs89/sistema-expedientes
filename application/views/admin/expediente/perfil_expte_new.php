<div class="row">
  <div class="col-md-3">
    <div class="box box-primary">
      <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="<?= base_url() ?>assets/img/default-50x50.gif" alt="User profile picture">
        <h3 class="profile-username text-center">N° Expediente</h3>
        <p class="text-muted text-center"><?= $datos->num_expte ?></p>
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <b>Cliente</b> <a class="pull-right"><?= $datos->cliente ?></a>
          </li>
          <li class="list-group-item">
            <b>Periodo</b> <a class="pull-right"><?= $datos->periodo ?></a>
          </li>
          <li class="list-group-item">
            <b>Monto</b> <a class="pull-right">$ <?= number_format($datos->monto,2, ",", ".") ?></a>
          </li>
          <li class="list-group-item">
            <b>N° Pedido fondo</b> <a class="pull-right"><?= $datos->num_pedido ?></a>
          </li>
        </ul>
      </div>
    </div>
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Relaciones</h3>
      </div>
      <div class="box-body no-padding">
        <table class="table table-condensed">
          <tr>
            <!-- <th style="width: 10px">#</th> -->
            <th>N° EXPTE</th>
            <th>FECHA</th>
            <th style="width: 40px">ACCION</th>
          </tr>
          <?php if (!empty($drelacion)) { $i = 1;
            foreach ($drelacion ->result() as $data){
            $expte = $this->Modelo_expediente->getDatosExpte($data->padre_expte);
            ?>
              <tr>
                <!-- <td><?= $i ?></td> -->
                <td><?= $expte->num_expte ?></td>
                <td><?= $expte->alta_expte ?></td>
                <td>
                  <a href="<?= base_url()?>expediente/perfil/<?= $expte->id_expte ?>" class="btn btn-primary btn-xs">Ver</a>
                </td>
              </tr>
          <?php $i++; } }  ?>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-9">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Actividades</h3>
        <div class="box-tools pull-right">
          <div class="btn-group">
            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bars"></i></button>
            <ul class="dropdown-menu pull-right" role="menu">
              <li>
                <a href="#" data-toggle="modal" onclick="nuevaActividad(<?= $datos->id_expte ?>)" data-target=".nuevaActividad">Nueva Actividad</a>
              </li>
              <li>
                <a href="#" data-toggle="modal" data-target=".nuevaRelacion">Nueva Relacion</a>
              </li>
              <li><a href="<?= base_url() ?>cliente/perfil/<?= $datos->ref_cliente ?>">Ver Cliente</a></li>
              <li><a href="#" data-toggle="modal" onclick="updateDatos(<?= $datos->id_expte ?>,'<?= $datos->cliente ?>','<?= $datos->num_expte ?>','<?= $datos->periodo ?>','<?= $datos->monto ?>','<?= $datos->num_pedido ?>','<?= $datos->alta_expte ?>')" data-target=".updateExpte">Actualizar datos</a></li>
              <!-- <li class="divider"></li> -->
              <!-- <li><a href="<?= base_url() ?>calendario/expte/1">Calendario Actividades</a></li> -->
            </ul>
          </div>
          <!-- <button type="button" class="btn btn-box-tool"><i class="fa fa-navicon"></i></button> -->
        </div>
      </div>
      <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          <tr>
            <th>PERSONAL</th>
            <th>ORIGEN</th>
            <th>DESTINO</th>
            <th>FECHA</th>
            <th>ESTADO</th>
            <th>ACCION</th>
          </tr>
          <?php if (!empty($dactividad)) { $i = 1;
            foreach ($dactividad ->result() as $datos){  ?>
          <tr>
            <td><?= $datos->personal ?></td>
            <td><?= $datos->origen ?></td>
            <td><?= $datos->destino ?></td>
            <td><?= $datos->alta_actividad ?></td>
            <?php 
              $result = $this->funciones->colores($datos->estado);
            ?>
            <td><span class="label label-<?= $result ?>"><?= $datos->estado ?></span></td>
            <td>
              <a href="#" class="btn btn-success btn-xs" onclick="verHistorial(<?= $datos->id_actividad ?>)" data-toggle="modal" data-target=".historialActividad">Historial</a> 
              <a href="#" class="btn btn-primary btn-xs" onclick="updateAct('<?= $datos->id_actividad ?>','<?= $datos->destino ?>','<?= $datos->origen ?>','<?= $datos->alta_actividad ?>')" data-toggle="modal" data-target=".updateDatosExpte">Editar</a>
            </td>
          </tr>
          <?php } } ?>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="modal fade nuevaRelacion" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header" style="background: #3C8DBC; color: white">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Agregar relacion</h4>
      </div>
      <form role="form" id="agregarRelacionExpte">
        <div class="modal-body">
          <div class="box-body">
            <div class="row">
              <div class="form-group">
                <label for="mexptePadre">EXPEDIENTE PADRE :</label>
                <input type="text" class="form-control" value="<?= $expte ?>"  disabled>
                <input type="hidden" class="form-control" id="mexpteid" name="mexpteid" value="<?= $idexpte ?>" required>
              </div>
              <div class="form-group">
                <label for="maorigen">EXPEDIENTE A RELACIONAR :</label>
                <select class="form-control select2" name="relacion" id="relacion" style="width: 100%">
                  <?php if (!empty($datosExpte)) {
                    foreach ($datosExpte ->result() as $expte) { ?>
                    <option value="<?= $expte->id_expte ?>"><?= $expte->num_expte ?></option>
                  <?php } } ?>
                </select>
              </div>
            </div>
            <div id="msg_arelacion"></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Agregar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade nuevaActividad" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header" style="background: #3C8DBC; color: white">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Nueva actividad</h4>
      </div>
      <form role="form" id="agregarActividad">
        <div class="modal-body">
          <div class="box-body">
            <div class="row">
              <div class="form-group">
                <label for="maorigen">ORIGEN :</label>
                <input type="text" class="form-control" id="maorigen" name="maorigen" placeholder="Origen" required>
                <input type="hidden" class="form-control" id="maid" name="maid" required>
              </div>
              <div class="form-group">
                <label for="madestino">DESTINO :</label>
                <input type="text" class="form-control" id="madestino" name="madestino" placeholder="Destino" required>
              </div>
              <div class="form-group">
                <label for="maencargado">ENCARGADO :</label>
                <input type="text" class="form-control" id="maencargado" name="maencargado" placeholder="Encargado" required>
              </div>   
              <div class="form-group">
                <label for="maobservaciones">OBSERVACIONES :</label>
                <textarea class="form-control" id="maobservaciones" name="maobservaciones" placeholder="Observaciones..."></textarea>
              </div>
            </div>
            <div id="msg_agactividad"></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Agregar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade historialActividad" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header" style="background: #3C8DBC; color: white">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Nueva actividad</h4>
      </div>
      <div class="modal-body">
        <ul class="timeline timeline-inverse" id="msg_historial">

          <li>
            <i class="fa fa-clock-o bg-gray"></i>
          </li>
        </ul>    
      </div>
    </div>
  </div>
</div>

<div class="modal fade updateExpte" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header" style="background: #3C8DBC; color: white">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Actualizar Datos Expediente</h4>
      </div>
      <form role="form" id="updateExpediente">
        <div class="modal-body">
          <div class="box-body">
            <div class="row">
              <div class="form-group">
                <label for="mcliente">CLIENTE :</label>
                <input type="text" class="form-control" id="mcliente" name="mcliente" placeholder="Nombre del cliente" required>
                <input type="hidden" class="form-control" id="mid" name="mid" required>
              </div>
              <div class="form-group">
                <label for="mnumexpte">N° EXPEDIENTE :</label>
                <input type="text" class="form-control" id="mnumexpte" name="mnumexpte" placeholder="Numero de expediente" required>
              </div>
              <div class="form-group">
                <label for="mperiodo">PERIODO :</label>
                <input type="text" class="form-control" id="mperiodo" name="mperiodo" placeholder="Periodo" required>
              </div>   
              <div class="form-group">
                <label for="mmonto">MONTO :</label>
                <input type="text" class="form-control" id="mmonto" name="mmonto" placeholder="Monto" required>
              </div>   
              <div class="form-group">
                <label for="mnumpedido">N° PEDIDO DE FONDO :</label>
                <input type="text" class="form-control" id="mnumpedido" name="mnumpedido" placeholder="N° pedido de fondo" required>
              </div>
              <div class="form-group">
                <label for="mfecha">FECHA :</label>
                <input type="date" class="form-control" id="mfecha" name="mfecha" placeholder="N° pedido de fondo" required>
              </div>   
            </div>
            <div id="msg_mexpte"></div>
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

<div class="modal fade updateDatosExpte" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header" style="background: #3C8DBC; color: white">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Actualizar Datos Expediente</h4>
      </div>
      <form role="form" id="updateActividad">
        <div class="modal-body">
          <div class="box-body">
            <div class="row">
              <div class="form-group">
                <label for="mnombre">DESTINO :</label>
                <input type="text" class="form-control" id="mdestino" name="mdestino" placeholder="Nombre del cliente" required>
                <input type="hidden" class="form-control" id="midact" name="midact" required>
                <input type="hidden" class="form-control" id="midexpte" name="midexpte" value="<?= $idexpte ?>" required>
              </div>
              <div class="form-group">
                <label for="mcorreo">ORIGEN EXPEDIENTE :</label>
                <input type="text" class="form-control" id="morigen" name="morigen" placeholder="Numero de expediente" required>
              </div>
              <div class="form-group">
                <label for="mpassword">FECHA :</label>
                <input type="text" class="form-control" id="mfecha" name="mfecha" placeholder="Periodo" required>
              </div>   
              <div class="form-group">
                <label for="mpassword">CAMBIAR ESTADO :</label>
                <select class="form-control select" id="mestado" name="mestado">
                  <?php if (!empty($destado)) {
                    foreach ($destado ->result() as $datos) { ?>
                    <option value="<?= $datos->estado ?>"><?= $datos->estado ?></option>
                  <?php } } ?>
                </select>
              </div>   
              <div class="form-group">
                <label for="mpassword">NOTAS :</label>
                <textarea class="form-control" id="mnotas" name="mnotas" placeholder="Nota..." required></textarea>
              </div>   
            </div>
            <div id="msg_aactividad"></div>
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