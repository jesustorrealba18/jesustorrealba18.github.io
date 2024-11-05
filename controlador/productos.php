<?php

require_once('modelo/categoria.php');
require_once('modelo/proveedores.php');
// Llamada al archivo que contiene la clase
if (!is_file("modelo/" . $pagina . ".php")) {
    echo "Falta definir la clase " . $pagina;
    exit;
}
require_once("modelo/" . $pagina . ".php");

   // Aquí agregamos el código para cargar las categorías
   $objCategoria = new Categoria(); // Asegúrate de que la clase Categoria esté incluida
   $arreglo_cat = $objCategoria->obtenerCategorias(); // Método que consulta las categorías
   $categorias = ""; // Se crea variable para almacenar las opciones del select

   foreach ($arreglo_cat as $categoria) { // Recorremos cada categoría
       $categorias .= "<option value='" . $categoria["cod_categoria"] . "'>" . $categoria["nom_categoria"] . "</option>"; // Creamos la opción del select
   }

   $objProveedor = new proveedores();
   $arreglo_pro = $objProveedor->obtenerProveedor();
   $proveedores = '';

   foreach ($arreglo_pro as $proveedor){
        $proveedores .="<option value='" . $proveedor["codigo"] . "'>" . $proveedor["nombre"] . "</option>";
   }

if (is_file("vista/" . $pagina . ".php")) {
    // Instanciamos la clase de productos
    $o = new productos();
    
    if (!empty($_POST)) {
        $accion = $_POST['accion'];
        
        if ($accion == 'consultar') {
            echo json_encode($o->consultar());
        } elseif ($accion == 'listadocategoria') {
           
        } elseif ($accion == 'obtienefecha') {
            echo json_encode($o->obtienefecha());
        } elseif ($accion == 'eliminar') {
            $o->set_codigo($_POST['codigo']);
            echo json_encode($o->eliminar());
        } else {
            // Aquí se establecen los datos del producto
            $o->set_codigo($_POST['codigo']);
            $o->set_nombre($_POST['nombre']);
            $o->set_descripcion($_POST['descripcion']);
            $o->set_cantidad($_POST['cantidad']);
            $o->set_proveedor($_POST['proveedor']);
            $o->set_almacen($_POST['almacen']);
            $o->set_categoria($_POST['cod_categoria']);
            
            if ($accion == 'incluir') {
                echo json_encode($o->incluir());
            } elseif ($accion == 'modificar') {
                echo json_encode($o->modificar());
            }
        }
        exit;
    }

 

    require_once("vista/" . $pagina . ".php"); // Cargamos la vista y luego mostramos el select
} else {
    echo "Página en construcción";
}
?>