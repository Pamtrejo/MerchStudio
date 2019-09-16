//Constante para establecer la ruta y parámetros de comunicación con la API
const apiInventario = '../../core/api/inventario.php?site=dashboard&action=';

//ESTE CODIGO SE EJECUTA CUANDO CARGA LA PAGINA 
$(document).ready(() => {
    //CARGA LA INFORMACION DE LA API EN LA VISTA
    fillSelect(apiInventario + 'CategoriasLista', 'create_categoria', null);
    fillSelect(apiInventario + 'CategoriasLista', 'update_categoria', null);
    fillSelecte(apiInventario + 'ProductoLista', 'create_producto', null);
    fillSelect(apiInventario + 'TallaLista', 'create_talla', null);
    fillSelect(apiInventario + 'SucursalLista', 'create_sucursal', null);
    fillSelect1(apiInventario, 'categoria',null);
})

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
function fillSelecte(api, id, selected) {
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
                        content += '<option value="" disabled selected>Seleccione una opción</option>';
                    }
                    result.dataset.forEach(function (row) {
                        value = Object.values(row)[0];
                        text = Object.values(row)[1];
                        if (row.id_categoria != selected) {
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
                console.log(response);
            }
        })
        .fail(function (jqXHR) {
            // Se muestran en consola los posibles errores de la solicitud AJAX
            console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
        });
}

function fillSelect(api, id, selected) {
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
            result.dataset.map(item => {
                //Por cada nombre del campo, saco una variable constante
                const { IdProductoxSucursal, idproducto, Diseno, Descripcion, Precio, Talla, NomSucursal, cantidad } = item
                //Le agregamos una fila al contenido de la tabla
                contenidoTabla += `
                <tr id="${IdProductoxSucursal}">
                    <th>${idproducto}</th>
                    <th>${Diseno}</th>
                    <th>${Talla === null ? "N/A" : Talla}</th>
                    <th>${Precio}</th>
                    <th>${Descripcion === null ? "Sin descripción" : Descripcion}</th>
                    <th>${NomSucursal}</th>
                    <th>${cantidad === null ? "0" : cantidad}</th>                    
                    <td>
                    <a href="#" onclick="modalUpdate(${idproducto})" class="text-dark tooltipped" data-tooltip="Modificar"><i class="fas fa-pencil-alt fa-lg">
                    </i></a>
                    </td>
                    <td>
                    <a href="#" onclick="confirmDelete(${idproducto})" class="text-dark tooltipped" data-tooltip="Eliminar"><i class="fas fa-trash-alt fa-lg"></i></a>
                    </td>
                </tr>
                `
            })
            $('#tbody-inventario').html(contenidoTabla)
        } else {
            console.log(result.exception)
        }
    } else {
        console.log(response);
    }
}
//funcion para buscar
$(document).ready(function () {
    $('#buscar').keyup(function (e) {
        let buscar = $('#buscar').val();
        buscar = buscar.replace(" ", "");
        console.log(buscar);
        $.ajax({
            url: '../../core/api/inventario.php?action=buscar&buscar=' + buscar,
            type: 'POST',
            data: { sucursal, buscar },
            datatype: 'json',
            success: function (response) {
                console.log("Trabajando");
                console.log(response);
                $("form#inventario").hide(function () { $(div.success).fadeIn(); });
                if (isJSONString(response)) {
                    const result = JSON.parse(response);
                    //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
                    if (result.status == 1) {
                        let contenidoTabla = ''
                        //Aqui recorremos el arreglo
                        //Item es cada elemento del arreglo
                        result.dataset.map(item => {
                            //Por cada nombre del campo, saco una variable constante
                            const { IdProductoxSucursal, idproducto, Diseno, Descripcion, Precio, Talla, NomSucursal, cantidad } = item
                            console.log(Talla);
                            //Le agregamos una fila al contenido de la tabla
                            contenidoTabla += `
                            <tr id="${IdProductoxSucursal}">
                                <th>${idproducto}</th>
                                <th>${Diseno}</th>
                                <th>${Talla === null ? "N/A" : Talla}</th>
                                <th>${Precio}</th>
                                <th>${Descripcion === null ? "Sin descripción" : Descripcion}</th>
                                <th>${NomSucursal}</th>
                                <th>${cantidad === null ? "0" : cantidad}</th>
                                <td>
                                <a href="#" onclick="modalUpdate(${idproducto})" class="text-dark tooltipped" data-tooltip="Modificar"><i class="fas fa-pencil-alt fa-lg">
                                </i></a>
                                </td>
                                <td>
                                <a href="#" onclick="confirmDelete(${idproducto})" class="text-dark tooltipped" data-tooltip="Eliminar"><i class="fas fa-trash-alt fa-lg"></i></a>
                                </td>
                            </tr>
                            `
                        })
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

function graficoCategorias()
{
    $.ajax({
        url: api + 'cantidadProductosCategoria',
        type: 'post',
        data: null,
        datatype: 'json'
    })
    .done(function(response){
        // Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            // Se comprueba que no hay usuarios registrados para redireccionar al registro del primer usuario
            if (result.status) {
                let categorias = [];
                let cantidad = [];
                result.dataset.forEach(function(row){
                    categorias.push(row.nombre_categoria);
                    cantidad.push(row.cantidad);
                });
                const context = $('#chart');
                const chart = new Chart(context, {
                    type: 'line',
                    data: {
                        labels: categorias,
                        datasets: [{
                            label: 'Cantidad de productos',
                            data: cantidad,
                            backgroundColor: 'rgba(189, 155, 192, 0.6)',
                            borderColor: 'rgba(94, 26, 100, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Cantidad de productos por categoría'
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    stepSize: 1
                                }
                            }]
                        }
                    }
                });
            } else {
                $('#chart').remove();
            }
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        // Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}


//funcion para que cargue el combobox del productosxTalla1 reporte
function fillSelect1(api, id, selected)
{
    $.ajax({
        url: api+'cargarCategoria',
        type: 'post',
        data: null,
        datatype: 'json'
    })
.done(function(response){
    console.log(response);
    // Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
    if (isJSONString(response)) {
        const result = JSON.parse(response);
        // Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
        if (result.status) {
            let content = '';
            if (!selected) {
                content += '<option value="" disabled selected>Seleccione una opción</option>';
            }
            result.dataset.forEach(function(row){
                value = Object.values(row)[0];
                text = Object.values(row)[1];
                if (row.id_categoria != selected) {
                    content += `<option value="${value}">${text}</option>`;
                } else {
                    content += `<option value="${value}" selected>${text}</option>`;
                }
            });
            $('#' + id).html(content);
        } else {
            $('#' + id).html('<option value="">No hay opciones</option>');
        }
    } else {
        console.log(response);
    }
})
}
//funcion para pasar el dato del combobox al reporte
function reporteCategoria(){
    //se obtiene el valor elegido del combobox
    let categorias = $('#categoria').val(); 
    //abre el reporte en otra pagina y manda a llamar el dato del combobox
    window.open('../../core/reportes/categorias1.php?categorias='+categorias);
}

