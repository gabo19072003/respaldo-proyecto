<?= $this->extend('layout/template_home');?>

<?= $this->section('content');?>

<!-- Begin Page Content -->
<div class="container-fluid ">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Registros de Cubículos</h1>

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

            <form class="form-sample" action="<?=site_url('cubiculo/guardar')?>" method="post" enctype="multipart/form-data">

            <?= csrf_field(); ?>

            <p class="card-description">Nuevo Cubículo</p>

            <div class="row">

                <div class="col-md-6">
                        
                    <div class="form-group row">
                      <label for="cubiculo_nro" class="col-sm-3 col-form-label">Número:</label>
                          <div class="col-sm-9">
                            <input id="cubiculo_nro" value="<?=old('cubiculo_nro')?>" type="text" class="form-control" name="cubiculo_nro"  placeholder="Ingrese el número de cubiculo">
                          </div>
                          <div class="col-sm-12 text-danger">
                            <?php echo validation_show_error('cubiculo_nro'); ?>
                          </div>
                    </div>

                </div>

                <div class="col-md-6">

                  <div class="form-group row">
                    <label for="cubiculo_ubicacion" class="col-sm-3 col-form-label">Ubicación:</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="cubiculo_ubicacion">
                        <option value="" >Seleccione...</option>
                           <option value="1" <?= set_select('cubiculo_ubicacion', '1', (set_value('cubiculo_ubicacion') == '1')); ?>>Derecha</option>
                           <option value="0" <?= set_select('cubiculo_ubicacion', '0', (set_value('cubiculo_ubicacion') == '0')); ?>>Izquierda</option>
                      </select>
                    </div>
                    <div class="col-sm-12 text-danger">
                      <?php echo validation_show_error('cubiculo_ubicacion'); ?>
                    </div>
                  </div>

                </div>

            </div>

            <div class="row">

                <div class="col-md-6">
                        
                    <div class="form-group row">
                      <label for="cubiculo_detalles" class="col-sm-3 col-form-label">Información:</label>
                          <div class="col-sm-9">
                            <input id="cubiculo_detalles" value="<?=old('cubiculo_detalles')?>" type="text" class="form-control" name="cubiculo_detalles"  placeholder="Ingrese detalles del cubiculo">
                          </div>
                          <div class="col-sm-12 text-danger">
                            <?php echo validation_show_error('cubiculo_detalles'); ?>
                          </div>
                    </div>

                </div>

                <div class="col-md-6">

                  <div class="form-group row">
                    <label for="cubiculo_espacioso" class="col-sm-3 col-form-label">Espacioso:</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="cubiculo_espacioso">
                        <option value="">Seleccione...</option>
                           <option value="1" <?= set_select('cubiculo_espacioso', '1', (set_value('cubiculo_espacioso') == '1')); ?>>Si</option>
                           <option value="0" <?= set_select('cubiculo_espacioso', '0', (set_value('cubiculo_espacioso') == '0')); ?>>No</option>
                      </select>
                    </div>
                    <div class="col-sm-12 text-danger">
                      <?php echo validation_show_error('cubiculo_espacioso'); ?>
                    </div>
                  </div>

                </div>

            </div>

            <div class="row">

                <div class="col-md-6">
                        
                        <div class="form-group row">
                          <label for="imagen" class="form-label col-sm-3">Subir Imagen de Escritorio</label>
                          <div class="col-sm-9">
                            <input class="form-control" type="file" id="imagen" name="cubiculo_escritorio">
                          </div>
                          <div class="col-sm-12 text-danger">
                            <?php echo validation_show_error('cubiculo_escritorio'); ?>
                          </div>
                        </div>
                        
                    </div>

                <div class="col-md-6">

                  <div class="form-group row">
                    <label for="cubiculo_silla" class="col-sm-3 col-form-label">Cantidad de sillas:</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="cubiculo_silla">
                                <option value="">Selecione...</option>
                                 <?php
                                  for ($silla = 1; $silla <= 12; $silla++) {
                                      echo "<option value='$silla' ".set_select('cubiculo_silla', $silla)." >$silla</option>";
                                  }
                                  ?>
                            </select> 
                    </div>
                    <div class="col-sm-12 text-danger">
                      <?php echo validation_show_error('cubiculo_silla'); ?>
                    </div>
                  </div>

                </div>

            </div>

            <div class="row">

                <div class="col-md-6">

                  <div class="form-group row">
                    <label for="cubiculo_ventana" class="col-sm-3 col-form-label">Tiene ventanas:</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="cubiculo_ventana">
                        <option value="">Seleccione...</option>
                           <option value="1" <?= set_select('cubiculo_ventana', '1', (set_value('cubiculo_ventana') == '1')); ?>>Si</option>
                           <option value="0" <?= set_select('cubiculo_ventana', '0', (set_value('cubiculo_ventana') == '0')); ?>>No</option>
                      </select>
                    </div>
                    <div class="col-sm-12 text-danger">
                      <?php echo validation_show_error('cubiculo_ventana'); ?>
                    </div>
                  </div>

                </div>

                <div class="col-md-6">

                  <div class="form-group row">
                    <label for="cubiculo_redes" class="col-sm-3 col-form-label">Tiene redes:</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="cubiculo_redes">
                        <option value="">Seleccione...</option>
                           <option value="1" <?= set_select('cubiculo_redes', '1', (set_value('cubiculo_redes') == '1')); ?>>Si</option>
                           <option value="0" <?= set_select('cubiculo_redes', '0', (set_value('cubiculo_redes') == '0')); ?>>No</option>
                      </select>
                    </div>
                    <div class="col-sm-12 text-danger">
                      <?php echo validation_show_error('cubiculo_redes'); ?>
                    </div>
                  </div>

                </div>

            </div>


             <div class="row d-flex justify-content-center">

                <div class="col-md-3">
                <a href="<?=base_url('cubiculo')?>" class="btn  btn-inverse-primary">Regresar</a>
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