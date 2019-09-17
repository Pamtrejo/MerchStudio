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
     <button type="button" class="btn btn-dark float-right" data-toggle="modal" data-target="#Modal5">Reporte1</button>
     <br>
     <br>
     <button type="button" class="btn btn-dark float-right" data-toggle="modal" data-target="#Modal3">Reporte2</button>
     <br>
     <br>
     <button type="button" class="btn btn-dark float-right" data-toggle="modal" data-target="#Modal4">Reporte3</button>
     <br>
     <br>
     <button type="button" class="btn btn-dark float-right" data-toggle="modal" data-target="#Modal6">Reporte4</button>
     <br>
     <br>
     <input type="search" id="buscar"> <button type="submit" class="btn btn-dark">Buscar</button>


     <!-- Modal para agregar un nuevo producto -->
     <button type="button" class="btn btn-dark float-right" data-toggle="modal" data-target="#exampleModal">
          Agregar
     </button>

     <!-- Modal -->
     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
          aria-hidden="true">
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
                                        <input id="create_sucursal" type="text" name="create_sucursal" class="validate"
                                             required />
                                        <label for="create_sucursal" class="float-left">Nombre de la sucursal</label>
                                   </div>
                                   <div class="input-field col s12 m6">
                                        <input id="create_direccion" type="text" name="create_direccion"
                                             class="validate" required />
                                        <label for="create_direccion" class="float-left">Direccion</label>
                                   </div>

                                   <div class="input-field col s12 m6">
                                        <input id="create_telefono" type="text" name="create_telefono" class="validate"
                                             required />
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

     <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
          aria-hidden="true">
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
                              <input type="hidden" id="IdSucursal" name="IdSucursal" />
                              <div class="row">
                                   <div class="input-field col s12 m6">
                                        <input id="update_sucursal" type="text" name="update_sucursal" class="validate"
                                             required />
                                        <label for="update_sucursal" class="float-left">Nombre de la sucursal</label>
                                   </div>
                                   <div class="input-field col s12 m6">
                                        <input id="update_direccion" type="text" name="update_direccion"
                                             class="validate" required />
                                        <label for="update_direccion" class="float-left">Direccion</label>
                                   </div>

                                   <div class="input-field col s12 m6">
                                        <input id="update_telefono" type="text" name="update_telefono" class="validate"
                                             required />
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

<!-- Modal del reporte-->
<div class="modal fade" id="Modal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Elegir talla</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
               </div>
               <div class="modal-crear" class="modal">
                    <form method="post" id="form-crear" enctype="multipart/form-data">
                         <div class="row">
                              <div class="input col s12 m6">
                                   <select id="talla" name="talla">
                                   </select>
                                   <label class="float-left"> Talla</label>
                              </div>
                         </div>
               </div>
               <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" onclick="reporteproductosxTalla()" class="btn btn-primary"
                         data-tooltip="form-crear">Abrir reporte</button>
               </div>
               </form>
          </div>
     </div>
</div>
<!-- Modal del reporte-->
<div class="modal fade" id="Modal5" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Seleccionar sucursal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
               </div>
               <div class="modal-crear" class="modal">
                    <form method="post" id="form-crear" enctype="multipart/form-data">
                         <div class="row">
                              <div class="input col s12 m6">
                                   <select id="sucursal" name="sucursal">
                                   </select>
                                   <label class="float-left">Sucursal</label>
                              </div>
                         </div>
               </div>
               <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" onclick="reporteSucursal()" class="btn btn-primary"
                         data-tooltip="form-crear">Abrir reporte</button>
               </div>
               </form>
          </div>
     </div>
</div>
<!-- Modal del reporte-->
<div class="modal fade" id="Modal6" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Seleccionar sucursal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
               </div>
               <div class="modal-crear" class="modal">
                    <form method="post" id="form-crear" enctype="multipart/form-data">
                         <div class="row">
                              <div class="input col s12 m6">
                                   <select id="sucursal1" name="sucursal1">
                                   </select>
                                   <label class="float-left">Sucursal</label>
                              </div>
                         </div>
               </div>
               <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" onclick="ventasxSucursal()" class="btn btn-primary"
                         data-tooltip="form-crear">Abrir reporte</button>
               </div>
               </form>
          </div>
     </div>
</div>
<!-- Modal del reporte-->
<div class="modal fade" id="Modal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Elegir el tipo de pago</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
               </div>
               <div class="modal-crear" class="modal">
                    <form method="post" id="form-crear" enctype="multipart/form-data">
                         <div class="row">
                              <div class="input col s12 m6">
                                   <select id="tipoPago" name="tipoPago">
                                   </select>
                                   <label class="float-left"> Tipo de pago</label>
                              </div>
                         </div>
               </div>
               <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" onclick="reportePagos()" class="btn btn-primary"
                         data-tooltip="form-crear">Abrir
                         reporte</button>
               </div>
               </form>
          </div>
     </div>
</div>

<!--Este es un modal para los graficos con parametros-->
<form id="form-sucursal" method="post">
     <div class="row">
          <div class="col-sm-6 offset-sm-3">
               <select class="select" id="sucursal" name="sucursal" value="">
               </select>
               <button type="submit" class="btn green accent-4">Generar</button>
               <canvas id="chartsucursal"></canvas>
          </div>
     </div>
</form>

<form id="form-categoria" method="post">
     <div class="row">
          <div class="col-sm-6 offset-sm-3">
               <select class="select" id="categoria" value="">
               </select>
               <button type="submit" class="btn green accent-4">Generar</button>
               <canvas id="chartcategoria"></canvas>
          </div>
     </div>
</form>
<br><br><br><br><br><br><br><br><br>
<?php
Commerce::footerTemplate('sucursal1.js');
?>