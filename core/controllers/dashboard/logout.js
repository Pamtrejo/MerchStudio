const apiCerrar = '../../core/api/usuarios.php?site=dashboard&action=';

function signOff()
{
    swal({
        title: 'Advertencia',
        text: '¿Quiere cerrar la sesión?',
        icon: 'warning',
        buttons: ['Cancelar', 'Aceptar'],
        closeOnClickOutside: false,
        closeOnEsc: false
    })
    .then(function(value){
        if (value) {
            location.href = apiCerrar + 'logout';
        } else {
            swal({
                title: 'Enhorabuena',
                text: 'Continúe con la sesión...',
                icon: 'info',
                button: 'Aceptar',
                closeOnClickOutside: false,
                closeOnEsc: false
            });
        }
    });
}