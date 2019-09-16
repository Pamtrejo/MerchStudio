<?php
require_once('../../core/helpers/dashboard/commerce.php');
Commerce::headerTemplate('MerchStudio');
?>

<br><br><br><br><br><br><br><br>

<!--se crea el buscador-->
<div class="container">
    <button type="button" class="btn btn-dark">Ver todas las sucursales</button>
    <button type="button" onclick="cargarTabla(1)" class="btn btn-dark">San Benito</button>
    <button type="button" onclick="cargarTabla(2)" class="btn btn-dark">Galerias</button>
    <button type="button" onclick="cargarTabla(3)" class="btn btn-dark">Plaza Mundo</button>
    <button type="button" class="btn btn-dark float-right" data-toggle="modal" data-target="#Modal4">Reporte1</button>

    <br>
    <br>
    <input type="search" id="buscar"> <a class=" text-dark" href="#"><i class="fas fa-search fa-lg"></i></a>

    
    <!-- Boton para abrir el modal-->
    <button type="button" class="btn btn-dark float-right" data-toggle="modal" data-target="#exampleModalCenter">
        <a class=" text-white" href="#"><i class="fas fa-plus fa-lg"></i></a>
    </button>
    <br>
    <br>
    <!-- Boton para abrir el modal de agregar un producto por sucursal-->
    <button type="button" class="btn btn-dark float-right" data-toggle="modal" data-target="#exampleCenter">
        <a class=" text-white" href="#"><i class="fas fa-edit fa-lg"></i></a>
    </button>
    <!-- Modal del reporte-->
    <div class="modal fade" id="Modal4" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Elegir la categoria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-crear" class="modal">
                <form method="post" id="form-crear" enctype="multipart/form-data">
                        <div class="row">
                            <div class="input col s12 m6">
                                <select id="categoria" name="categoria">
                                </select>
                                <label class="float-left"> Categorias</label>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" onclick="reporteCategoria()" class="btn btn-primary" data-tooltip="form-crear">Abrir reporte</button>
                </div>
                </form>
        </div>
        </div>
    </div>

    
    <!-- Modal  para poder agregar un nuevo producto-->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                <input id="create_precio" type="number" name="create_precio" class="validate" max="999.99" min="0.01" step="any" required />
                                <label for="create_precio" class="float-left">Precio ($)</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input id="create_descripcion" type="text" name="create_descripcion" class="validate" required />
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

    <!-- Modal  para poder agregar un  producto por sucuarsal-->
    <div class="modal fade" id="exampleCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Ingresar producto por sucursal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <br>
                <div class="modal-producto" class="modal">
                    <form method="post" id="form-producto" enctype="multipart/form-data">
                        <div class="row container">

                            <div class="input col ">
                                <select id="create_producto" name="create_producto">
                                </select>
                                <label >Producto</label>
                            </div>

                            <div class="input col s12 m6">
                                <select id="create_talla" name="create_talla">
                                </select>
                                <label class="float-left">Talla</label>
                            </div>

                            <div class="input col s12 m6">
                                <select id="create_sucursal" name="create_sucursal">
                                </select>
                                <label class="float-left">Sucursal</label>
                            </div>

                            <div class="input-field col s12 m6">
                                <input id="create_cantidad" type="text" name="create_cantidad" class="validate" required />
                                <label for="create_cantidad" class="float-left">Cantidad</label>
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
    <!-- Modal  para modificar un  producto-->
    <div class="modal fade" id="modal-update" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Modificar producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <br>
                <div class="modal-update" class="modal">
                    <form method="post" id="form-update" enctype="multipart/form-data">
                        <div class="row container">
                            <div class="input-field col s12">
                                <input id="idProducto" type="number" name="idProducto" class="validate" max="999.99" min="0.01" step="any" required />
                                <label for="idProducto" class="float-left">Codigo</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input id="update_precio" type="text" name="update_precio" class="validate" max="999.99" min="0.01" step="any" required />
                                <label for="update_precio" class="float-left">Precio ($)</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input id="update_descripcion" type="text" name="update_descripcion" class="validate" required />
                                <label for="update_descripcion" class="float-left">Descripcion</label>
                            </div>

                            <div class="input-field col s12 m6">
                                <input id="update_diseno" type="text" name="update_diseno" class="validate" required />
                                <label for="update_diseno" class="float-left">Diseño</label>
                            </div>

                            <div class="input col s12 m6">
                                <select id="update_categoria" name="update_categoria">
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

<br>
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
                    <th scope="col">Descripcion</th>
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