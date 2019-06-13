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

    <!-- Modal para agregar un nuevo producto -->
    <button type="button" class="btn btn-dark float-right" data-toggle="modal" data-target="#exampleModalCenter">
        Agregar
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Ingresar nuevo producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <br>
                <div class="modal-crear" class="modal">
                    <form method="post" id="form-crear" enctype="multipart/form-data">
                        <div class="row container">
                            <div class="input-field col s12 m6">
                                <input id="create_precio" type="number" name="create_precio" class="validate"
                                    max="999.99" min="0.01" step="any" required />
                                <label for="create_precio" class="float-left">Precio ($)</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input id="create_descripcion" type="text" name="create_descripcion" class="validate"
                                    required />
                                <label for="create_descripcion" class="float-left">Descripcion</label>
                            </div>

                            <div class="input-field col s12 m6">
                                <input id="create_diseno" type="text" name="create_diseno" class="validate" required />
                                <label for="create_diseno" class="float-left">Diseño</label>
                            </div>

                            <div class="input col s12 m6">
                                <select id="create_categoria" name="create_categoria">
                                </select>
                                <label class="float-left">Categoría</label>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-dark" data-tooltip="crear">Agregar</button>
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
                    <th scope="col">#</th>
                    <th scope="col">Diseño</th>
                    <th scope="col">Talla</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Sucursal</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col"></th>
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