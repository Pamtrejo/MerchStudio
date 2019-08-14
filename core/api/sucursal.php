<?php
require_once('../../core/helpers/database.php');
require_once('../../core/helpers/validator.php');
require_once('../../core/models/sucursal.php');

if (isset($_GET['action'])) {
    session_start();
    $sucursal = new Sucursal;
    $result = array('status' => 0, 'message' => null, 'exception' => null);

    switch ($_GET['action']) {
        case 'cargarSucursal':
        
            if ($result['dataset'] = $sucursal->readSucursal()){
                $result['status'] = 1;
            } else {
                $result['exception'] = 'Error al cargar sucursal';
            }
        break;
        case 'search':
            $_POST = $sucursal->validateForm($_POST);
            if ($_POST['buscar'] != '') {
                if ($result['dataset'] = $sucursal->searchSucursal($_POST['buscar'])) {
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
            $_POST = $sucursal->validateForm($_POST);
            if ($sucursal->setSucursal($_POST['create_sucursal'])) {
                if($sucursal->setDireccion($_POST['create_direccion'])){
                    if($sucursal->setTelefono($_POST['create_telefono'])){
                        if ($sucursal->createSucursal()) {
                            $result['status'] = 1;
                            $result['message'] = 'Sucursal creada';
                        } else {
                            $result['exception'] = 'Operación fallida';
                        }
                    } else {
                        $result['exception'] = 'Telefono incorrecto';
                    }
                } else {
                    $result['exception'] = 'Direccion incorrecta';
                }
            } else {
                $result['exception'] = 'Sucursal incorrecta';
            }
            break;
            case 'get':
                if ($sucursal->setId($_POST['IdSucursal'])) {
                    if ($result['dataset'] = $sucursal->getSucursal1()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Sucursal inexistente';
                    }
                } else {
                    $result['exception'] = 'Sucursal incorrecta';
                }
            break;
            case 'update':
                $_POST = $sucursal->validateForm($_POST);
				if ($sucursal->setId($_POST['IdSucursal'])) {
					if ($sucursal->getSucursal1()) {
		                if ($sucursal->setSucursal($_POST['update_sucursal'])) {
                            if ($sucursal->setDireccion($_POST['update_direccion'])) {
                                if ($sucursal->setTelefono($_POST['update_telefono'])) {
								    if ($sucursal->updateSucursal()) {
                                        $result['status'] = 1;
                                        $result['message'] = 'Sucursal modificada correctamente';
								    } else {
									    $result['exception'] = 'Operación fallida';
								    }
						        } else {
                                    $result['exception'] = 'Telefono Incorrecto';
                                }
					        } else{
                                $result['exception'] = 'Direccion Incorrecta';
                            }
                        } else {
                            $result['exception'] = 'Sucursal Incorrecta';
                        }
                    } else{
                        $result['exception'] = 'Nombre de Sucursal Incorrecta';
                    }
                } else{
                    $result['exception'] = 'Sucursal inexistente';
                }
            break;
                case 'delete':
				if ($sucursal->setId($_POST['IdSucursal'])) {
					if ($sucursal->getSucursal1()) {
						if ($sucursal->deleteSucursal()) {
							$result['status'] = 1;
						} else {
							$result['exception'] = 'Operación fallida';
						}
					} else {
						$result['exception'] = 'Sucursal inexistente';
					}
				} else {
					$result['exception'] = 'Sucursal incorrecto';
				}
                break;
                case 'SucursalLista':
                if ($result['dataset'] = $sucursal->ListaSucursal()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No se pudo obtener la sucursal';
                }
                break;
                case 'readCantidadProductoSucursal':
                if ($result['dataset'] = $sucursal->CantidadProductoSucursal()) {
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