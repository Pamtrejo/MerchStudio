//Constante para establecer la ruta y parámetros de comunicación con la API
const apiInventario = '../../core/api/inventario.php?site=dashboard&action=';

//ESTE CODIGO SE EJECUTA CUANDO CARGA LA PAGINA 
$(document).ready(() => {
    //CARGA LA INFORMACION DE LA API EN LA VISTA
    fillSelect(apiInventario+'CategoriasLista','create_categoria',null);
})

function isJSONString(string)
{
    try {
        if (string != "[]") {
            JSON.parse(string);
            return true;
        } else {
            return false;
        }
    } catch(error) {
        return false;
    }
}
function fillSelect(api, id, selected)
{
    $.ajax({
        url: api,
        type: 'post',
        data: null,
        datatype: 'json'
    })
    .done(function(response){
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
    .fail(function(jqXHR){
        // Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}




var sucursal;

//Función para obtener y mostrar los registros disponibles
const cargarTabla = async (idSucursal) => {
    sucursal=idSucursal;
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
            result.dataset.map( item => {
                //Por cada nombre del campo, saco una variable constante
                const { IdProductoxSucursal, idproducto, Diseno, Descripcion, Precio, Talla, NomSucursal, cantidad } = item
                console.log(Talla);
                //Le agregamos una fila al contenido de la tabla
                contenidoTabla += `
                <tr id="${IdProductoxSucursal}">
                    <th>${idproducto}</th>
                    <th>${Diseno}</th>
                    <th>${Talla === null?"N/A":Talla}</th>
                    <th>${Precio}</th>
                    <th>${Descripcion===null?"Sin descripción":Descripcion}</th>
                    <th>Imagen</th>
                    <th>${NomSucursal}</th>
                    <th>${cantidad===null?"0":cantidad}</th>
                    <td><button type="button" class="btn btn-outline-dark">Modificar</button></td>
                    <td><button  onclick="confirmDelete('${apiInventario}', ${IdProductoxSucursal})" type="button" class="btn btn-outline-dark">Eliminar</button></td>
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

$(document).ready(function(){
    $('#buscar').keyup(function(e){
        let buscar= $('#buscar').val();
        buscar = buscar.replace(" ", "");
        console.log(buscar);
        $.ajax({
            url:'../../core/api/inventario.php?action=buscar&buscar='+buscar,
            type:'POST',
            data: { sucursal, buscar },
            datatype: 'json',
            success: function(response){
                console.log("Trabajando");
                console.log(response);
                $("form#inventario").hide(function(){$(div.success).fadeIn();});
                if (isJSONString(response)) {
                    const result = JSON.parse(response);
                    //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
                    if (result.status == 1) {
                        let contenidoTabla = ''
                        //Aqui recorremos el arreglo
                        //Item es cada elemento del arreglo
                        result.dataset.map( item => {
                            //Por cada nombre del campo, saco una variable constante
                            const { IdProductoxSucursal, idproducto, Diseno, Descripcion, Precio, Talla, NomSucursal, cantidad } = item
                            console.log(Talla);
                            //Le agregamos una fila al contenido de la tabla
                            contenidoTabla += `
                            <tr id="${IdProductoxSucursal}">
                                <th>${idproducto}</th>
                                <th>${Diseno}</th>
                                <th>${Talla === null?"N/A":Talla}</th>
                                <th>${Precio}</th>
                                <th>${Descripcion===null?"Sin descripción":Descripcion}</th>
                                <th>Imagen</th>
                                <th>${NomSucursal}</th>
                                <th>${cantidad===null?"0":cantidad}</th>
                                <td><button type="button" class="btn btn-outline-dark">Modificar</button></td>
                                <td><button type="button" class="btn btn-outline-dark">Eliminar</button></td>
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
            error: function(XMLHttpRequest,textStatus,errorThrown){
                alert("Status: "+textStatus); alert("Error: "+errorThrown);
            }

        })
    })
});
// Función para crear un nuevo registro
$('#form-crear').submit(function()
{
    event.preventDefault();
    $.ajax({
        
        url: apiInventario + 'createProducto',
        type: 'post',
        data: $('#form-crear').serialize(),
        datatype: 'json',
    })
    .done(function(response){
        // Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            // Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
            if (result.status) {
                $('#modal-crear').modal('close');
                showTable();
                sweetAlert(1, "Exitoso", null);
            } else {
                sweetAlert(2, result.exception, null);
                console.log(result);
            }
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        // Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
})

