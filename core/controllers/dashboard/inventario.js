//Constante para establecer la ruta y parámetros de comunicación con la API
const apiInventario = '../../core/api/inventario.php?site=dashboard&action=';

//ESTE CODIGO SE EJECUTA CUANDO CARGA LA PAGINA 
$(document).ready(() => {
    //CARGA LA INFORMACION DE LA API EN LA VISTA
    llenarSelect(apiInventario + 'CategoriasLista', 'create_categoria', null);
    llenarSelect(apiInventario + 'CategoriasLista', 'update_categoria', null);
    llenarSelect(apiInventario + 'ProductoLista', 'create_producto', null);
    llenarSelect(apiInventario + 'TallaLista', 'create_talla', null);
    llenarSelect(apiInventario + 'SucursalLista', 'create_sucursal', null);
})
$(document).ready(function(){
    cargarSucursales();
})

function cargarSucursales () {
    $('#sucursalesButton').html('')
    $.ajax({
        url: apiInventario + 'cargarSucursales',
        type: 'post',
        data: { },
        datatype: 'json'
    })
    .then(response => {
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
            if (result.status == 1) {
                let contenidoTabla = ''
                //Aqui recorremos el arreglo
                //Item es cada elemento del arreglo
                let dato = result.dataset
                for (let i= 0;i< dato.length; i++) {
                    contenidoTabla += `
                        <button type="button" onclick="cargarTabla(${dato[i].IdSucursal})" class="btn btn-dark">
                            ${dato[i].NomSucursal}
                        </button>
                    `
                }
                /*result.dataset.map(item => {
                    //Por cada nombre del campo, saco una variable constante
                    let da = 0;
                    const { IdProductoxSucursal, IdProducto, Diseno, Descripcion, Precio, Talla, NomSucursal, cantidad } = item
                    //Le agregamos una fila al contenido de la tabla
                        
                })*/
                $('#sucursalesButton').html(contenidoTabla)
            } else {
                console.log(result.exception)
            }
        } else {
            console.log(response);
        }
    })
    .fail(function (jqXHR) {
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}

function isJSONString(string) {
    try {
        if (string != "[]") {
            JSON.parse(string);
            return true;
        } else {
            return false;
        }
    } catch (error) {
        return false;
    }
}

function llenarSelect(api, id, selected) {
    $.ajax({
        url: api,
        type: 'post',
        data: null,
        datatype: 'json'
    })
        .done(function (response) {
            // Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
            if (isJSONString(response)) {
                const result = JSON.parse(response);
                // Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
                if (result.status) {
                    let content = '';
                    if (!selected) {
                        content += '<option value="" disabled selected>Seleccione otra opción</option>';
                    }
                    result.dataset.forEach(function (row) {
                        value = Object.values(row)[0];
                        text = Object.values(row)[1];
                        if (row.idproducto != selected) {
                            content += `<option value="${value}">${text}</option>`
                            
                        } else {
                            content += `<option value="${value}" selected>${text}</option>`;
                        }
                    });
                    $('#' + id).html(content);
                } else {
                    $('#' + id).html('<option value="">No hay opciones</option>');
                }
            } else {
            }
        })
        .fail(function (jqXHR) {
            // Se muestran en consola los posibles errores de la solicitud AJAX
            console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
        });
}
var sucursal;
//Función para obtener y mostrar los registros disponibles
const cargarTabla = async (idSucursal) => {
    $('#buscar').val('');
    sucursal = idSucursal;
    //Con el id que tenés de sucursal, consultar el nombre, lo guardas en una variable y lo imprimis en la tabla
    const response = await $.ajax({
        url: apiInventario + 'cargarCamisetasSucursal',
        type: 'post',
        data: { idSucursal },
        datatype: 'json'
    }).fail(function (jqXHR) {
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
    if (isJSONString(response)) {
        const result = JSON.parse(response);
        //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
        if (result.status == 1) {
            let contenidoTabla = ''
            //Aqui recorremos el arreglo
            //Item es cada elemento del arreglo
            let dato = result.dataset
            let d = 0;
            let e = 0;
            let t = '';
            for (let i= 0;i< dato.length; i++) {
                if (dato[i].IdProducto == d) {
                    dato[e].cantidad = parseInt(dato[e].cantidad) + parseInt(dato[i].cantidad)
                    if ( dato[i].Talla != dato[e].Talla ) {
                        if ( dato[i].Talla != t ) {
                            dato[e].Talla = dato[e].Talla +','+dato[i].Talla
                            t = dato[i].Talla
                        }
                    }
                }
                else {
                    e = i;
                    d = dato[i].IdProducto
                }
            }
            d = 0;
            e = 0;
            for (let i= 0;i< dato.length; i++) {
                if (d != dato[i].IdProducto) {
                    if (idSucursal == 'todo') {
                        contenidoTabla += `
                        <tr id="${dato[i].IdProductoxSucursal}">
                            <th>${dato[i].IdProducto}</th>
                            <th>${dato[i].Diseno}</th>
                            <th>${dato[i].Talla === null ? "N/A" : dato[i].Talla}</th>
                            <th>${dato[i].Precio}</th>
                            <th>${dato[i].Descripcion === null ? "Sin descripción" : dato[i].Descripcion}</th>
                            <th>${dato[i].NomSucursal}</th>
                            <th>${dato[i].cantidad === null ? "0" : dato[i].cantidad}</th>                    
                            <td>
                            <a href="#" onclick="modalUpdate(${dato[i].IdProducto})" class="text-dark tooltipped" data-tooltip="Modificar"><i class="fas fa-pencil-alt fa-lg">
                            </i></a>
                            </td>
                            <td>
                            <a href="#" onclick="confirmDelete(${dato[i].IdProducto})" class="text-dark tooltipped" data-tooltip="Eliminar"><i class="fas fa-trash-alt fa-lg"></i></a>
                            </td>
                            <td>
                            <a href="#" onclick="verTallas(${dato[i].IdProducto},'todo')" class="text-dark tooltipped" data-tooltip="Ver Más"
                            data-toggle="modal" data-target="#verMas">
                                <i class="fas fa-eye fa-lg"></i>
                            </a>
                            </td>
                        </tr>
                        `
                    }
                    else {
                        contenidoTabla += `
                        <tr id="${dato[i].IdProductoxSucursal}">
                            <th>${dato[i].IdProducto}</th>
                            <th>${dato[i].Diseno}</th>
                            <th>${dato[i].Talla === null ? "N/A" : dato[i].Talla}</th>
                            <th>${dato[i].Precio}</th>
                            <th>${dato[i].Descripcion === null ? "Sin descripción" : dato[i].Descripcion}</th>
                            <th>${dato[i].NomSucursal}</th>
                            <th>${dato[i].cantidad === null ? "0" : dato[i].cantidad}</th>                    
                            <td>
                            <a href="#" onclick="modalUpdate(${dato[i].IdProducto})" class="text-dark tooltipped" data-tooltip="Modificar"><i class="fas fa-pencil-alt fa-lg">
                            </i></a>
                            </td>
                            <td>
                            <a href="#" onclick="confirmDelete(${dato[i].IdProducto})" class="text-dark tooltipped" data-tooltip="Eliminar"><i class="fas fa-trash-alt fa-lg"></i></a>
                            </td>
                            <td>
                            <a href="#" onclick="verTallas(${dato[i].IdProducto},${dato[i].IdSucursal})" class="text-dark tooltipped" data-tooltip="Ver Más"
                            data-toggle="modal" data-target="#verMas">
                                <i class="fas fa-eye fa-lg"></i>
                            </a>
                            </td>
                        </tr>
                        `
                    }
                }
                d = dato[i].IdProducto
            }
            /*result.dataset.map(item => {
                //Por cada nombre del campo, saco una variable constante
                let da = 0;
                const { IdProductoxSucursal, IdProducto, Diseno, Descripcion, Precio, Talla, NomSucursal, cantidad } = item
                //Le agregamos una fila al contenido de la tabla
                    
            })*/
            $('#tbody-inventario').html(contenidoTabla)
        } else {
            console.log(result.exception)
        }
    } else {
        console.log(response);
    }
}

//Funcion para mostrar la cantidad de las diferentes tallas

//funcion para buscar
    $('#buscar').keyup(function (e) {
        let buscar = $('#buscar').val();
        buscar = buscar.replace(" ", "");
        //console.log(buscar);
        $.ajax({
            url: '../../core/api/inventario.php?action=buscar&buscar=' + buscar,
            type: 'POST',
            data: { sucursal, buscar },
            datatype: 'json',
            success: function (response) {
                //console.log("Trabajando");
                //console.log(response);
                $("form#inventario").hide(function () { $(div.success).fadeIn(); });
                if (isJSONString(response)) {
                    const result = JSON.parse(response);
                    //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
                    if (result.status == 1) {
                        let contenidoTabla = ''
                        //Aqui recorremos el arreglo
                        //Item es cada elemento del arreglo
                        let dato = result.dataset
                        let d = 0;
                        let e = 0;
                        let t = '';
                        for (let i= 0;i< dato.length; i++) {
                            if (dato[i].IdProducto == d) {
                                dato[i].cantidad = parseInt(dato[i].cantidad) + parseInt(dato[e].cantidad)
                                if ( dato[i].Talla != dato[e].Talla ) {
                                    if ( dato[i].Talla != t ) {
                                        dato[e].Talla = dato[e].Talla +','+dato[i].Talla
                                        t = dato[i].Talla
                                    }
                                }
                            }
                            else {
                                d = dato[i].IdProducto
                                e = i;
                            }
                        }
                        d = 0;
                        e = 0;
                        for (let i= 0;i< dato.length; i++) {
                            if (d != dato[i].IdProducto) {
                                contenidoTabla += `
                                <tr id="${dato[i].IdProductoxSucursal}">
                                    <th>${dato[i].IdProducto}</th>
                                    <th>${dato[i].Diseno}</th>
                                    <th>${dato[i].Talla === null ? "N/A" : dato[i].Talla}</th>
                                    <th>${dato[i].Precio}</th>
                                    <th>${dato[i].Descripcion === null ? "Sin descripción" : dato[i].Descripcion}</th>
                                    <th>${dato[i].NomSucursal}</th>
                                    <th>${dato[i].cantidad === null ? "0" : dato[i].cantidad}</th>                    
                                    <td>
                                    <a href="#" onclick="modalUpdate(${dato[i].IdProducto})" class="text-dark tooltipped" data-tooltip="Modificar"><i class="fas fa-pencil-alt fa-lg">
                                    </i></a>
                                    </td>
                                    <td>
                                    <a href="#" onclick="confirmDelete(${dato[i].IdProducto})" class="text-dark tooltipped" data-tooltip="Eliminar"><i class="fas fa-trash-alt fa-lg"></i></a>
                                    </td>
                                    <td>
                                    <a href="#" onclick="verTallas(${dato[i].IdProducto},'todo')" class="text-dark tooltipped" data-tooltip="Ver Más"
                                    data-toggle="modal" data-target="#verMas">
                                        <i class="fas fa-eye fa-lg"></i>
                                    </a>
                                    </td>
                                </tr>
                                `
                            }
                            d = dato[i].IdProducto
                        }
                        /*result.dataset.map(item => {
                            //Por cada nombre del campo, saco una variable constante
                            let da = 0;
                            const { IdProductoxSucursal, IdProducto, Diseno, Descripcion, Precio, Talla, NomSucursal, cantidad } = item
                            //Le agregamos una fila al contenido de la tabla
                                
                        })*/
                        $('#tbody-inventario').html(contenidoTabla)
                    } else {
                        console.log(result.exception)
                    }
                } else {
                    console.log(response);
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus); alert("Error: " + errorThrown);
            }

        })
    });
// Función para crear un nuevo registro
$('#form-crear').submit(function () {
    event.preventDefault();
    $.ajax({

        url: apiInventario + 'createProducto',
        type: 'post',
        data: $('#form-crear').serialize(),
        datatype: 'json',
    })
        .done(function (response) {
            // Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
            if (isJSONString(response)) {
                const result = JSON.parse(response);
                // Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
                if (result.status) {
                    $('#modal-crear').modal('close');
                    cargarTabla(1);
                    sweetAlert(1, "Exitoso", null);
                } else {
                    sweetAlert(2, result.exception, null);
                    console.log(result);
                }
            } else {
                console.log(response);
            }
        })
        .fail(function (jqXHR) {
            // Se muestran en consola los posibles errores de la solicitud AJAX
            console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
        });
})
//funcion para poder modificar un producto
$('#form-update').submit(function () {
    event.preventDefault();
    $.ajax({

        url: apiInventario + 'update ',
        type: 'post',
        data: $('#form-update').serialize(),
        datatype: 'json',
    })
        .done(function (response) {
            //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
            if (isJSONString(response)) {
                const result = JSON.parse(response);
                //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
                if (result.status) {
                    if (result.status == 1) {
                        sweetAlert(1, 'Producto modificado correctamente', null);
                    } else if (result.status == 2) {
                        sweetAlert(3, 'Producto modificado. ' + result.exception, null);
                    } else if (result.status == 3) {
                        sweetAlert(1, 'Producto modificado. ' + result.exception, null);
                    }
                    $('#modal-update').modal('hide');
                } else {
                    sweetAlert(2, result.exception, null);
                }
            } else {
                console.log(response);
            }
        })
        .fail(function (jqXHR) {
            //Se muestran en consola los posibles errores de la solicitud AJAX
            console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
        });
})

// Función para mostrar formulario con registro a modificar
function modalUpdate(IdProducto) {
    $.ajax({
        url: apiInventario + 'obtener',
        type: 'post',
        data: {
            IdProducto
        },
        datatype: 'json'
    })
        .done(function (response) {
            // Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
            if (isJSONString(response)) {
                const result = JSON.parse(response);
                // Se comprueba si el resultado es satisfactorio para mostrar los valores en el formulario, sino se muestra la excepción
                if (result.status) {
                    console.log(result.dataset)
                    $('#idProducto').val(result.dataset.idproducto)
                    $('#update_precio').val(result.dataset.precio)
                    $('#update_descripcion').val(result.dataset.descripcion)
                    $('#update_diseno').val(result.dataset.diseno)
                    $('#update_categoria').val(result.dataset.idcategoria)
                    $('#modal-update').modal('toggle');
                } else {
                    sweetAlert(2, result.exception, null);
                }
            } else {
                console.log(response);
            }
        })
        .fail(function (jqXHR) {
            // Se muestran en consola los posibles errores de la solicitud AJAX
            console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
        });
}

//Funcion para eliminar productos
function confirmDelete(idproducto) {
    swal({
        title: 'Advertencia',
        text: '¿Quiere eliminar el producto?',
        icon: 'warning',
        buttons: ['Cancelar', 'Aceptar'],
        closeOnClickOutside: false,
        closeOnEsc: false
    })
        .then(function (value) {
            if (value) {
                $.ajax({
                    url: apiInventario + 'delete',
                    type: 'post',
                    data: {
                        idproducto: idproducto,
                    },
                    datatype: 'json'
                })
                    .done(function (response) {
                        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
                        if (isJSONString(response)) {
                            const result = JSON.parse(response);
                            //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
                            if (result.status) {
                                if (result.status == 1) {
                                    sweetAlert(1, 'Categoría eliminada correctamente', null);
                                }
                                location.reload()
                            } else {
                                sweetAlert(2, result.exception, null);
                            }
                        } else {
                            console.log(response);
                        }
                    })
                    .fail(function (jqXHR) {
                        //Se muestran en consola los posibles errores de la solicitud AJAX
                        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
                    });
            }
        });
}

//Funcion para agregar producto por sucursal
$('#form-producto').submit(function () {
    event.preventDefault();
    $.ajax({

        url: apiInventario + 'createProductoxSucursal',
        type: 'post',
        data: $('#form-producto').serialize(),
        datatype: 'json',
    })
        .done(function (response) {
            // Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
            if (isJSONString(response)) {
                const result = JSON.parse(response);
                // Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
                if (result.status) {
                    $('#modal-producto').modal('close');
                    cargarTabla(1);
                    sweetAlert(1, "Exitoso", null);
                } else {
                    sweetAlert(2, result.exception, null);
                    console.log(result);
                }
            } else {
                console.log(response);
            }
        })
        .fail(function (jqXHR) {
            // Se muestran en consola los posibles errores de la solicitud AJAX
            console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
        });
})

//Funcion para restar cantidad de productos en el inventario
function restar (id) {
    let cantidad = $('#cantidad'+id).val()
    $.ajax({

        url: apiInventario + 'restar',
        type: 'post',
        data: {id, cantidad},
        datatype: 'json',
    })
        .done(function (response) {
            // Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
            if (isJSONString(response)) {
                const result = JSON.parse(response);
                // Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
                if (result.status) {
                    sweetAlert(1, "Restadpo con exito", "inventario.php");
                } else {
                    sweetAlert(2, result.exception, null);
                }
            } else {
                console.log(response);
            }
        })
        .fail(function (jqXHR) {
            // Se muestran en consola los posibles errores de la solicitud AJAX
            console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
        });
}


//Funcion para sacar las tallas
function verTallas (idProducto,idSucursal) {
    //Con el id que tenés de sucursal, consultar el nombre, lo guardas en una variable y lo imprimis en la tabla
    $.ajax({
        url: apiInventario + 'cargarCamisetasTallas',
        type: 'post',
        data: { idProducto,idSucursal },
        datatype: 'json'
    })
    .then(response => {
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
            if (result.status == 1) {
                let contenidoTabla = ''
                //Aqui recorremos el arreglo
                //Item es cada elemento del arreglo
                let dato = result.dataset
                for (let i= 0;i< dato.length; i++) {
                    contenidoTabla += `
                    <tr id="${dato[i].IdProducto}">
                        <th>${dato[i].Diseno}</th>
                        <th>${dato[i].Talla === null ? "N/A" : dato[i].Talla}</th>
                        <th>${dato[i].NomSucursal}</th>
                        <th>${dato[i].cantidad === null ? "0" : dato[i].cantidad}</th>
                        <th>
                            <divclass="row">
                                <div class="col-12">
                                    <input type="number" id="cantidad${dato[i].IdProductoxSucursal}" required placeholder="Cantidad a restar">
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-outline-danger block" onclick="restar(${dato[i].IdProductoxSucursal})">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                        </th>
                    </tr>
                    `
                }
                /*result.dataset.map(item => {
                    //Por cada nombre del campo, saco una variable constante
                    let da = 0;
                    const { IdProductoxSucursal, IdProducto, Diseno, Descripcion, Precio, Talla, NomSucursal, cantidad } = item
                    //Le agregamos una fila al contenido de la tabla
                        
                })*/
                $('#tbody-inventario-mas').html(contenidoTabla)
            } else {
                console.log(result.exception)
            }
        } else {
            console.log(response);
        }
    })
    .fail(function (jqXHR) {
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}