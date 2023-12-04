<?php
require '../../includes/funciones.php';
$auth = estaAutenticado();

if (!$auth) {
    header('Location: /Proyecto_connect/index.php');
}

require '../../includes/config/database.php';
$db = conectarDB();


//Arreglo con mensaje de errores
$errores = [];

$nombre = '';
$email = '';
$telefono = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    // echo "<pre>";
    // var_dump($_FILES);
    // echo "</pre>";


    $nombre = mysqli_real_escape_string($db, $_POST['nombre']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $telefono = mysqli_real_escape_string($db, $_POST['telefono']);

    if (!$nombre) {
        $errores[] = "Debes agregar un nombre";
    }

    if (!$email) {
        $errores[] = "Debes agregar un email";
    }

    if (!$telefono) {
        $errores[] = "Debes agregar una telefono";
    }

    // echo "<pre>";
    // var_dump($errores);
    // echo "</pre>";

    //Revisar que el array de errores este vacio
    if (empty($errores)) {

        $query = "INSERT INTO clientes (nombre, email, telefono) VALUES ('$nombre', '$email', '$telefono');";

        var_dump($query);

        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            //Redireccionar al usuario

            header('Location: /Proyecto_connect/admin/index.php?resultadoClientes=1');
        }
    }
}



incluirTemplate('headerAdminAC');

?>

<main class="contenedor seccion">
    <h1>Crear Cliente</h1>

    <a href="/Proyecto_connect/admin/index.php" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/Proyecto_connect/admin/clientes/crear.php" enctype="multipart/form-data">
        <fieldset>
            <legend>Información Cliente</legend>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $nombre; ?>">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Email" value="<?php echo $email; ?>">

            <label for="telefono">Telefono:</label>
            <input type="text" id="telefono" name="telefono" placeholder="Telefono" value="<?php echo $telefono; ?>">

        </fieldset>

        <input type="submit" value="Crear Cliente" class="boton-verde">
    </form>
</main>

<?php
incluirTemplate('footerAdmin');
?>