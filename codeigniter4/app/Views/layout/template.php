<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Biblioteca Michel Roche</title>
	<link rel="stylesheet" href="<?= base_url('/public/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('/public/bootstrap-icons/font/bootstrap-icons.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('/public/css/toastr.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('/public/css/styles.css'); ?>">
	<link rel="shortcut icon" type="image/png" href="<?= base_url('/public/images/logo.png'); ?>">
</head>
<body>
	<div class="container">
		<?= $this->renderSection('content');?>
	</div>
</body>
<script src="<?= base_url('/public/js/index.global.min.js'); ?>"></script>
<script src="<?= base_url('/public/js/jquery.min.js'); ?>"></script>
<script src="<?= base_url('/public/js/bootstrap.bundle.js'); ?>"></script>
<script src="<?= base_url('/public/js/moment.min.js'); ?>"></script>
<script src="<?= base_url('/public/js/toastr.min.js'); ?>"></script>
</html>