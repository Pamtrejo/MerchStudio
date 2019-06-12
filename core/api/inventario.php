<?php
require_once('../../core/helpers/database.php');
require_once('../../core/helpers/validator.php');
require_once('../../core/models/inventario.php');

$accion= $_GET['action'];
session_start();
    $inventario = new Inventario;
    $result = array('status' => 0, 'exception' => '');
//Se comprueba si existe una petición del sitio web y la acción a realizar, de lo contrario se muestra una página de error
if (isset($_GET['site']) && isset($_GET['action']) ) {
    
    //Se verifica si existe una sesión iniciada como administrador para realizar las operaciones correspondientes
	if ( $_GET['site'] == 'dashboard') {
        switch ($_GET['action']) {
            case 'cargarCamisetasSucursal':
                if ($inventario->establecerIdSucursal($_POST['idSucursal'])) {
                    if ($result['dataset'] = $inventario->cargarCamisetasSucursal()){
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Error al cargar camisetas por sucursal';
                    }
                } else {
                    $result['exception'] = 'Codigo sucursal invalido';
                }
                break;
            default:
                exit('Acción no disponible');
    	}
    } else {
        exit('Acceso no disponible');
    }
	print(json_encode($result));
}else if($accion=="buscar"){
    $buscar = $_GET["buscar"];
    if ($inventario->establecerIdSucursal($_POST['sucursal'])) {
        if ($result['dataset'] = $inventario->buscarCamisetaPorNombre($buscar)){
            $result['status'] = 1;
        } else {
            $result['exception'] = 'No se encontro el diseno';
        }
    } else {
        $result['exception'] = 'Codigo sucursal invalido';
    }
    print(json_encode($result));
} else {
	exit('Recurso denegado');
}

//Buscador

//Le vamos a decir que si el valor no es vacio entonces que me mande a buscar lo que le pido 

?>