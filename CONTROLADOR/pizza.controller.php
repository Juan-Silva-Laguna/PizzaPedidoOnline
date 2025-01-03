<?php
include_once("../ENTIDAD/pizza.entity.php");
include_once("../MODELO/pizza.model.php");
$operacion = $_POST['operacion'];
$pizzaE = new \entidadPizza\Pizza();
switch ($operacion) {
    case 'Crear Pizza':
        $pizzaE->setNombre($_POST['nombre']);
        $pizzaE->setIngredientes($_POST['ingredientes']);
        $pizzaE->setValor($_POST['valor']);
        $pizzaE->setFoto($_POST['foto']);
        $pizzaM = new \modeloPizza\Pizza($pizzaE);
        $mensaje = $pizzaM->crear();
        break;
    case 'Editar Pizza':
        $pizzaE->setId($_POST['id']);
        $pizzaE->setNombre($_POST['nombre']);
        $pizzaE->setIngredientes($_POST['ingredientes']);
        $pizzaE->setValor($_POST['valor']);
        $pizzaE->setFoto($_POST['foto']);
        $pizzaM = new \modeloPizza\Pizza($pizzaE);
        $mensaje = $pizzaM->editar();
        break;
    case 'desactivar':
        $pizzaE->setId($_POST['id']);
        $pizzaM = new \modeloPizza\Pizza($pizzaE);
        $mensaje = $pizzaM->desactivar();
        break;
    case 'activar':
        $pizzaE->setId($_POST['id']);
        $pizzaM = new \modeloPizza\Pizza($pizzaE);
        $mensaje = $pizzaM->activar();
        break;
    case 'mostrar':
        $pizzaE->setId($_POST['id']);
        $pizzaE->setNombre($_POST['nombre']);
        $pizzaE->setEstado($_POST['estado']);
        $pizzaM = new \modeloPizza\Pizza($pizzaE);
        $mensaje = $pizzaM->mostrar();
        break;        
}

unset($pizzaE);
unset($pizzaM);

echo json_encode($mensaje);
?>