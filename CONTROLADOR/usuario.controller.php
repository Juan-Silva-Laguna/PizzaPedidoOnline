<?php
include_once("../ENTIDAD/usuario.entity.php");
include_once("../MODELO/usuario.model.php");
$operacion = $_POST['operacion'];
$usuarioE = new \entidadUsuario\Usuario();
switch ($operacion) {
    case 'registrar':
        $usuarioE->setNombre($_POST['nombre']);
        $usuarioE->setCorreo($_POST['correo']);
        $usuarioE->setCelular($_POST['celular']);
        $usuarioE->setClave($_POST['clave']);
        $usuarioM = new \modeloUsuario\Usuario($usuarioE);
        $mensaje = $usuarioM->registrar();
        break;
    case 'ingresar':
        if ($_POST['tabla']=="usuarios") {
            $usuarioE->setCorreo($_POST['correo']);
            $usuarioE->setClave($_POST['clave']);
            $usuarioM = new \modeloUsuario\Usuario($usuarioE);
            $mensaje = $usuarioM->ingresarAdmin();
        }elseif ($_POST['tabla']=="clientes") {
            $usuarioE->setCorreo($_POST['correo']);
            $usuarioE->setClave($_POST['clave']);
            $usuarioM = new \modeloUsuario\Usuario($usuarioE);
            $mensaje = $usuarioM->ingresarCliente();
        }        
        break;
    case 'salir':
        session_start();
        session_destroy(); 
        $mensaje = 1;
        break;       
}

unset($usuarioE);
unset($usuarioM);

echo json_encode($mensaje);
?>