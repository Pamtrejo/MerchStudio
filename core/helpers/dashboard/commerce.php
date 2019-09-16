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
            <nav class="navbar navbar-dark fixed-top black flex-md-nowrap p-0 shadow">
          <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#"><img src="../../resources/img/logo2.png" alt="" width="10px"  class="container"> </a>
          <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
          <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
              <a class="nav-link" href="#">SALIR</a>
            </li>
          </ul>
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
                    <a class="nav-link" href="#">
                      <span data-feather="shopping-cart"></span>
                      Sucursales
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">
                      <span data-feather="user"></span>
                      Vendedores
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">
                      <span data-feather="users"></span>
                      Usuarios
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">
                      <span data-feather="user"></span>
                      Cliente
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">
                      <span data-feather="layers"></span>
                      Tallas  
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">
                      <span data-feather="users"></span>
                      Roles  
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">
                      <span data-feather="layers"></span>
                      Categoria  
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">
                      <span data-feather="layers"></span>
                      Estadistica  
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
        <script src =" ../../resources/js/feather.min.js "> </script>
        <script>feather.replace()</script>
        <script src="../../core/controllers/public/'.$controller.'"></script>
        </body>
</html>
		');
	
    }

}
?>