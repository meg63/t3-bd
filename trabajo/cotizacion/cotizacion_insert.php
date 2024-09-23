<?php
 
// Crear conexión con la BD
require('../config/conexion.php');

// Sacar los datos del formulario. Cada input se identifica con su "name"
$codigo = $_POST["codigo"];
$fecha = $_POST["fecha"];
$valor = $_POST["valor"];
$receptor = $_POST["receptor"];
$verificador = $_POST["verificador"];

// Query SQL a la BD. Si tienen que hacer comprobaciones, hacerlas acá (Generar una query diferente para casos especiales)
if ($receptor == $verificador){
	echo ".<br>";
	echo "Debe ingresar un receptor diferente al verificador para poder agregar la persona.";
	echo ".<br>";
	echo "Regresar a la página anterior para realizar el cambio.";
} else {
		// Query SQL a la BD. Si tienen que hacer comprobaciones, hacerlas acá (Generar una query diferente para casos especiales)
	if ($verificador == "") {
		$query = "INSERT INTO `cotizacion`(`codigo`,`fecha`, `valor`, `receptor`, `verificador`) VALUES ('$codigo', '$fecha', '$valor', '$receptor', NULL)";
	} else {
		$query = "INSERT INTO `cotizacion`(`codigo`,`fecha`, `valor`, `receptor`, `verificador`) VALUES ('$codigo', '$fecha', '$valor', '$receptor', '$verificador')";
}

$result = mysqli_query($conn, $query) or die(mysqli_error($conn));


// Redirigir al usuario a la misma pagina
if($result):
    // Si fue exitosa, redirigirse de nuevo a la página de la entidad
	header("Location: cotizacion.php");
else:
	echo "Ha ocurrido un error al crear la persona";
endif;

mysqli_close($conn);
}