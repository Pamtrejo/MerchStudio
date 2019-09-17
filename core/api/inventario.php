<?php
require_once('../../core/helpers/database.php');
require_once('../../core/helpers/validator.php');
require_once('../../core/models/inventario.php');

$accion = $_GET['action'];
session_start();
$inventario = new Inventario;
$result = array('status' => 0, 'exception' => '');
//Se comprueba si existe una petición del sitio web y la acción a realizar, de lo contrario se muestra una página de error
if (isset($_GET['site']) && isset($_GET['action'])) {

    //Se verifica si existe una sesión iniciada como administrador para realizar las operaciones correspondientes
    if ($_GET['site'] == 'dashboard' || true) {
        switch ($_GET['action']) {
            case 'cargarSucursales':
                if ($result['dataset'] = $inventario->cargarSucursalTodas()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'Error al cargar camisetas por sucursal';
                }
            break;
            case 'cargarCamisetasSucursal':
                if (isset($_POST['idSucursal'])) {
                    if ($_POST['idSucursal'] != 'todo') {
                        if ($inventario->establecerIdSucursal($_POST['idSucursal'])) {
                            if ($result['dataset'] = $inventario->cargarCamisetasSucursal()) {
                                $result['status'] = 1;
                            } else {
                                $result['exception'] = 'Error al cargar camisetas por sucursal';
                            }
                        } else {
                            $result['exception'] = 'Codigo sucursal invalido';
                        }
                    }
                    else {
                        if ($result['dataset'] = $inventario->cargarCamisetasSucursalTodas()) {
                            $result['status'] = 1;
                        } else {
                            $result['exception'] = 'Error al cargar camisetas por sucursal';
                        }
                    }
                } else {
                    $result['exception'] = 'Valor vacío';
                }
            break;
            case 'cargarCamisetasTallas':
                if (isset($_POST['idProducto']) && isset($_POST['idSucursal'])) {
                    if ($_POST['idSucursal'] != 'todo') {
                        if ($inventario->establecerIdSucursal($_POST['idSucursal'])) {
                            if ($inventario->fijarIdProducto($_POST['idProducto'])) {
                                if ($result['dataset'] = $inventario->cargarCamisetasTallas()) {
                                    $result['status'] = 1;
                                } else {
                                    $result['exception'] = 'Error al cargar camisetas por sucursal';
                                }
                            } else {
                                $result['exception'] = 'Codigo sucursal invalido';
                            }
                        } else {
                            $result['exception'] = 'Codigo producto invalido';
                        }
                    }
                    else {
                        if ($inventario->fijarIdProducto($_POST['idProducto'])) {
                            if ($result['dataset'] = $inventario->cargarCamisetasTallasT()) {
                                $result['status'] = 1;
                            } else {
                                $result['exception'] = 'Error al cargar camisetas por sucursal';
                            }
                        } else {
                            $result['exception'] = 'Codigo sucursal invalido';
                        }
                    }
                } else {
                    $result['exception'] = 'Valor vacío';
                }
            break;
            case 'restar':
                if (isset($_POST['id']) && isset($_POST['cantidad'])) {
                    if (!empty($_POST['id'])  && !empty($_POST['cantidad']) ) {
                        if ($inventario->establecerIdSucursal($_POST['id'])) {
                            if ($_POST['cantidad'] > 0) {
                                if ($inventario->fijarCantidad($_POST['cantidad'])) {
                                    if ($result['dataset'] = $inventario->restar() ) {
                                        $result['status'] = 1;
                                    } else {
                                        $result['exception'] = 'Error al cargar camisetas por sucursal';
                                    }
                                } else {
                                    $result['exception'] = 'Codigo sucursal invalido';
                                }
                            }
                        } else {
                            $result['exception'] = 'Codigo sucursal invalido';
                        }
                    } else {
                        $result['exception'] = 'Valor vacío';
                    }
                } else {
                    $result['exception'] = 'Valor vacío';
                }
            break;
            case 'createProducto':
                if ($inventario->fijarPrecio($_POST['create_precio'])) {
                    if ($inventario->fijarCategoria($_POST['create_categoria'])) {
                        if ($inventario->fijarDiseno($_POST['create_diseno'])) {
                            if ($inventario->fijarDescripcion($_POST['create_descripcion'])) {
                                $inventario->createProducto();
                                $result['status'] = 1;
                            } else {
                                $result['exception'] = 'Descripción incorrecta';
                            }
                        } else {
                            $result['exception'] = 'Diseño incorrecto';
                        }
                    } else {
                        $result['excpetion'] = 'No se ha seleccionado ninguna categoria';
                    }
                } else {
                    $result['exception'] = 'Precio incorrecto';
                }
                break;
            case 'obtener':
                if ($inventario->fijarIdProducto($_POST['IdProducto'])) {
                    if ($result['dataset'] = $inventario->getProducto()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Producto inexistente';
                    }
                } else {
                    $result['exception'] = 'Producto incorrecto';
                }
                break;
            case 'CategoriasLista':
                if ($result['dataset'] = $inventario->ListaCategorias()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No se pudo obtener las categorias';
                }
                break;
            case 'delete':
                if ($inventario->fijarIdProducto($_POST['idproducto'])) {
                    if ($inventario->getProducto()) {
                        if ($inventario->deleteProducto2()) {
                            if ($inventario->deleteProducto()) {
                                $result['status'] = 1;
                            } else {
                                $result['exception'] = 'Operacion Fallida';
                            }
                        } else {
                            $result['exception'] = 'Operacion Fallida';
                        }
                    } else {
                        $result['exception'] = 'Producto inexistente';
                    }
                } else {
                    $result['exception'] = 'Producto incorrecto';
                }
                break;

            case 'update':
                $_POST = $inventario->validateForm($_POST);
                if ($inventario->fijarIdProducto($_POST['idProducto'])) {
                    if ($inventario->getProducto()) {
                        if ($inventario->fijarPrecio($_POST['update_precio'])) {
                            if ($inventario->fijarCategoria($_POST['update_categoria'])) {
                                if ($inventario->fijarDiseno($_POST['update_diseno'])) {
                                    if ($inventario->fijarDescripcion($_POST['update_descripcion'])) {
                                        if ($inventario->updateProducto()) {
                                            $result['status'] = 1;
                                        }
                                    } else {
                                        $result['exception'] = 'Descripcion incorrecta';
                                    }
                                } else {
                                    $result['exception'] = 'Diseno incorrecta';
                                }
                            } else {
                                $result['exception'] = 'Categoria incorrecta';
                            }
                        } else {
                            $result['exception'] = 'Precio incorrecto';
                        }
                    } else {
                        $result['exception'] = 'Producto inexistente';
                    }
                } else {
                    $result['exception'] = 'Codigo incorrecta';
                }
                break;
            case 'ProductoLista':
                if ($result['dataset'] = $inventario->ListaProducto()) {
                    $result['status'] =1 ;
                } else {
                    $result['exception'] = 'No se pudo obtener el producto';
                }
                break;
            case 'TallaLista':
                if ($result['dataset'] = $inventario->ListaTalla()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No se pudo obtener la talla';
                }
                break;
            case 'SucursalLista':
                if ($result['dataset'] = $inventario->ListaSucursal()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No se pudo obtener la sucursal';
                }
                break;
            case 'createProductoxSucursal':
                if ($inventario->fijarIdProducto($_POST['create_producto'])) {
                    if ($inventario->fijarTalla($_POST['create_talla'])) {
                        if ($inventario->establecerIdSucursal($_POST['create_sucursal'])) {
                            if ($inventario->fijarCantidad($_POST['create_cantidad'])) {
                                $inventario->createProductoxSucursal();
                                $result['status'] = 1;
                            } else {
                                $result['exception'] = 'Ingrese una cantidad';
                            }
                        } else {
                            $result['exception'] = 'No se ha seleccionado ninguna sucursal';
                        }
                    } else {
                        $result['excpetion'] = 'No se ha seleccionado ninguna talla';
                    }
                } else {
                    $result['exception'] = 'Producto incorrecto';
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
} else if ($accion == "buscar") {
    if (isset($_GET['buscar'])) {
        $buscar = $_GET["buscar"];
        if ($result['dataset'] = $inventario->buscarCamisetaPorNombre($buscar)) {
            $result['status'] = 1;
        } else {
            $result['exception'] = 'No se encontro el diseno';
        }
    }
    //Le vamos a decir que si el valor no es vacio entonces que me mande a buscar lo que le pido 
    print(json_encode($result));
} else {
    exit('Recurso denegado');
}
