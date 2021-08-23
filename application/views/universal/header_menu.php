<br>
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?= base_url() ?>assets/img/default-50x50.gif" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p> <?= $this->session->userdata('nombre') ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i>  
          <?= $this->session->userdata('permiso') ?>
        </a>
      </div>
    </div>
    <!-- search form -->
    <!-- <form action="<?= base_url() ?>search" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Buscar..." required>
          <span class="input-group-btn">
            <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
      </div>
    </form> -->
    <!-- /.search form