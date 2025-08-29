<?= $this->extend('layout/template_home');?>

<?= $this->section('content');?>

<!-- Begin Page Content -->
<div class="container-fluid ">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Libros</h1>

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
        <a href="<?=base_url('libro/crear')?>" class="btn btn-primary"><i class="nav-icon bi bi-file-earmark-plus fs-5"></i></a>
    </div>

    <div class="row">
        <div class="col-lg-12">

            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="table">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>ID</th>
                            <th>COTA</th>
                            <th>NOMBRE</th>
                            <th>EDITORIAL</th>
                            <th>AUTOR</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if ($libros > 0) {
                          foreach($libros as $libro): ?>
                                <tr>
                                    <td class="text-center"><?=$libro['lib_id'];?></td>
                                    <td class="text-center"><?=$libro['cota'];?></td>
                                    <td class="text-center"><?=$libro['lib_nombre'];?></td>
                                    <td class="text-center"><?=$libro['lib_editorial'];?></td>
                                    <td class="text-center"><?=$libro['lib_autor'];?></td>
                                    <td class="text-center">
                                        <a href="<?=base_url('libro/editar/'.$libro['lib_id']);?>" class="btn py-0 me-2"><i class="bi bi-pencil-square fs-5"></i></a>
                                        <a href="<?=base_url('libro/borrar/'.$libro['lib_id']);?>" class="btn py-0 me-2"><i class="bi bi-trash3-fill text-danger fs-5"></i></a>
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