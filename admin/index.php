<?php
require '../includes/funciones.php';
$auth = estaAutenticado();

if (!$auth) {
    header('Location: /Proyecto_connect/index.php');
}
// var_dump($_SESSION);

//Importar la conexion
require '../includes/config/database.php';
$db = conectarDB();

//Escribir el Query
$query = "SELECT * FROM barcos";
$queryRutas = "SELECT * FROM rutas";
$queryClientes = "SELECT * FROM clientes";

//Consultar la BD
$resultadoConsulta = mysqli_query($db, $query);
$resultadoConsultaRutas = mysqli_query($db, $queryRutas);
$resultadoConsultaClientes = mysqli_query($db, $queryClientes);

//Muestra mensaje condicional
$resultado = $_GET['resultado'] ?? null;
$resultadoRutas = $_GET['resultadoRutas'] ?? null;
$resultadoClientes = $_GET['resultadoClientes'] ?? null;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if ($id) {
        //Eliminar el barco
        $query = "DELETE FROM barcos WHERE id = {$id}";
        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            header('Location: /Proyecto_connect/admin/index.php?resultado=3');
        }
    }

    if ($id) {
        //Eliminar la ruta
        $queryRutas = "DELETE FROM rutas WHERE id = {$id}";
        $resultadoRutas = mysqli_query($db, $queryRutas);

        if ($resultadoRutas) {
            header('Location: /Proyecto_connect/admin/index.php?resultadoRutas=3');
        }
    }

    if ($id) {
        //Eliminar el cliente
        $queryClientes = "DELETE FROM clientes WHERE id = {$id}";
        $resultadoClientes = mysqli_query($db, $queryClientes);

        if ($resultadoClientes) {
            header('Location: /Proyecto_connect/admin/index.php?resultadoClientes=3');
        }
    }
}


incluirTemplate('headerAdmin');
?>

<main class="contenedor seccion">
    <h1>Administrador de Connect</h1>

    <?php if ($resultado == 1) : ?>
        <p class="alerta exito">Barco Creado Correctamente</p>
    <?php elseif ($resultado == 2) : ?>
        <p class="alerta exito">Barco Actualizado Correctamente</p>
    <?php elseif ($resultado == 3) : ?>
        <p class="alerta exito">Barco Eliminado Correctamente</p>
    <?php elseif ($resultadoRutas == 1) : ?>
        <p class="alerta exito">Ruta Creada Correctamente</p>
    <?php elseif ($resultadoRutas == 2) : ?>
        <p class="alerta exito">Ruta Actualizada Correctamente</p>
    <?php elseif ($resultadoRutas == 3) : ?>
        <p class="alerta exito">Ruta Eliminada Correctamente</p>
    <?php elseif ($resultadoClientes == 1) : ?>
        <p class="alerta exito">Cliente Creado Correctamente</p>
    <?php elseif ($resultadoClientes == 2) : ?>
        <p class="alerta exito">Cliente Actualizado Correctamente</p>
    <?php elseif ($resultadoClientes == 3) : ?>
        <p class="alerta exito">Cliente Eliminado Correctamente</p>
    <?php endif; ?>

    <div class="creacion">
        <a href="/Proyecto_connect/admin/barcos/crear.php" class="boton boton-verde">Nuevo Barco</a>
        <a href="/Proyecto_connect/admin/rutas/crear.php" class="boton boton-amarillo-inline">Nueva Ruta</a>
        <a href="/Proyecto_connect/admin/clientes/crear.php" class="boton boton-azul-inline">Nuevo Cliente</a>
    </div>

    <!-- Tabla de barcos -->
    <table id="barcos" class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Capacidad</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody> <!-- Mostrar los resultados -->
            <?php while ($barco = mysqli_fetch_assoc($resultadoConsulta)) : ?>
                <tr>
                    <td><?php echo $barco['id']; ?></td>
                    <td><?php echo $barco['nombre']; ?></td>
                    <td><?php echo $barco['capacidad']; ?></td>
                    <td><?php echo $barco['estado']; ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $barco['id']; ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>

                        <a href="barcos/actualizar.php?id=<?php echo $barco['id']; ?>" class="boton-amarillo">Actualizar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Tabla de rutas -->
    <table id="rutas" class="propiedades amarillo">
        <thead>
            <tr>
                <th>ID</th>
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
                    <td><?php echo $ruta['id']; ?></td>
                    <td><?php echo $ruta['origen']; ?></td>
                    <td><?php echo $ruta['destino']; ?></td>
                    <td><?php echo $ruta['distancia']; ?></td>
                    <td><?php echo $ruta['duracion']; ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $ruta['id']; ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>

                        <a href="rutas/actualizar.php?id=<?php echo $ruta['id']; ?>" class="boton-amarillo">Actualizar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Tabla de Clientes -->
    <table id="clientes" class="propiedades azul">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Telefono</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody> <!-- Mostrar los resultados -->
            <?php while ($cliente = mysqli_fetch_assoc($resultadoConsultaClientes)) : ?>
                <tr>
                    <td><?php echo $cliente['id']; ?></td>
                    <td><?php echo $cliente['nombre']; ?></td>
                    <td><?php echo $cliente['email']; ?></td>
                    <td><?php echo $cliente['telefono']; ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $clientes['id']; ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>

                        <a href="clientes/actualizar.php?id=<?php echo $cliente['id']; ?>" class="boton-amarillo">Actualizar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>

<?php
//Cerrar la conexion
mysqli_close($db);

incluirTemplate('footer')
?>