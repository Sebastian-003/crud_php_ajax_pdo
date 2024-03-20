<?php
try {
    $usuario = "root";
    $password = "";
    $conexion = new PDO("mysql:host=localhost;dbname=crud_usuarios;charset=utf8mb4", $usuario, $password);
    // Configurar PDO para que lance excepciones en caso de errores
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    // Puedes elegir manejar el error de otra manera, como registrar en un archivo de registro.
}

    

