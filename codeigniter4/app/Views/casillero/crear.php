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
    </div>

<div class="row">
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Ingresar datos</h4>

                <form class="form-sample" action="<?=site_url('casillero/guardar')?>" method="post" enctype="multipart/form-data">

                <?= csrf_field(); ?>

                <p class="card-description">Nueva Persona y Asignación de Libro</p>

                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group row">
                            <label for="cedula" class="col-sm-3 col-form-label">Cédula:</label>
                                <div class="col-sm-9">
                                    <input id="cedula" value="<?=old('cedula')?>" type="text" class="form-control" name="cedula" placeholder="Ingrese el número de cédula">
                                </div>
                                <div class="col-sm-12 text-danger">
                                    <?php echo validation_show_error('cedula'); ?>
                                </div>
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group row">
                            <label for="nombre" class="col-sm-3 col-form-label">Nombre:</label>
                                <div class="col-sm-9">
                                    <input id="nombre" value="<?=old('nombre')?>" type="text" class="form-control" name="nombre" placeholder="Ingrese el nombre">
                                </div>
                                <div class="col-sm-12 text-danger">
                                    <?php echo validation_show_error('nombre'); ?>
                                </div>
                        </div>

                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="libro_id" class="col-sm-3 col-form-label">Libro Asignado:</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="libro_id" name="libro_id">
                                    <option value="">Seleccione un libro</option>
                                    <?php foreach ($libros as $libro): ?>
                                        <option value="<?= $libro['lib_id'] ?>" <?= old('libro_id') == $libro['lib_id'] ? 'selected' : '' ?>>
                                            <?= esc($libro['lib_nombre']) ?> (<?= esc($libro['cota']) ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-sm-12 text-danger">
                                <?php echo validation_show_error('libro_id'); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row d-flex justify-content-center">

                    <div class="col-md-3">
                    <a href="<?=base_url('casillero')?>" class="btn btn-inverse-primary">Regresar</a>
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    </div>

                </div>

                </form>


            </div>
        </div>

    </div>
</div>

</div>
<?= $this->endSection();?>