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
        <h1 class="text-center">www.render2web.com</h1>

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

        <!-- Modal -->
        <div class="modal fade" id="ModalUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Crear ususario</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form method="POST" id="formulario" enctype="multipart/form-data">
                            <div class="model-content">
                                <div class="modal-body">

                                    <label for="nombre">Ingrese el nombre</label>
                                    <input type="text" name="nombre" id="nombre" class="form-control">
                                    <br />

                                    <label for="apellidos">Ingrese los apellidos</label>
                                    <input type="text" name="apellidos" id="apellidos" class="form-control">
                                    <br />

                                    <label for="telefono">Ingrese el Telefono</label>
                                    <input type="text" name="Telefono" id="Telefono" class="form-control">
                                    <br />

                                    <label for="email">Ingrese el email</label>
                                    <input type="email" name="email" id="email" class="form-control">
                                    <br />

                                    <label for="imagen">Seleccionar imagen</label>
                                    <input type="file" name="imagen_usuario" id="imagen_usuario" class="form-control">
                                    <br />

                                    <span id="imagen-subida"></span>

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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- DataTables -->
        <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

        <script type="text/javascript">
    $(document).ready(function() {
        $('#datos_usuario').DataTable({
            "processing": true,
            "serverSide": true, // Habilita el procesamiento del lado del servidor
            "ajax": {
                "url": "obtener_registros.php", // Ruta al archivo PHP que carga los datos
                "type": "POST"
            },
            "columns": [
                { "data": "id" },
                { "data": "nombres" },
                { "data": "apellidos" },
                { "data": "telefono" },
                { "data": "email" },
                { "data": "imagen" },
                { "data": "fecha_creacion" },
                // Puedes agregar más columnas aquí según tu estructura de datos
                {
                    "data": null,
                    "defaultContent": "<button class='btn btn-primary btn-editar'>Editar</button>"
                },
                {
                    "data": null,
                    "defaultContent": "<button class='btn btn-danger btn-borrar'>Borrar</button>"
                }
            ]
        });
    });

    
</script>

</body>

</html>