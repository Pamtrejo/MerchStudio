<?php
require_once('../../core/helpers/dashboard/commerce.php');
Commerce::headerTemplate('MerchStudio');
?>

    <div class="container-fluid"> 
        <a href=""><img src="" id="imagen" width="500"></a>
        <a href=""><img src="" id="imagen2"></a>
    </div>

    <div class="container row bg-white" >
        
            <div class="mx-auto" style="width: 430px;">
                <p class="text-dark letra">Crea tu propio diseño</p>
            </div> 
    </div>

    <div class="row ">
            <div class="col s-12 md-8 l-4">  
                <div>
                    <img src="../../resources/img/parte1.1.jpg" class="img-fluid" alt="Responsive image" width="400" height="60">
                </div>
            </div>

            <div class="col s-12 md-8 l-4">  
                <div>
                    <img src="../../resources/img/parte2.jpg" class="img-fluid" alt="Responsive image" width="400" height="60">
                </div>
            </div>

            <div class="col s-12 md-8 l-4">  
                <div>
                    <img src="../../resources/img/parte2.5.jpg" class="img-fluid" alt="Responsive image" width="400" height="60">
                </div>
            </div>
        </div>
        <br>





<?php
Commerce::footerTemplate('inicio.js');
?>
