<?= $this->extend('layout/template_home');?>

<?= $this->section('content');?>

<!-- Begin Page Content -->
<div class="container-fluid ">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Bitácora</h1>
         <?= csrf_field(); ?>

            <?php if (session()->getFlashdata('mensaje') !== null) : ?>
                <div class="alert alert-<?= session()->getFlashdata('color'); ?> alert-dismissible fade show" role="alert">
                   <?= session()->getFlashdata('mensaje'); ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; 
            if(empty($_SESSION['mensaje'])) {

                $_SESSION['color'] = null;
                $_SESSION['mensaje'] = null;
            } 
            ?>
        <a href="<?=base_url('')?>" class="btn btn-primary"><i class="nav-icon bi bi-filetype-pdf fs-5"></i></a>
    </div>

    <div class="row">
        <div class="col-lg-12">

            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="table">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>ID</th>
                            <th>DIRECCIÓN IP</th>
                            <th>DETALLES</th>
                            <th>FECHA</th>
                            <th>HORA</th>
                            <th>USUARIO</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        foreach($bitacoras as $bitacora): ?>
                            <tr>
                                <td class="text-center"><?=$bitacora['bitacora_id'];?></td>
                                <td class="text-center"><?=$bitacora['bitacora_ip'];?></td>
                                <td class="text-center"><?=$bitacora['bitacora_detalles'];?></td>
                                <td class="text-center"><?=$bitacora['bitacora_fecha'];?></td>
                                <td class="text-center"><?=$bitacora['bitacora_hora'];?></td>
                                <td class="text-center"><?=$bitacora['user'];?></td>
                            </tr>
                        <?php endforeach;
                     ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>


</div>
<!-- /.container-fluid -->

<?= $this->endSection();?>