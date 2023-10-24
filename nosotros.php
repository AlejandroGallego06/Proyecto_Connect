<?php
require 'includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor ">
    <h1>Conoce Sobre Nosotros</h1>

    <section class="contenido-nosotros">
        <div class="imagen">
            <picture>
                <source srcset="build/img/nosotros.webp" type="image/webp">
                <source srcset="build/img/nosotros.jpeg" type="image/jpeg">
                <img loading="lazy" src="build/img/nosotros.jpg" alt="Texto Nosotros">
            </picture>
        </div>

        <div class="texto-nosotros">
            <h4>25 Años de Experiencia</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique placeat impedit molestiae eaque. Ad voluptas nemo et nulla quidem a dolorum exercitationem eligendi maiores consequuntur natus alias itaque, repellat Lorem ipsum dolor sit, amet consectetur adipisicing elit. Mollitia dolorem unde architecto debitis atque veniam eos praesentium, assumenda similique perferendis laborum deserunt corporis soluta rem neque.</p>
            <p>Reprehenderit minus nemo aspernatur Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic rerum repellendus voluptatibus cum? Minima magni et eligendi sint maxime amet facilis, eius magnam earum dignissimos officia at alias fuga odio.</p>
        </div>
    </section>

    <h2>Más sobre nosotros</h2>
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

<?php
incluirTemplate('footer')
?>