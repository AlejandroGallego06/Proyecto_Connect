<?php
require '../../includes/funciones.php';
$auth = estaAutenticado();

if (!$auth) {
    header('Location: /Proyecto_connect/index.php');
}

//Importar la conexion
require '../../includes/config/database.php';
$db = conectarDB();

//Escribir el Query
$query = "SELECT * FROM reservas";

//Consultar la BD
$resultadoConsulta = mysqli_query($db, $query);

//Muestra mensaje condicional
$resultadoReserva = $_GET['resultadoReserva'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if ($id) {
        //Eliminar la reserva
        $query = "DELETE FROM reservas WHERE id = {$id}";
        $resultadoReserva = mysqli_query($db, $query);

        if ($resultadoReserva) {
            header('Location: /Proyecto_connect/admin/reservas/eliminar.php?resultadoReserva=2');
        }
    }
}

incluirTemplate('headerAdminAC');
?>

<main class="contenedor seccion">
    <h1>Reservas</h1>

    <a href="/Proyecto_connect/admin/index.php" class="boton boton-verde">Volver</a>

    <?php
    // Verificar si hay un parámetro 'resultadoReserva' en la URL y si su valor es 2
    if (isset($_GET['resultadoReserva']) && $_GET['resultadoReserva'] == 2) {

        echo '<div class="alerta exito">La reserva se eliminó correctamente</div>';
    }
    ?>

    <!-- Tabla de reservas -->
    <table id="reservas" class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID ruta</th>
                <th>Correo</th>
                <th>Telefono</th>
                <th>Fecha Creacion</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($reserva = mysqli_fetch_assoc($resultadoConsulta)) : ?>
                <tr>
                    <td><?php echo $reserva['id']; ?></td>
                    <td><?php echo $reserva['ruta']; ?></td>
                    <td><?php echo $reserva['correo']; ?></td>
                    <td><?php echo $reserva['telefono']; ?></td>
                    <td><?php echo $reserva['creado']; ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $reserva['id']; ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>

<?php
// Cerrar la conexión
mysqli_close($db);

incluirTemplate('footerAdmin');
?>