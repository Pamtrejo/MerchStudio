<?php
require_once('../../core/helpers/commerce.php');
Commerce::headerTemplate('MerchStudio');
?>

    <br><br><br><br><br><br>
    <div class="row  bg- white ">
        <div class="mx-auto" style="width: 390px;">
            <p class="text-dark letra">Encuentranos</p>
        </div>
    </div>
    <br><br><br>

    <div class="container">
        <div class="row">
            <div class="col letrita">
                GALERIAS <br>
                Col. San Benito, Av. La Revolución,<br>
                #159A San Salvador, San Benito <br>
                Centro comercial Galerias<br><br>
                2550 5300
            </div>
            <div class="col letrita">
                ZONA ROSA<br>
                Col. San Benito, Av. La Revolución, <br>
                #159A San Salvador, San Benito <br> <br>
                2563 0852
            </div>
            <div class="col letrita">
                PLAZA MUNDO <br>
                Plaza Mundo, CA 1W, <br>
                San Salvador <br><br>
                25002500

            </div>
        </div>
    </div>

    <br><br><br><br><br><br>

    <div class="row  bg-white ">
        <div class="mx-auto" style="width: 300px;">
            <p class="text-dark letrita">Contactate con nosotros</p>
        </div>
    </div>

    <!--se crea el fomrulario para enviar mensajes o recomendaciones-->
    <form class="container">
        <div class="form-group">
            <label for="exampleInputEmail1">Correo Electronico</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                placeholder="Ingrese correo electronico">

        </div>

        <div class="mb-3">
            <label for="validationTextarea"></label>
            <textarea class="form-control " id="validationTextarea"
                placeholder="Escribenos para conctatarnos"></textarea>


        </div>
        </div>

        </div>

        <button type="submit" class="btn btn-dark">Enviar</button>


    </form> <br><br><br>
    <img src="../../resources/img/mapa.png" class="img-fluid rounded " alt="Responsive image" width="2000"
        height="1000">
   

    <?php
Commerce::footerTemplate('inicio.js');
?>