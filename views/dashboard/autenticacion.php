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
    <div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-6" style="margin-top: 10%;">
            <div class="card">
                <div class="card-body">
                    <form class="row" id="form-autenticacion">
                        <div class="col-12 d-flex justify-content-center align-items-center py-4" style="flex-direction: column;">
                            <h1>Ingrese el codigo que fue enviado</h1>
                
                        </div>
                        <div class="form-group col-12 col-md-10 mt-3 offset-md-1">
                            <label for="codigo">Codigo:</label>
                            <input type="text" class="form-control" name="codigo" id="codigo"  placeholder="Ingresa aqui el codigo" required autocomplete="off">
                            <small id="email" class="form-text text-muted">Verifica tu correo electronico.</small>
                        </div>
                        <div class="col-12 col-md-10 offset-md-1">
                            <div class="row d-flex justify-content-center">
                                <button onclick="autenticacion()" type="button" class="btn btn-primary p-3">Enviar</button>
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>
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
    <script src =" ../../core/controllers/dashboard/index.js "> </script
</body>

</html>