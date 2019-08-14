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

            <title>Merch Studio</title>
        </head>
        
        <body>
            <!--se crea el navbar-->
            <header>
        <nav class="">

        <nav class="navbar navbar-expand-lg  contenido">
        <div class="mx-auto video" id="video" style="width:300px;">
            <video src="../../resources/img/merch.mp4" autoplay loop  muted width="200"></video>
        </div>
    </nav>

            <nav class="navbar navbar-expand-lg navbar-dark bg-white" id="menu">
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto container">
                    <a class="navbar-brand " href="#"> <img src="../../resources/img/logo.png" alt=""  width="150" height="65"> </a>
                    &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
                    <br> <br>
                    <div class="container">
                        <ul class="navbar-nav container">
                        <a class="nav-link  text-dark letrita" href="factura.php">FACTURA</a>
                        <a class="nav-link text-dark letrita" href="inventario.php">INVENTARIO</a>
                        <a class="nav-link text-dark letrita" href="sucursal.php">SUCURSAL</a>
                        <a class="nav-link text-dark letrita" href="vendedor.php">VENDEDOR</a>
                        <a class="nav-link text-dark letrita" href="graficos.php">ESTADISTICAS</a>
                        </ul>
                        
                    </div>
                        
                    </ul>
                </div>

                
            </nav>
        </nav>

        
    </header>  
			<main>
		');

	}

	public static function footerTemplate($controller)
	{
		print('
		</main>
		<footer >
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
        <script src="../../resources/js/chart.js"></script>
        <script src="../../resources/js/all.js"></script>
        <script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
        <script src="../../core/helpers/functions.js"></script>
        <script src="../../core/controllers/public/'.$controller.'"></script>
        </body>

        </html>
		');
	
    }

}
?>