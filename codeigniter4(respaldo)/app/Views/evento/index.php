<?= $this->extend('layout/template_home');?>

<?= $this->section('content');?>

<!-- Begin Page Content -->
<div class="container-fluid">
        <div class="row">
            <div class="col-md-11">
                <div id="agenda"></div>
            </div>
            <div class="col-md-1">
                <div class="row">
                    <div class="col-12">
                        <a href="<?=base_url('evento/crear');?>" title="Crear nuevo evento" class="btn btn-dark mb-2"><i class="nav-icon bi bi-file-earmark-plus fs-5"></i></a>
                    </div>
                 </div>
                 <div class="row">
                    <div class="col-12">
                        <a href="<?=base_url('evento/lista');?>" title="Lista de eventos" class="btn btn-dark my-2"><i class="nav-icon bi bi-card-list fs-5"></i></a>
                    </div>
                 </div>
                 <div class="row">
                    <div class="col-12">
                        <a href="<?=base_url('evento/listarexit');?>" title="Lista de eventos suspendidos" class="btn btn-dark my-2"><i class="nav-icon bi bi-calendar2-x fs-5"></i></a>
                    </div>
                 </div>
                 <div class="row">
                    <div class="col-12">
                        <a href="<?=base_url('evento/imprimir');?>" title="Reporte de eventos" class="btn btn-dark my-2"><i class="nav-icon bi bi-file-earmark-pdf fs-5"></i></a>
                    </div>
                 </div>

            </div>
        </div>
    </div>

<?= $this->endSection();?>