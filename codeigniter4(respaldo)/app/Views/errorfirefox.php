<?= $this->extend('layout/template');?>

<?= $this->section('content');?>

		<div class="card shadow-lg form-signin">
            <div class="card-body p-5 ">
                <div class="d-flex justify-content-center">
                <div class="w-50"><img src="<?= base_url('/public/images/logo.png'); ?>" alt="" class="img-fluid"></div>
                </div>
                <h1 class="fs-4 card-title text-center fw-bold mb-4">Biblioteca </h1> <!-- Marcel Roche -->
                
                <div class="row text-center">
                    
                    <div class="alert alert-danger" role="alert">
                        <div class="col-12">
                        <i class="bi bi-exclamation-triangle fs-1"></i>
                        </div>
                      <h4 class="alert-heading">Navegador</h4>
                      <p class="">Verifique si posee un navegador Firefox en su sistema. El navegador no es el apropiado para el uso de sistema.</p>
                    </div>
                </div>

            </div>
            <div class="card-footer py-0 border-0">

            </div>
        </div>

<?= $this->endSection();?>