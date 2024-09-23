<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Consulta 1: Mejores receptores </h1>

<p class="mt-3">
    ANALOGA: El primer botón debe mostrar la cédula y el nombre de los tres mecánicos que
más reparaciones han recibido (en caso de empates, usted decide cómo
proceder).
    <br>
    En nuestro caso:
    Se debe mostrar el codigo y el nombre de los tres patrocinadores que más cotizaciones
    hayan recibido.

</p>

<?php
// Crear conexión con la BD
require('../config/conexion.php');

// Query SQL a la BD -> Crearla acá (No está completada, cambiarla a su contexto y a su analogía)

//Consulta para traer los 3 patrocinadores con mas cotizaciones
$query="SELECT receptor,nombre, COUNT(*) as total FROM cotizacion INNER JOIN patrocinador ON 
cotizacion.receptor = patrocinador.codigo GROUP BY receptor ORDER BY total DESC LIMIT 3;";


// Ejecutar la consulta
$resultadoC1 = mysqli_query($conn, $query) or die(mysqli_error($conn));

mysqli_close($conn);
?>

<?php
// Verificar si llegan datos
if($resultadoC1 and $resultadoC1->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Código</th>
                <th scope="col" class="text-center">Nombre</th>
                <th scope="col" class="text-center">Cotizaciones</th>

            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoC1 as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["receptor"]; ?></td>
                <td class="text-center"><?= $fila["nombre"]; ?></td>
                <td class="text-center"><?= $fila["total"]; ?></td>
            </tr>

            <?php
            // Cerrar los estructuras de control
            endforeach;
            ?>

        </tbody>

    </table>
</div>

<!-- Mensaje de error si no hay resultados -->
<?php
else:
?>

<div class="alert alert-danger text-center mt-5">
    No se encontraron resultados para esta consulta
</div>

<?php
endif;

include "../includes/footer.php";
?>