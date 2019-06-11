<?php
require_once('../../core/helpers/commerce.php');
Commerce::headerTemplate('MerchStudio');
?>
   
   <br><br><br><br><br><br><br><br>
    <!--se crea el buscador-->
    <div class="container">
    <button type="button" class="btn btn-dark">Ver todas las sucursales</button>
    <button type="button" onclick="cargarTabla(1)" class="btn btn-dark">San Benito</button>
    <button type="button" onclick="cargarTabla(2)" class="btn btn-dark">Galerias</button>
    <button type="button" onclick="cargarTabla(3)" class="btn btn-dark">Plaza Mundo</button>
    <br>
    <br>
    <input type="search" id="buscar"> <button type="submit" class="btn btn-dark">Buscar</button>
    
    
    
  <br><br>


    <!--se crea la tabla-->
    <div class="table-responsive">
    <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Diseño</th>
      <th scope="col">Talla</th>
      <th scope="col">Precio</th>
      <th scope="col">Descripcion</th>
      <th scope="col">Imagen</th>
      <th scope="col">Sucursal</th>
      <th scope="col">Cantidad</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody id="tbody-inventario"></tbody>
</table>

  </tbody>
</table>
</div>
<br>


<br><br><br><br><br><br><br><br><br>
<?php
Commerce::footerTemplate('inventario.js');
?>