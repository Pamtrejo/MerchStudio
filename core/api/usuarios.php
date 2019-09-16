<?php
require_once('../../core/helpers/database.php');
require_once('../../core/helpers/validator.php');
require_once('../../core/models/usuarios.php');

//Se comprueba si existe una petición del sitio web y la acción a realizar, de lo contrario se muestra una página de error
if (isset($_GET['site']) && isset($_GET['action'])) {
    session_start();
    $usuario = new Usuarios;
    $result = array('status' => 0, 'exception' => '');
    //Se verifica si existe una sesión iniciada como administrador para realizar las operaciones correspondientes
    if (isset($_SESSION['idUsuario']) && $_GET['site'] == 'dashboard') {
        switch ($_GET['action']) {
            case 'logout':
                if (session_destroy()) {
                    header('location: ../../views/dashboard/');
                } else {
                    header('location: ../../views/dashboard/main.php');
                }
                break;
            case 'readProfile':
                if ($usuario->setId($_SESSION['idUsuario'])) {
                    if ($result['dataset'] = $usuario->getUsuario()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Usuario inexistente';
                    }
                } else {
                    $result['exception'] = 'Usuario incorrecto';
                }
                break;
            case 'editProfile':
                if ($usuario->setId($_SESSION['idUsuario'])) {
                    if ($usuario->getUsuario()) {
                        $_POST = $usuario->validateForm($_POST);
                        if ($usuario->setNombres($_POST['profile_nombres'])) {
                            if ($usuario->setApellidos($_POST['profile_apellidos'])) {
                                if ($usuario->setCorreo($_POST['profile_correo'])) {
                                    if ($usuario->setAlias($_POST['profile_alias'])) {
                                        if ($usuario->updateUsuario()) {
                                            $_SESSION['aliasUsuario'] = $_POST['profile_alias'];
                                            $result['status'] = 1;
                                        } else {
                                            $result['exception'] = 'Operación fallida';
                                        }
                                    } else {
                                        $result['exception'] = 'Alias incorrecto';
                                    }
                                } else {
                                    $result['exception'] = 'Correo incorrecto';
                                }
                            } else {
                                $result['exception'] = 'Apellidos incorrectos';
                            }
                        } else {
                            $result['exception'] = 'Nombres incorrectos';
                        }
                    } else {
                        $result['exception'] = 'Usuario inexistente';
                    }
                } else {
                    $result['exception'] = 'Usuario incorrecto';
                }
                break;
            case 'password':
                if ($usuario->setId($_SESSION['idUsuario'])) {
                    $_POST = $usuario->validateForm($_POST);
                    if ($_POST['contrasena'] == $_POST['confirmar']) {
                        if ($usuario->setContrasena($_POST['contrasena'])) {
                            if ($usuario->checkPassword()) {
                                if ($_POST['clave_nueva_1'] == $_POST['clave_nueva_2']) {
                                    if ($usuario->setClave($_POST['clave_nueva_1'])) {
                                        if ($usuario->changePassword()) {
                                            $result['status'] = 1;
                                        } else {
                                            $result['exception'] = 'Operación fallida';
                                        }
                                    } else {
                                        $result['exception'] = 'Clave nueva menor a 6 caracteres';
                                    }
                                } else {
                                    $result['exception'] = 'Claves nuevas diferentes';
                                }
                            } else {
                                $result['exception'] = 'Clave actual incorrecta';
                            }
                        } else {
                            $result['exception'] = 'Clave actual menor a 6 caracteres';
                        }
                    } else {
                        $result['exception'] = 'Claves actuales diferentes';
                    }
                } else {
                    $result['exception'] = 'Usuario incorrecto';
                }
                break;
            case 'read':
                if ($result['dataset'] = $usuario->readUsuarios()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No hay usuarios registrados';
                }
                break;
            case 'search':
                $_POST = $usuario->validateForm($_POST);
                if ($_POST['busqueda'] != '') {
                    if ($result['dataset'] = $usuario->searchUsuarios($_POST['busqueda'])) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'No hay coincidencias';
                    }
                } else {
                    $result['exception'] = 'Ingrese un valor para buscar';
                }
                break;
            case 'create':
                $_POST = $usuario->validateForm($_POST);
                if ($usuario->setNombres($_POST['nombres'])) {
                    if ($usuario->setApellidos($_POST['create_apellidos'])) {
                        if ($usuario->setCorreo($_POST['create_correo'])) {
                            if ($usuario->setAlias($_POST['create_alias'])) {
                                if ($_POST['contrasena'] == $_POST['confirmar']) {
                                    if ($usuario->setClave($_POST['contrasena'])) {
                                        if ($usuario->createUsuario()) {
                                            $result['status'] = 1;
                                        } else {
                                            $result['exception'] = 'Operación fallida';
                                        }
                                    } else {
                                        $result['exception'] = 'Clave menor a 8 caracteres';
                                    }
                                } else {
                                    $result['exception'] = 'Claves diferentes';
                                }
                            } else {
                                $result['exception'] = 'Alias incorrecto';
                            }
                        } else {
                            $result['exception'] = 'Correo incorrecto';
                        }
                    } else {
                        $result['exception'] = 'Apellidos incorrectos';
                    }
                } else {
                    $result['exception'] = 'Nombres incorrectos';
                }
                break;
            case 'get':
                if ($usuario->setId($_POST['id_usuario'])) {
                    if ($result['dataset'] = $usuario->getUsuario()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Usuario inexistente';
                    }
                } else {
                    $result['exception'] = 'Usuario incorrecto';
                }
                break;
            case 'update':
                $_POST = $usuario->validateForm($_POST);
                if ($usuario->setId($_POST['id_usuario'])) {
                    if ($usuario->getUsuario()) {
                        if ($usuario->setNombres($_POST['update_nombres'])) {
                            if ($usuario->setApellidos($_POST['update_apellidos'])) {
                                if ($usuario->setCorreo($_POST['update_correo'])) {
                                    if ($usuario->setAlias($_POST['update_alias'])) {
                                        if ($usuario->updateUsuario()) {
                                            $result['status'] = 1;
                                        } else {
                                            $result['exception'] = 'Operación fallida';
                                        }
                                    } else {
                                        $result['exception'] = 'Alias incorrecto';
                                    }
                                } else {
                                    $result['exception'] = 'Correo incorrecto';
                                }
                            } else {
                                $result['exception'] = 'Apellidos incorrectos';
                            }
                        } else {
                            $result['exception'] = 'Nombres incorrectos';
                        }
                    } else {
                        $result['exception'] = 'Usuario inexistente';
                    }
                } else {
                    $result['exception'] = 'Usuario incorrecto';
                }
                break;
            case 'delete':
                if ($_POST['id_usuario'] != $_SESSION['idUsuario']) {
                    if ($usuario->setId($_POST['id_usuario'])) {
                        if ($usuario->getUsuario()) {
                            if ($usuario->deleteUsuario()) {
                                $result['status'] = 1;
                            } else {
                                $result['exception'] = 'Operación fallida';
                            }
                        } else {
                            $result['exception'] = 'Usuario inexistente';
                        }
                    } else {
                        $result['exception'] = 'Usuario incorrecto';
                    }
                } else {
                    $result['exception'] = 'No se puede eliminar a sí mismo';
                }
                break;
            default:
                exit('Acción no disponible login');
        }
    } else if ($_GET['site'] == 'dashboard') {
        switch ($_GET['action']) {
            case 'read':
                if ($usuario->readUsuarios()) {
                    $result['status'] = 1;
                    $result['exception'] = 'Existe al menos un usuario registrado';
                } else {
                    $result['status'] = 2;
                    $result['exception'] = 'No existen usuarios registrados';
                }
                break;
            case 'register':
                $_POST = $usuario->validateForm($_POST);
                if ($usuario->setRol(1)) {
                    if ($usuario->setNombres($_POST['nombres'])) {
                        if ($usuario->setApellidos($_POST['apellidos'])) {
                            if ($usuario->setCorreo($_POST['correo'])) {
                                if ($usuario->setNomUsuario($_POST['usuario'])) {
                                    if ($usuario->setVencimiento($_POST['fecha'])) {
                                        if ($_POST['contrasena'] == $_POST['confirmar']) {
                                            if ($usuario->setContrasena($_POST['contrasena'])) {
                                                if ($usuario->createUsuario()) {
                                                    $result['status'] = 1;
                                                } else {
                                                    $result['exception'] = 'Operación fallida';
                                                }
                                            } else {
                                                $result['exception'] = 'Clave menor a 8 caracteres';
                                            }
                                        } else {
                                            $result['exception'] = 'Claves diferentes';
                                        }
                                    } else {
                                        $result['exception'] = 'Fecha incorrecta';
                                    }
                                } else {
                                    $result['exception'] = 'Alias incorrecto';
                                }
                            } else {
                                $result['exception'] = 'Correo incorrecto';
                            }
                        } else {
                            $result['exception'] = 'Apellidos incorrectos';
                        }
                    } else {
                        $result['exception'] = 'Nombres incorrectos';
                    }
                } else {
                    $result['exception'] = 'Rol incorrecto';
                }
                break;
                case 'login':
                $_POST = $usuario->validateForm($_POST);
                if ($usuario->setNomUsuario($_POST['alias'])) {
                    if ($usuario->checkNomUsuario()) {
                        if ($usuario->setContrasena($_POST['contrasena'])) {
                            if ($usuario->checkPassword()) {
                                $_SESSION['IdUsuario'] = $usuario->getId();
                                $_SESSION['usuario'] = $usuario->getNomUsuario();
                                $result['status'] = 1;
                                $_SESSION['tiempo'] = time();
                            } else {
                                $contrasena='';
                                       foreach  (array_keys($_POST) as $field) {
                        // list($name, $type) = explode(':', $index);
                        $contrasena=$contrasena.$field.' ' ;
                    }
                                $result['exception'] = 'Clave inexistente'.$contrasena;
                            }
                        } else {
                            
                            $result['exception'] = 'Contraseña menor a 8 caracteres';
                        }
                    } else {
                        $result['exception'] = 'Nombre de usuario inexistente';
                    }
                } else {
                    $Stringnombre='';
                                       foreach  (array_keys($_POST) as $field) {
                        // list($name, $type) = explode(':', $index);
                        $Stringnombre=$Stringnombre.$field.' ' ;
                    }
                    $result['exception'] = 'Nombre de usuario incorrecto'.$Stringnombre;
                }
                break;
            default:
                exit('Acción no disponible');
        }
    } else {
        exit('Acceso no disponible');
    }
	print(json_encode($result));
} else {
	exit('Recurso denegado');
}
?>
