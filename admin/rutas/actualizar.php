<?php
require '../../includes/funciones.php';
$auth = estaAutenticado();

if (!$auth) {
    header('Location: /Proyecto_connect/index.php');
}

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: /Proyecto_connect/admin/index.php');
}

require '../../includes/config/database.php';
$db = conectarDB();

//Obtener los datos de  la ruta
$consultaRutas = "SELECT * FROM rutas WHERE id= {$id}";
$resultadoRutas = mysqli_query($db, $consultaRutas);
$ruta = mysqli_fetch_assoc($resultadoRutas);

//Consultar para obtener los barcos
$query = "SELECT * FROM barcos";
$resultado = mysqli_query($db, $query);

//Arreglo con mensaje de errores
$errores = [];

$origen = $ruta['origen'];
$destino = $ruta['destino'];
$distancia = $ruta['distancia'];
$duracion = $ruta['duracion'];
$barco = $ruta['barco'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    // echo "<pre>";
    // var_dump($_FILES);
    // echo "</pre>";


    $origen = mysqli_real_escape_string($db, $_POST['origen']);
    $destino = mysqli_real_escape_string($db, $_POST['destino']);
    $distancia = mysqli_real_escape_string($db, $_POST['distancia']);
    $duracion = mysqli_real_escape_string($db, $_POST['duracion']);
    $barco = mysqli_real_escape_string($db, $_POST['barco']);

    if (!$origen) {
        $errores[] = "Debes agregar un origen";
    }

    if (!$destino) {
        $errores[] = "Debes agregar un destino";
    }

    if (!$distancia) {
        $errores[] = "Debes agregar una distancia";
    }

    if (!$duracion) {
        $errores[] = "Establece una duracion";
    }

    if (!$barco) {
        $errores[] = "Debes agregar un barco";
    }

    // echo "<pre>";
    // var_dump($errores);
    // echo "</pre>";

    //Revisar que el array de errores este vacio
    if (empty($errores)) {

        $query = "UPDATE rutas SET origen = '{$origen}', destino = '{$destino}', distancia = {$distancia}, duracion = {$duracion}, barco = {$barco} WHERE id = {$id}";

        var_dump($query);

        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            //Redireccionar al usuario

            header('Location: /Proyecto_connect/admin/index.php?resultadoRutas=2');
        }
    }
}



incluirTemplate('headerAdminAC');

?>

<main class="contenedor seccion">
    <h1>Actualizar Ruta</h1>

    <a href="/Proyecto_connect/admin/index.php" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Información Ruta</legend>

            <label for="origen">Origen:</label>
            <input type="text" id="origen" name="origen" placeholder="Origen Ruta" value="<?php echo $origen; ?>">

            <label for="destino">Destino:</label>
            <input type="text" id="destino" name="destino" placeholder="Destino Ruta" value="<?php echo $destino; ?>">

            <label for="distancia">Distancia (Millas):</label>
            <input type="number" id="distancia" name="distancia" placeholder="Distancia Ruta" value="<?php echo $distancia; ?>">

            <label for="duracion">Duracion (Dias):</label>
            <input type="number" id="duracion" name="duracion" placeholder="Duracion Ruta" value="<?php echo $duracion; ?>">

        </fieldset>

        <fieldset>
            <legend>Barco</legend>

            <select name="barco">
                <option value="">-- Seleccione --</option>
                <?php while ($barcos = mysqli_fetch_assoc($resultado)) : ?>
                    <option <?php echo $barco === $barcos['id'] ? 'selected' : ''; ?> value="<?php echo $barcos['id']; ?>"><?php echo $barcos['nombre']; ?></option>
                <?php endwhile; ?>
            </select>
        </fieldset>

        <input type="submit" value="Actualizar Ruta" class="boton-verde">
    </form>
</main>

<?php
incluirTemplate('footerAdmin');
?>