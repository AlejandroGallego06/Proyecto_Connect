<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connect</title>
    <link rel="stylesheet" href="/Proyecto_connect/build/css/app.css">
</head>

<body>
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/Proyecto_connect/index.php">
                    <img class="logo-header" src="/Proyecto_connect/build/img/logo2.svg" alt="logo del sitio de bienes raices">
                </a>

                <div class="mobile-menu">
                    <img src="/Proyecto_connect/build/img/barras.svg" alt="menu responsive">
                </div>

                <div class="derecha">
                    <img class="boton-modo-oscuro" src="/Proyecto_connect/build/img/dark-mode.svg" alt="boton modo oscuro">
                    <nav class="navegacion">
                        <a href="#barcos">Barcos</a>
                        <a href="../anuncios.php">Anuncios</a>
                        <a href="../blog.php">Blog</a>
                        <a href="../contacto.php">Contacto</a>
                    </nav>
                </div>


            </div> <!--.barra-->

            <?php if ($inicio) { ?>
                <h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>
            <?php } ?>

        </div>

    </header>