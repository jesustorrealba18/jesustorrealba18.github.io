<?php

// llamada al archivo que contiene la clase
// usuarios, en ella estará el código que me 
// permitirá guardar, consultar y modificar dentro de mi base de datos

// lo primero que se debe hacer es verificar al igual que en la vista que exista el archivo
if (!is_file("modelo/".$pagina.".php")) {
    // allí pregunte que si no es archivo se niega con !
    // si no existe envío mensaje y me salgo
    echo "Falta definir la clase ".$pagina;
    exit;
}

require_once("modelo/".$pagina.".php");

if (is_file("vista/".$pagina.".php")) {
    // bien si estamos acá es porque existe la vista y la clase
    // por lo que lo primero que debemos hacer es realizar una instancia de la clase
    // instanciar es crear una variable local, que contiene los métodos de la clase
    // para poderlos usar

    if (!empty($_POST)) {
        $o = new proveedores();
        // como ya sabemos si estamos acá es porque se recibió alguna información
        // de la vista, por lo que lo primero que debemos hacer ahora que tenemos una 
        // clase es guardar esos valores en ella con los métodos set
        $accion = $_POST['accion'];

        if ($accion == 'consultar') {
            echo json_encode($o->consultar());
        } elseif ($accion == 'obtienefecha') {
            echo json_encode($o->obtienefecha());
        } elseif ($accion == 'eliminar') {
            $o->set_codigo($_POST['codigo']);
            echo json_encode($o->eliminar());
        } else {
            $o->set_codigo($_POST['codigo']);
            $o->set_nombre($_POST['nombre']);
            $o->set_direccion($_POST['direccion']);
            $o->set_contacto($_POST['contacto']);
           

            if ($accion == 'incluir') {
                echo json_encode($o->incluir());
            } elseif ($accion == 'modificar') {
                echo json_encode($o->modificar());
            }
        }
        exit;
    }

    require_once("vista/".$pagina.".php");
} else {
    echo "Página en construcción";
}
?>