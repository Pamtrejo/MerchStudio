//Constante para establecer la ruta y parámetros de comunicación con la API
const apiSucursal = '../../core/api/sucursal.php?site=dashboard&action=';
//ESTE CODIGO SE EJECUTA CUANDO CARGA LA PAGINA 
$(document).ready(() => {
    //CARGA LA INFORMACION DE LA API EN LA VISTA
    cargarTabla();
    fillSelect(apiSucursal + 'SucursalLista', 'sucursal', null);
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
                        content += '<option value="" disabled selected>Seleccione una sucursal</option>';
                    }
                    result.dataset.forEach(function (row) {
                        value = Object.values(row)[0];
                        text = Object.values(row)[1];
                        if (row.IdSucursal != selected) {
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
const cargarTabla = async (IdSucursal) => {
    sucursal=IdSucursal;
    //Con el id que tenés de sucursal, consultar el nombre, lo guardas en una variable y lo imprimis en la tabla
    const response = await $.ajax({
        url: apiSucursal + 'cargarSucursal',
        type: 'post',
        data: { IdSucursal },
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
                const { IdSucursal, NomSucursal, Direccion, Telefono } = item
                
                //Le agregamos una fila al contenido de la tabla
                contenidoTabla += `
                <tr id="${IdSucursal}">
                    <th>${NomSucursal}</th>
                    <th>${Direccion}</th>
                    <th>${Telefono}</th>
                    <td><button onclick="modalUpdate(${IdSucursal})" type="button" class="btn btn-outline-primary">Modificar</button></td>
                    <td><button onclick="deleteModal(${IdSucursal})" type="button" class="btn btn-outline-primary">Eliminar</button></td>
                </tr>
                `
            })
            $('#tbody-sucursal').html(contenidoTabla)
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
                url:'../../core/api/sucursal.php?action=search&search='+buscar,
                type:'POST',
                data: {sucursal, buscar },
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
                                const { IdSucursal, NomSucursal, Direccion, Telefono } = item
                                console.log(result);
                                //Le agregamos una fila al contenido de la tabla
                                contenidoTabla += `
                                <tr id="${IdSucursal}">
                                <th>${NomSucursal}</th>
                                <th>${Direccion}</th>
                                <th>${Telefono}</th>
                                <td><button type="button" class="btn btn-outline-primary">Modificar</button></td>
                                <td><button type="button" class="btn btn-outline-primary">Eliminar</button></td>
                                </tr>
                                `
                            })
                            $('#tbody-sucursal').html(contenidoTabla)
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
        
        url: apiSucursal + 'create',
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
                swal(result.message, {
                    icon: "success",
                  });
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
                url :apiSucursal + 'delete',
                type: 'post',
                data:{
                    IdSucursal: id
                },
                datatype: 'json'
            }).done(function(response){
                if (isJSONString(response)) {
                    const result = JSON.parse(response);
                    // Se comprueba si el resultado es satisfactorio para mostrar los valores en el formulario, sino se muestra la excepción
                    if (result.status) {
                        swal("Poof! Your imaginary file has been deleted!", {
                            icon: "success",
                          });
                    } else {
                        swal("Poof! Your imaginary file has been deleted!", {
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
        url: apiSucursal + 'get',
        type: 'post',
        data:{
            IdSucursal: id
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
                $('#IdSucursal').val(result.dataset.IdSucursal);
                $('#update_sucursal').val(result.dataset.NomSucursal);
                $('#update_direccion').val(result.dataset.Direccion);
                $('#update_telefono').val(result.dataset.Telefono);
                $('#exampleModal1').modal('show');
                console.log('hola')
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
        url: apiSucursal + 'update',
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
                swal(result.message, {
                    icon: "success",
                  });
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

//Funcion para crear grafico
$('#form-sucursal').submit(function()
{
    event.preventDefault();
    //Manda a llamar el id del combobox y las convierte en una variable mas
    let sucursal = $('#sucursal').val();
  $ .ajax({
      url: apiSucursal + "readCantidadProductoSucursal",
      type: 'post',
      data: {
          id : sucursal
      },
      datatype: 'json'
  })
  //Se establecen algunas variables que nos serviran mas adelante y en donde se mandaran a llamar los campos de la base
  .done(function(data){
          if(isJSONString(data)){
            const result = JSON.parse(data);
            if(result.status){
                console.log(result.dataset);
                var cantidad = [];
                var categoria = []; 
                var color = ['rgba(255, 99, 132, 0.2)', 'rgba(255, 99, 132, 0.2)' ]
                var bordercolor = ['rgba(255, 99, 132, 1)','rgba(255, 99, 132, 1)']
                 //Se verfica que el resultado sea en formato JSON
                  //Aqui es en donde se hace un push para que las variable ya declaradas anteriormente manden a llamar los campos de la base
                    cantidad.push(result.dataset.Cantidad);
                    categoria.push(result.dataset.categoria);
                  //En esta parte se mandan a llamar ya los valores establecidos y los inserta en la grafica
                 var chartdata = {
                     labels: categoria,
                     datasets: [{
                             label: 'Cantidad de productos por sucursal',
                             backgroundColor: color,
                             borderColor: bordercolor,
                             borderWidth: 2,
                             hoverBackgroundColor: color,
                             hoverBorderColor: bordercolor,
                             data: cantidad
                        }]
                 };  
                 console.log(chartdata);
                 //Muestra el grafico y las diferentes opciones para modificarlo 
                 var mostrar = $("#chartsucursal");
                 var grafico = new Chart (mostrar,{
                     type: 'bar',
                     data: chartdata,
                     options: {
                         responsive: true,
                         legend: {
                          labels: {
                           fontColor: "black",
                           fontSize: 15
                          }
                         }
                     }
                 }); 
     
            }
            else{
                alert(result.exception);
            }
          }
          else{
            console.log(data);
          }
      })
      //Si algo falla manda error
      .fail(function(jqXHR){
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
})