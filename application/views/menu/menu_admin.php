<!-- INICIO DEL MENU -->
<ul class="sidebar-menu" data-widget="tree">
  <!-- <li class="header">HOME</li>
  <li class="">
    <a href="#">
      <i class="fa fa-home"></i> <span>Principal</span>
    </a>
  </li> -->
  <li class="header">MENU DE OPCIONES</li>
  <li class="<?php if(!empty($vexpte)){ echo $vexpte; } ?>">
    <a href="<?= base_url() ?>expediente">
      <i class="fa fa-paste"></i> <span>Expedientes</span>
    </a>
  </li>
  <li class="<?php if(!empty($vcliente)){ echo $vcliente; } ?>">
    <a href="<?= base_url() ?>cliente">
      <i class="fa fa-users"></i> <span>Clientes</span>
    </a>
  </li>
  <!-- <li class="<?php if(!empty($vcalendario)){ echo $vcalendario; } ?>">
    <a href="<?= base_url() ?>calendario">
      <i class="fa fa-calendar"></i> <span>Calendario</span>
    </a>
  </li> -->
  <!-- <li class="<?php if(!empty($vreporte)){ echo $vreporte; } ?>">
    <a href="<?= base_url() ?>filtrado" target="_blank">
      <i class="fa fa-pie-chart"></i> <span>Reportes</span>
    </a>
  </li> 
  <li class="<?php if(!empty($vfiltrado)){ echo $vfiltrado; } ?>">
    <a href="<?= base_url() ?>filtrado">
      <i class="fa fa-pie-chart"></i> <span>Reportes</span>
    </a>
  </li> -->
  <li class="header">OTROS</li>
  <li class="<?php if(!empty($vuser)){ echo $vuser; } ?>">
    <a href="<?= base_url() ?>usuario">
      <i class="fa fa-users"></i> <span>Usuarios y Roles</span>
    </a>
  </li>
  <li class="<?php if(!empty($vestado)){ echo $vestado; } ?>">
    <a href="<?= base_url() ?>estado">
      <i class="fa fa-pencil-square-o"></i> <span>Alta estados</span>
    </a>
  </li>
</ul> 
</section>
    <!-- /.sidebar -->
</aside>
 <!-- ==================FIN DEL MENU============================= -->  