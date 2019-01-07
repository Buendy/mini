<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 23/12/18
 * Time: 20:08
 */

namespace Mini\Controller;
use Mini\Core\Controller;
use Mini\Core\Validacion;
use Mini\Model\Product;
use PDO;

class ProductController extends Controller
{
    private $carpeta = '../img/products/';
    public function index()
    {
        $consulta = new Product();


        $query = $consulta->allsWithCategory('Productos');
        echo $this->view->render("/products/index", ["query" => $query]);

    }


    public function create()
    {
        $errores = [];
        if(isset($_SESSION['userConSesionIniciada']['rol'])){
            if(!$_POST){
                echo $this->view->render("/create/createProducts");
            }else{

                $repeat = new Product();
                $validaciones = new Validacion();

                if(!isset($_POST['nombre'])){
                    $errores['nombre'] = 'No he recibido el nombre';
                }else{
                    Validacion::formateaDatos($_POST['nombre']);
                    $value = $validaciones->validaNombreProduct($_POST['nombre']);
                    if($value){
                        $errores['nombre'] = $value;
                    }
                    if($check = $repeat->checkRepeat('Productos','nombre', $_POST['nombre'])){
                        $errores['nombre'] = 'Esa categoria ya existe';
                    }
                }

                if(!isset($_POST['descripcion'])){
                    $errores['descripcion'] = 'No he recibido la descripción';
                }else{
                    Validacion::formateaDatos($_POST['descripcion']);
                    $value = $validaciones->validaDescripcion($_POST['descripcion']);
                    if($value){
                        $errores['descripcion'] = $value;
                    }
                }

                if(!isset($_POST['marca'])){
                    $errores['marca'] = 'No he recibido la descripción';
                }else{
                    Validacion::formateaDatos($_POST['marca']);
                    $value = $validaciones->validaMarca($_POST['marca']);
                    if($value){
                        $errores['marca'] = $value;
                    }
                }

                if(!isset($_POST['categoria'])){
                    $errores['categoria'] = 'No he recibido la categoria';
                }else{
                    Validacion::formateaDatos('categoria');
                    $cat = new Product();
                    $query = $cat->checkRepeat('Categorias','id', $_POST['categoria']);
                    if($query == false){
                        $errores['categoria'] = 'No has elegido una categoría correcta';
                    }

                }

                if(!isset($_FILES['archivo'])){
                    $errores['archivo'] = "No estoy recibiendo el archivo";
                }else{
                    $value = $validaciones->validaArchivo('archivo');
                    if($value){
                        $errores['archivo'] = $value;
                    }
                }

                if ($errores) {
                    echo $this->view->render("/create/createProducts", ["errores" => $errores]);

                } else {
                    self::store();
                }

            }
        }else{
            echo $this->view->render("/error/errorPrivate");
        }
    }




    public function store()
    {
        $insertar = new Product();
        $dataArray = ['nombre' => $_POST['nombre'], 'descripcion' => $_POST['descripcion'], 'idUsr' => $_SESSION['userConSesionIniciada']['id'],
            'marca' => $_POST['marca'], 'categoria' => $_POST['categoria'], 'archivo' => $this->carpeta . $_POST['nombre'] . '.jpg'];

        try{
           $this->carpeta = '../public/img/products/';
            $insertar->insert('Productos', $dataArray);
            $destino = $this->carpeta . $_POST['nombre'] . '.jpg';
            if(!move_uploaded_file($_FILES['archivo']['tmp_name'], $destino)) {
                echo 'Fallo al cargar el archivo';

            }
            echo $this->view->render("/partials/productSuccess");

        }catch (Exception $e){
            echo '<h3>Ha ocurrido un error en la conexión a la BD</h3>';
            if($insertar->modeDEV){
                echo $e->getMessage();
            }
        }
    }


    public function crud()
    {

        if(isset($_POST['actualizar'])){
            if(!isset($errores)){
                $errores = [];
            }

            echo $this->view->render("/products/formUpdate", ["errores" => $errores, "data" => $_POST]);

        }elseif(isset($_POST['borrar'])){
            self::delete();
        }elseif(isset($_POST['detalles'])){
            self::showdetails();
        }else{
            self::index();
        }

    }


    public function delete()
    {
        try{
            $producto = new Product();
            $producto->delete('Productos', 'nombre', $_POST['nombre']);
            echo $this->view->render("/partials/deleteSuccess");
        }catch (Exception $e){

            echo '<h3>Ha ocurrido un error, no se ha borrado el producto</h3>';
            if($producto->modeDEV){
                echo $e->getMessage();
            }
        }
    }



    public function update()
    {
        if(!isset($errores)){
            $errores = [];
        }

        if (!$_POST) {
            echo $this->view->render("/products/formUpdate", ["errores" => $errores, "data" => $_POST]);
        } else {
            $repeat = new Product();
            $validaciones = new Validacion();

            if(!isset($_POST['nombre'])){
                $errores['nombre'] = 'No he recibido el nombre';
            }else{
                Validacion::formateaDatos($_POST['nombre']);
                if(!$check = $repeat->checkRepeatUpdate('Productos', 'nombre', $_POST['nombre'], $_POST['id'])){
                    $errores['nombre'] = 'Ese nombre ya existe';
                }
            }

            if(!isset($_POST['descripcion'])){
                $errores['descripcion'] = 'No he recibido la descripción';
            }else{
                Validacion::formateaDatos($_POST['descripcion']);
                $value = $validaciones->validaDescripcion($_POST['descripcion']);
                if($value){
                    $errores['descripcion'] = $value;
                }
            }

            if(!isset($_POST['marca'])){
                $errores['marca'] = 'No he recibido la descripción';
            }else{
                Validacion::formateaDatos($_POST['marca']);
                $value = $validaciones->validaMarca($_POST['marca']);
                if($value){
                    $errores['marca'] = $value;
                }
            }

            if(!isset($_POST['categoria'])){
                $errores['categoria'] = 'No he recibido la categoria';
            }else{
                Validacion::formateaDatos('categoria');
                $cat = new Product();
                $query = $cat->checkRepeat('Categorias','id', $_POST['categoria']);
                if($query == false){
                    $errores['categoria'] = 'No has elegido una categoría correcta';
                }

            }

            if(isset($_FILES['archivo']) && $_FILES['archivo']['size'] != 0) {

                $value = $validaciones->validaArchivo('archivo');
                if($value){
                    $errores['archivo'] = $value;
                }

            }

            if($errores) {
                echo $this->view->render("/products/formUpdate", ["errores" => $errores, "data" => $_POST]);
            } else {

                try{
                    $update = new Product();


                    if($_FILES['archivo']['size'] == 0) {
                        $dataArray = ['id' => $_POST['id'], 'nombre' => $_POST['nombre'], 'descripcion' => $_POST['descripcion'],
                            'marca' => $_POST['marca'], 'categoria' => $_POST['categoria']];
                        $update->updateProduct('Productos', $dataArray);
                    }else {
                        $dataArray = ['id' => $_POST['id'], 'nombre' => $_POST['nombre'], 'descripcion' => $_POST['descripcion'],
                            'marca' => $_POST['marca'], 'categoria' => $_POST['categoria'], 'archivo' => $this->carpeta . $_POST['nombre'] . '.jpg'];
                        $update->updateProductPhoto('Productos', $dataArray);
                        $this->carpeta = '../public/img/products/';
                        $destino = $this->carpeta . $_POST['nombre'] . '.jpg';
                        if(!move_uploaded_file($_FILES['archivo']['tmp_name'], $destino)) {
                            echo 'Fallo al cargar el archivo';

                        }
                    }

                    echo $this->view->render("/partials/productUpdateSuccess");

                }catch (Exception $e){
                    echo '<h3>Ha ocurrido un error, no se ha actualizado el producto</h3>';

                    if($update->modeDEV){
                        echo $e->getMessage();
                    }
                }

            }
        }



    }

    public function showdetails()
    {
        echo $this->view->render("/products/show", ['data' => $_POST]);
    }


    public function search()
    {
        $errores = [];
        if(!isset($_POST['text']) || empty($_POST['text'])){
            $errores['text'] = "No has introducido nada";
        }

        if(!isset($_POST['opcion'])){
            $errores['text'] = "No has introducido nada";
        }elseif($_POST['opcion'] == 'nombre'){
            $condicion = 'p.'.$_POST['opcion'];
        }elseif($_POST['opcion'] == 'marca'){
            $condicion = 'p.'. $_POST['opcion'];
        }elseif($_POST['opcion'] == 'categoria'){
            $condicion = 'c.nombre';
        }else{
            $errores['opcion'] = "La opción no es correcta";
        }
        if($errores){

            $consulta = new Product();
            $query = $consulta->allsWithCategory('Productos');
            echo $this->view->render("/home/index", ['query' => $query, 'errores' => $errores]);
        }else{
            $consulta = new Product();
            $query = $consulta->search('Productos', $condicion, $_POST['text']);

            if($query->rowCount()){
                echo $this->view->render("/home/index", ['query' => $query]);
            }else{
                echo $this->view->render("/partials/errorSearch");
            }

        }
    }

}