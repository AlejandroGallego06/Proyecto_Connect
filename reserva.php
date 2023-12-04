<?php
require 'includes/funciones.php';

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: /Proyecto_connect/admin/index.php');
}

require 'includes/config/database.php';
$db = conectarDB();

//Obtener los datos de  la ruta
$consultaRutas = "SELECT * FROM rutas WHERE id= {$id}";
$resultadoRutas = mysqli_query($db, $consultaRutas);
$ruta = mysqli_fetch_assoc($resultadoRutas);

$errores = [];

$origen = $ruta['origen'];
$destino = $ruta['destino'];
$correo = '';
$telefono = '';
$fecha = '';
$fechaf = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $origen = mysqli_real_escape_string($db, $_POST['origen']);
    $destino = mysqli_real_escape_string($db, $_POST['destino']);
    $correo = mysqli_real_escape_string($db, $_POST['correo']);
    $telefono = mysqli_real_escape_string($db, $_POST['telefono']);
    $fecha = mysqli_real_escape_string($db, $_POST['fecha']);
    $fechaf = mysqli_real_escape_string($db, $_POST['fechaf']);
    $creado = date('Y/m/d');

    if (!$origen) {
        $errores[] = "Debes agregar un origen";
    }

    if (!$destino) {
        $errores[] = "Debes agregar un destino";
    }

    if (!$correo) {
        $errores[] = "Debes agregar un correo";
    }

    if (!$telefono) {
        $errores[] = "Debes agregar un telefono";
    }

    if (!$fecha) {
        $errores[] = "Debes agregar una fecha de inicio";
    }

    if (!$fechaf) {
        $errores[] = "Debes agregar una fecha de fin";
    }

    if (empty($errores)) {

        $query = "INSERT INTO reservas (ruta, correo, telefono, fecha, fechaf, creado) VALUES ('$id', '$correo', '$telefono','$fecha', '$fechaf', '$creado');";

        var_dump($query);

        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            //Redireccionar al usuario

            header('Location: /Proyecto_connect/index.php?resultadoReserva=1');
        }
    }
}

incluirTemplate('header');
?>

<main class="contenedor ">
    <h1>Ingresa los siguientes datos para realizar la reserva</h1>

    <a href="/Proyecto_connect/index.php" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Información Reserva</legend>

            <label for="origen">Origen:</label>
            <input type="text" id="origen" name="origen" placeholder="Origen" value="<?php echo $origen; ?>">

            <label for="destino">Destino:</label>
            <input type="text" id="destino" name="destino" placeholder="Destino" value="<?php echo $destino; ?>">

            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" placeholder="Correo" value="<?php echo $correo; ?>">

            <label for="telefono">Telefono:</label>
            <input type="tel" id="telefono" name="telefono" placeholder="Telefono" value="<?php echo $telefono; ?>">

            <label for="fecha">Fecha Inicio:</label>
            <input type="date" id="fecha" name="fecha" placeholder="Fecha" value="<?php echo $fecha; ?>">

            <label for="fechaf">Fecha Fin:</label>
            <input type="date" id="fechaf" name="fechaf" placeholder="Fecha" value="<?php echo $fechaf; ?>">

        </fieldset>

        <input type="submit" value="Crear Reserva" class="boton-verde">
    </form>

</main>

<?php
incluirTemplate('footer')
?>