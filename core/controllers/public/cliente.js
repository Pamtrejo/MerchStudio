//ESTE CODIGO SE EJECUTA CUANDO CARGA LA PAGINA 
$(document).ready(() => {
    //CARGA LA INFORMACION DE LA API EN LA VISTA
    cargarTabla();
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

//Constante para establecer la ruta y parámetros de comunicación con la API
const apiCliente = '../../core/api/cliente.php?site=dashboard&action=';

var cliente;
//Función para obtener y mostrar los registros disponibles
const cargarTabla = async (IdCliente) => {
    cliente=IdCliente;
    //Con el id que tenés de sucursal, consultar el nombre, lo guardas en una variable y lo imprimis en la tabla
    const response = await $.ajax({
        url: apiCliente + 'cargarCliente',
        type: 'post',
        data: { IdCliente },
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
                const { IdCliente, NombreCliente,DUI, Direccion} = item
                
                //Le agregamos una fila al contenido de la tabla
                contenidoTabla += `
                <tr id="${IdCliente}">
                    <th>${NombreCliente}</th>
                    <th>${DUI}</th>
                    <th>${Direccion}</th>
                    <td><button onclick="modalUpdate(${IdCliente})" type="button" class="btn btn-outline-primary">Modificar</button></td>
                    <td><button onclick="deleteModal(${IdCliente})" type="button" class="btn btn-outline-primary">Eliminar</button></td>
                </tr>
                `
            })
            $('#tbody-cliente').html(contenidoTabla)
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
        if(buscar!=""){
            $.ajax({
                url:'../../core/api/cliente.php?action=search&search='+buscar,
                type:'POST',
                data: {cliente, buscar },
                datatype: 'json',
                success: function(response){
                    console.log("Trabajando");
                    console.log(response);
                    $("form#sucursal").hide(function(){$(div.success).fadeIn();});
                    if (isJSONString(response)) {
                        const result = JSON.parse(response);
                        //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
                        if (result.status == 1) {
                            let contenidoTabla = ''
                            //Aqui recorremos el arreglo
                            //Item es cada elemento del arreglo
                            result.dataset.map( item => {
                                //Por cada nombre del campo, saco una variable constante
                                const { IdCliente, NombreCliente, DUI, Direccion} = item
                                console.log(result);
                                //Le agregamos una fila al contenido de la tabla
                                contenidoTabla += `
                                <tr id="${IdCliente}">
                                <th>${NombreCliente}</th>
                                <th>${DUI}</th>
                                <th>${Direccion}</th>
                                <td><button type="button" class="btn btn-outline-primary">Modificar</button></td>
                                <td><button type="button" class="btn btn-outline-primary">Eliminar</button></td>
                                </tr>
                                `
                            })
                            $('#tbody-cliente').html(contenidoTabla)
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
        }else{
            cargarTabla();
        }
        
    })
});
// Función para crear un nuevo registro
$('#form-crear').submit(function()
{
    event.preventDefault();
    $.ajax({
        
        url: apiCliente + 'create',
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
                sweetAlert(1, "Exitoso", null);
                cargarTabla();
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

function deleteModal(id){
    swal({
        title: "Estas seguro?",
        text: "Once deleted, you will not be able to recover this imaginary file!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url :apiCliente + 'delete',
                type: 'post',
                data:{
                    IdCliente: id
                },
                datatype: 'json'
            }).done(function(response){
                if (isJSONString(response)) {
                    const result = JSON.parse(response);
                    // Se comprueba si el resultado es satisfactorio para mostrar los valores en el formulario, sino se muestra la excepción
                    if (result.status) {
                        swal(result.message, {
                            icon: "success",
                          });
                          cargarTabla();
                    } else {
                        swal(result.exception, {
                            icon: "error",
                          });
                    }
                } else {
                    console.log(response);
                }
            })
        } else {
          swal("Your imaginary file is safe!");
        }
      });
   /* $.ajax({
        url :apiSucursal + 'delete',
        type: 'post',
        data:{
            IdSucursal: id
        },
        datatype: 'json'
    }).done(function(response){

    })*/
}
// Función para mostrar formulario con registro a modificar
function modalUpdate(id)
{
    $.ajax({
        url: apiCliente + 'get',
        type: 'post',
        data:{
            IdCliente: id
        },
        datatype: 'json'
    })
    .done(function(response){
        // Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            // Se comprueba si el resultado es satisfactorio para mostrar los valores en el formulario, sino se muestra la excepción
            if (result.status) {
                $('#form-update')[0].reset();
                $('#IdCliente').val(result.dataset.IdCliente);
                $('#update_nombre').val(result.dataset.NombreCliente);
                $('#update_dui').val(result.dataset.DUI);
                $('#update_direccion').val(result.dataset.Direccion);
                $('#exampleModal1').modal('show');
            } else {
                sweetAlert(2, result.exception, null);
                
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

// Función para modificar un registro seleccionado previamente
$('#form-update').submit(function()
{
    event.preventDefault();
    $.ajax({
        url: apiCliente + 'update',
        type: 'post',
        data: new FormData($('#form-update')[0]),
        datatype: 'json',
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(response){
        // Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            // Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
            if (result.status) {
                $('#exampleModal1').modal('hide');
                cargarTabla();
                sweetAlert(1, result.message, null);
            } else {
                sweetAlert(2, result.exception, null);
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