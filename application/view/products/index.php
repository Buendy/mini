<?php
$this->layout('layout'); ?>
<div class="container">
    <h1>Products</h1>
    <h2>You are in the View: application/view/products/index.php (everything in the box comes from this file)</h2>
    <p>In a real application this could be the products page.</p>
</div>
<div class='container'>
    <h3>Index of products</h3>
    <div class="">
        <table>
            <tr>
                <th class="centrado">Nombre</th>
                <th class="centrado">Descripción</th>
                <th class="centrado">Marca</th>
                <th class="centrado">Categoria</th>
                <th class="centrado">Fecha de alta</th>
                <th colspan="3" class="centrado">Acciones</th>
            </tr>
    <?php


    try{
        while($row = $query->fetch(PDO::FETCH_ASSOC)){

            echo "<form class=\"form\" action=\"" . URL ."product/crud\" method=\"post\">";
            echo '<tr>';

            $id = $row['id'];
            echo "<input type=\"hidden\" name=\"id\" value=\"$id\">";

            $idCat = $row['idCategoria'];
            echo "<input type=\"hidden\" name=\"idCat\" value=\"$idCat\">";

            $foto = $row['foto'];
            echo "<input type=\"hidden\" name=\"foto\" value=\"$foto\">";

            echo '<td>'.$row['nombre'].'</td>';
            $nombre = $row['nombre'];
            echo "<input type=\"hidden\" name=\"nombre\" value=\"$nombre\">";

            echo '<td class="descripcion">'.$row['descripcion'].'</td>';
            $descripcion = $row['descripcion'];
            echo "<input type=\"hidden\" name=\"descripcion\" value=\"$descripcion\">";


            echo '<td>'.$row['marca'].'</td>';
            $marca = $row['marca'];
            echo "<input type=\"hidden\" name=\"marca\" value=\"$marca\">";

            echo '<td>'.$row['nombrecat'].'</td>';
            $nombrecat = $row['nombrecat'];
            echo "<input type=\"hidden\" name=\"nombrecat\" value=\"$nombrecat\">";

            echo '<td>'.$row['fechaAlta'].'</td>';
            $fecha = $row['fechaAlta'];
            echo "<input type=\"hidden\" name=\"fecha\" value=\"$fecha\">";

            echo "<td><input type=\"submit\" name=\"actualizar\"  value=\"Actualizar\"></td>";
            if($_SESSION['userConSesionIniciada']['rol'] == 'jefe'){
                echo "<td><input type=\"submit\" name=\"borrar\" value=\"Borrar\"></td>";
            }
            echo "<td><input type=\"submit\" name=\"detalles\" value=\"Detalles\"></td>";
            echo '</tr>';
            echo "</form>";


        }


        echo '</table>';
        echo "</div>";
    }catch (Exception $e){
        echo '<h3>Ha ocurrido un error en la conexión a la BD</h3>';
        if($consulta->modeDEV){
            echo $e->getMessage();
        }
    }


    ?>

</div>