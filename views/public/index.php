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

        <div class="card-group container">
  <div class="card">
    <img src="../../resources/img/login/login.jpg" class="card-img-top" alt="..." >
    
    
  </div>
  <div class="card">

  <form method="post" id="form-sesion" class="form-signin" autocomplete="off">
  <h1>Inicia sesion o registrate</h1>
            <div >
                <input id="alias" type="text" name="alias" class="validate form-control" required placeholder="Nombre de usuario"/>
            </div>
            <div >
                <input id="contrasena" type="password" name="contrasena" class="validate form-control" required placeholder="Contraseña" />
            </div>
            <a href="recuperarContrasena.php">
                                <p class="mt-5 text-center ">¿Olvidaste tu contraseña?</p>
                            </a>
            <div class="col s12 center-align">
                <button type="submit" class="btn btn-lg btn-dark btn-block" data-tooltip="Ingresar">Iniciar </button>
            </div>
            <br>
            <a href="registrar.php" class="btn btn-lg btn-primary btn-block">Crear una cuenta</a> 
        </form>
  
    
  </div>
  
</div>
</main>
    <footer>
    
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
    <script src =" ../../core/controllers/public/index.js"></script>
</body>

</html>