<?= $this->extend('layout/template');?>

<?= $this->section('content');?>

		<div class="card shadow-lg form-signin">
            <div class="card-body px-5 pt-5">
                <div class="d-flex justify-content-center">
                <div class="w-50"><img src="<?= base_url('/public/images/logo.png'); ?>" alt="" class="img-fluid"></div>
                </div>
                <h1 class="fs-4 card-title text-center fw-bold mb-4">Biblioteca Marcel Roche</h1>
                
                <form method="POST" action="<?= base_url('auth'); ?>" autocomplete="off">

                	<?= csrf_field(); ?>

                    <div class="mb-3">
                        <label title="usuario" class="mb-2" for="usuario">Usuario</label>
                        <input type="text" class="form-control" name="user" id="user" required autofocus>
                    </div>

                    <div class="mb-3">
                        <div class="mb-2 w-100">
                            <label for="password">Contraseña</label>
                            <a href="<?= base_url('password-request'); ?>" class="float-end">
                                Olvide mi contraseña
                            </a>
                        </div>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="text-center">
                    <button type="submit" class="btn btn-primary">
                        Ingresar
                    </button>
                    </div>
                </form>
                
                <?php if (session()->getFlashdata('errors') !== null) : ?>
                <div class="alert alert-danger mt-3 mb-1" role="alert">
                	<?= session()->getFlashdata('errors'); ?>	
                </div> 
            	<?php endif; ?>

            </div>
            <div class="card-footer py-2 border-0">
                <div class="text-center">
                    Oficina de Tecnologia de la Información y Comunicación<br>
                     &copy; <?php echo date("Y"); ?>

                </div>
            </div>
        </div>

<?= $this->endSection();?>