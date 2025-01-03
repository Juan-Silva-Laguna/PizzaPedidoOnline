<?php
//require 'phpmailer/PHPMailerAutoload.php';
include_once("../ENTIDAD/pedido.entity.php");
include_once("../MODELO/pedido.model.php");
$operacion = $_POST['operacion'];
$pedidoE = new \entidadPedido\Pedido();
switch ($operacion) {
    case 'agregar':
        $pedidoE->setIdPizza($_POST['idPizza']);
        $pedidoE->setCantidad($_POST['cantidad']);
        $pedidoM = new \modeloPedido\Pedido($pedidoE);
        $mensaje = $pedidoM->agregar();
        break;
    case 'mostrarMiPedido':
        $pedidoE->setIdCliente($_POST['idCliente']);
        $pedidoM = new \modeloPedido\Pedido($pedidoE);
        $mensaje = $pedidoM->mostrarMiPedido();
        break;
    case 'realizarMiPedido':
        $pedidoE->setDireccion($_POST['direccion']);
        $pedidoM = new \modeloPedido\Pedido($pedidoE);
        $mensaje = $pedidoM->realizarMiPedido();
        break;
    case 'ponerEnProceso':
        $pedidoE->setIdCliente($_POST['idCliente']);
        $pedidoM = new \modeloPedido\Pedido($pedidoE);
        $mensaje = $pedidoM->ponerEnProceso();
        break;
    case 'mostrarClientesPedidos':
        $pedidoE->setIdCliente($_POST['nombre']);
        $pedidoE->setEstado($_POST['estado']);
        $pedidoM = new \modeloPedido\Pedido($pedidoE);
        $mensaje = $pedidoM->mostrarClientesPedidos();
        break;
    case 'atendido':
        $pedidoE->setIdCliente($_POST['idCliente']);
        $pedidoM = new \modeloPedido\Pedido($pedidoE);
        $mensaje = $pedidoM->atendido();
        break;        
}

unset($pedidoE);
unset($pedidoM);

echo json_encode($mensaje);
?>