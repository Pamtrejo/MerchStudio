<?php
require_once('../../core/helpers/database.php');
require_once('../../core/helpers/validator.php');
require_once('../../core/models/vendedor.php');

if (isset($_GET['action'])) {
    session_start();
    $vendedor = new Vendedor();
    $result = array('status' => 0, 'message' => null, 'exception' => null);

    switch ($_GET['action']) {
        case 'cargarVendedor':
            if ($result['dataset'] = $vendedor->readVendedor()){
                $result['status'] = 1;
            } else {
                $result['exception'] = 'Error al cargar sucursal';
            }
        break;
        case 'search':
            $_POST = $vendedor->validateForm($_POST);
            if ($_POST['buscar'] != '') {
                if ($result['dataset'] = $vendedor->searchVendedor($_POST['buscar'])) {
                    $result['status'] = 1;
                    $rows = count($result['dataset']);
                    if ($rows > 1) {
                        $result['message'] = 'Se encontraron '.$rows.' coincidencias';
                    } else {
                        $result['message'] = 'Solo existe una coincidencia';
                    }
                } else {
                    $result['exception'] = 'No hay coincidencias';
                }
            } else {
                $result['exception'] = 'Ingrese un valor para buscar';
            }
        break;
        case 'create':
            $_POST = $vendedor->validateForm($_POST);
            if ($vendedor->setNombre($_POST['create_nombre'])) {
                if($vendedor->setTelefono($_POST['create_telefono'])){
                    if ($vendedor->createVendedor()) {
                        $result['status'] = 1;
                        $result['message'] = 'Vendedor creado';
                    } else {
                        $result['exception'] = 'Operación fallida';
                    }
                } else {
                    $result['exception'] = 'Telefono incorrecto';
                }
            } else {
                $result['exception'] = 'Vendedor incorrecto';
            }
        break;
        case 'get':
                if ($vendedor->setId($_POST['IdVendedor'])) {
                    if ($result['dataset'] = $vendedor->getVendedor1()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Sucursal inexistente';
                    }
                } else {
                    $result['exception'] = 'Sucursal incorrecta';
                }
        break;
        case 'update':
                $_POST = $vendedor->validateForm($_POST);
				if ($vendedor->setId($_POST['IdVendedor'])) {
					if ($vendedor->getVendedor1()) {
		                if ($vendedor->setNombre($_POST['update_nombre'])) {
                            if ($vendedor->setTelefono($_POST['update_telefono'])) {
								if ($vendedor->updateVendedor()) {
                                    $result['status'] = 1;
                                    $result['message'] = 'Vendedor modificada correctamente';
								} else {
								    $result['exception'] = 'Operación fallida';
								}
						    } else {
                                $result['exception'] = 'Telefono Incorrecto';
                            }
                        } else {
                            $result['exception'] = 'Vendedor Incorrecto';
                        }
                    } else{
                        $result['exception'] = 'Nombre de Vendedor Incorrecto';
                    }
                } else{
                    $result['exception'] = 'Vendedor inexistente';
                }
        break;
        case 'delete':
				if ($vendedor->setId($_POST['IdVendedor'])) {
					if ($vendedor->getVendedor1()) {
						if ($vendedor->deleteVendedor()) {
							$result['status'] = 1;
						} else {
							$result['exception'] = 'Operación fallida';
						}
					} else {
						$result['exception'] = 'Vendedor inexistente';
					}
				} else {
					$result['exception'] = 'Vendedor incorrecto';
				}
        break;
        case 'VendedorLista':
                if ($result['dataset'] = $vendedor->VendedorLista()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No se pudo obtener el vendedor';
                }
                break;
        case 'vendedores':
                $vendedor->setId($_POST['id']);
                if ($result['dataset'] = $vendedor->vendedor()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No se pudo obtener la cantidad';
                }
                break;
        default:
		exit('Acción no disponible');
		}
    print(json_encode($result));
    } else {
        exit('Recurso denegado');
    }
    ?>