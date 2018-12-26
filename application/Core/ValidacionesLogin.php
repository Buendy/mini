<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 2/12/18
 * Time: 20:11
 */
namespace Mini\Core;
use Mini\Model\User;


class ValidacionesLogin
{
    public static function checkField()
    {

        if(!isset($_POST['initname'])){
            return 'No he recibido el nombre de usuario';

        }else if(!$_POST['initname']){
            return'No he recibido el nombre de usuario';

        }else{
            return null;
        }

    }


    public static function checkPass()
    {
        if(!isset($_POST['pass'])){
            return  'No he recibido la contraseña';

        }else if(!$_POST['pass']){
            return  'No he recibido la contraseña';

        }else{
            return null;
        }
    }

    public static function checkSelect()
    {
        if(!isset($_POST['select'])){
            return 'No he recibido con qué nombre vas a iniciar';

        }else if(!$_POST['select']){
            return'No he recibido con qué nombre vas a iniciar';

        }else if($_POST['select'] != 'nickname'){
            if($_POST['select'] != 'email'){
                return'No has seleccionado una opción correcta';

            }

        }else{
            return null;
        }

    }

    public static function checkRep()
    {

            $query = new User();

            if($_POST['select'] == 'nickname'){
                if(!$query->checkRepeat('Usuarios', 'nickname', $_POST['initname'])){
                    return 'Usuario o contraseña incorrectos';

                }else{
                    if(!$query->checkRepeatPass('Usuarios', 'nickname', 'clave', $_POST['initname'], md5($_POST['pass']))){
                        return 'Usuario o contraseña incorrecto';

                    }
                }
            }

            if ($_POST['select'] == 'email'){
                if(!$query->checkRepeat('Usuarios', 'email', $_POST['initname'])){
                    return'Usuario o contraseña incorrectos';

                }else{
                    if(!$query->checkRepeatPass('Usuarios', 'email', 'clave', $_POST['initname'], md5($_POST['pass']))){
                        return'Usuario o contraseña incorrecto';


                    }else{
                        return null;
                    }
                }
            }


    }

}