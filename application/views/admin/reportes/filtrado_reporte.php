<div class="row">
<!-- left column -->
  <div class="col-md-4">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Filtrado</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" id="generarReporte">
        <div class="box-body">
          <!-- <div class="form-group">
            <label for="cliente">TIPO FILTRADO : </label>
            <select class="form-control select2" id="tipo" name="tipo" data-placeholder="Selecciona" style="width: 100%" onchange="tipoFiltrado()" required>
              <option value="">Selecciona</option>
              <option value="cliente">Cliente</option>
              <option value="estado">Estado</option>
              <option value="mes">Mes</option>
            </select>
          </div>
          <hr> -->
          <div class="form-group">
            <label for="cliente">CLIENTE : </label>
            <select class="form-control select2" id="cliente" name="cliente" data-placeholder="Selecciona" style="width: 100%" required>
              <option value="">Selecciona</option>
              <option value="Vacio">Vacio</option>
              <?php if (!empty($dcliente)) { 
                foreach ($dcliente ->result() as $d){ ?>
              <option value="<?= $d->id_cliente ?>"><?= $d->cliente ?></option>
              <?php } }  ?>
            </select>
          </div>
          <div class="form-group">
            <label for="periodo">MES : </label>
            <select name="mes" id="mes" class="form-control select2" data-placeholder="Selecciona" style="width: 100%" required>
              <option value="">Selecciona</option>
              <option value="Vacio">Vacio</option>
            	<option value="Enero">Enero</option>	
            	<option value="Febrero">Febrero</option>	
            	<option value="Marzo">Marzo</option>	
            	<option value="Abril">Abril</option>	
            	<option value="Mayo">Mayo</option>	
            	<option value="Junio">Junio</option>	
            	<option value="Julio">Julio</option>	
            	<option value="Agosto">Agosto</option>	
            	<option value="Septiembre">Septiembre</option>	
            	<option value="Octubre">Octubre</option>	
            	<option value="Noviembre">Noviembre</option>	
            	<option value="Diciembre">Diciembre</option>	
            </select>
          </div>
          <div class="form-group">
            <label for="periodo">ESTADO : </label>
            <select name="estado" id="estado" class="form-control select2" data-placeholder="Selecciona" style="width: 100%" required>
              <option value="">Selecciona</option>
              <option value="Vacio">Vacio</option>
              <?php if (!empty($destado)) { 
                foreach ($destado ->result() as $d){ ?>
              <option value="<?= $d->estado ?>"><?= $d->estado ?></option>
              <?php } }  ?>
            </select>
          </div>
          <div class="form-group">
            <label for="periodo">FECHA : </label>
            <input type="date" class="form-control" name="fecha" placeholder="Fecha">
          </div>
          <div class="col-md-6" id="reporte_pdf"></div>
          <div class="col-md-6" id="reporte_excel"></div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right">Generar</button>
        </div>
      </form>
    </div>
  </div>
</div>