$('#myTab a[href="#crear]').tab('show')
$('#myTab a[href="#iniciar]').tab('show')

var imagenes=new Array(
    ['../../resources/img/parte1.1.jpg'],
    ['../../resources/img/img1.0.jpg'],
    ['../../resources/img/parte2.jpg'],
    ['../../resources/img/parte2.5.jpg']
);

/**
 * Funcion para cambiar la imagen
 */
function rotarImagenes()
{
    // obtenemos un numero aleatorio entre 0 y la cantidad de imagenes que hay
    var index=Math.floor((Math.random()*imagenes.length));
    // cambiamos la imagen y la url
    document.getElementById("imagen").src=imagenes[index][0];   
}

/**
 * Función que se ejecuta una vez cargada la página
 */
onload=function()
{
    // Cargamos una imagen aleatoria
    rotarImagenes();

    // Indicamos que cada 2 segundos cambie la imagen
    setInterval(rotarImagenes,2000);
}

