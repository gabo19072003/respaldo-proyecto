<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="with=device-width, initial-scale=1.0">
        <title>Biblioteca</title>

        <link rel="stylesheet" href="<?=base_url()?>/public/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?=base_url()?>/public/bootstrap-icons/font/bootstrap-icons.min.css">
    </head>
    <body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand">Biblioteca</a>
        <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="my-nav" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?=base_url('listar')?>">Libros</a>
                </li>
            </ul>
        </div>
    </nav>

        <h1 class="text-center">Sistema Libros</h1>
        <div class="container">
            
<?php if(session('mensaje')){?>
    <div class="alert alert-danger" role="alert">
        <?php echo session('mensaje'); ?>
    </div>
<?php } ?>