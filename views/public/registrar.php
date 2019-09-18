<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../../resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../resources/css/all.css">
    <link href="../../resources/css/fuente.css" rel="stylesheet">
    <title>Merch Studio</title>
    <script src="https://www.google.com/recaptcha/api.js?render=6Leja7UUAAAAANNYm7YxNV2UxykCDIv_OnGwuqpB"></script>
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
    <img src="../../resources/img/login/register.jpg" class="card-img-top" alt="..." >
    
    
  </div>
  <div class="card">
  <form class="container" id="form-registrar" autocomplete="off">
      <h1 class="container">Registrate</h1>
      <br><br>
            <div class="form-group row">
                <div class="form-group col-md-6">
                <span data-feather="user"></span>
                    <input id="nombres" type="text" name="nombres" class="validate form-control" required placeholder="Nombre">
                </div>
                <div class="form-group col-md-6">
                <span data-feather="user"></span>
                    <input id="usuario" type="text" name="usuario" class="validate form-control" required placeholder="Nombre Usuario">
                </div>
                <div class="form-group col-md-6">
                <span data-feather="mail"></span>
                    <input id="correo" type="email" name="correo" class="validate form-control" required placeholder="Correo electronico">
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
                <input id="token" name="token" type="hidden"/>
            </div>
            <button type="submit" class="btn btn-dark">Enviar</button>
        </form>
    
  </div>
  
</div>
<br><br>
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
    <script src =" ../../resources/js/feather.min.js "> </script>
    <script src =" ../../core/controllers/public/registrar.js "> </script>
    <script>feather.replace()</script>
    
</body>
</html>