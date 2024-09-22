<?php
 
// Crear conexión con la BD
require('../config/conexion.php');

// Sacar los datos del formulario. Cada input se identifica con su "name"
$codigo = $_POST["codigo"];
$nombre = $_POST["nombre"];
$patrocinio = $_POST["patrocinio"];
$departamento = $_POST["departamento"];

// Query SQL a la BD. Si tienen que hacer comprobaciones, hacerlas acá (Generar una query diferente para casos especiales)
$query = "INSERT INTO `patrocinador`(`codigo`,`nombre`, `patrocinio`, `departamento`) VALUES ('$codigo', '$nombre', '$patrocinio', '$departamento')";

// Ejecutar consulta
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

// Redirigir al usuario a la misma pagina
if($result):
    // Si fue exitosa, redirigirse de nuevo a la página de la entidad
	header("Location: patrocinador.php");
else:
	echo "Ha ocurrido un error al crear la persona";
endif;

mysqli_close($conn);