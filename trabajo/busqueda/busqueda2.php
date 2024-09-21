<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Búsqueda 2: Departamento</h1>

<p class="mt-3">
    ANALOGA: El código de un departamento. Se debe mostrar, para el empleado de mayor
salario adscrito a ese departamento, todos los datos de todas las reparaciones que ese
mecánico revisó (en caso de empates, usted decide cómo proceder).
    <br>
    En nuestro caso: El código de un departamento. Se debe mostrar, para el patrocinador de mayor
patrocinio adscrito a ese departamento, todos los datos de todas las cotizaciones que ese
patrocinador verifico.
</p>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <!-- En esta caso, el Action va a esta mismo archivo -->
    <form action="busqueda2.php" method="post" class="form-group">
    <div class="mb-3">
            <label for="departamento" class="form-label">Departamento</label>
            <select name="departamento" id="departamento" class="form-select">
                
                <!-- Option por defecto -->
                <option value="" selected disabled hidden></option>

                <?php
                // Importar el código del otro archivo
                require("../departamento/departamento_select.php");
                
                // Verificar si llegan datos
                if($resultadoDepartamento):
                    
                    // Iterar sobre los registros que llegaron
                    foreach ($resultadoDepartamento as $fila):
                ?>

                <!-- Opción que se genera -->
                <option value="<?= $fila["codigo"]; ?>"><?= $fila["nombre"]; ?> - codigo: <?= $fila["codigo"]; ?></option>

                <?php
                        // Cerrar los estructuras de control
                    endforeach;
                endif;
                ?>
            </select>
        </div>

       

        <button type="submit" class="btn btn-primary">Buscar</button>

    </form>
    
</div>

<?php
// Dado que el action apunta a este mismo archivo, hay que hacer eata verificación antes
if ($_SERVER['REQUEST_METHOD'] === 'POST'):

    // Crear conexión con la BD
    require('../config/conexion.php');

    $departamento = $_POST["departamento"];

    // Query SQL a la BD -> Crearla acá (No está completada, cambiarla a su contexto y a su analogía)
    $query = "SELECT *
    FROM cotizacion
    WHERE verificador IN (
      SELECT codigo
      FROM (
        SELECT codigo
        FROM patrocinador
        WHERE departamento = $departamento
        ORDER BY patrocinio DESC
        LIMIT 1
      ) AS temp
    );";

    // Ejecutar la consulta
    $resultadoB2 = mysqli_query($conn, $query) or die(mysqli_error($conn));

    mysqli_close($conn);

    // Verificar si llegan datos
    if($resultadoB2 and $resultadoB2->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Codigo</th>
                <th scope="col" class="text-center">Fecha</th>
                <th scope="col" class="text-center">Valor</th>
                <th scope="col" class="text-center">Receptor</th>
                <th scope="col" class="text-center">Verificador</th>

            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoB2 as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["codigo"]; ?></td>
                <td class="text-center"><?= $fila["fecha"]; ?></td>
                <td class="text-center">$<?= $fila["valor"]; ?></td>
                <td class="text-center">Codigo patrocinador:<?= $fila["receptor"]; ?></td>
                <td class="text-center">Codigo patrocinador:<?= $fila["verificador"]; ?></td>



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
endif;

include "../includes/footer.php";
?>