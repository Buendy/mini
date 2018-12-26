<div class="navigation">


    <a href="<?php echo URL; ?>">home</a>
    <?php if(isset($_SESSION['userConSesionIniciada']['rol']) && $_SESSION['userConSesionIniciada']['rol'] == 'jefe') : ?>
    <a href="<?php echo URL; ?>User">Crear usuarios</a>
    <?php endif ?>
    <?php if(isset($_SESSION['userConSesionIniciada']['rol'])) : ?>
        <a href="<?php echo URL; ?>Product/create">Crear productos</a>
    <?php endif ?>
    <?php if(isset($_SESSION['userConSesionIniciada']['rol'])) : ?>
        <a href="<?php echo URL; ?>product" class="float-right">Ver listado productos</a>
    <?php endif ?>


    <?php if(isset($_SESSION['userConSesionIniciada']['rol'])) : ?>
        <a href="<?php echo URL; ?>logOut" >Cerrar sesión</a>
    <?php endif ?>

    <?php if(!isset($_SESSION['userConSesionIniciada']['rol'])) : ?>
        <a href="<?php echo URL; ?>login" class="float-left">Iniciar sesión</a>
    <?php endif ?>




</div>
