<?= $this->extend('layout/template_home');?>

<?= $this->section('content');?>

<!-- Begin Page Content -->
<div class="container-fluid ">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Registros de los Libros</h1>
             
            <?php if (session()->getFlashdata('mensaje') !== null){
               echo "<div class='alert alert-".session()->getFlashdata('color')." alert-dismissible fade show' role='alert'>
                    ".session()->getFlashdata('mensaje')."
                      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            } 

            if(empty($_SESSION['mensaje'])) {

                $_SESSION['color'] = null;
                $_SESSION['mensaje'] = null;
            } 
            ?>
    </div>

<div class="row">
  <div class="col-lg-12">

    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Ingresar datos</h4>

            <form class="form-sample" action="<?=site_url('libro/guardar')?>" method="post" enctype="multipart/form-data">

              <?= csrf_field(); ?>

            <p class="card-description">Nuevo Libro</p>

            <div class="row">

                <div class="col-md-6">
                        
                    <div class="form-group row">
                      <label for="cota" class="col-sm-3 col-form-label">COTA:</label>
                          <div class="col-sm-9">
                            <input id="cota" value="<?=old('cota')?>" type="text" class="form-control" name="cota"  placeholder="Ingrese COTA">
                          </div>
                          <div class="col-sm-12 text-danger">
                            <?php echo validation_show_error('cota'); ?>
                          </div>
                    </div>

                </div>

                <div class="col-md-6">
                        
                    <div class="form-group row">
                      <label for="nombre" class="col-sm-3 col-form-label">Nombre:</label>
                          <div class="col-sm-9">
                            <input id="nombre" value="<?=old('lib_nombre')?>" type="text" class="form-control" name="lib_nombre"  placeholder="Ingrese nombre">
                          </div>
                          <div class="col-sm-12 text-danger">
                            <?php echo validation_show_error('lib_nombre'); ?>
                          </div>
                    </div>

                </div>

            </div>

            <div class="row">

                  <div class="col-md-6">

                      <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Editorial:</label>
                          <div class="col-sm-9">
                            <input id="editorial" value="<?=old('lib_editorial')?>" type="text" class="form-control" name="lib_editorial" placeholder="Ingrese editorial" />
                          </div>
                          <div class="col-sm-12 text-danger">
                            <?php echo validation_show_error('lib_editorial'); ?>
                          </div>
                      </div>

                  </div>

                  <div class="col-md-6">

                      <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Autor:</label>
                          <div class="col-sm-9">
                            <input type="text" id="autor" value="<?=old('lib_autor')?>" class="form-control" name="lib_autor" placeholder="Ingrese autor" />
                          </div>
                          <div class="col-sm-12 text-danger">
                            <?php echo validation_show_error('lib_autor'); ?>
                          </div>
                      </div>

                  </div>

            </div>

            <div class="row d-flex justify-content-center">

                <div class="col-md-3">
                <a href="<?=base_url('libro')?>" class="btn  btn-inverse-primary">Regresar</a>
                <button class="btn btn-primary" type="submit">Guardar</button>
                </div>

            </div>

            </form>


        </div>
    </div>

  </div>
</div>

</div>
<?= $this->endSection();?>