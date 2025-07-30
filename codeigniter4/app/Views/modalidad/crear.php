<?= $this->extend('layout/template_home');?>

<?= $this->section('content');?>

<!-- Begin Page Content -->
<div class="container-fluid ">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Registros de Modalidades</h1>

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

            <form class="form-sample" action="<?=site_url('modalidad/guardar/'.$id)?>" method="post" enctype="multipart/form-data">

            <?= csrf_field(); ?>

            <p class="card-description">Nueva Modalidad</p>

            <div class="row">

                <div class="col-md-12">
                        
                    <div class="form-group row">
                      <label for="modalidad_detalles" class="col-sm-3 col-form-label">Detalles:</label>
                          <div class="col-sm-12">
                            <input id="modalidad_detalles" value="<?=old('modalidad_detalles')?>" type="text" class="form-control" name="modalidad_detalles"  placeholder="Ingrese detalles del modalidad">
                          </div>
                          <div class="col-sm-12 text-danger">
                            <?php echo validation_show_error('modalidad_detalles'); ?>
                          </div>
                    </div>

                </div>

            </div>

             <div class="row d-flex justify-content-center">

                <div class="col-md-3">
                <a href="<?=base_url('servicio/agregar/'.$id)?>" class="btn  btn-inverse-primary">Regresar</a>
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