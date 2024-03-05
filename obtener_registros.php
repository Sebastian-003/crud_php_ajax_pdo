<?php
// Incluir archivo de conexión
include('conexion.php');

// Preparar y ejecutar consulta SQL para obtener registros
$stmt = $conexion->prepare("SELECT id, nombre, apellidos, imagen, telefono, email, fecha_creacion FROM usuarios");
$stmt->execute();

// Obtener resultados como un array asociativo
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);



// Devolver los resultados en formato JSON
echo json_encode(["data" => $resultados]);
?>
