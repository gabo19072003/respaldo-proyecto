<?= $this->extend('layout/template_home');?>

<?= $this->section('content');?>

<!-- Begin Page Content -->
<div class="container-fluid ">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        
        <span>
            <h1 class="h3 mb-0 text-gray-800">Usuarios del Sistemas</h1>
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

        <a href="<?=base_url('usuario/crear')?>" class="btn btn-primary"><i class="nav-icon bi bi-person-fill-add fs-4"></i></a>
    </div>

    <div class="row">
        <div class="col-lg-12">

            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="table">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>ID</th>
                            <th>USUARIO</th>
                            <th>CORREO</th>
                            <th>ROL</th>
                            <th>ESTADO</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($users as $user): ?>
                                <tr>
                                    <td class="text-center"><?=$user['id'];?></td>
                                    <td class="text-center"><?=$user['usuario'];?></td>
                                    <td class="text-center"><?=$user['email'];?></td>
                                    <td class="text-center"><?=$user['rol'];?></td>
                                    <td class="text-center"><?php if ($user['active'] == 1) {echo 'Activo';} 
                                    else {echo 'Inactivo';}?></td>
                                    <td class="text-center">
                                        <a href="<?=base_url('usuario/editar/'.$user['id']);?>" class="btn py-0 me-2"><i class="bi bi-person-gear fs-4"></i></a>
                                        <a href="<?=base_url('usuario/borrar/'.$user['id']);?>" class="btn py-0 me-2"><i class="bi bi-trash3-fill text-danger fs-5"></i></a>
                                    </td>
                                </tr>
                    <?php endforeach;?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>


</div>
<!-- /.container-fluid -->

<?= $this->endSection();?>