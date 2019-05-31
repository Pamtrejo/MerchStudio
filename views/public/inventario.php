
<?php
require_once('../../core/helpers/commerce.php');
Commerce::headerTemplate('MerchStudio');
?>
   
   <br><br><br><br><br><br><br><br>
    <!--se crea el buscador-->
    <div class="container">
    <input class="form-control mr-sm-2" type="search" placeholder="Buscar">
    <br>
    <!--se crea la tabla-->
    <div class="table-responsive">
    <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Diseño</th>
      <th scope="col">Talla</th>
      <th scope="col">Precio</th>
      <th scope="col">Descripcion producto </th>
      <th scope="col">Descripcion</th>
      <th scope="col">Imagen</th>
      <th scope="col">Sucursal</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>1</td>
      <td>@mdo</td>
      <td>@fat</td>
      <td>@fat</td>
      <td>@fat</td>
      <td>@fat</td>
      <td><button type="button" class="btn btn-outline-primary">Eliminar</button></td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>2</td>
      <td>@fat</td>
      <td>@fat</td>
      <td>@fat</td>
      <td>@fat</td>
      <td>@fat</td>
      <td><button type="button" class="btn btn-outline-primary">Eliminar</button></td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>3</td>
      <td>@twitter</td>
      <td>@fat</td>
      <td>@fat</td>
      <td>@fat</td>
      <td>@fat</td>
      <td><button type="button" class="btn btn-outline-primary">Eliminar</button></td>
    </tr>

    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>1</td>
      <td>@mdo</td>
      <td>@fat</td>
      <td>@fat</td>
      <td>@fat</td>
      <td>@fat</td>
      
      <td><button type="button" class="btn btn-outline-primary">Eliminar</button></td>
    </tr>
  </tbody>
</table>

  </tbody>
</table>
</div>
<br>


<br><br><br><br><br><br><br><br><br>
<?php
Commerce::footerTemplate('inicio.js');
?>