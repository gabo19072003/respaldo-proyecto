<!DOCTYPE html>
<html lang="es">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Biblioteca Michel Roche</title>

  <!-- base:css -->
  <link rel="stylesheet" href="<?= base_url('/public/bootstrap-icons/font/bootstrap-icons.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('/public/assets/vendor/mdi/css/materialdesignicons.min.css')?>">
  <link rel="stylesheet" href="<?= base_url('/public/assets/vendor/css/vendor.bundle.base.css'); ?>">
  <!-- endinject -->

  <!-- inject:css -->
  <link rel="stylesheet" href="<?= base_url('/public/assets/css/style.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('/public/assets/css/full-calendar.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('/public/assets/vendor/DataTables/datatables.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('/public/assets/css/snackbar.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('/public/assets/css/jquery-ui.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('/public/css/toastr.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('/public/css/daterangepicker.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('/public/css/bootstrap-clockpicker.min.css'); ?>">
  <!-- endinject -->

  <link rel="shortcut icon" href="<?= base_url('/public/images/logo.png'); ?>" />

</head>

<body>

  <div class="container-scroller d-flex">

    <?= $this->include('layout/sidebar'); ?>

        <!-- partial -->
    <div class="container-fluid page-body-wrapper">

      <?= $this->include('layout/navbar'); ?>

      <!-- partial -->
      <div class="main-panel">

        <div class="content-wrapper">

    <?= $this->renderSection('content');?>

        </div>
        <!-- content-wrapper ends -->

      </div>
      <!-- main-panel ends -->
      
    </div>
    <!-- page-body-wrapper ends -->

  </div>
  <!-- container-scroller -->

  <script type="text/javascript">

    var BASE_URL ="<?= base_url() ?>";

</script>
  
  <!-- base:js -->
  <script src="<?= base_url('public/assets/vendor/js/vendor.bundle.base.js'); ?>"></script>
  <script src="<?= base_url('public/assets/vendor/js/bootstrap-datepicker.min.js'); ?>"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="<?= base_url('public/assets/js/jquery.cookie.js'); ?>" type="text/javascript"></script>
  <script src="<?= base_url('public/vendors/chart.js/Chart.min.js'); ?>"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="<?= base_url('public/assets/js/off-canvas.js'); ?>"></script>
  <script src="<?= base_url('public/assets/js/hoverable-collapse.js'); ?>"></script>
  <script src="<?= base_url('public/assets/js/template.js'); ?>"></script>
  <!-- endinject -->
    <!-- Custom js for this page-->
  <script src="<?= base_url('public/assets/js/dashboard.js'); ?>"></script>
  <!-- End custom js for this page-->
  <script src="<?= base_url('public/assets/js/snackbar.min.js'); ?>"></script>
  <script src="<?= base_url('public/assets/js/axios.min.js'); ?>"></script>

<script type="text/javascript" src="<?= base_url('public/assets/vendor/DataTables/datatables.min.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('public/assets/vendor/all.min.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('public/assets/js/full-calendar.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('public/assets/js/es.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('public/assets/js/jquery-ui.min.js'); ?>"></script>
<script src="<?= base_url('/public/js/scripts.js'); ?>"></script>
<script src="<?= base_url('/public/js/moment.min.js'); ?>"></script>
<script src="<?= base_url('/public/js/toastr.min.js'); ?>"></script>
<script src="<?= base_url('/public/js/bootstrap-clockpicker.min.js'); ?>"></script>

<script>

    function message(tipo, mensaje) {
        Snackbar.show({
            text: mensaje,
            pos: 'top-right',
            backgroundColor: tipo == 'success' ? '#079F00' : '#FF0303',
            actionText: 'Cerrar'
        });
    }

    function salir(params) {
      Snackbar.show({
    text: 'Esta seguro de salir?',
    width: '475px',
    actionText: 'Salir',
    backgroundColor: '#FF0303',
    onActionClick: function (element) {
      axios.get(BASE_URL + 'logout')
        .then(function (response) {
          const info = response.data;
          message(info.tipo, info.mensaje);
          if (info.tipo == 'success') {
            setTimeout(() => {
              window.location = BASE_URL;
            }, 1500);
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    }
  });
    }
</script>


<script type="text/javascript">
  $(document).ready(function() {
    $('#table').DataTable({
      language: {
        "decimal": "",
        "emptyTable": "No hay datos",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
        "infoEmpty": "Mostrando 0 a 0 de 0 registros",
        "infoFiltered": "(Filtro de _MAX_ total registros)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ registros",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "No se encontraron coincidencias",
        "paginate": {
          "first": "Primero",
          "last": "Ultimo",
          "next": "Siguiente",
          "previous": "Anterior"
        },
        "aria": {
          "sortAscending": ": Activar orden de columna ascendente",
          "sortDescending": ": Activar orden de columna desendente"
        }
      }
    });
  });
</script>
</body>

</html> 
<?php
function fecha()
{
    $mes = array(
        "", "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre"
    );
    return date('d') . " de " . $mes[date('n')] . " de " . date('Y');
}      
?>