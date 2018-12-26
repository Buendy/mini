<?php
use Mini\Core\Functions;
$this->layout('layout'); ?>
<div class="container">
    <h1>Create Users</h1>
    <h2>You are in the View: application/view/user/index.php (everything in the box comes from this file)</h2>
    <p>In a real application this could be the creation users page.</p>
</div>
<div class="container">
<div class="formUser">

    <form class="" action="<?= URL."User"?>" method="post" >


        <p><label for="nombre" class="formCreate">Nombre:</label></p>
        <p><input type="text" name="nombre" id="nombre" class="form-control" <?= Functions::mostrarCampo('nombre') ?>></p>

        <p><label for="apellidos" class="formCreate">Apellidos:</label></p>
        <p><input type="text" name="apellidos" id="apellidos" class="form-control" <?= Functions::mostrarCampo('apellidos') ?>></p>

        <p><label for="email" class="formCreate">Email:</label></p>
        <p><input type="text" name="email" id="email" class="form-control" <?= Functions::mostrarCampo('email') ?>></p>

        <p><label for="nickname" class="formCreate">Nick:</label></p>
        <p><input type="text" name="nickname" id="nickname" class="form-control" <?= Functions::mostrarCampo('nickname') ?>></p>

        <p><label for="pass">Contraseña:</label></p>
        <p><input type="password" name="pass" id="pass" class="form-control"></p>
        <p><label for="pass2" >Repetir contraseña:</label></p>
        <p><input type="password" name="pass2" id="pass2" class="form-control"></p>
        <p> <label class="">Rol del usuario:</label></p>
        <select class="form-group" name="rol">
            <option value="empleado">Empleado</option>
            <option value="jefe">Jefe</option>
        </select>

        <p><input type="submit" value="Crear" class="btn btn-primary"></p>


    </form>

    <div>
        <?php
        if(isset($errores)){
            Functions::mostrarErrorCampo('nombre', $errores);
            Functions::mostrarErrorCampo('apellidos', $errores);
            Functions::mostrarErrorCampo('email', $errores);
            Functions::mostrarErrorCampo('nickname', $errores);
            Functions::mostrarErrorCampo('pass', $errores);
            Functions::mostrarErrorCampo('rol', $errores);
        }?>
    </div>



</div>
</div>
