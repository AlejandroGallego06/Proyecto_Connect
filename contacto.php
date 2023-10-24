<?php
require 'includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor ">
    <h1>Contacto</h1>

    <picture>
        <source srcset="build/img/destacada3.webp" type="webp">
        <source srcset="build/img/destacada3.jpg" type="jpeg">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="imagen del contacto">
    </picture>

    <h2>Llena el formulario de contacto</h2>

    <form class="formulario">
        <fieldset>
            <legend>Informacion Personal</legend>

            <label for="nombre">Nombre</label>
            <input type="text" placeholder="Tu Nombre" id="nombre">

            <label for="correo">E-mail</label>
            <input type="email" placeholder="Tu Correo electronico" id="correo">

            <label for="telefono">Teléfono</label>
            <input type="tel" placeholder="Tu Teléfono" id="telefono">

            <label for="mensaje">Mensaje:</label>
            <textarea id="mensaje"></textarea>
        </fieldset>

        <fieldset>
            <legend>Contacto</legend>

            <p>Como desea ser contactado</p>
            <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input name="contacto" type="radio" value="telefono" id="contactar-telefono">

                <label for="contactar-email">E-mail</label>
                <input name="contacto" type="radio" value="email" id="contactar-email">
            </div>

            <p>Si eligio telefono, elija la fecha y la hora</p>

            <label for="fecha">Fecha</label>
            <input type="date" id="fecha">

            <label for="hora">Hora</label>
            <input type="time" id="hora" min="09:00" max="18:00">
        </fieldset>

        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>

<?php
incluirTemplate('footer')
?>