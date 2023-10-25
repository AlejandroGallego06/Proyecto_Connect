<?php
require 'includes/funciones.php';


require 'includes/config/database.php';
$db = conectarDB();

$queryRutas = "SELECT * FROM rutas";
$resultadoConsultaRutas = mysqli_query($db, $queryRutas);
$resultadoRutas = $_GET['resultadoRutas'] ?? null;

incluirTemplate('header', true);
?>

<main class="contenedor seccion">
    <h1>Más sobre nosotros</h1>
    <div class="iconos-nosotros">
        <div class="icono">
            <img src="build/img/icono1.svg" alt="icono Seguridad">
            <h3>Seguridad</h3>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Debitis, aut assumenda. Minus, vitae doloribus animi nesciunt iure distinctio. Magni, quia distinctio beatae accusamus harum culpa atque quod. At, consectetur fugit!</p>
        </div>
        <div class="icono">
            <img src="build/img/icono2.svg" alt="icono Precio">
            <h3>Precio</h3>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Debitis, aut assumenda. Minus, vitae doloribus animi nesciunt iure distinctio. Magni, quia distinctio beatae accusamus harum culpa atque quod. At, consectetur fugit!</p>
        </div>
        <div class="icono">
            <img src="build/img/icono3.svg" alt="icono Tiempo">
            <h3>Tiempo</h3>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Debitis, aut assumenda. Minus, vitae doloribus animi nesciunt iure distinctio. Magni, quia distinctio beatae accusamus harum culpa atque quod. At, consectetur fugit!</p>
        </div>
    </div>
</main>

<section class="imagen-contacto">
    <h2>Descubre la experiencia de tus sueños en el mar</h2>
    <p>Llena el formulario de contacto y un asesor se pondra en contacto contigo a la brevedad</p>
    <a href="contacto.php" class="boton-amarillo-inline">Contáctanos</a>
</section><!--Contacto-->

<div class="contenedor seccion seccion-inferior">
    <section class="tabla-rutas">
        <!-- Tabla de rutas -->
        <table id="rutas" class="propiedades amarillo">
            <thead>
                <tr>
                    <th>Origen</th>
                    <th>Destino</th>
                    <th>Distancia</th>
                    <th>Duracion</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!-- Mostrar los resultados -->
                <?php while ($ruta = mysqli_fetch_assoc($resultadoConsultaRutas)) : ?>
                    <tr>
                        <td><?php echo $ruta['origen']; ?></td>
                        <td><?php echo $ruta['destino']; ?></td>
                        <td><?php echo $ruta['distancia']; ?></td>
                        <td><?php echo $ruta['duracion']; ?></td>
                        <td>
                            <a href="#" class="boton boton-amarillo">Reservar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </section><!--Blog-->

    <section class="testimoniales">
        <h3>testimoniales</h3>

        <div class="testimonial">
            <blockquote>
                El personal se comporto de una forma excelente, muy buena atención y servicio, los recomiendo ampliamente.
            </blockquote>
            <p>- Alejandro Gallego Castro</p>
        </div>
    </section><!--Testimoniales-->
</div>

<?php
mysqli_close($db);
incluirTemplate('footer')
?>