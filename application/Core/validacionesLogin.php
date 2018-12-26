<?php

use Mini\Model\User;
$query = new User();



if(!isset($_POST['initname'])){
    $errores['inituser'] = 'No he recibido el nombre de usuario';
}else if(!$_POST['initname']){
    $errores['inituser'] = 'No he recibido el nombre de usuario';
}

if(!isset($_POST['pass'])){
    $errores['pass'] = 'No he recibido la contraseña';
}else if(!$_POST['pass']){
    $errores['pass'] = 'No he recibido la contraseña';
}

if(!isset($_POST['select'])){
    $errores['select'] = 'No he recibido con qué nombre vas a iniciar';
}else if(!$_POST['select']){
    $errores['select'] = 'No he recibido con qué nombre vas a iniciar';
}else if($_POST['select'] != 'nickname'){
    if($_POST['select'] != 'email'){
        $errores['select'] = 'No has seleccionado una opción correcta';
    }

}

if(!$errores){

    if($_POST['select'] == 'nickname'){
        if(!$query->checkRepeat('Usuarios', 'nickname', $_POST['initname'])){
            $errores['inituser'] = 'Usuario o contraseña incorrectos';
        }else{
            if(!$query->checkRepeatPass('Usuarios', 'nickname', 'clave', $_POST['initname'], md5($_POST['pass']))){
                $errores['inituser'] = 'Usuario o contraseña incorrecto';
            }
        }
    }

    if ($_POST['select'] == 'email'){
        if(!$query->checkRepeat('Usuarios', 'email', $_POST['initname'])){
            $errores['inituser'] = 'Usuario o contraseña incorrectos';
        }else{
            if(!$query->checkRepeatPass('Usuarios', 'email', 'clave', $_POST['initname'], md5($_POST['pass']))){
                $errores['inituser'] = 'Usuario o contraseña incorrecto';
            }
        }
    }



}

?>