// Constante para establecer la ruta y parámetros de comunicación con la API
const api= '../../core/api/inventario.php?site=dashboard&action=';

$(document).ready(function()
{
    // Se muestra un gráfico
    graficoCategorias();
    graficoVentaporFecha();
    graficoTallasVendidas();
    graficoCategoriaVendida();
    graficoCategoriaVenta();
})

var imagenes=new Array(
    ['../../resources/img/login/1.jpg','http://www.lawebdelprogramador.com/cursos/'],
    ['../../resources/img/login/2.jpg','http://www.lawebdelprogramador.com/foros/'],
    ['../../resources/img/login/3.jpg','http://www.lawebdelprogramador.com/pdf/'],
    ['../../resources/img/login/4.jpg','http://www.lawebdelprogramador.com/utilidades/']
);
var contador=0;

function rotarImagenes()
    {
        // cambiamos la imagen y la url
        contador++
        document.getElementById("imagen").src=imagenes[contador%imagenes.length][0];
        document.getElementById("link").href=imagenes[contador%imagenes.length][1];
    }

onload=function()
    {
        // Cargamos una imagen aleatoria
        rotarImagenes();
 
        // Indicamos que cada 5 segundos cambie la imagen
        setInterval(rotarImagenes,3000);
    }

    

//funcion para los iconos flotantes
$(window).scroll(function(){
    if($(document).scrollTop()>=$(document).height()/5)
        $("#spopup").show("slow");else $("#spopup").hide("slow");
});
function closeSPopup(){
    $('#spopup').hide('slow');
}    
// Función para generar un gráfico de la cantidad de productos por categoría
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
                let categoria = [];
                let cantidad = [];
                result.dataset.forEach(function(row){
                    categoria.push(row.Categoria);
                    cantidad.push(row.cantidad);
                });
                const context = $('#chart');
                const chart = new Chart(context, {
                    type: 'bar',
                    data: {
                        labels: categoria,
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
function graficoVentaporFecha()
{
    $.ajax({
        url: api + 'VentaporFecha',
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
                    categorias.push(row.fecha);
                    cantidad.push(row.cantidad);
                });
                const context = $('#chart2');
                const chart = new Chart(context, {
                    type: 'line',
                    data: {
                        datasets: [{
                            label: 'Venta',
                            data: cantidad,
                            backgroundColor: 'rgba(189, 155, 192, 0.6)',
                            borderColor: 'rgba(94, 26, 100, 1)',
                            borderWidth: 1
                        }],
                        labels: categorias,
                    },
                    options: {
                        
                        title: {
                            display: true,
                            text: 'Venta de los ultimos 3 dias'
                        },
                        
                    }
                });
            } else {
                $('#chart2').remove();
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
function graficoTallasVendidas()
{
    $.ajax({
        url: api + 'TallasVendidas',
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
                let tallas = [];
                let cantidad = [];
                result.dataset.forEach(function(row){
                    tallas.push(row.Tallas);
                    cantidad.push(row.Cantidad);
                });
                const context = $('#chart3');
                const chart = new Chart(context, {
                    type: 'bar',
                    data: {
                        datasets: [{
                            label: 'Talla',
                            data: cantidad,
                            backgroundColor: 'rgba(189, 155, 192, 0.6)',
                            borderColor: 'rgba(94, 26, 100, 1)',
                            borderWidth: 1
                        }],
                        labels: cantidad,
                    },
                    options: {
                        
                        title: {
                            display: true,
                            text: 'Tallas mas vendidas'
                        },
                        
                    }
                });
            } else {
                $('#chart3').remove();
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
function graficoCategoriaVendida()
{
    $.ajax({
        url: api + 'CategoriasVendidas',
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
                let categoria = [];
                let cantidad = [];
                result.dataset.forEach(function(row){
                    categoria.push(row.Categoria);
                    cantidad.push(row.Cantidad);
                });
                const context = $('#chart4');
                const chart = new Chart(context, {
                    type: 'line',
                    data: {
                        datasets: [{
                            label: 'Categoria',
                            data: cantidad,
                            backgroundColor: 'rgba(189, 155, 192, 0.6)',
                            borderColor: 'rgba(94, 26, 100, 1)',
                            borderWidth: 1
                        }],
                        labels: categoria,
                    },
                    options: {
                        
                        title: {
                            display: true,
                            text: 'Categorias mas vendidas'
                        },
                        
                    }
                });
            } else {
                $('#chart4').remove();
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
function graficoCategoriaVenta()
{
    $.ajax({
        url: api + 'CategoriasVentas',
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
                let cantidad = [];
                let categoria = [];
                result.dataset.forEach(function(row){
                    cantidad.push(row.cantidad);
                    categoria.push(row.Categoria);
                });
                const context = $('#chart5');
                const chart = new Chart(context, {
                    type: 'bar',
                    data: {
                        datasets: [{
                            label: 'Venta',
                            data: cantidad,
                            backgroundColor: 'rgba(189, 155, 192, 0.6)',
                            borderColor: 'rgba(94, 26, 100, 1)',
                            borderWidth: 1
                        }],
                        labels: categoria,
                    },
                    options: {
                        
                        title: {
                            display: true,
                            text: 'Venta por categoria'
                        },
                        
                    }
                });
            } else {
                $('#chart5').remove();
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