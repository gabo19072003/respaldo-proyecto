<?= $this->extend('layout/template_home');?>

<?= $this->section('content');?>

<!-- Begin Page Content -->
<div class="container-fluid ">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Crear una nueva sesión</h1>

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

            <form class="form-sample" action="<?=site_url('seccion/guardar')?>" method="post" enctype="multipart/form-data">

              <?= csrf_field(); ?>

            <p class="card-description">Nueva sesion</p>

                    <div class="row">

                      <div class="col-md-4">
                        <div class="row">
                          
                        <form class="form-sample" action="<?=site_url('persona/buscar')?>" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                          <label class="col-sm-12 col-form-label">Cédula/Carnet</label>
                          <div class="col-sm-12">
                            <input type="text" class="form-control" name="identificacion" placeholder="Ingrese la identificación" value="<?=old('identificacion')?>"/>
                          </div>
                          <div class="col-sm-12 text-danger">
                            <?php echo validation_show_error('identificacion'); ?>
                          </div>
                        </div>

                        <div class="row d-flex justify-content-start">
                            <div class="col-md-3">
                            <button class="btn btn-primary" type="submit">Consultar</button>
                            </div>
                        </div>

                        </form>

                        <h4 class="card-title mt-4">Datos del Trabajador</h4>

                        <div class="col-md-12">

                            <div class="form-group row">
                              <div class="col-sm-12">
                                <input type="text" class="form-control my-0" name="persona_nombre" placeholder="Nombre" value="<?=$persona['persona_nombre']?>"/>
                              </div>
                            </div>

                          </div>

                          <div class="col-md-12">

                            <div class="form-group row">
                              <div class="col-sm-12">
                                <input type="text" class="form-control" name="persona_apellido" placeholder="Apellido" value="<?=$persona['persona_apellido']?>"/>
                              </div>
                            </div>

                          </div>


                        </div>
                      </div>

                    <div class="col-md-8">

                        <div class="row">

                          <div class="col-md-6">

                            <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Recurso a utilizar</label>
                              <div class="col-sm-9">
                                <select class="form-control" name="recurso_id">
                                    <option value="">Selecione...</option>
                                    <?php foreach ($recursos as $recurso): ?>
                                    <option value="<?= $recurso['recurso_id'] ?>"> <?= $recurso['recurso_nombre'] ?> </option>
                                    <?php endforeach; ?>
                                </select> 
                              </div>
                              <div class="col-sm-12 text-danger">
                                <?php echo validation_show_error('recurso_id'); ?>
                              </div>
                            </div>

                          </div>


                        </div>

                        

                    </div>






                      </div>


                      

                    <div class="row">

                      <div class="col-md-6">

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Género</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="persona_sexo">
                              <option value="">Seleccione...</option>
                                 <option value="masculino" <?= set_select('persona_sexo', 'masculino', (set_value('persona_sexo') == 'masculino')); ?>>Masculino</option>
                                 <option value="femenino" <?= set_select('persona_sexo', 'femenino', (set_value('persona_sexo') == 'femenino')); ?>>Femenino</option>
                            </select>
                          </div>
                          <div class="col-sm-12 text-danger">
                            <?php echo validation_show_error('persona_sexo'); ?>
                          </div>
                        </div>

                      </div>

                      <div class="col-md-6">

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Fecha de Nacimiento</label>
                          <div class="col-sm-9">
                            <input type="date" class="form-control" name="persona_fch_nacimi" value="<?=old('persona_fch_nacimi')?>">
                          </div>
                          <div class="col-sm-12 text-danger">
                            <?php echo validation_show_error('persona_fch_nacimi'); ?>
                          </div>
                        </div>
                      </div>
                      
                    </div>

                    <div class="row">

                      <div class="col-md-6">

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Cédula</label>
                          <div class="col-sm-9">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                     <span class="input-group-text">CI</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Ingrese cédula" aria-label="Ingresa cédula" name="persona_ci" value="<?=old('persona_ci')?>">
                              </div>
                          </div>
                          <div class="col-sm-12 text-danger">
                              <?php echo validation_show_error('persona_ci'); ?>
                          </div>
                        </div>

                      </div>

                      <div class="col-md-6">

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Carnet</label>
                          <div class="col-sm-9">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                     <span class="input-group-text">Nro.</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Ingrese carnet" aria-label="Ingresa carnet" name="persona_carnet" value="<?=old('persona_carnet')?>">
                            </div>
                          </div>
                          <div class="col-sm-12 text-danger">
                            <?php echo validation_show_error('persona_carnet'); ?>
                          </div>
                        </div>

                      </div>

                    </div>

                    <div class="row">

                      <div class="col-md-6">

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Correo</label>
                          <div class="col-sm-9">
                            <input type="email" class="form-control" name="persona_email" placeholder="ejemplo@dominio.com" value="<?=old('persona_email')?>">
                          </div>
                          <div class="col-sm-12 text-danger">
                            <?php echo validation_show_error('persona_email'); ?>
                          </div>
                        </div>

                      </div>

                      <div class="col-md-6">

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Teléfono</label>
                          <div class="col-sm-9">
                            <input type="tel" class="form-control" name="persona_tf" placeholder="Ingrese número de teléfono" value="<?=old('persona_tf')?>">
                          </div>
                          <div class="col-sm-12 text-danger">
                            <?php echo validation_show_error('persona_tf'); ?>
                          </div>
                        </div>

                      </div>

                    </div>

                    <div class="row">

                    <div class="col-md-6">
                        
                        <div class="form-group row">
                          <label for="imagen" class="form-label">Subir Foto</label>
                          <div class="col-sm-9">
                            <input class="form-control" type="file" id="imagen" name="persona_foto">
                          </div>
                          <div class="col-sm-12 text-danger">
                            <?php echo validation_show_error('persona_foto'); ?>
                          </div>
                        </div>
                        
                    </div>

                    <div class="col-md-6">
                        
                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <textarea class="form-control col-sm-12" id="direccion" placeholder="Ingrese la dirección" rows="4" name="direccion" ><?=old('direccion')?></textarea>
                            <div class="col-sm-12 text-danger">
                            <?php echo validation_show_error('direccion'); ?>
                            </div>
                        </div>                              

                    </div>

                    </div>

            <div class="row d-flex justify-content-center">

                <div class="col-md-4">

                <a href="<?=base_url('persona')?>" class="btn  btn-inverse-primary me-2">Regresar</a>

                <button class="btn btn-primary  " type="submit">Guardar</button>
               
                </div>

            </div>
            
            </form>

        </div>
        
        </div>

        </div>
    </div>


</div>
<!-- /.container-fluid -->

<?= $this->endSection();?>