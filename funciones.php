<?php 
function subir_imagenes() {
    if (isset($_FILES["imagen_usuario"])) {
        $extension = explode('.', $_FILES["imagen_usuario"]['name']);
        $nuevo_nombre = rand() . '.' . $extension[1];
        $ubicacion = 'img/' . $nuevo_nombre;

        if (move_uploaded_file($_FILES["imagen_usuario"]['tmp_name'], $ubicacion)) {
            return $ubicacion;
        } else {
            return false; // Manejar el error de carga de imagen según sea necesario
        }
    }
}  

?>


    // function obtener_todos_registros(){
    //     include('conexion.php');
    //     $stmt = $conexion->prepare("SELECT * FROM usuarios");
    //     $stmt->execute();
    //     $resultado = $stmt->fetchAll();
    //     return $resultado;
    //     // var_dump($resultado);
    

    // }


//     <?php
// // Incluir archivo de conexión
// include('conexion.php');

// // Preparar y ejecutar consulta SQL para obtener registros
// $stmt = $conexion->prepare("SELECT * FROM usuarios");
// $stmt->execute();

// // Obtener resultados como un array asociativo
// $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

// // Devolver los resultados en formato JSON
// echo json_encode($resultados);
// ?>






    