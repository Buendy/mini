<?php
use Mini\Core\Functions;
$this->layout('layout'); ?>
<div class="container">
    <h1>Login</h1>
    <h2>You are in the View: application/view/login/index.php (everything in the box comes from this file)</h2>
    <p>In a real application this could be the login page.</p>
</div>
<div class="container">
    <div align="center">
        <form class="" action="<?= URL."login"?>" method="post">
            <?php
            if(isset($errores)){
                Functions::mostrarErrorCampo('select', $errores);
                Functions::mostrarErrorCampo('pass', $errores);
                Functions::mostrarErrorCampo('inituser', $errores);


            }
            ?>


            <p>Email o Nick:
                <select class="" name="select">
                    <option value="nickname">Nick</option>
                    <option value="email">Email</option>
                </select>
            </p>

            <p><input type="text" name="initname" class="form-control"></p>
            <p>Contraseña:</p>
            <p><input type="password" name="pass" value="" class="form-control"></p>
            <p><input type="submit" name="submit" value="Acceder"></p>
        </form>
    </div>
</div>



