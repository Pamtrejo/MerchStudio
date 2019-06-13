<?php
require_once('../../core/helpers/commerce.php');
Commerce::headerTemplate('MerchStudio');
?>
<br><br><br><br><br><br>
<div class="mx-auto" style="width: 200px;">
    <h4 class="center letra">ACCEDER</h4>
</div>
<!-- En esta parte estan los botones para acceder, el de registrarse e iniciar sesion -->
<div class="mx-auto" style="width: 200px;">
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active letrita " id="home-tab" data-toggle="tab" href="#crear" role="tab" aria-controls="home"
            aria-selected="true">REGISTRAR</a>
    </li>
    <li class="nav-item">
        <a class="nav-link letrita" id="profile-tab" data-toggle="tab" href="#iniciar" role="tab" aria-controls="profile"
            aria-selected="false">INICIAR</a>
    </li>

</ul>
</div>

<!-- En esta parte se pone el contenido de cada uno de ellos -->

<div class="tab-content">
    <!--Para registrar -->
    <div class="tab-pane active" id="crear" role="tabpanel" aria-labelledby="home-tab">
    <div class="container">
            <div class="row">
                <div class="col">
                    <img src="../../resources/img/register.jpg" class="img-fluid" alt="Responsive image" width="500px">
                </div>

                <div class="col">
                    <form class="needs-validation" novalidate>
                        <div class="col-md-6 mb-3">
                            <label for="">Nombre</label>
                            <input type="text" class="form-control" id="" placeholder="" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="">Apellido</label>
                            <input type="text" class="form-control" id="" placeholder="" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="">Nombre usuario</label>
                            <input type="text" class="form-control" id="" placeholder="" required>
                        </div>

                        <div class="input col-md-6 mb-3">
                                <label class="float-left">Rol</label>
                                <select id="create_rol" name="create_rol">
                                </select>                               
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="">Correo electronico</label>
                            <input type="text" class="form-control" id="" placeholder="" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="validationCustom03">Contraseña</label>
                            <label for="inputPassword2" class="sr-only">Contraseña</label>
                            <input type="password" class="form-control" id="inputPassword2" placeholder="">
                        </div>

                        <div class="col-auto my-1">
                        <a class="nav-link active text-dark"  href="#"><i class="fas fa-location-arrow fa-lg"></i>   </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
      <!--Para iniciar sesion -->
    <div class="tab-pane" id="iniciar" role="tabpanel" aria-labelledby="profile-tab">
    <div class="container">
            <div class="row">
                <div class="col">
                    <img src="../../resources/img/register.jpg" class="img-fluid" alt="Responsive image" width="500px">
                </div>

                <div class="col">
                    <form class="needs-validation" novalidate>                       
                        <div class="col-md-6 mb-3">
                            <label for="">Nombre usuario</label>
                            <input type="text" class="form-control" id="" placeholder="" required>
                        </div>

                        
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom03">Contraseña</label>
                            <label for="inputPassword2" class="sr-only">Contraseña</label>
                            <input type="password" class="form-control" id="inputPassword2" placeholder="">
                        </div>

                        <div class="col-auto my-1">
                            <button type="submit" class="btn btn-dark">Iniciar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




<br>

<?php
Commerce::footerTemplate('inicio.js');
?>