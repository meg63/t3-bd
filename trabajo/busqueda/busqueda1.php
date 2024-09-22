<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Búsqueda 1</h1>

<p class="mt-3">
    ANÁLOGA: La cédula de un mecánico y un rango de fechas (es decir, dos fechas f1 y f2
    (cada fecha con día, mes y año) y f2 >= f1). Se debe mostrar el total recaudado por el
    mecánico a raíz de las reparaciones que él revisó junto con el nombre del mecánico.
    <br>
    Nuestro caso:
    El código de un patrocinador y un rango de fechas (es decir, dos fechas f1 y f2
    (cada fecha con día, mes y año) y f2 >= f1). Se debe mostrar el total cotizado por el
    patrocinador a raíz de las cotizaciones que él verificó junto con el nombre del patrocinador.
</p>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <!-- En esta caso, el Action va a esta mismo archivo -->
    <form action="busqueda1.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="fecha1" class="form-label">Fecha 1</label>
            <input type="date" class="form-control" id="fecha1" name="fecha1" required>
        </div>

        <div class="mb-3">
            <label for="fecha2" class="form-label">Fecha 2, Debe ser mayor o igual a la Fecha 1</label>
            <input type="date" class="form-control" id="fecha2" name="fecha2" required>
        </div>

        <div class="mb-3">
            <label for="verificador" class="form-label">Código Patrocinador</label>
            <select name="verificador" id="verificador" class="form-select" required>
                
                <!-- Option por defecto -->
                <option value="" selected disabled hidden></option>

                <?php
                // Importar el código del otro archivo
                require("../patrocinador/patrocinador_select.php");
                
                // Verificar si llegan datos
                if($resultadoPatrocinador):
                    
                    // Iterar sobre los registros que llegaron
                    foreach ($resultadoPatrocinador as $fila):
                ?>

                <!-- Opción que se genera -->
                <option value="<?= $fila["codigo"]; ?>">Codigo Patrocinador: <?= $fila["codigo"]; ?> - Nombre Patrocinador: <?= $fila["nombre"]; ?></option>

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

    $fecha1 = $_POST["fecha1"];
    $fecha2 = $_POST["fecha2"];
    $codigo = $_POST["verificador"];
    $resultadoB1 = null;
    
    if ($fecha1<=$fecha2) {
        // Query SQL a la BD -> Crearla acá (No está completada, cambiarla a su contexto y a su analogía)
        $query = "SELECT nombre, total FROM (SELECT verificador, SUM(valor) as total FROM cotizacion WHERE fecha >= '$fecha1'
        and fecha <= '$fecha2' and verificador = $codigo GROUP BY verificador) as tabla 
        INNER JOIN patrocinador ON patrocinador.codigo = tabla.verificador;";

        // Ejecutar la consulta
        $resultadoB1 = mysqli_query($conn, $query) or die(mysqli_error($conn));

        mysqli_close($conn);
        
    } else {
        echo ".<br>";
        echo 'La fecha 2 debe ser mayor a la fecha 1 para poder realizar la búsqueda.';
    }

    // Verificar si llegan datos
    if($resultadoB1 and $resultadoB1->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Nombre Patrocinador</th>
                <th scope="col" class="text-center">Total Suma</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoB1 as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
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
endif;

include "../includes/footer.php";
?>