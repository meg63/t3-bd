<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">COTIZACION <br> Entidad análoga a REPARACIÓN</h1>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <form action="cotizacion_insert.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="codigo" class="form-label">Código</label>
            <input type="number" class="form-control" id="codigo" name="codigo" required>
        </div>

        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" class="form-control" id="fecha" name="fecha" required>
        </div>

        <div class="mb-3">
            <label for="valor" class="form-label">Valor</label>
            <input type="number" class="form-control" id="valor" name="valor" required>
        </div>

        <div class="mb-3">
            <label for="verificador" class="form-label">Verificador</label>
            <select name="verificador" id="verificador" class="form-select">
                
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
        
        <!-- Consultar la lista de clientes y desplegarlos -->
        <div class="mb-3">
            <label for="receptor" class="form-label">Receptor</label>
            <select name="receptor" id="receptor" class="form-select">
                
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

        

        <button type="submit" class="btn btn-primary">Agregar</button>

    </form>
    
</div>

<?php
// Importar el código del otro archivo
require("cotizacion_select.php");
            
// Verificar si llegan datos
if($resultadoCotizacion and $resultadoCotizacion->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Código</th>
                <th scope="col" class="text-center">Fecha</th>
                <th scope="col" class="text-center">Valor</th>
                <th scope="col" class="text-center">Verificador</th>
                <th scope="col" class="text-center">Receptor</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoCotizacion as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["codigo"]; ?></td>
                <td class="text-center"><?= $fila["fecha"]; ?></td>
                <td class="text-center">$<?= $fila["valor"]; ?></td>
                <td class="text-center">Código Patrocinador: <?= $fila["verificador"]; ?></td>
                <td class="text-center">Código Patrocinador: <?= $fila["receptor"]; ?></td>
                
                <!-- Botón de eliminar. Debe de incluir la CP de la entidad para identificarla -->
                <td class="text-center">
                    <form action="cotizacion_delete.php" method="post">
                        <input hidden type="text" name="codigoEliminar" value="<?= $fila["codigo"]; ?>">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>

            </tr>

            <?php
            // Cerrar los estructuras de control
            endforeach;
            ?>

        </tbody>

    </table>
</div>

<?php
endif;

include "../includes/footer.php";
?>