<!doctype html>
<html lang="en">

<head>
    <title>CRUD</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- fontawesome 5 -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <!-- datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.0/datatables.min.css" />
    <!-- styles -->
    <link rel="stylesheet" href="./assets/css/main.css">
</head>

<body>

    <div class="container bg-container my-2 shadow py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center text-white">
                    <h3>CRUD CON PHP, PDO, DATATABLES Y AJAX</h1>
                        <h4>Andrés Garcia &copy;2021
                    </h3>
                </div>
                <!-- Button trigger modal -->
                <div class="d-flex justify-content-end">
                    <button id="btn_create" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modelUser">
                        Añadir <i class="fas fa-plus-circle"></i>
                    </button>
                </div>

                <div class="table-responsive  bg-light p-2 mt-2">
                    <table class="table table-striped table-bordered" id="data_user">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Teléfono</th>
                                <th>Correo</th>
                                <th>Imagen</th>
                                <th>Fecha de creación</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modelUser" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crear usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formUser" enctype="multipart/form-data">
                        <div class="modal-content p-2">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre:</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="last_name" class="form-label">Apellido:</label>
                                <input type="text" name="last_name" id="last_name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Teléfono:</label>
                                <input type="number" name="phone" id="phone" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo:</label>
                                <input type="email" name="email" id="email" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Imagen:</label>
                                <input type="file" name="image" accept="image/*" id="image" class="form-control">
                            </div>
                            <span id="load_image">

                            </span>
                        </div>
                 
                        <div class="d-flex justify-content-between mt-2">
                            <input type="hidden" name="operation" id="operation">
                            <input type="hidden" name="id_user" id="id_user">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closeModal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" >Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.0/datatables.min.js"></script>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <!-- script site -->
    <script src="./assets/js/main.js"></script>
</body>

</html>