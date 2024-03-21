<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <title>CRUD con PHP, PDO, Ajax y Datatables.js</title>
</head>

<body>

    <div class="container fondo">

        <h1 class="text-center">CRUD con PHP, PDO, Ajax y Datatables.js</h1>
        <h1 class="text-center"></h1>

        <div class="row">
            <div class="col-2 offset-10">
                <div class="text-center">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#ModalUsuario" id="BotonCrear">
                        <i class="bi bi-plus-circle-fill"></i> Crear
                    </button>
                </div>
            </div>
        </div>

        <br />
        <br />

        <div class="table-responsive">
            <table id="datos_usuario" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Telefono</th>
                        <th>Email</th>
                        <th>Imagen</th>
                        <th>Fecha creación</th>
                        <th>Editar</th>
                        <th>Borrar</th>
                    </tr>
                </thead>
            </table>
        </div>



        <!-- Modal de Edición -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Editar Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulario de Edición -->
                        <form id="editForm" method="POST" id="formulario" enctype="multipart/form-data">
                            <input type="hidden" id="editUserId" name="editUserId">
                            <div class="mb-3">
                                <label for="editNombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="editNombre" name="editNombre">
                            </div>
                            <div class="mb-3">
                                <label for="editApellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="editApellidos" name="editApellidos">
                            </div>
                            <div class="mb-3">
                                <label for="editTelefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="editTelefono" name="editTelefono">
                            </div>
                            <div class="mb-3">
                                <label for="editEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="editEmail" name="editEmail">
                            </div>
                            <!-- Puedes añadir más campos aquí si es necesario -->
                            <button type="submit" class="btn btn-primary" id="btnGuardar">Guardar cambios</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="ModalUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Crear ususario</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="formulario" enctype="multipart/form-data" action="crear.php">
                            <div class="model-content">
                                <div class="modal-body">

                                    <label for="nombre">Ingrese el nombre</label>
                                    <input type="text" name="nombre" id="nombre" class="form-control">
                                    <br />

                                    <label for="apellidos">Ingrese los apellidos</label>
                                    <input type="text" name="apellidos" id="apellidos" class="form-control">
                                    <br />

                                    <label for="telefono">Ingrese el Teléfono</label>
                                    <input type="text" name="telefono" id="telefono" class="form-control">
                                    <br />

                                    <label for="email">Ingrese el email</label>
                                    <input type="email" name="email" id="email" class="form-control">
                                    <br />

                                    <label for="imagen_usuario">Seleccionar imagen</label>
                                    <input type="file" name="imagen_usuario" id="imagen_usuario" class="form-control">
                                    <br />

                                </div>

                                <div class="modal-footer">
                                    <input type="hidden" name="id_usuario" id="id_usuario">
                                    <input type="hidden" name="operacion" id="operacion">
                                    <input type="submit" name="action" id="action" class="btn btn-success" value="crear">
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

        <script type="text/javascript">
            let id = 0
            $(document).ready(function() {
                let alertaMostrada = false;
                $('#datos_usuario').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "obtener_registros.php",
                        "type": "POST"
                    },
                    "columns": [{
                            "render": function(data, type, full, meta) {
                                return meta.row + 1; // Esto asigna el número de fila como ID
                            }
                        },
                        {
                            "data": "nombre"
                        },
                        {
                            "data": "apellidos"
                        },
                        {
                            "data": "telefono"
                        },
                        {
                            "data": "email"
                        },
                        {
                            "data": "imagen",
                            "render": function(data, type, full, meta) {
                                if (data) {
                                    return '<img src="' + data + '" alt="Imagen de usuario" style="max-width: 100px;" class="imagen-valida">';
                                } else {
                                    return '';
                                }
                            }
                        },
                        {
                            "data": "fecha_creacion"
                        },
                        // Puedes agregar más columnas aquí según tu estructura de datos

                        {
                            "data": "id", // Utilizamos el ID para el botón de editar también
                            "render": function(data, type, full, meta) {
                                return "<button class='btn btn-primary btn-editar' data-id='" +
                                    data + "'>Editar</button>";
                            }
                        },
                        {
                            "data": "id",
                            "render": function(data, type, full, meta) {
                                return "<button class='btn btn-danger btn-borrar' data-id='" +
                                    data + "'>Borrar</button>";
                            }
                        }

                    ],
                    "drawCallback": function(settings) {
                        // Añadir validación de imagen en cada fila de la tabla
                        if (!alertaMostrada) { // Verificar si la alerta aún no se ha mostrado
                            $('#datos_usuario tbody tr').each(function() {
                                let imagen = $(this).find('td:eq(5)').html(); // Obtener el contenido HTML de la celda de imagen
                                if (imagen.includes('<img')) { // Verificar si la celda contiene una etiqueta de imagen
                                    let src = $(imagen).attr('src'); // Obtener la ruta de la imagen
                                    let extension = src.split('.').pop().toLowerCase(); // Obtener la extensión del archivo

                                    // Verificar si la extensión es válida
                                    if (['gif', 'png', 'jpg', 'jpeg'].indexOf(extension) === -1) {
                                        alert("Formato de imagen inválido en la fila: " + src);
                                        alertaMostrada = true; // Establecer la variable como true para indicar que la alerta se ha mostrado
                                    }
                                }
                            });
                        }
                    }
                });
            });


            $(document).on('click', '.btn-borrar', function() {
                let id = $(this).data('id');
                alert(id);

                if (confirm('¿Estás seguro de que deseas borrar este registro?')) {
                    $.post('borrar.php', {
                        id: id
                    }, function(data) {
                        // Recargar la tabla después de borrar el registro
                        $('#datos_usuario').DataTable().ajax.reload();
                    });
                }
            });

            // Agregar evento de clic para el botón de editar


            // Modificar la función para abrir el modal de edición
            function openEditForm(id) {
                $.ajax({
                    url: 'obtener_usuario.php',
                    method: 'GET',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        let usuario = JSON.parse(response);
                        if (usuario) {
                            // Asignar valores a los campos del formulario en el modal de edición
                            $('#editUserId').val(usuario.id);
                            $('#editNombre').val(usuario.nombre);
                            $('#editApellidos').val(usuario.apellidos);
                            $('#editTelefono').val(usuario.telefono);
                            $('#editEmail').val(usuario.email);
                            // Mostrar el modal de edición
                            $('#editModal').modal('show');
                        } else {
                            alert('No se encontraron datos para el usuario con el ID proporcionado.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText); // Muestra el mensaje de error completo en la consola
                        alert('Error al obtener los datos del usuario. Por favor, revisa la consola para más detalles.');
                    }
                });
            }

            // Agregar evento de clic para el botón de editar
            $(document).on('click', '.btn-editar', function() {
                let id = $(this).data('id');
                openEditForm(id);
            });

            $('#editForm').on('submit', function(event) {
                event.preventDefault(); // Prevenir el comportamiento por defecto del formulario

                // Obtener los datos del formulario de edición
                let formData = $(this).serialize();

                // Enviar los datos al servidor
                $.ajax({
                    url: 'editar.php',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        let data = JSON.parse(response);
                        if (data.success) {
                            // Si la edición fue exitosa, cerrar el modal de edición y recargar la página
                            $('#editModal').modal('hide');
                            location.reload();
                        } else {
                            // Si hubo un error, mostrar un mensaje de error
                            alert('Error al editar el usuario. Por favor, inténtalo de nuevo.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Error al editar el usuario. Por favor, revisa la consola para más detalles.');
                    }
                });
            });
        </script>


</body>

</html>