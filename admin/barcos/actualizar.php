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

//Conexion base de datos
require '../../includes/config/database.php';
$db = conectarDB();

//Obtener los datos del barco
$consultaBarco = "SELECT * FROM barcos WHERE id= {$id}";
$resultadoBarcos = mysqli_query($db, $consultaBarco);
$barco = mysqli_fetch_assoc($resultadoBarcos);


//Arreglo con mensaje de errores
$errores = [];

$nombre = $barco['nombre'];
$capacidad = $barco['capacidad'];
$estado = $barco['estado'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    // echo "<pre>";
    // var_dump($_FILES);
    // echo "</pre>";


    $nombre = mysqli_real_escape_string($db, $_POST['nombre']);
    $capacidad = mysqli_real_escape_string($db, $_POST['capacidad']);
    $estado = mysqli_real_escape_string($db, $_POST['estado']);

    if (!$nombre) {
        $errores[] = "Debes agregar un nombre";
    }

    if (!$capacidad) {
        $errores[] = "Debes agregar un capacidad";
    }

    if (!$estado) {
        $errores[] = "Elige un estado";
    }

    // echo "<pre>";
    // var_dump($errores);
    // echo "</pre>";

    //Revisar que el array de errores este vacio
    if (empty($errores)) {

        $query = "UPDATE barcos SET nombre = '{$nombre}', capacidad = {$capacidad}, estado = '{$estado}' WHERE id = {$id}";

        var_dump($query);

        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            //Redireccionar al usuario

            header('Location: /Proyecto_connect/admin/index.php?resultado=2');
        }
    }

    //Insertar en la base de datos


}



incluirTemplate('headerAdminAC');

?>

<main class="contenedor seccion">
    <h1>Actualizar Barco</h1>

    <a href="/Proyecto_connect/admin/index.php" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Información Barco</legend>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" placeholder="Nombre barco" value="<?php echo $nombre; ?>">

            <label for="capacidad">Capacidad:</label>
            <input type="number" id="capacidad" name="capacidad" placeholder="Capacidad Barco" value="<?php echo $capacidad; ?>">

            <label for="estado">Estado:</label>
            <select id="estado" name="estado">
                <option value="">-- Seleccione --</option>
                <option value="Activo" <?php if ($estado == 'Activo') echo 'selected'; ?>>Disponible</option>
                <option value="Inactivo" <?php if ($estado == 'Inactivo') echo 'selected'; ?>>No Disponible</option>
            </select>
        </fieldset>

        <input type="submit" value="Actualizar barco" class="boton-verde">
    </form>
</main>

<?php
incluirTemplate('footer');
?>