<?php
$this->layout('layout'); ?>
<div class="container">
    <h1>Show product</h1>
    <h2>You are in the View: application/view/products/show.php (everything in the box comes from this file)</h2>
    <p>In a real application this could be the product details.</p>
</div>

<div class="container flexing" >

    <div class="flex-20">
    <h2><?= $data['nombre'] ?></h2>
        <h4><?= $data['marca'] ?></h4>
    <p><?= $data['descripcion'] ?></p><br>
    <h3 class="float-right">Categoría: <?= $data['nombrecat'] ?></h3>
    </div>
    <div class="flex-60">
        <h2>Imagenes</h2>
        <img src="<?= $data['foto'] ?>" alt="FotoProducto" width="400" height="400">
    </div>

</div>
