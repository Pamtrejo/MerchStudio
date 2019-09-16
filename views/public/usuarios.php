<?php
require_once('../../core/helpers/commerce.php');
Commerce::headerTemplate('MerchStudio');
?>
   
   <br><br><br><br><br><br><br><br>
   
    <div class="container">
    <!--se crea el buscador-->
    <div class="container">
    <button type="button" onclick="cargarTabla()" class="btn btn-dark">Visualizar usuarios</button>
    <br>
    <br>
    <input type="search" id="buscar"> <button type="submit" class="btn btn-dark">Buscar</button>
    <a href="../../core/reportes/rol1.php" target="_blank" class="btn btn-dark pink">Reporte</a>
    <a href="../../core/reportes/ventasDia1.php" target="_blank" class="btn btn-dark pink">Reporte</a>


    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-create">
    Agregar Usuario nuevo
    </button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Ingresar nuevo usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-crear" class="modal">
                    <form method="post" id="form-crear" enctype="multipart/form-data">
                        <div class="row">
                            <div class="input-field col s12 m6">
                                <input id="create_sucursal" type="text" name="create_sucursal" class="validate" required />
                                <label for="create_sucursal" class="float-left">Nombre de la sucursal</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input id="create_direccion" type="text" name="create_direccion" class="validate"
                                    required />
                                <label for="create_direccion" class="float-left">Direccion</label>
                            </div>

                            <div class="input-field col s12 m6">
                                <input id="create_telefono" type="text" name="create_telefono" class="validate" required />
                                <label for="create_telefono" class="float-left">Telefono</label>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" data-tooltip="form-crear">Agregar</button>
                </div>
                </form>

            </div>
        </div>
    </div>


    <!--se crea la tabla-->
    <div class="table-responsive">
    <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Rol</th>
      <th scope="col">Nombre</th>
      <th scope="col">Apellido</th>
      <th scope="col">Nombre de Usuario</th>
      <th scope="col"> Correo</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody id="tbody-usuario"></tbody>
</table>

  </tbody>
</table>
</div>
<br>


<br><br><br><br><br><br><br><br><br>
<?php
Commerce::footerTemplate('usuarios.js');
?>