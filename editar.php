<?php
include('conexion.php');

// Verificar si se recibieron datos del formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id = $_POST['editUserId'];
    $nombre = $_POST['editNombre'];
    $apellidos = $_POST['editApellidos'];
    $telefono = $_POST['editTelefono'];
    $email = $_POST['editEmail'];

    // Preparar y ejecutar la consulta para actualizar los datos del usuario
    $consulta = "UPDATE usuarios SET nombre = :nombre, apellidos = :apellidos, telefono = :telefono, email = :email WHERE id = :id";
    $statement = $conexion->prepare($consulta);
    $statement->bindParam(':nombre', $nombre);
    $statement->bindParam(':apellidos', $apellidos);
    $statement->bindParam(':telefono', $telefono);
    $statement->bindParam(':email', $email);
    $statement->bindParam(':id', $id);

    if ($statement->execute()) {
        // Si la actualización es exitosa, devolver una respuesta con éxito
        echo json_encode(array('success' => true));
    } else {
        // Si la actualización falla, devolver una respuesta con error
        http_response_code(500);
        echo json_encode(array('error' => 'Error al actualizar los datos del usuario.'));
    }
} else {
    // Si la solicitud no es de tipo POST, devolver un código de estado 405 (Método no permitido)
    http_response_code(405);
    echo json_encode(array('error' => 'Método no permitido.'));
}
?>
