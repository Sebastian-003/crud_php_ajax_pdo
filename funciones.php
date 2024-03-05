<?php 

    function subir_imagenes() {
        if (isset($_FILES["imagen_usuario"])) {
           
            $extension = explode('.', $_FILES["imagen_usuario"]['name']);
            $nuevo_nombre = rand() . '.' . $extension[1];

            $ubicacion = './img/' . $nuevo_nombre;
            move_uploaded_file($_FILES["imagen_usuario"]['tmp_name'], $ubicacion);
            return $nuevo_nombre;  
        }
    }


    function obtener_todos_registros(){
        include('conexion.php');
        $stmt = $conexion->prepare("SELECT * FROM usuarios");
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        return $resultado;
        // var_dump($resultado);
    

    }


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






    