<?php
require_once('../../core/helpers/dashboard/commerce.php');
Commerce::headerTemplate('MerchStudio');
?>
<div class="container mt-5">
    <div class="row shadow-sm p-3 mb-5 bg-secondary rounded">
        <div class="table-responsive-lg" style="width:100%">
            <h1 class="text-center  mt-4 mb-4 letra">ROLES</h1>
            <div class="row d-flex justify-content-center">
                <div class="col-6 col-md-4 text-center">

                </div>
            </div>
            <br>
            <table id="roles" class="table ">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="letrita">TIPO ROL</th>
                        <th scope="col" class="letrita"> ACCIONES</th>
                        <th scope="col" class="letrita"> </th>
                    </tr>
                </thead>
                <tbody id="tbody-read-rol"></tbody>
            </table>
            <br>

            <form method="POST" id="crear_roles">
                <div class="col-6">
                    <label for="recipient-name" class="col-form-label">Nombre Rol:</label>
                    <input type="text" id="rol" name="rol" class="form-control form-control-alternative" required
                        autocomplete="off">
                </div>
                <div class="col-6">
                    <label for="recipient-name" class="col-form-label"></label>
                    <input type="text" id="nombrerol" name="nombrerol" class="form-control form-control-alternative"
                        required autocomplete="off" readonly>
                </div>
                <br>

                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <input type="checkbox" aria-label="Checkbox for following text input" id="inventario"
                                onclick="cambiar(0, 'inventario')">
                            <label for="recipient-name" class="col-form-label">Inventario</label>
                        </div>
                        <div class="col-6">
                            <input type="checkbox" aria-label="Checkbox for following text input" id="sucursales"
                                onclick="cambiar(1, 'sucursales')">
                            <label for="recipient-name" class="col-form-label">Sucursales</label>
                        </div>
                        <div class="col-6">
                            <input type="checkbox" aria-label="Checkbox for following text input" id="vendedores"
                                onclick="cambiar(2, 'vendedores')">
                            <label for="recipient-name" class="col-form-label">Vendedores</label>
                        </div>
                        <div class="col-6">
                            <input type="checkbox" aria-label="Checkbox for following text input" id="usuarios"
                                onclick="cambiar(3, 'usuarios')">
                            <label for="recipient-name" class="col-form-label">Usuarios</label>
                        </div>

                        <div class="col-6">
                            <input type="checkbox" aria-label="Checkbox for following text input" id="clientes"
                                onclick="cambiar(4, 'clientes')">
                            <label for="recipient-name" class="col-form-label">Clientes</label>
                        </div>
                        <div class="col-6">
                            <input type="checkbox" aria-label="Checkbox for following text input" id="tallas"
                                onclick="cambiar(5, 'tallas')">
                            <label for="recipient-name" class="col-form-label">Tallas</label>
                        </div>

                        <div class="col-6">
                            <input type="checkbox" aria-label="Checkbox for following text input" id="roles1"
                                onclick="cambiar(6, 'roles1')">
                            <label for="recipient-name" class="col-form-label">Roles</label>
                        </div>
                        <div class="col-6">
                            <input type="checkbox" aria-label="Checkbox for following text input" id="categorias"
                                onclick="cambiar(7, 'categorias')">
                            <label for="recipient-name" class="col-form-label">Categoria</label>
                        </div>
                        <div class="col-6">
                            <input type="checkbox" aria-label="Checkbox for following text input" id="estadisticas"
                                onclick="cambiar(8, 'estadisticas')">
                            <label for="recipient-name" class="col-form-label">Estadisticas</label>
                        </div>

                    </div>
                </div>
                <button type="submit" class="btn btn-dark" onclick="cambiarestado(false)">Guardar</button>
                <button type="submit" class="btn btn-dark" onclick="cambiarestado(true)">Editar</button>
            </form>
        </div>
    </div>

    <?php
Commerce::footerTemplate('rol.js');
?>