<?php
include('conexion.php');

if (isset($_GET['id'])) {
    $id_usuario = $_GET['id'];

    // Preparar y ejecutar la consulta para obtener los datos del usuario
    $consulta = "SELECT * FROM usuarios WHERE id = :id";
    $statement = $conexion->prepare($consulta);
    $statement->bindParam(':id', $id_usuario);
    $statement->execute();

    // Obtener los datos del usuario como un array asociativo
    $usuario = $statement->fetch(PDO::FETCH_ASSOC);

    // Verificar si se encontraron datos para el usuario
    if ($usuario) {
        // Devolver los datos del usuario en formato JSON
        echo json_encode($usuario);
    } else {
        // Si no se encontraron datos para el usuario, devolver un código de estado 404 (No encontrado)
        http_response_code(404);
        echo json_encode(array('error' => 'No se encontraron datos para el usuario con el ID proporcionado.'));
    }
} else {
    // Si no se proporciona un ID de usuario, devolver un código de estado 400 (Solicitud incorrecta)
    http_response_code(400);
    echo json_encode(array('error' => 'No se proporcionó un ID de usuario.'));
}
?>
