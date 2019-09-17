const apiRol = '../../core/api/rol.php?site=dashboard&action=';
let dato = '000000000'
let estado=false;
$(document).ready(() => {
    //CARGA LA INFORMACION DE LA API EN LA VISTA
    cargarTabla();
    $('#nombrerol').val(dato);
})
var rol;
//Función para obtener y mostrar los registros disponibles
const cargarTabla = async () => {
    
    //Con el id que tenés de sucursal, consultar el nombre, lo guardas en una variable y lo imprimis en la tabla
    const response = await $.ajax({
        url: apiRol + 'cargarRol',
        type: 'post',
        data: {},
        datatype: 'json'
    }).fail(function (jqXHR) {
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
    if (isJSONString(response)) {
        //console.log(response);
        const result = JSON.parse(response);
        //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
        if (result.status == 1) {
            let contenidoTabla = ''
            //Aqui recorremos el arreglo
            //Item es cada elemento del arreglo
            result.dataset.map( item => {
                //Por cada nombre del campo, saco una variable constante
                const { IdRol, TipoRol, atributos} = item
                
                //Le agregamos una fila al contenido de la tabla
                contenidoTabla += `
                <tr id="${IdRol}">
                    <th>${TipoRol}</th>
                    <td><button onclick="deleteModal(${IdRol})" type="button" class="btn btn-outline-primary">Eliminar</button></td>
                    <td><button onclick="update(${IdRol},'${TipoRol}','${atributos}')" type="button" class="btn btn-outline-primary">Editarr</button></td>
                </tr>
                `
            })
            $('#tbody-read-rol').html(contenidoTabla)
        } else {
            console.log(result.exception)
        }
    } else {
        console.log(response);
        
    }
}

$('#crear_roles').submit(function () {
    event.preventDefault();
    let roll;
    if(estado){
        roll='update'
    }else{
        roll='create'
    }
    $.ajax({

        url: apiRol + roll,
        type: 'post',
        data: $('#crear_roles').serialize() + '&IdRol='+rol,
        datatype: 'json',
    })
        .done(function (response) {
            // Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
            if (isJSONString(response)) {
                const result = JSON.parse(response);
                // Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
                if (result.status) {
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
function cambiar(e, id){
    dato = $('#nombrerol').val()
    if($('#'+ id).is(':checked')){
        r='1'
    }else{
        r='0'
    }

    let d= [dato[0],dato[1],dato[2],dato[3],dato[4],dato[5],dato[6],dato[7],dato[8]];
    let len= d.length
    for(let i=0; i < len; i++){
        if(i == e){
            d[i]=r
        }
    }
    dato =''
    for(let i = 0; i <len; i++){
        dato = dato +''+ d[i];
        
    }
    $('#nombrerol').val(dato);
}

function update(id, nombrerol,atributos){
    rol = id
    $('#rol').val(nombrerol)
    $('#nombrerol').val(atributos)
    $('#inventario').attr("checked",!! +atributos[0])
    $('#sucursales').attr("checked",!! +atributos[1])
    $('#vendedores').attr("checked",!! +atributos[2])
    $('#usuarios').attr("checked",!! +atributos[3])
    $('#clientes').attr("checked",!! +atributos[4])
    $('#tallas').attr("checked",!! +atributos[5])
    $('#roles1').attr("checked",!! +atributos[6])
    $('#categorias').attr("checked",!! +atributos[7])
    $('#estadisticas').attr("checked",!! +atributos[8])
}

function cambiarestado(e){
    estado=e
}