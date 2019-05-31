<?php
require_once('../../core/helpers/commerce.php');
Commerce::headerTemplate('MerchStudio');
?>
<br><br><br><br><br><br><br>
<div class="mx-auto" style="width: 430px;">
<div class="card" style="width: 20rem;">
  
<form>
  <div class="form-group container">
    <label for="exampleInputEmail1">Correo Electronico</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingrese su correo">
    <small id="emailHelp" class="form-text text-muted">Necesita un correompara iniciar sesion.</small>
  </div>
  <div class="form-group container">
    <label for="exampleInputPassword1">Contraseña</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña">
  </div>
  <div class="form-group container">
  <button type="submit" class="btn btn-dark ">Submit</button>
  </div>
</form>
</div>

<?php
Commerce::footerTemplate('inicio.js');
?>