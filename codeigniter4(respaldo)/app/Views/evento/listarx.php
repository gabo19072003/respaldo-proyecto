<?= $this->extend('layout/template_home');?>

<?= $this->section('content');?>

 <style>
    .color-box {
      width: 60px;
      height: 25px;
      border: 1px solid #000;
    }
  </style>

<!-- Begin Page Content -->
<div class="container-fluid ">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="row">
        <a class="col-md-2"  href="<?=base_url('evento');?>"><i class="bi bi-arrow-left-circle-fill me-3 fs-2 text-secondary"></i></a>
        <h1 class="col-md-9 h3 mt-1 ms-2 mb-0 text-gray-800">Eventos Suspendidos</h1>
        </div>
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

    <div class="row">
        <div class="col-lg-12">

            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="table">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>ID</th>
                            <th>EVENTO</th>
                            <th>COLOR</th>
                            <th>FECHA INICIAL</th>
                            <th>FECHA FINAL</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if ($eventos > 0) {
                          foreach($eventos as $evento): ?>
                                <tr>
                                    <td class="text-center"><?=$evento['id'];?></td>
                                    <td class="text-center"><?=$evento['title'];?></td>
                                    <td class="text-center"><p class="color-box" style="background-color:<?=$evento['color'];?>;" ></p></td>
                                    <td class="text-center"><?=$evento['start'];?></td>
                                    <td class="text-center"><?=$evento['end'];?></td>
                                    <td class="text-center">
                                        <a href="<?=base_url('evento/restaurar/'.$evento['id']);?>" class="btn py-0 me-2" title="Restaurar evento"><i class="bi bi-recycle text-dark fs-5"></i></a>
                                        <a href="<?=base_url('evento/borrar/'.$evento['id']);?>" class="btn py-0 me-2" title="Borrar evento"><i class="bi bi-trash3-fill text-danger fs-5"></i></a>
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