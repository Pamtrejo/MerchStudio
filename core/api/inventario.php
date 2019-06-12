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
	if ( $_GET['site'] == 'dashboard' || true) {
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
            case 'crear':
                $_POST= $inventario->valideForm($_POST);
                if($inventario->fijarPrecio($_POST['create_precio'])){
                    if(isset($_POST['create_categoria'])){
                        if ($inventario->fijarCategoria($_POST['create_categoria'])){
                            if($inventario->fijarDiseno($_POST['create_diseno'])){
                                if($inventario->fijarDescripcion($_POST['create_descripcion'])){
                                    if($inventario->createProducto()){
                                        $result['status']=1;
                                    }else{
                                        $result['exception']='No se puede realizar la operacion';
                                    }
                                }else{
                                    $result['exception']='Descripcion incorrecta';
                                }
                            }else{
                                $result['exception']='No ingreso diseno';
                            }
                        } else{
                            $result['exception']='Categoria  incorrecta';
                        }
                    }else{
                        $result['exception']='Seleccione categoria';
                    }
                }else{
                    $result['exception']='Precio incorrecto';
                }break;
            
                case 'obtener':
                if($inventario->fijarIdProducto($_POST['IdProducto'])){
                    if($result['dataset']=$inventario->recibirIdProducto()){
                        $result['status']=1;
                    }else{
                        $result['exception']='Producto inexistente';
                    }
                }else{
                    $result['exception']='Producto incorrecto';
                }
                break;
            default:
                exit('Acción no disponible');
    	}
    } else {
        exit('Acceso no disponible');
    }
    print(json_encode($result));
    //Buscador
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
    //Le vamos a decir que si el valor no es vacio entonces que me mande a buscar lo que le pido 
    print(json_encode($result));
} 
else {
	exit('Recurso denegado');
}

?>