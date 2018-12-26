<?php
use Mini\Core\Functions;
use Mini\Libs\Dbpdo;
use Mini\Model\Category;
$textarea = new Functions();

$this->layout('layout');
?>
<div class="container">
    <h1>Create Products</h1>
    <h2>You are in the View: application/view/create/createProducts.php (everything in the box comes from this file)</h2>
    <p>In a real application this could be the creation products page.</p>
</div>

<div class="container">
    <div class="formUser">
        <form action="<?= URL . "Product/Create" ?>" method="post" enctype="multipart/form-data">
            <p><label for="nombre" class="formCreate">Nombre:</label></p>
            <p><input type="text" name="nombre" id="nombre" class="form-control" <?= Functions::mostrarCampo('nombre') ?>></p>

            <p><label for="descripcion" class="formCreate">Descripción:</label></p>
            <p><textarea name="descripcion" id="descripcion" cols="43" rows="10" class="form-control"><?= $textarea->mostrarCampo2('descripcion') ?></textarea></p>

            <p><label for="marca" class="formCreate">Marca:</label></p>
            <p><input type="text" name="marca" id="marca" class="" <?= Functions::mostrarCampo('marca') ?>></p>

            <p><label for="categoria" class="formCreate">Categoría:</label></p>
            <p><select class="form-control formCreate2" name="categoria">
                    <option value="null">Escoge una opción</option>
                    <?php
                    $cat = new Category();
                    $query = $cat->alls('Categorias');

                    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        $id = $row['id'];
                        $nombre = $row['nombre'];
                        echo $id;
                        echo $nombre;
                        echo "<option value=\"$id\">$nombre</option>";
                    }
                    ?>
                </select></p>

            <p><label for="file" class="formCreate">Subir una imagen:</label></p>
            <p><input type="file" name="archivo"></p>

            <p><input type="submit" value="Crear" class="btn btn-primary"></p>
        </form>

        <div>
            <?php
            if(isset($errores)){
                Functions::mostrarErrorCampo('nombre', $errores);
                Functions::mostrarErrorCampo('descripcion', $errores);
                Functions::mostrarErrorCampo('marca', $errores);
                Functions::mostrarErrorCampo('categoria', $errores);
                Functions::mostrarErrorCampo('archivo', $errores);
            }?>
        </div>
    </div>
</div>