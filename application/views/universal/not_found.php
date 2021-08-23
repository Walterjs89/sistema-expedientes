<!-- Main content -->
<section class="content">
  <div class="error-page">
    <h2 class="headline text-yellow"> 404</h2>

    <div class="error-content">
      <h3><i class="fa fa-warning text-yellow"></i> Oops! Pagina no encontrada.</h3>

      <p>
        No hemos podido encontrar la página que estabas buscando.
        Mientras tanto <a href="<?= base_url()?>home">puede volver al panel</a> o intentar usar el formulario de búsqueda.
      </p>

      <form class="search-form" action="<?= base_url() ?>search" method="get">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Buscar" required>

          <div class="input-group-btn">
            <button type="submit" id="search-btn" class="btn btn-warning btn-flat"><i class="fa fa-search"></i>
            </button>
          </div>
        </div>
        <!-- /.input-group -->
      </form>
    </div>
    <!-- /.error-content -->
  </div>
  <!-- /.error-page -->
</section>
<!-- /.content -->