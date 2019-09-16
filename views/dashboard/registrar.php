<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../../resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../resources/css/all.css">
    <link href="../../resources/css/fuente.css" rel="stylesheet">
    <title>Merch Studio</title>
</head>

<body>
    <!--se crea el navbar-->
    <header>
        <nav class="navbar navbar-expand-lg  contenido">
            <div class="mx-auto video" id="video" style="width:300px;">
                <video src="../../resources/img/merch.mp4" autoplay loop muted width="200"></video>
            </div>
        </nav>
    </header>
    <main>
        <br><br>
        <form class="container" id="form-registrar" autocomplete="off">
            <div class="form-group row">
                <div class="form-group col-md-6">
                <span data-feather="user"></span>
                    <input id="nombres" type="text" name="nombres" class="validate form-control" required placeholder="Nombres">
                </div>
                <div class="form-group col-md-6">
                <span data-feather="user"></span>
                    <input id="apellidos" type="text" name="apellidos" class="validate form-control" required placeholder="Apellidos">
                </div>
                <div class="form-group col-md-6">
                <span data-feather="mail"></span>
                    <input id="correo" type="email" name="correo" class="validate form-control" required placeholder="Email">
                </div>
                <div class="form-group col-md-6">
                <span data-feather="user"></span>
                    <input id="usuario" type="text" name="usuario" class="validate form-control" required  placeholder="Nombre Usuario">
                </div>
                <div class="form-group col-md-6">
                <span data-feather="calendar"></span>
                    <input id="fecha" type="date" name="fecha" class="validate form-control" required placeholder="Fecha de Creacion">
                </div>
                <div class="form-group col-md-6">
                <span data-feather="key"></span>
                    <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Contraseña">
                </div>
                <div class="form-group col-md-6">
                <span data-feather="key"></span>
                    <input type="password" class="form-control" id="confirmar" name="confirmar" placeholder="Confirmar Contraseña">
                </div>
            </div>
            <button type="submit" class="btn btn-dark">Sign in</button>
        </form>

    </main>
    <footer>
        <div class=" bg-dark">
            <ul class="nav ">
                <li class="nav-item">
                    <div class="mx-auto" style="width: 550px;">
                        <a class="nav-link active text-white" href=""></a>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white letrita" href="crear.php"> CREA TU DISEÑO </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white letrita" href="index.php">INICIO </a>
                </li>
            </ul>
        </div>
        <div class="bg-light">
            <div class="mx-auto" style="width: 400px;">
                <p class="text-dark ">© 2019 by MPG. Proudly created with bootstrap</p>
            </div>
        </div>
    </footer>

    <script src="../../libraries/jquery-3.2.1.min.js"></script>
    <script src="../../resources/js/popper.min.js"></script>
    <script src="../../resources/js/bootstrap.min.js"></script>
    <script src="../../resources/js/all.js"></script>
    <script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
    <script src="../../core/helpers/functions.js"></script>
    <script src =" ../../resources/js/feather.min.js "> </script>
    <script src =" ../../core/controllers/dashboard/registrar.js "> </script>
    <script>feather.replace()</script>
    
</body>
</html>