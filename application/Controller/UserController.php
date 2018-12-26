<?php

namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Libs\Dbpdo;
use Mini\Core\Validacion;
use Mini\Model\User;

class UserController extends Controller
{
    public function index()
    {
        $errores = [];
        if(isset($_SESSION['userConSesionIniciada']['rol']) && $_SESSION['userConSesionIniciada']['rol'] == 'jefe' ){
            if(!$_POST){
                echo $this->view->render("/create/CreateUsers");
            }else{

                $validacion = new User();
                $validaciones = new Validacion();

                if(!isset($_POST['nombre'])){
                    $errores['nombre'] = 'No he recibido el nombre';
                }else{
                    Validacion::formateaDatos($_POST['nombre']);
                    $value = $validaciones->validaNombre($_POST['nombre']);
                    if($value){
                        $errores['nombre'] = $value;
                    }
                }

                if(!isset($_POST['apellidos'])){
                    $errores['apellidos'] = 'No he recibido los apellidos';
                }else{
                    Validacion::formateaDatos($_POST['apellidos']);
                    $value = $validaciones->validaApellidos($_POST['apellidos']);
                    if($value){
                        $errores['apellidos'] = $value;
                    }
                }

                if(!isset($_POST['email'])){
                    $errores['email'] = 'No he recibido el email';
                }else{
                    Validacion::formateaDatos($_POST['email']);
                    $value = $validaciones->validaEmail($_POST['email']);
                    if($value){
                        $errores['email'] = $value;
                    }elseif($check = $validacion->checkRepeat('Usuarios', 'email', $_POST['email'])){
                        $errores['email'] = 'El email ya está registrado';
                    }
                }

                if(!isset($_POST['nickname'])){
                    $errores['nickname'] = 'No he recibido el nick';
                }else{
                    Validacion::formateaDatos($_POST['nickname']);
                    $value = $validaciones->validaNick($_POST['nickname']);
                    if($value){
                        $errores['nickname'] = $value;
                    }elseif($check = $validacion->checkRepeat('Usuarios', 'nickname', $_POST['nickname'])){
                        $errores['nickname'] = 'El Nick ya está registrado';
                    }
                }

                if(!isset($_POST['pass']) || ! isset($_POST['pass2'])){
                    $errores['pass'] = 'No he recibido ambas claves<br>';
                } else {
                    Validacion::formateaDatos('pass');
                    Validacion::formateaDatos('pass2');
                    $value = $validaciones->validaPass($_POST['pass'], $_POST['pass2']);
                    if($value){
                        $errores['pass'] = $value;
                    }

                }

                if(!isset($_POST['rol'])){
                    $errores['rol'] = 'No he recibido el tipo de usuario';
                }else{
                    Validacion::formateaDatos('rol');
                    $value = $validaciones->validaRol($_POST['rol']);
                    if($value){
                        $errores['rol'] = $value;
                    }

                }

                if ($errores) {
                    echo $this->view->render("/create/CreateUsers", ["errores" => $errores]);
                } else {
                    $insertar = new User();
                    $dataArray = ['nombre' => $_POST['nombre'], 'apellidos' => $_POST['apellidos'], 'email' => $_POST['email'],
                        'nick' => $_POST['nickname'],'pass'=> md5($_POST['pass']), 'rol' => $_POST['rol']];

                    try{

                        $insertar->insert('Usuarios', $dataArray);

                        echo $this->view->render("/partials/createSuccess");

                    }catch (Exception $e){
                        echo '<h3>Ha ocurrido un error en la conexión a la BD</h3>';
                        if($insertar->modeDEV){
                            echo $e->getMessage();
                        }
                    }



                }

            }
        }else{
            echo $this->view->render("/error/errorPrivate");
        }
    }



}