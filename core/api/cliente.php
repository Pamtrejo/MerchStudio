<?php
require_once('../../core/helpers/database.php');
require_once('../../core/helpers/validator.php');
require_once('../../core/models/cliente.php');

if (isset($_GET['action'])) {
    session_start();
    $cliente = new Cliente;
    $result = array('status' => 0, 'message' => null, 'exception' => null);

    switch ($_GET['action']) {
        case 'cargarCliente':
        
            if ($result['dataset'] = $cliente->readCliente()){
                $result['status'] = 1;
            } else {
                $result['exception'] = 'Error al cargar cliente';
            }
        break;
        case 'search':
            $_POST = $cliente->validateForm($_POST);
            if ($_POST['buscar'] != '') {
                if ($result['dataset'] = $cliente->searchCliente($_POST['buscar'])) {
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
            $_POST = $cliente->validateForm($_POST);
            if ($cliente->setNombre($_POST['create_nombre'])) {
                if($cliente->setDui($_POST['create_dui'])){
                    if($cliente->setDireccion($_POST['create_direccion'])){
                        if ($cliente->createCliente()) {
                            $result['status'] = 1;
                            $result['message'] = 'Cliente creado';
                        } else {
                            $result['exception'] = 'Operación fallida';
                        }
                    } else {
                        $result['exception'] = 'Direccion incorrecta';
                    }
                } else {
                    $result['exception'] = 'Dui incorrecto';
                }
            } else {
                $result['exception'] = 'Cliente incorrecto';
            }
            break;
            case 'get':
                if ($cliente->setId($_POST['IdCliente'])) {
                    if ($result['dataset'] = $cliente->getCliente1()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Cliente inexistente';
                    }
                } else {
                    $result['exception'] = 'Cliente incorrecta';
                }
            break;
            case 'update':
                $_POST = $cliente->validateForm($_POST);
				if ($cliente->setId($_POST['IdCliente'])) {
					if ($cliente->getCliente1()) {
		                if ($cliente->setNombre($_POST['update_nombre'])) {
                            if ($cliente->setDui($_POST['update_dui'])) {
                                if ($cliente->setDireccion($_POST['update_direccion'])) {
								    if ($cliente->updateCliente()) {
                                        $result['status'] = 1;
                                        $result['message'] = 'Cliente modificado correctamente';
								    } else {
									    $result['exception'] = 'Operación fallida';
								    }
						        } else {
                                    $result['exception'] = 'Direccion Incorrecta';
                                }
					        } else{
                                $result['exception'] = 'Dui Incorrecta';
                            }
                        } else {
                            $result['exception'] = 'Cliente Incorrecto';
                        }
                    } else{
                        $result['exception'] = 'Nombre del Cliente Incorrecto';
                    }
                } else{
                    $result['exception'] = 'Cliente inexistente';
                }
            break;
                case 'delete':
				if ($cliente->setId($_POST['IdCliente'])) {
					if ($cliente->getCliente1()) {
						if ($cliente->deleteCliente()) {
                            $result['status'] = 1;
                            $result['message']= 'Se ha eliminado el cliente';
						} else {
							$result['exception'] = 'Operación fallida';
						}
					} else {
						$result['exception'] = 'Cliente inexistente';
					}
				} else {
					$result['exception'] = 'Cliente incorrecto';
				}
                break;
                //grafico
            case 'ClienteLista':
                if ($result['dataset'] = $cliente->ClienteLista()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No se pudo obtener la sucursal';
                }
                break;
            case 'cliente':
                $cliente->setId($_POST['id']);
                if ($result['dataset'] = $cliente->cliente()) {
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