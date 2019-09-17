<?php
require_once('../../core/helpers/database.php');
require_once('../../core/helpers/validator.php');
require_once('../../core/models/rol.php');

if (isset($_GET['action'])) {
    session_start();
    $rol = new Rol;
    $result = array('status' => 0, 'message' => null, 'exception' => null);

    switch ($_GET['action']) {
        case 'cargarRol':
            if ($result['dataset'] = $rol->readRol()){
                $result['status'] = 1;
            } else {
                $result['exception'] = 'Error al cargar sucursal';
            }
        break;
        case 'search':
            $_POST = $rol->validateForm($_POST);
            if ($_POST['buscar'] != '') {
                if ($result['dataset'] = $rol->searchRol($_POST['buscar'])) {
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
            $_POST = $rol->validateForm($_POST);
            if ($rol->setRol($_POST['rol'])) {
                if($rol->setAtributos($_POST['nombrerol'])){
                        if ($rol->createRol()) {
                            $result['status'] = 1;
                            $result['message'] = 'Rol creado';
                        } else {
                            $result['exception'] = 'Operación fallida';
                        }
                    
                } else {
                    $result['exception'] = 'ingrese atributo';
                }
            } else {
                $result['exception'] = 'Rol incorrecto';
            }
            break;
            case 'get':
                if ($rol->setId($_POST['IdRol'])) {
                    if ($result['dataset'] = $rol->getRol()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Sucursal inexistente';
                    }
                } else {
                    $result['exception'] = 'Sucursal incorrecta';
                }
            break;
            case 'update':
                $_POST = $rol->validateForm($_POST);
				if ($rol->setId($_POST['IdRol'])) {
		                if ($rol->setRol($_POST['rol'])) {
                            if ($rol->setAtributos($_POST['nombrerol'])) {
								    if ($rol->updateRol()) {
                                        $result['status'] = 1;
                                        $result['message'] = 'Rol modificado correctamente';
								    } else {
									    $result['exception'] = 'Operación fallida';
								    }
					        } else{
                                $result['exception'] = 'Atributo Incorrecta';
                            }
                        } else {
                            $result['exception'] = 'Rol Incorrecta';
                        }
                } else{
                    $result['exception'] = 'rol inexistente';
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
                $sucursal->setId($_POST['id']);
                if ($result['dataset'] = $sucursal->CantidadProductoSucursal()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No se pudo obtener la cantidad';
                }
                break;
            case 'CategoriaLista':
                if ($result['dataset'] = $sucursal->CategoriaLista()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No se pudo obtener la sucursal';
                }
                break;
            case 'Cantidad':
                $sucursal->setId($_POST['id']);
                if ($result['dataset'] = $sucursal->Cantidad()) {
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