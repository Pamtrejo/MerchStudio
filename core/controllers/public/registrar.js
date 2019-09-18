const apiRegistrar = '../../core/api/cliente.php?site=dashboard&action=';

$(document).ready(function()
{
    grecaptcha.ready(function() {
        grecaptcha.execute('6Leja7UUAAAAANNYm7YxNV2UxykCDIv_OnGwuqpB', {action: 'homepage'})
        .then(function(token){
         $('#token').val(token)  
        });
        console.log(token)
    });
})

$('#form-registrar').submit(function()
{
    event.preventDefault();
    $.ajax({
        url: apiRegistrar + 'register',
        type: 'post',
        data: $('#form-registrar').serialize(),
        datatype: 'json'
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const dataset = JSON.parse(response);
            //Se comprueba si la respuesta es satisfactoria, sino se muestra la excepción
            if (dataset.status) {
                sweetAlert(1, 'Usuario registrado correctamente', 'index.php');
            } else {
                sweetAlert(2, dataset.exception, null);
            }
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
});