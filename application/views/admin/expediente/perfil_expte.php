<div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?= base_url() ?>assets/img/default-50x50.gif" alt="User profile picture">

              <h3 class="profile-username text-center">N° Expediente</h3>

              <p class="text-muted text-center"><?= $datos->num_expte ?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Perido</b> <a class="pull-right"><?= $datos->periodo ?></a>
                </li>
                <li class="list-group-item">
                  <b>Monto</b> <a class="pull-right">$ <?= number_format($datos->monto,2, ",", ".") ?></a>
                </li>
                <li class="list-group-item">
                  <b>N° Pedido fondo</b> <a class="pull-right"><?= $datos->num_pedido ?></a>
                </li>
              </ul>

              <a href="#" class="btn btn-primary btn-xs" data-toggle="modal" data-target=".agregarActividad"><b>Nueva Actividad</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Expediente</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Cliente</strong>

              <p class="text-muted">
                <?= $datos->cliente ?>
              </p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

              <p>
                <span class="label label-danger">UI Design</span>
                <span class="label label-success">Coding</span>
                <span class="label label-info">Javascript</span>
                <span class="label label-warning">PHP</span>
                <span class="label label-primary">Node.js</span>
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Notas</strong>

              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#timeline" data-toggle="tab">Linea Tiempo</a></li>
              <li><a href="#activity" data-toggle="tab">Actividad</a></li>
              <li><a href="#settings" data-toggle="tab">Datos</a></li>
              <li><a href="#relacion" data-toggle="tab">Relaciones</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane" id="activity">
                <div class="row table-responsive no-padding">
	              <table class="table table-hover">
	                <tr>
	                  <th>Persona</th>
	                  <th>Destino</th>
	                  <th>Fecha</th>
	                  <th>Status</th>
	                  <th>Observaciones</th>
	                  <th>Accion</th>
	                </tr>
	                <tr>
	                  <td>183</td>
	                  <td>John Doe</td>
	                  <td>11-7-2014</td>
	                  <td><span class="label label-success">Entregado</span></td>
	                  <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
	                  <td><button class="btn btn-primary btn-xs"  data-toggle="modal" data-target=".updateActividad" >Editar</button></td>
	                </tr>
	                <tr>
	                  <td>219</td>
	                  <td>Alexander Pierce</td>
	                  <td>11-7-2014</td>
	                  <td><span class="label label-warning">Pendiente</span></td>
	                  <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
	                  <td><button class="btn btn-primary btn-xs"  data-toggle="modal" data-target=".updateActividad" >Editar</button></td>
	                </tr>
	                <tr>
	                  <td>657</td>
	                  <td>Bob Doe</td>
	                  <td>11-7-2014</td>
	                  <td><span class="label label-primary">Entregado</span></td>
	                  <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
	                  <td><button class="btn btn-primary btn-xs"  data-toggle="modal" data-target=".updateActividad" >Editar</button></td>
	                </tr>
	                <tr>
	                  <td>175</td>
	                  <td>Mike Doe</td>
	                  <td>11-7-2014</td>
	                  <td><span class="label label-danger">Denegado</span></td>
	                  <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
	                  <td><button class="btn btn-primary btn-xs"  data-toggle="modal" data-target=".updateActividad" >Editar</button></td>
	                </tr>
	              </table>
	            </div>

              </div>
              <!-- /.tab-pane -->
              <div class="active tab-pane" id="timeline">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                  <!-- timeline time label -->
                  <?php if (!empty($dactividad)) {
                    $fecha = "";
                    foreach ($dactividad ->result() as $actividad){ 
                    if ($actividad->alta_actividad != $fecha) { ?>
                  <li class="time-label">
                    <span class="bg-red">
                      <?= substr($actividad->alta_actividad, 0, 10) ?>
                    </span>
                  </li>
                  <?php }
                    $fecha = $actividad->alta_actividad;
                  ?>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-envelope bg-blue"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> <?= substr($actividad->alta_actividad, 10, 18) ?></span>

                      <h3 class="timeline-header"><a href="#">Tipo Actividad</a> sent you an email</h3>

                      <div class="timeline-body">
                        <?= $actividad->actividad ?>
                      </div>
                      <!-- <div class="timeline-footer">
                        <a class="btn btn-primary btn-xs">Read more</a>
                        <a class="btn btn-danger btn-xs">Delete</a>
                      </div> -->
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <?php } } ?>
                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="settings">
                <form class="form-horizontal" id="updateExpte">
                  <div class="form-group">
                    <label for="mcliente" class="col-sm-3 control-label">Cliente</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="mcliente" name="mcliente" value="<?= $datos->cliente ?>" placeholder="Nombre cliente">
                      <input type="hidden" class="form-control" id="mid" name="mid" value="<?= $datos->id_expte ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="mnumero" class="col-sm-3 control-label">N° expediente</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="mnumero" name="mnumero" value="<?= $datos->num_expte ?>" placeholder="Numero de expediente">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="mperiodo" class="col-sm-3 control-label">Periodo</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="mperiodo" name="mperiodo" value="<?= $datos->periodo ?>" placeholder="Periodo">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="mmonto" class="col-sm-3 control-label">Monto</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="mmonto" name="mmonto" value="<?= $datos->monto ?>" placeholder="Monto">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="mpedido" class="col-sm-3 control-label">N° de pedido</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="mpedido" name="mpedido" value="<?= $datos->num_pedido ?>" placeholder="Numero de pedido">
                    </div>
                  </div>
                  <div class="col-sm-offset-3 col-sm-9" id="msg_expte"></div>
                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                      <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                  </div>
                </form>
              </div>
              <div class="tab-pane" id="relacion">
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr style="border: hidden">
                      <th>Cliente</th>
                      <th>N° expediente</th>
                      <th>Periodo</th>
                      <th>Monto</th>
                      <th>N° Pedido</th>
                      <th>Accion</th>
                    </tr>
                    <?php if (!empty($drelacion)) {
                    foreach ($drelacion ->result() as $relacion) {?>
                    <tr style="border: hidden">
                      <td><?= $relacion->cliente ?></td>
                      <td><?= $relacion->num_expte ?></td>
                      <td><?= $relacion->periodo ?></td>
                      <td><?= $relacion->monto ?></td>
                      <td><?= $relacion->num_pedido ?></td>
                      <td><a href="<?= base_url() ?>expediente/perfil/<?= $relacion->id_expte?>" class="btn btn-primary btn-xs" >Perfil</a></td>
                    </tr>
                    <?php } } ?>
                  </table>
                </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <div class="modal fade agregarActividad" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
		  <div class="modal-dialog modal-md">
		    <div class="modal-content">
		      <div class="modal-header" style="background: #3C8DBC; color: white">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title">Agregar Actividad</h4>
		      </div>
		      <form role="form" id="updateUsuario">
		        <div class="modal-body">
		          <div class="box-body">
		            <div class="row">
		              <div class="form-group">
		                <label for="mnombre">Persona Traslado :</label>
		                <input type="text" class="form-control" id="mnombre" name="mnombre" placeholder="Persona Traslado" required>
		                <!-- <input type="hidden" class="form-control" id="mid" name="mid" required> -->
		              </div>
		              <div class="form-group">
		                <label for="mcorreo">Origen :</label>
		                <input type="text" class="form-control" id="mcorreo" name="mcorreo" placeholder="Origen" required>
		              </div>
		              <div class="form-group">
		                <label for="mpassword">Destino :</label>
		                <input type="text" class="form-control" id="mpassword" name="mpassword" placeholder="Destino" required>
		              </div>   
		              <div class="form-group">
		                <label for="mpermisos">Observaciones :</label>
		                <textarea class="form-control" rows="3" id="inputExperience" placeholder="Actividad ..."></textarea>
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
	  <div class="modal fade updateActividad" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
		  <div class="modal-dialog modal-md">
		    <div class="modal-content">
		      <div class="modal-header" style="background: #3C8DBC; color: white">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title">Cambiar Status</h4>
		      </div>
		      <form role="form" id="updateUsuario">
		        <div class="modal-body">
		          <div class="box-body">
		            <div class="row">
		              <div class="form-group">
		                <label for="mnombre">Status :</label>
		                <!-- <input type="text" class="form-control" id="mnombre" name="mnombre" placeholder="Persona Traslado" required> -->
		                <select class="form-control select2" style="width: 100%">
		                	<option>Pendiente</option>
		                	<option>Entregado</option>
		                	<option>Denegado</option>
		                </select>
		                <!-- <input type="hidden" class="form-control" id="mid" name="mid" required> -->
		              </div>
		              <div class="form-group">
		                <label for="mcorreo">Fecha de confirmacion :</label>
		                <input type="datetime-local" class="form-control" id="fecha" name="fecha" placeholder="fecha de confirmacion" required>
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