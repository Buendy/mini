<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 2/12/18
 * Time: 18:21
 */

namespace Mini\Controller;


use Mini\Core\Controller;
use Mini\Model\User;
use Mini\Core\ValidacionesLogin;


class LoginController extends Controller
{
    public function index()
    {
        $errores = [];
        if(!$_SESSION){
            if(!$_POST){
                echo $this->view->render("/login/index");
            }else{

                $errores['inituser']=ValidacionesLogin::checkField();
                $errores['pass']=ValidacionesLogin::checkPass();
                $errores['select']=ValidacionesLogin::checkSelect();


                if($errores['inituser']== null && $errores['pass']== null && $errores['select']== null){
                    $errores['inituser']=ValidacionesLogin::checkRep();
                }



                if ($errores['inituser']) {
                    echo $this->view->render("/login/index", ["errores" => $errores]);
                } else {

                    $query = new User();
                    $user = $query->allFields('Usuarios', 'nickname', 'email', $_POST['initname']);


                    $_SESSION['userConSesionIniciada']['nickname'] = $user['nickname'];
                    $_SESSION['userConSesionIniciada']['id'] = $user['id'];
                    $_SESSION['userConSesionIniciada']['email'] = $user['email'];
                    $_SESSION['userConSesionIniciada']['rol'] = $user['rol'];

                    echo $this->view->render("/partials/loginSuccess");

                }

            }

        }else{

           echo $this->view->render("/error/errorLogin");
        }


    }

}