//ESTE CODIGO SE EJECUTA CUANDO CARGA LA PAGINA 
$(document).ready(() => {
    //CARGA LA INFORMACION DE LA API EN LA VISTA
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
const apiInventario = '../../core/api/inventario.php?site=dashboard&action=';


//Función para obtener y mostrar los registros disponibles
const cargarTabla = async (idSucursal) => {
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
                    <td><button type="button" class="btn btn-outline-primary">Modificar</button></td>
                    <td><button type="button" class="btn btn-outline-primary">Eliminar</button></td>
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

//En este apartado estamos realizando una funcion para que el buscador mande a llamar algo al servidor.

$(function(){
    console.log('jQuery esta trabajando');

    $('#buscar').keyup(function(){
        let buscar= $('#buscar').val();
        console.log(buscar);
        $.ajax({
            url:'../api/inventario.php',
            type:'POST',
            data: { buscar},
            success: function(response){
                console.log(response);  
            }
        })
    })
});