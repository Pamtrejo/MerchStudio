<?php
require_once('../../core/helpers/dashboard/commerce.php');
Commerce::headerTemplate('MerchStudio');
?>

<br><br>
<!--se crea el buscador-->
<div class="container">
    <button type="button" onclick="cargarTabla()" class="btn btn-dark">Visualizar sucursales</button>
    <br>
    <br>
    <input type="search" id="buscar"> <button type="submit" class="btn btn-dark">Buscar</button>

<!-- Modal para agregar un nuevo producto -->
<button type="button" class="btn btn-dark float-right" data-toggle="modal" data-target="#exampleModal">
        Agregar
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Ingresar nuevo producto</h5>
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

    <br><br>


    <!--se crea la tabla-->
    <div class="table-responsive">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    
                    <th scope="col">Sucursal</th>
                    <th scope="col">Direccion</th>
                    <th scope="col">Telefono</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody id="tbody-sucursal"></tbody>
        </table>

        </tbody>
        </table>
    </div>
    <br>

    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Modificar producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-update" class="modal">
                    <form method="post" id="form-update" enctype="multipart/form-data">
                    <input type="hidden" id="IdSucursal" name="IdSucursal"/>
                        <div class="row">
                            <div class="input-field col s12 m6">
                                <input id="update_sucursal" type="text" name="update_sucursal" class="validate" required />
                                <label for="update_sucursal" class="float-left">Nombre de la sucursal</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input id="update_direccion" type="text" name="update_direccion" class="validate"
                                    required />
                                <label for="update_direccion" class="float-left">Direccion</label>
                            </div>

                            <div class="input-field col s12 m6">
                                <input id="update_telefono" type="text" name="update_telefono" class="validate" required />
                                <label for="update_telefono" class="float-left">Telefono</label>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" data-tooltip="form-update">Agregar</button>
                </div>
                </form>

            </div>
        </div>
    </div>
</div>

 <!--Este es un modal para los graficos con parametros-->
 <form id="form-sucursal" method="post">
        <div class="row">
          <div class="col s12 m12">
            <canvas id="chartsucursal"></canvas>
              <select class="select" id="sucursal" name="sucursal" value="">
                  </select>
            <button type="submit" class="btn green accent-4">Generar</button>
          </div>
        </div>
      </form>


    <br><br><br><br><br><br><br><br><br>
    <?php
Commerce::footerTemplate('sucursal1.js');
?>