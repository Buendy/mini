<?php



class Validacion
{
    public function validaNombre2($campo){

        if ( isset($campo)){

            if(strlen($campo) < 4){
                return 'El nombre es demasiado corto<br>';
            }elseif(preg_match("/[^a-zA-Z' áéíóúàèìòùäëïöüÁÉÍÓÚÀÈÌÒÙÄËÏÖÜ]/", $campo)){
                return 'El nombre no puede contener números o caracteres especiales';
            }else {
                return null;
            }
        } else {
            return 'No he recibido el nombre';
        }
    }

    public function validaNombreProduct($campo){

        if ( isset($campo)){

            if(strlen($campo) < 4){
                return 'El nombre es demasiado corto<br>';
            }elseif(preg_match("/[^a-zA-Z' áéíóúàèìòùäëïöüÁÉÍÓÚÀÈÌÒÙÄËÏÖÜ0-9]/", $campo)){
                return 'El nombre no puede contener números o caracteres especiales';
            }else {
                return null;
            }
        } else {
            return 'No he recibido el nombre';
        }
    }


    public function validaApellidos($campo){

        if(isset($campo)){

            if(strlen($campo) < 4){
                return 'El apellido es demasiado corto<br>';
            } elseif(preg_match("/[^a-zA-Z'á éíóúàèìòùäëïöüÁÉÍÓÚÀÈÌÒÙÄËÏÖÜ]/", $campo)){
                return 'El apellido no puede contener números o caracteres especiales';
            }else {
                return null;
            }

        } else {
            return 'No he recibido los apellidos';
        }

    }

    public function validaEmail($campo){ //Se valida el email para que tenga el formato correcto

        if (isset($campo)){

            if(strlen($campo) < 6){
                return 'El email es demasiado corto';
            }elseif(!preg_match_all('/^[a-zA-Z\d-_*\.]+@[a-zA-Z\d-_*\.]+\.[a-zA-Z\d]{2,}$/',$campo)){
                return 'El email no es correcto';
            }else {
                return null;
            }
        } else {
            return 'No he recibido el email';
        }

    }

    public function validaNick($campo){
        if(isset($campo)){

            if(strlen($campo) > 20 || strlen($campo) < 4  ){
                return 'El nick debe tener entre 4 y 10 caracteres';
            }elseif(preg_match("/[^a-zA-Z'áéíóúàèìòùäëïöüÁÉÍÓÚÀÈÌÒÙÄËÏÖÜ_\d]/", $campo)){
                return 'El nick solo puede contener letras, -_\' y algún número';
            }else {
                return null;
            }

        }else {
            return 'No he recibido el nick';
        }
    }

    public function validaPass($campo1, $campo2){

        if(isset($campo1) || isset($campo2)){

            if(strlen($campo1) < 8){
                return 'La contraseña debe de tener al menos 8 caracteres';

            }elseif(!preg_match_all("/(?=.*[A-Z])(?=.*\d)(?=.*[a-z])/", $campo1)){
                return 'El formato no es correcto, Debe tener 1 minúscula, 1 mayúscula y 1 número';
            }elseif($campo1 != $campo2){
                return 'Las contraseñas no coinciden';
            } else {
                return null;
            }
        } else {
            return 'No he recibido ambas claves';
        }

    }

    public function validaRol($campo){

        if(isset($campo)){
            if($campo != 'empleado'){
                if($campo != 'jefe'){
                    return 'El tipo de usuario no es correcto';
                }
            }else{
                return null;
            }

        }else{
            return 'No he recibido el tipo de usuario';
        }
    }

    public static function formateaDatos($campo){

        if ( isset($_POST[$campo])){
            $_POST[$campo] = trim($_POST[$campo]);
            $_POST[$campo] = strip_tags($_POST[$campo]);
            $_POST[$campo] = preg_replace("/\"/",'', $_POST[$campo]);
            return $_POST[$campo];
        }

    }



}