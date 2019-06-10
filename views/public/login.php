<?php
require_once('../../core/helpers/commerce.php');
Commerce::headerTemplate('MerchStudio');
?>
<br><br><br><br><br><br>
<div class="container">
<h4 class="center">ACCEDER</h4>
<ul class="tabs center-align">
		<li class="tab"><a href="#cuenta">CREAR CUENTA</a></li>
		<li class="tab"><a href="#sesion">INICIAR SESIÓN</a></li>
	</ul>
<div class="container">
  <div class="row">
    <div class="col">
      <img src="../../resources/img/register.jpg" class="img-fluid" alt="Responsive image">
    </div>

    <div class="col">
      <form class="needs-validation" novalidate>
      <div class="col-md-6 mb-3">
            <label for="validationCustom03">Nombre</label>
            <input type="text" class="form-control" id="validationCustom03" placeholder="" required>
          </div>
        
          <div class="col-md-6 mb-3">
            <label for="validationCustom03">Apellido</label>
            <input type="text" class="form-control" id="validationCustom03" placeholder="" required>
          </div>

          <div class="col-md-6 mb-3">
            <label for="validationCustom03">Nombre usuario</label>
            <input type="text" class="form-control" id="validationCustom03" placeholder="" required>
          </div>

          <div class="col-md-6 mb-3">
              <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Preference</label>
              <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                <option selected>Rol</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
          </div>

          <div class="col-md-6 mb-3">
            <label for="validationCustom03">Correo electronico</label>
            <input type="text" class="form-control" id="validationCustom03" placeholder="" required>
          </div>

          <div class="col-md-6 mb-3">
            <label for="validationCustom03">Contraseña</label>
            <label for="inputPassword2" class="sr-only">Contraseña</label>
            <input type="password" class="form-control" id="inputPassword2" placeholder="">
          </div>

          <div class="col-auto my-1">
            <button type="submit" class="btn btn-dark">Registrar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col">
      
    </div>

    <div class="col">
      <form class="needs-validation" novalidate>
          <div class="col-md-6 mb-3">
            <label for="validationCustom03">Nombre usuario</label>
            <input type="text" class="form-control" id="validationCustom03" placeholder="" required>
          </div>

          
          <div class="col-md-6 mb-3">
            <label for="validationCustom03">Contraseña</label>
            <label for="inputPassword2" class="sr-only">Contraseña</label>
            <input type="password" class="form-control" id="inputPassword2" placeholder="">
          </div>

          <div class="col-auto my-1">
            <button type="submit" class="btn btn-dark">Iniciar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</div>

<br>

<?php
Commerce::footerTemplate('inicio.js');
?>