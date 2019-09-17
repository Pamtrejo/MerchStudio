<?php
class Commerce
{
	public static function headerTemplate($title)
	{
		ini_set('date.timezone', 'America/El_Salvador');
		print('
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <link rel="stylesheet" href="../../resources/css/bootstrap.min.css">
                <link rel="stylesheet" href="../../resources/css/all.css">
                <link href="../../resources/css/fuente.css" rel="stylesheet">
                <link href="../../resources/css/dashboard.css" rel="stylesheet">
                <title>Dashboard MerchStudio</title>
                
            </head>
            
            <body>
            <header>
            <nav class="navbar  fixed-top  " style="background-image: linear-gradient(to right, #000000 0%, #000000 0%, #000000 0%, #151515 33%, #A4A4A4 66%, #000000 100%);>
          <a class="navbar-brand container" href="#"> <img src="../../resources/img/logo.png" alt="" width="120"</a>  
        </nav>
        
        <div class="container-fluid">
          <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
              <div class="sidebar-sticky">
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <a class="nav-link active" href="#">
                    <i data-feather="home"></i>
                      Dashboard <span class="sr-only">(current)</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="inventario.php">
                      <span data-feather="file-text"></span>
                      Inventario
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="sucursal.php">
                      <span data-feather="shopping-cart"></span>
                      Sucursales
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="vendedor.php">
                      <span data-feather="user"></span>
                      Vendedores
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="usuarios.php">
                      <span data-feather="users"></span>
                      Usuarios
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="cliente.php">
                      <span data-feather="user"></span>
                      Cliente
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="tallas.php">
                      <span data-feather="layers"></span>
                      Tallas  
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="roles.php">
                      <span data-feather="users"></span>
                      Roles  
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="categoria.php">
                      <span data-feather="layers"></span>
                      Categoria  
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="graficos.php">
                      <span data-feather="layers"></span>
                      Estadistica  
                    </a>
                  </li>
                  <li class="nav-item">
                  
                    <a class="nav-link" onclick="signOff()" href="#">
                      <span data-feather="log-out"></span>
                      Cerrar sesión
                    </a>
                  </li>

                 
                </ul>
            </nav>
            </header>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
		');

	}

	public static function footerTemplate($controller)
	{
		print('
		</main>
  
        <script src="../../libraries/jquery-3.2.1.min.js"></script>
        <script src="../../resources/js/popper.min.js"></script>
        <script src="../../resources/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
        <script src="../../core/helpers/functions.js"></script>
        <script src="../../core/controllers/dashboard/logout.js"></script>
        <script src =" ../../resources/js/feather.min.js "> </script>
        <script>feather.replace()</script>
        <script src="../../core/controllers/dashboard/'.$controller.'"></script>
        </body>
</html>
		');
	
    }

}
?>