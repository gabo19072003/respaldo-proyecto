<?= $this->extend('layout/template');?>

<?= $this->section('content');?>

		<div class="card shadow-lg form">
            <div class="card-body p-5 pb-3">

                <div class="d-sm-flex align-items-center justify-content-between" >

                <h1 class="fs-4 card-title fw-bold mb-4">Registrar Usuario</h1>

                <?php if (session()->getFlashdata('errors') !== null){
                   echo "<div class='alert alert-".session()->getFlashdata('color')." alert-dismissible fade show' role='alert'>
                        ".session()->getFlashdata('errors')."
                          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                } 

                if(empty($_SESSION['errors'])) {

                    $_SESSION['color'] = null;
                    $_SESSION['errors'] = null;
                } 
                ?>

                </div>

                <form method="POST" action="<?= base_url('register'); ?>" autocomplete="off">

                    <div class="row">

                        <?= csrf_field(); ?>

                        <div class="col-md-6 mb-3">
                        <label class="mb-2" for="carnet">Carnet:</label>
                        <input type="text" class="form-control" name="carnet" id="carnet" value="<?= set_value('carnet') ?>" required autofocus>
                        <div class="col-sm-12 text-danger">
                            <?php echo validation_show_error('carnet'); ?>
                        </div>
                        </div>

                        <div class="col-md-6 mb-3">
                        <label class="mb-2" for="user">Usuario</label>
                        <input type="text" class="form-control" name="user" id="user" value="<?= set_value('user') ?>" required>
                        <div class="col-sm-12 text-danger">
                            <?php echo validation_show_error('user'); ?>
                        </div>
                        </div>

                    </div>

                    <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="mb-2" for="name">Nombre</label>
                        <input type="text" class="form-control" name="name" id="name" value="<?= set_value('name') ?>" required>
                        <div class="col-sm-12 text-danger">
                            <?php echo validation_show_error('name'); ?>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="mb-2" for="name">Apellido</label>
                        <input type="text" class="form-control" name="lastname" id="lastname" value="<?= set_value('lastname') ?>" required>
                        <div class="col-sm-12 text-danger">
                            <?php echo validation_show_error('lastname'); ?>
                        </div>
                    </div>

                    </div>

                    <div class="row">

                    <div class="col-md-12 mb-3">
                        <label class="mb-2" for="email">Correo electrónico</label>
                        <input type="email" class="form-control" name="email" id="email" value="<?= set_value('email') ?>" required>
                        <div class="col-sm-12 text-danger">
                            <?php echo validation_show_error('email'); ?>
                        </div>
                    </div>

                    </div>

                    <div class="row">

                    <div class="col-md-6 mb-3">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                        <div class="col-sm-12 text-danger">
                            <?php echo validation_show_error('password'); ?>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="repassword">Confirmar contraseña</label>
                        <input type="password" class="form-control" name="repassword" id="repassword" required>
                        <div class="col-sm-12 text-danger">
                            <?php echo validation_show_error('repassword'); ?>
                        </div>
                    </div>

                    </div>

                    <div class="row text-center">

                    <button type="submit" class="btn btn-primary">
                        Registrar
                    </button>

                    </div>
                </form>

            </div>
            <div class="card-footer py-3 border-0">
                <div class="text-center">
                    <a href="<?= base_url(); ?>">Iniciar sesión</a>
                </div>
            </div>
        </div>
<?= $this->endSection();?>
