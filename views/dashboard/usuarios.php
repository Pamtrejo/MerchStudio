<?php
require_once('../../core/helpers/dashboard/commerce.php');
Commerce::headerTemplate('MerchStudio');
?>
<div class="container mt-5">
    <div class="row shadow-sm p-3 mb-5 bg-secondary rounded">
        <div class="table-responsive-lg" style="width:100%">
            <h1 class="text-center  mt-4 mb-4 letra">USUARIOS</h1>
            <div class="row d-flex justify-content-center">
                <div class="col-6 col-md-4 text-center">
                    <button type="button" class="mr-lg-2 btn btn-dark" data-toggle="modal" data-target="#guardarusuario">
                    <i data-feather="plus-circle"></i>
                        
                    </button>
                    <button type="button" class="btn btn-dark float-right" data-toggle="modal" data-target="#modal12">
                     Cambiar contrasena
                     </button>
                </div>
            </div>
            <br>
            <table id="categoria" class="table ">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="letrita">ROL</th>
                        <th scope="col"  class="letrita">NOMBRE</th>
                        <th scope="col" class="letrita">APELLIDO</th>
                        <th scope="col" class="letrita">NOMBRE USUARIO</th>
                        <th scope="col" class="letrita">CORREO</th>
                        <th scope="col" class="text-center letrita">ACCIONES</th>
                    </tr>
                </thead>
                <tbody id="tbody-read-categoria"></tbody>
            </table>
        </div>
    </div>
 
<!-- Ventana para guardar Categoria -->
<div class="modal fade" id="guardarusuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title letrita" id="exampleModalLabel">AGREGAR UN NUEVO USUARIO</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="crear_usuario">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <label for="recipient-name" class="col-form-label">Nombre:</label>
                                <input type="text" id="nombre" name="nombre" class="form-control form-control-alternative" required autocomplete="off">
                            </div>
                            <div class="col-6">
                                <label for="recipient-name" class="col-form-label">Apellido:</label>
                                <input type="text" name="apellido" id="apellido" class="form-control form-control-alternative">
                            </div>
                            <div class="col-6">
                                <label for="recipient-name" class="col-form-label">Nombre de usuario:</label>
                                <input type="text" name="usuario" id="usuario" class="form-control form-control-alternative">
                            </div>
                            <div class="col-6">
                                <label for="recipient-name" class="col-form-label">Correo:</label>
                                <input type="text" name="email" id="email" class="form-control form-control-alternative">
                            </div>

                            <div class="col-6">
                                <label for="recipient-name" class="col-form-label">Rol:</label>
                                <select id="rol" name="rol" class="form-control form-control-alternative">
                                </select>
                            </div>
                                    <div class="form-group col-6">
                                    <label for="autorSelect">Fecha de Creacion</label>
                                    <input id="fecha" type="date" name="fecha" class="validate form-control" required placeholder="Fecha de Creacion">
                                </div>
                                
                            <div class="col-6">
                                <label for="recipient-name" class="col-form-label">Contraseña:</label>
                                <input type="password" name="contrasena" id="contrasena" class="form-control form-control-alternative">
                            </div>
                            <div class="col-6">
                                <label for="recipient-name" class="col-form-label">Confirmar contraseña:</label>
                                <input type="password" name="confirmar" id="confirmar" class="form-control form-control-alternative">
                            </div>
                            
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="estado(false)" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-dark" onclick="estado(true)">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal cambiar contrasena-->
<div class="modal fade" id="modal12" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
               <div class="modal-content">
                    <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalCenterTitle">Cambiar contrasena</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                         </button>
                    </div>
                    <div class="modal1" class="modal">
                         <form method="post" id="form-password" enctype="multipart/form-data">
                              <div class="row">
                                   <div class="input-field col s12 m6">
                                        <input id="clave1" type="password" name="clave1" class="validate"
                                             required />
                                        <label for="clave1" class="float-left">Clave actual</label>
                                   </div>
                                   <div class="input-field col s12 m6">
                                        <input id="clave2" type="password" name="clave2"
                                             class="validate" required />
                                        <label for="clave2" class="float-left">Confirmar clave actual</label>
                                   </div>

                                   <div class="input-field col s12 m6">
                                        <input id="clave_nueva_1" type="password" name="clave_nueva_1" class="validate"
                                             required />
                                        <label for="clave_nueva_1" class="float-left">Clave nueva</label>
                                   </div>
                                    
                                   <div class="input-field col s12 m6">
                                        <input id="clave_nueva_2" type="password" name="clave_nueva_2" class="validate"
                                             required />
                                        <label for="clave_nueva_2" class="float-left">Confirmar clave nueva</label>
                                   </div>

                              </div>

                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                         <button type="submit" class="btn btn-primary" data-tooltip="form-password">Cambiar</button>
                    </div>
                    </form>

               </div>
          </div>
     </div>
<!-- Ventana para modificar Categoria -->
<div class="modal fade" id="modificarCategoriaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Modificar Categoria</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="form-update-categoria">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Codigo:</label>
                        <input name="id-update" type="text" class="form-control form-control-alternative" id="idCategoria" readonly>

                        <div class="row">
                            <div class="col-6">
                                <label for="recipient-name" class="col-form-label">Nombre:</label>
                                <input name="nombres-update" type="text" class="form-control form-control-alternative" id="nombreCategoria">
                            </div>
                            <div class="col-6">
                                <label for="recipient-name" class="col-form-label">Descuento:</label>
                                <input name="descuento-update" type="text" class="form-control form-control-alternative" id="descuentoCategoria">
                            </div>
                            <div class="col-12">
                                <label for="recipient-name" class="col-form-label">Descripción:</label>
                                <textarea class="form-control" name="descripcion-update" id="descripcion-update" aria-label="With textarea"></textarea>
                            </div>
                            
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-warning">Modificar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
   
<?php
Commerce::footerTemplate('usuarios.js');
?>