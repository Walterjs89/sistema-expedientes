<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Datos encontrados (<?= $totalDatos ?>)</h3>
  </div>
  <form role="form">
    <div class="box-body">
      <?php  
      if (!empty($resultado)) {
      foreach ($resultado->result_array() as $row) { 
        $datos = $this->funciones->tipo_comprobante($row['tipo_comprobante'] ); 
        $dato = $this->funciones->tipo_comprobante2($row['tipo_comprobante'],$row['status_factura']);
        $img = "";
        if ($row['status_factura'] == "CANCELADO") {
          $img = "/assets/img/cancelado_3.png";
        }
        ?>
        <div class="post imgFondo" style="background-image: url('<?= $img ?>');">
          <div class="user-block" style="margin: 0px 0px 0px 0px">
            <img class="img-circle img-bordered-sm" src="<?= base_url() ?>assets/img/logo_mini_bajaj.jpg" alt="user image">
                <span class="username">
                  <a href="<?= base_url() ?>pcliente/<?= $row['id_cliente'] ?>"><?= $row['cliente'] ?>.</a>
                </span>
            <ul class="list-inline" style="margin-left: 5px">
              <li>
                <a href="<?=$row['pdf'] ?>" target="blank" class="link-black text-sm">
                  <i class="fa fa-download margin-r-5"></i> Factura
                </a>
              </li>
              <li>
                <a href="<?= $row['xml'] ?>" target="blank" class="link-black text-sm">
                <i class="fa fa-file-code-o margin-r-5"></i> XML</a>
              </li>
            </ul>
          </div>
          <p>
            <div class="row">
              <div class="col-md-6">
                <ul>
                  <li><strong>UUID: </strong><a href="<?= base_url() ?>dfactura/<?= $row['id_factura'] ?>"><?= $row['uuid'] ?></a></li>
                  <!-- <li><strong>FOLIO: </strong><?= $row['folio'] ?></li> -->
                  <li><strong>SERIE y FOLIO: </strong><?= $row['serie'] ?>-<?= $row['folio'] ?></li>
                  <li><strong>FECHA: </strong><?= $row['fecha_timbrado'] ?></li>
                </ul>
              </div>
              <div class="col-md-6">
                <ul>
                  <li><strong>STATUS: </strong>
                    <span class="letraslist" style="background-color: <?= $dato[2] ?>"><?= $row['status_factura'] ?></span>
                  </li>
                  <li><strong>METODO PAGO: </strong><?= $row['metodo_pago'] ?></li>
                  <li><strong>CONDICION PAGO: </strong><?= $row['condicion_pago'] ?></li>
                  <li><strong>TIPO: </strong><span class="label label-<?= $datos[1] ?>"><?= $datos[0] ?></span></li>
                </ul>
              </div>
            </div>
          </p>
        </div>
      <?php } } ?>
    </div>
  </form>
</div>
<!-- /.box -->