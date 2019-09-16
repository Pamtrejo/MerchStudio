<?php
require_once('../../core/helpers/dashboard/commerce.php');
Commerce::headerTemplate('MerchStudio');
?>

<br><br><br><br><br><br><br><br>
<!--se crea el buscador-->
<div class="container">
    <button type="button" onclick="cargarTabla1()" class="btn btn-dark">Visualizar vendedores</button>
    <a href="../../core/reportes/ventasVendedor1.php" target="_blank" class="btn btn-dark pink">Reporte</a>

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
                    <h5 class="modal-title" id="exampleModalCenterTitle">Ingresar nuevo vendedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-crear" class="modal">
                    <form method="post" id="form-crear" enctype="multipart/form-data">
                        <div class="row">
                            <div class="input-field col s12 m6">
                                <input id="create_nombre" type="text" name="create_nombre" class="validate" required />
                                <label for="create_nombre" class="float-left">Nombre del vendedor</label>
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
                    <th scope="col">Nombre</th>
                    <th scope="col">Telefono</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody id="tbody-vendedor"></tbody>
        

            </tbody>
        </table>
    </div>
    <br>

    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Modificar vendedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-update" class="modal">
                    <form method="post" id="form-update" enctype="multipart/form-data">
                    <input type="hidden" id="IdVendedor" name="IdVendedor"/>
                        <div class="row">
                            <div class="input-field col s12 m6">
                                <input id="update_nombre" type="text" name="update_nombre" class="validate" required />
                                <label for="update_nombre" class="float-left">Nombre del vendedor</label>
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


<form id="form-vendedor" method="post">
        <div class="row">
          <div class="col-sm-6 offset-sm-3">
            <select class="select" id="vendedor" value="">
                  </select>
            <button type="submit" class="btn green accent-4">Generar</button>
            <canvas id="chartvendedor"></canvas>
          </div>
        </div>
      </form>

    <br><br><br><br><br><br><br><br><br>
    <?php
Commerce::footerTemplate('vendedor.js');

?>