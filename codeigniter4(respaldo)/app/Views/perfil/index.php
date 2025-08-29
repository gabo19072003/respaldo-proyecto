<?= $this->extend('layout/template_home');?>

<?= $this->section('content');?>

<div class="container-fluid">

	<div class="row  mt-3 align-items-center ">

		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-primary text-white">
					Información Personal
				</div>
				<div class="card-body">

					<div class="row ">

					<div class="col-md-5">

						<div class="form-group row text-center">
              <div class="col-12">
                 <img class="img-thumbnail" src="<?=base_url()?>/public/uploads/<?=$persona['persona_foto']?>" width="150" alt="">
              </div>
              <div class="col-sm-12 text-danger">
                <?php echo validation_show_error('persona_foto'); ?>
              </div>
            </div>
						

					</div>

					<div class="col-md-7">

					<div class="row mt-5">

					<div class="col-sm-6">
					<div class="form-group">
						<label>Nombre y Apellido: <strong><?php echo ''.ucfirst($_SESSION['username']).' '.ucfirst($_SESSION['userlastname']).''; ?></strong></label>
					</div>
					</div>

					<div class="col-sm-6">
					<div class="form-group">
						<label>Usuario: <strong><?= ucfirst($_SESSION['user']); ?></strong></label>
					</div>
					</div>

					</div>
					<div class="row">

					<div class="col-sm-6">
					<div class="form-group">
						<label>Correo: <strong><?= $_SESSION['email']; ?></strong></label>
					</div>
					</div>

					<div class="col-sm-6">
					<div class="form-group">
						<label>Rol: 
						<?php if ($roles > 0) {
                          foreach($roles as $rol): 
                          	if($rol['rol_id'] == $_SESSION['rol']){
                                echo '<strong>'.ucfirst($rol['nombre']).'</strong>';  
                                } 
                          endforeach;
                    	} ?>
                        </label>
					</div>
					</div>

					</div>

					</div>

					</div>

					<ul class="list-group">
						<li class="list-group-item active">Cambiar Contraseña</li>
						<form action="<?=site_url('persona/cambiar')?>" method="post" name="frmChangePass" id="frmChangePass" class="p-3">
							<div class="row">

							<div class="col-md-6">

							<div class="form-group">
								<label class="col-sm-6 col-form-label my-0">Contraseña Actual</label>
								<div class="col-sm-12">
								<input type="password" name="actual" id="actual" placeholder="Clave Actual" required class="form-control">
								</div>
								<div class="col-sm-12 text-danger">
                     <?php echo validation_show_error('actual'); ?>
                </div>
							</div>

							</div>

							<div class="col-md-6">
								<?= csrf_field(); ?>

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
							
							<div class="col-md-6">

							<div class="form-group">
								<label class="col-sm-6 col-form-label my-0">Nueva Contraseña</label>
								<div class="col-sm-12">
								<input type="password" name="nueva" id="nueva" placeholder="Nueva Clave" required class="form-control">
								</div>
								<div class="col-sm-12 text-danger">
                                   <?php echo validation_show_error('nueva'); ?>
                                </div>
							</div>

							</div>
							<div class="col-md-6">

							<div class="form-group">
								<label class="col-sm-6 col-form-label my-0">Confirmar Contraseña</label>
								<div class="col-sm-12">
								<input type="password" name="confirmar" id="confirmar" placeholder="Confirmar clave" required class="form-control">
								</div>
								<div class="col-sm-12 text-danger">
                                   <?php echo validation_show_error('confirmar'); ?>
                                </div>
							</div>

							</div>

							<div class="col-md-12 text-center">

							<div>
								<button type="submit" class="btn btn-primary btnChangePass">Cambiar Contraseña</button>
							</div>

							</div>

							</div>
						</form>
					</ul>

				</div>
			</div>
		</div>

	</div>

<?= $this->endSection();?>