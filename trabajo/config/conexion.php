<?php

// Cambiar los datos de acuerdo a su base de datos
$host = "localhost";
$user = "root";
$pass = "";
$db = "bd_trabajo";

// Crear conexión
$conn = new mysqli($host, $user, $pass, $db);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error al conectar a la DB: " . $conn->connect_error);
} else {
    echo "Conexión exitosa a la base de datos";
}

// Cerrar la conexión cuando sea necesario
// $conn->close();
?>
