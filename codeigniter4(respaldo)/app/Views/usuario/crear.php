<?= $this->extend('layout/template_home');?>

<?= $this->section('content');?>

<!-- Begin Page Content -->
<div class="container-fluid ">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Registros de Usuarios del Sistema</h1>

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

            <form class="form-sample" action="<?=site_url('usuario/guardar')?>" method="post" enctype="multipart/form-data">

                <?= csrf_field(); ?>

            <p class="card-description">Nuevo Usuario</p>

            <div class="row">
              
            </div>

            <div class="row">

                <div class="col-md-6">
                        
                    <div class="form-group row">
                      <label for="user_name" class="col-sm-3 col-form-label">Nombre:</label>
                          <div class="col-sm-9">
                            <input id="user_name" value="<?=old('user_name')?>" type="text" class="form-control" name="user_name"  placeholder="Ingrese el nombre">
                          </div>
                          <div class="col-sm-12 text-danger">
                            <?php echo validation_show_error('user_name'); ?>
                          </div>
                    </div>

                </div>

                <div class="col-md-6">
                        
                    <div class="form-group row">
                      <label for="user_lastname" class="col-sm-3 col-form-label">Apellido:</label>
                          <div class="col-sm-9">
                            <input id="user_lastname" value="<?=old('user_lastname')?>" type="text" class="form-control" name="user_lastname"  placeholder="Ingrese el apellido">
                          </div>
                          <div class="col-sm-12 text-danger">
                            <?php echo validation_show_error('user_lastname'); ?>
                          </div>
                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-md-6">
                        
                    <div class="form-group row">
                      <label for="carnet" class="col-sm-3 col-form-label">Carnet:</label>
                          <div class="col-sm-9">
                            <input id="carnet" value="<?=old('carnet')?>" type="text" class="form-control" name="carnet"  placeholder="Ingrese el número de carnet">
                          </div>
                          <div class="col-sm-12 text-danger">
                            <?php echo validation_show_error('carnet'); ?>
                          </div>
                    </div>

                </div>

                <div class="col-md-6">
                        
                    <div class="form-group row">
                      <label for="usuario" class="col-sm-3 col-form-label">Usuario:</label>
                          <div class="col-sm-9">
                            <input id="usuario" value="<?=old('usuario')?>" type="text" class="form-control" name="usuario"  placeholder="Ingrese el usuario">
                          </div>
                          <div class="col-sm-12 text-danger">
                            <?php echo validation_show_error('usuario'); ?>
                          </div>
                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-md-6">

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Correo:</label>
                          <div class="col-sm-9">
                            <input type="email" class="form-control" name="user_email" placeholder="ejemplo@dominio.com" value="<?=old('user_email')?>">
                          </div>
                          <div class="col-sm-12 text-danger">
                            <?php echo validation_show_error('user_email'); ?>
                          </div>
                        </div>

                </div>

                <div class="col-md-6">

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Rol</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="rol_id">
                                <option value="">Selecione...</option>
                                <?php foreach ($roles as $rol): ?>
                                <option value="<?= $rol['rol_id'] ?>" <?= set_select('rol_id', $rol['rol_id']); ?> ><?= $rol['nombre'] ?></option>
                                <?php endforeach; ?>
                            </select> 
                          </div>
                          <div class="col-sm-12 text-danger">
                            <?php echo validation_show_error('rol_id'); ?>
                          </div>
                        </div>

                </div>

            </div>

            <div class="row">

                  <div class="col-md-6">

                      <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Contraseña:</label>
                          <div class="col-sm-9">
                            <input id="password" value="<?=old('password')?>" type="password" class="form-control" name="password" placeholder="Ingrese una contraseña" />
                          </div>
                          <div class="col-sm-12 text-danger">
                            <?php echo validation_show_error('password'); ?>
                          </div>
                      </div>

                  </div>

                  <div class="col-md-6">

                      <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Confirmar Contraseña:</label>
                          <div class="col-sm-8">
                            <input type="password" id="autor" value="<?=old('repassword')?>" class="form-control" name="repassword" placeholder="Ingrese confirmar contraseña" />
                          </div>
                          <div class="col-sm-12 text-danger">
                            <?php echo validation_show_error('repassword'); ?>
                          </div>
                      </div>

                  </div>

            </div>


             <div class="row d-flex justify-content-center">

                <div class="col-md-4">
                <a href="<?=base_url('usuario')?>" class="btn  btn-inverse-primary">Regresar</a>
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