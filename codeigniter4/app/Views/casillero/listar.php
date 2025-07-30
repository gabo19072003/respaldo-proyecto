<?= $this->extend('layout/template_home');?>

<?= $this->section('content');?>

<div class="container-fluid ">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Registros de Prestamos</h1>

            <?php if (session()->getFlashdata('mensaje') !== null){
                echo "<div class='alert alert-".session()->getFlashdata('color')." alert-dismissible fade show' role='alert'>
                            ".session()->getFlashdata('mensaje')."
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
            }
            ?>
        <a href="<?=base_url('casillero/crear')?>" class="btn btn-primary"><i class="nav-icon bi bi-file-earmark-plus fs-5"></i></a>
    </div>

    <div class="row">
        <div class="col-lg-12">

            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="table">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>ID</th>
                            <th>CÉDULA</th>
                            <th>NOMBRE</th>
                            <th>LIBRO ASIGNADO</th> <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($casilleros)): // Mejoramos la condición para verificar si el array no está vacío ?>
                            <?php foreach($casilleros as $casillero): ?>
                                <tr>
                                    <td class="text-center"><?=$casillero['casillero_id'];?></td>
                                    <td class="text-center"><?=$casillero['cedula'];?></td>
                                    <td class="text-center"><?=$casillero['nombre'];?></td>
                                    <td class="text-center">
                                        <?= esc($casillero['lib_nombre'] ?? 'N/A'); ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?=base_url('casillero/editar/'.$casillero['casillero_id']);?>" class="btn py-0 me-2"><i class="bi bi-pencil-square fs-5"></i></a>
                                        <a href="<?=base_url('casillero/borrar/'.$casillero['casillero_id']);?>" class="btn py-0 me-2"><i class="bi bi-trash3-fill text-danger fs-5"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No hay prestamos registrados.</td> </tr>
                    <?php endif; ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>
<?= $this->endSection();?>