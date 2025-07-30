<?= $this->extend('layout/template_home');?>

<?= $this->section('content');?>

<!-- Begin Page Content -->
<div class="container-fluid ">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        
        <span>
            <h1 class="h3 mb-0 text-gray-800">Personas</h1>
        </span>
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

        <a href="<?=base_url('persona/crear')?>" class="btn btn-primary"><i class="nav-icon bi bi-file-earmark-plus fs-5"></i></a>
    </div>

    <div class="row">
        <div class="col-lg-12">

            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="table">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>ID</th>
                            <th>FOTO</th>
                            <th>CARNET</th>
                            <th>CÉDULA</th>
                            <th>NOMBRE</th>
                            <th>APELLIDO</th>
                            <th>FECHA</th>
                            <th>SEXO</th>
                            <th>TELEFONO</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if ($personas > 0) {
                          foreach($personas as $persona): ?>
                                <tr>
                                    <td class="text-center"><?=$persona['persona_id'];?></td>
                                    <td class="text-center">
                                        <div class="preview-thumbnail">
                                            <img class="profile-pic" src="<?=base_url()?>/public/uploads/<?=$persona['persona_foto'];?>" width="100" alt="<?=$persona['persona_foto'];?>">
                                        </div>
                                    </td>
                                    <td class="text-center"><?=$persona['persona_carnet'];?></td>
                                    <td class="text-center"><?=$persona['persona_ci'];?></td>
                                    <td class="text-center"><?=$persona['persona_nombre'];?></td>
                                    <td class="text-center"><?=$persona['persona_apellido'];?></td>
                                    <td class="text-center"><?=$persona['persona_fch_nacimi'];?></td>
                                    <td class="text-center"><?=$persona['persona_sexo'];?></td>
                                    <td class="text-center"><?=$persona['persona_tf'];?></td>
                                    <td class="text-center">
                                        <a href="<?=base_url('persona/editar/'.$persona['persona_id']);?>" class="btn py-0 me-2"><i class="bi bi-pencil-square fs-5"></i></a>
                                       

<form action="<?= site_url('persona/borrar/' . $persona['persona_id']) ?>" method="post" class="d-inline" onsubmit="return confirm('¿Estás seguro de que quieres eliminar a <?= esc($persona['persona_nombre']) ?> (CI: <?= esc($persona['persona_ci']) ?>)? Esta acción es irreversible.');">
    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="DELETE">
    <button type="submit" class="btn btn-danger py-0 px-2 me-2"> <i class="bi bi-trash fs-5"></i>
    </button>
</form>



                                    </td>
                                </tr>
                            <?php endforeach;
                    } ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>


</div>
<!-- /.container-fluid -->

<?= $this->endSection();?>