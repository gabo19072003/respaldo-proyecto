<?= $this->extend('layout/template_home');?>

<?= $this->section('content');?>

<!-- Begin Page Content -->
<div class="container-fluid ">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Registros de Recursos</h1>

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

            <form class="form-sample" action="<?=site_url('recurso/actualizar')?>" method="post" enctype="multipart/form-data">

                <?= csrf_field(); ?>

            <input type="hidden" name="recurso_id" value="<?=$recurso['recurso_id']?>">

            <p class="card-description">Editar Recurso</p>

            <div class="row">

                <div class="col-md-6">
                        
                    <div class="form-group row">
                      <label for="recurso_nro" class="col-sm-3 col-form-label">Número:</label>
                          <div class="col-sm-9">
                            <input id="recurso_nro" value="<?=$recurso['recurso_nro']?>" type="text" class="form-control" name="recurso_nro"  placeholder="Ingrese el número de recurso">
                          </div>
                          <div class="col-sm-12 text-danger">
                            <?php echo validation_show_error('recurso_nro'); ?>
                          </div>
                    </div>

                </div>

                <div class="col-md-6">
                        
                    <div class="form-group row">
                      <label for="recurso_nombre" class="col-sm-3 col-form-label">Información:</label>
                          <div class="col-sm-9">
                            <input id="recurso_nombre" value="<?=$recurso['recurso_nombre']?>" type="text" class="form-control" name="recurso_nombre"  placeholder="Ingrese detalles del recurso">
                          </div>
                          <div class="col-sm-12 text-danger">
                            <?php echo validation_show_error('recurso_nombre'); ?>
                          </div>
                    </div>

                </div>

            </div>

             <div class="row d-flex justify-content-center">

                <div class="col-md-3">
                <a href="<?=base_url('recurso')?>" class="btn  btn-inverse-primary">Regresar</a>
                <button class="btn btn-primary" type="submit">Actualizar</button>
                </div>

            </div>

            </form>


        </div>
    </div>

  </div>
</div>

</div>
<?= $this->endSection();?>