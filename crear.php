<?php

include('conexion.php');
include('funciones.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];

    // Verificar si se ha seleccionado una imagen
    $imagen = '';
    if ($_FILES["imagen_usuario"]["error"] == 0) {
        if ($_FILES["imagen_usuario"]["name"]) {
            $imagen = subir_imagenes();
            if ($imagen === false) {
                // Manejar el error de carga de imagen
                echo "Error al subir la imagen.";
                exit();
            }
        }
    }

    // Preparar la consulta SQL
    $sql = "INSERT INTO usuarios (nombre, apellidos, imagen, telefono, email) VALUES (:nombre, :apellidos, :imagen, :telefono, :email)";
    $stmt = $conexion->prepare($sql);

    // Vincular parámetros
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellidos', $apellidos);
    $stmt->bindParam(':imagen', $imagen); // Usar la variable $imagen directamente
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':email', $email);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error al insertar el registro.";
    }
} else {
    header("Location: index.php");
    exit();
}


?>




// include("conexion.php");
// include("funciones.php");

// if ($_POST["operacion"] == "crear") {
//     $imagen = '';
//     if ($_FILES["image_usuario"]["name"] != '') {
//         $imagen = subir_imagenes();
//     }

//     $smt = $conexion->prepare("INSERT INTO usuarios (nombre, apellidos, imagen, telefono, email)VALUES(:nombre, :apellidos, :imagen, :telefono, :email)");
    
//     $resultado = $smt->execute(
//         array(
//             ':nombre'  => $_POST["nombre"],
//             ':apellidos'  => $_POST["apellidos"],
//             ':telefono'  => $_POST["telefono"],
//             ':email'  => $_POST["email"],
//             ':nombre'  => $imagen
//         )
//         );

//         if (empty($resultado)){
//             echo 'registro creado';
//         }
// }




$(document).ready(function() {
    $(document).on('click', '.btn-borrar', function() {
        var id = $(this).data('id');
        if (confirm('¿Estás seguro de que deseas borrar este registro?')) {
            $.post('borrar.php', {id: id}, function(data) {
                // Recargar la tabla después de borrar el registro
                $('#datos_usuario').DataTable().ajax.reload();
            });
        }
    });
});
