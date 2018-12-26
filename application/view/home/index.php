<?php
use Mini\Core\Functions;
if(!isset($errores)){
    $errores = [];
}
$this->layout('layout'); ?>
<div class="container">
    <h1>Home</h1>
    <h2>You are in the View: application/view/home/index.php (everything in the box comes from this file)</h2>
    <p>In a real application this could be the homepage.</p>
</div>
<div class="container">
    <form action="<?= URL; ?>/product/search" method="post">
        <label for="search">Busqueda: <input type="text" size="30" name="text"></label>
        <select class="" name="opcion">
            <option value="">Elige un criterio</option>
            <option value="nombre">Nombre</option>
            <option value="marca">Marca</option>
            <option value="categoria">Categoría</option>
        </select>
        <input type="submit" value="Buscar">
        <?= Functions::mostrarErrorCampo2('text', $errores); Functions::mostrarErrorCampo2('opcion', $errores); ?>

    </form>
</div>
<div class="container centrado prodPrincipal">

<?php



try{

    while($row = $query->fetch(PDO::FETCH_ASSOC)){

        echo "<div class=\"container prodPrincipal\">";
        $nombre = $row['nombre'];
        echo "<input type=\"hidden\" name=\"nombre\" value=\"$nombre\">";
        echo '<p>'.$row['nombre'].'</p>';
        $foto = $row['foto'];
        echo "<p class=\"centrado\"><img src=\"$foto \" class=\"photos\" alt=\"Foto producto\" width=\"290\" height=\"290\" ></p>";

        echo "<form class=\"form\" action=\" ". URL .  "/product/showdetails\" method=\"post\">";


        $id = $row['id'];
        echo "<input type=\"hidden\" name=\"id\" value=\"$id\">";

        $nombre = $row['nombre'];
        echo "<input type=\"hidden\" name=\"nombre\" value=\"$nombre\">";

        $nombrecat = $row['nombrecat'];
        echo "<input type=\"hidden\" name=\"nombrecat\" value=\"$nombrecat\">";

        $foto = $row['foto'];
        echo "<input type=\"hidden\" name=\"foto\" value=\"$foto\">";


        $descripcion = $row['descripcion'];
        echo "<input type=\"hidden\" name=\"descripcion\" value=\"$descripcion\">";

        $marca = $row['marca'];
        echo "<input type=\"hidden\" name=\"marca\" value=\"$marca\">";


        echo "<td><input type=\"submit\" name=\"detalles\" value=\"Detalles\"></td>";
        echo '</tr>';
        echo "</form>";

        echo "</div>";

    }


}catch (Exception $e){
    echo '<h3>Ha ocurrido un error en la conexión a la BD</h3>';
    if($consulta->modeDEV){
        echo $e->getMessage();
    }
}
?>

</div>


