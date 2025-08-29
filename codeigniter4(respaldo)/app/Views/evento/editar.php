<?= $this->extend('layout/template_home');?>

<?= $this->section('content');?>

<!-- Begin Page Content -->

    <div class="container-fluid ">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Registro de Evento</h1>

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

    <div class="cardt rounded-0 shadow col-lg-12">
            <div class="card-header bg-gradient bg-primary text-light">
                <h5 class="card-title">Editar Evento</h5>
            </div>
            <div class="card-body">

                    <form action="<?=site_url('evento/actualizar')?>" method="post" enctype="multipart/form-data">

                        <?= csrf_field(); ?>

                        <input type="hidden" name="id" value="<?=$evento['id']?>">

                        <div class="row">

                            <div class="col-md-6">
                                    
                                    <div class="form-group row">
                                      <label for="title" class="col-form-label">Nombre:</label>
                                          <div class="col-sm-12">
                                            <input id="title" value="<?=$evento['title']?>" type="text" class="form-control form-control-sm" name="title"  placeholder="Ingrese nombre">
                                          </div>
                                          <div class="col-sm-12 text-danger">
                                            <?php echo validation_show_error('title'); ?>
                                          </div>
                                    </div>

                            </div>

                            <div class="col-md-6">
                                    
                                    <div class="form-group row">
                                      <label for="lugar" class="col-form-label">Lugar:</label>
                                          <div class="col-sm-12">
                                            <input id="lugar" value="<?=$evento['lugar']?>" type="text" class="form-control form-control-sm" name="lugar"  placeholder="Ingrese nombre del lugar">
                                          </div>
                                          <div class="col-sm-12 text-danger">
                                            <?php echo validation_show_error('lugar'); ?>
                                          </div>
                                    </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                    
                                    <div class="form-group row">
                                      <label for="responsable" class="col-form-label">Responsable:</label>
                                          <div class="col-sm-12">
                                            <input id="responsable" value="<?=$evento['responsable']?>" type="text" class="form-control form-control-sm" name="responsable"  placeholder="Ingrese cédula del reponsable">
                                          </div>
                                          <div class="col-sm-12 text-danger">
                                            <?php echo validation_show_error('responsable'); ?>
                                          </div>
                                    </div>

                            </div>

                            <div class="col-md-6">
                                    
                                    <div class="form-group row">
                                      <label for="color" class="col-form-label">Color:</label>
                                          <div class="col-sm-12">
                                            <input id="color" value="<?=$evento['color']?>" type="color" class="form-control form-control-sm" name="color">
                                          </div>
                                          <div class="col-sm-12 text-danger">
                                            <?php echo validation_show_error('color'); ?>
                                          </div>
                                    </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-12">
                                    
                                    <div class="form-group row">
                                      <label for="description" class="col-form-label">Descripción:</label>
                                          <div class="col-sm-12">
                                            <textarea rows="3" class="form-control form-control-sm" name="description" id="description" placeholder="Describa el evento" ><?=$evento['detalles']?></textarea>
                                          </div>
                                          <div class="col-sm-12 text-danger">
                                            <?php echo validation_show_error('description'); ?>
                                          </div>
                                    </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                    
                                    <div class="form-group row">
                                      <label for="start" class="col-form-label">Inicio:</label>
                                          <div class="col-sm-12">
                                            <input id="start" value="<?=$evento['start']?>" type="datetime-local" class="form-control form-control-sm" name="start">
                                          </div>
                                          <div class="col-sm-12 text-danger">
                                            <?php echo validation_show_error('start'); ?>
                                          </div>
                                    </div>

                            </div>

                            <div class="col-md-6">
                                    
                                    <div class="form-group row">
                                      <label for="end" class="col-form-label">Final:</label>
                                          <div class="col-sm-12">
                                            <input id="end" value="<?=$evento['end']?>" type="datetime-local" class="form-control form-control-sm" name="end">
                                          </div>
                                          <div class="col-sm-12 text-danger">
                                            <?php echo validation_show_error('end'); ?>
                                          </div>
                                    </div>

                            </div>

                        </div>
                </div>

            <div class="card-footer">
                <div class="row d-flex justify-content-center">

                    <div class="col-md-5">

                    <a href="<?=base_url('evento')?>" class="btn btn-inverse-primary me-2">Regresar</a>

                    <button class="btn btn-primary" type="submit">Guardar</button>
                   
                    </div>

                </div>
            </div>
    </div>

<?= $this->endSection();?>