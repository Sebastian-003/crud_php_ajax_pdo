<?php
// Incluir archivo de conexión
include('conexion.php');

// Verificar si se ha recibido un ID válido
if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = $_POST['id'];

    

    // Verificar si el registro existe
    $stmt_check = $conexion->prepare("SELECT COUNT(*) FROM usuarios WHERE id = :id");
    $stmt_check->bindParam(':id', $id);
    $stmt_check->execute();
    $count = $stmt_check->fetchColumn();

    

    if ($count > 0) {
        // El registro existe, procede con la eliminación
        // Preparar la consulta SQL para borrar el registro
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $conexion->prepare($sql);

        // Vincular parámetro
        $stmt->bindParam(':id', $id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Registro eliminado correctamente
            echo "Registro eliminado exitosamente.";
        } else {
            // Error al eliminar el registro
            $error_info = $stmt->errorInfo();
            echo "Error al eliminar el registro: " . $error_info[2];
        }
    } else {
        // El registro no existe, muestra un mensaje de error
        echo "El registro no existe.";
    }
} else {
    // Si no se recibió un ID válido, devolver un mensaje de error
    echo "ID de usuario no válido.";
}


?>



