<?= $this->extend('layout/template_home');?>

<?= $this->section('content');?>

<!-- Begin Page Content -->
<div class="container-fluid ">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Registros de Servicios</h1>

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

            <form class="form-sample" action="<?=site_url('servicio/guardar')?>" method="post" enctype="multipart/form-data">

                <?= csrf_field(); ?>

            <p class="card-description">Nuevo Servicio</p>

            <div class="row">

                <div class="col-md-12">
                        
                    <div class="form-group row">
                      <label for="servicio_detalles" class="col-form-label">Información del servicio:</label>
                          <div class="col-sm-12">
                            <input id="servicio_detalles" value="<?=old('servicio_detalles')?>" type="text" class="form-control" name="servicio_detalles"  placeholder="Ingrese detalles del servicio">
                          </div>
                          <div class="col-sm-12 text-danger">
                            <?php echo validation_show_error('servicio_detalles'); ?>
                          </div>
                    </div>

                </div>

            </div>

             <div class="row d-flex justify-content-center">

                <div class="col-md-3">
                <a href="<?=base_url('servicio')?>" class="btn  btn-inverse-primary">Regresar</a>
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