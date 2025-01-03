<?php
namespace modeloPedido;
use PDO;

include_once("../ENTIDAD/pedido.entity.php");
include_once("../ENTORNO/conexion.php");
class Pedido{
      private $id;
      private $idPizza;
      private $idCliente;
      private $cantidad;
      private $fechaHora;
      private $direccion;
      private $estado;
      private $conexion;
      private $consulta;
      private $resultado;
      private $retorno;
      public function __construct(\entidadPedido\Pedido $pedidoE)
      {
         $this->conexion = new \Conexion();
         $this->id=$pedidoE->getId();
         $this->idPizza=$pedidoE->getIdPizza();
         $this->idCliente=$pedidoE->getIdCliente();  
         $this->cantidad=$pedidoE->getCantidad();  
         $this->fechaHora=$pedidoE->getFechaHora(); 
         $this->direccion=$pedidoE->getDireccion();
         $this->estado=$pedidoE->getEstado(); 
      }

    public function agregar()
    {
       session_start();
       $hoy = date("Y-m-d H:i:s");
       $idCliente = $_SESSION['id'];
       $this->consulta="INSERT INTO pedidos VALUES(null, '$idCliente', '$this->idPizza', '$this->cantidad', '$hoy', '', 'Inicio')";
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       if($this->resultado->rowCount()>=1){
            $this->retorno=1;
       }
       else{
            $this->retorno=0;
       }
       return $this->retorno;
    }

    public function mostrar()
    {
       if ($this->estado == '') {
          $complemento = '';
       }
       else{
          $complemento = "AND pizEstado NOT LIKE '%$this->estado%'";
       }
       $this->consulta="SELECT * FROM pedidos WHERE idpedido LIKE '%$this->id%' AND pizNombre LIKE '%$this->nombre%' $complemento";
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       return $this->resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function desactivar()
   {
      $this->consulta="UPDATE pedidos SET pizEstado='Desactiva' WHERE idpedido='$this->id'";
      $this->resultado=$this->conexion->con->prepare($this->consulta);
      $this->resultado->execute();
      if($this->resultado->rowCount()>=1){
            $this->retorno=1;
      }
      else{
         $this->retorno=0;
      }
      return $this->retorno;       
   }

   public function activar()
   {
      $this->consulta="UPDATE pedidos SET pizEstado='Activa' WHERE idpedido='$this->id'";
      $this->resultado=$this->conexion->con->prepare($this->consulta);
      $this->resultado->execute();
      if($this->resultado->rowCount()>=1){
            $this->retorno=1;
      }
      else{
         $this->retorno=0;
      }
      return $this->retorno;       
   }

   public function realizarMiPedido()
   {
      session_start();
      $idCliente = $_SESSION['id'];
      $hoy = date("Y-m-d H:i:s");
      $this->consulta="UPDATE pedidos SET pedEstado='Pendiente', pedFechaHora='$hoy', pedDireccion='$this->direccion' WHERE pedCliente='$idCliente' AND pedEstado='Inicio'";
      $this->resultado=$this->conexion->con->prepare($this->consulta);
      $this->resultado->execute();
      if($this->resultado->rowCount()>=1){
            $this->retorno=1;
      }
      else{
         $this->retorno=0;
      }
      return $this->retorno;       
   }

   public function ponerEnProceso()
   {
      $this->consulta="UPDATE pedidos SET pedEstado='En Proceso' WHERE pedCliente='$this->idCliente' AND pedEstado='Pendiente'";
      $this->resultado=$this->conexion->con->prepare($this->consulta);
      $this->resultado->execute();
      if($this->resultado->rowCount()>=1){
            $this->retorno=1;
      }
      else{
         $this->retorno=0;
      }
      return $this->retorno;       
   }

   public function atendido()
   {
      $this->consulta="UPDATE pedidos SET pedEstado='Atendido' WHERE pedCliente='$this->idCliente' AND pedEstado='En Proceso'";
      $this->resultado=$this->conexion->con->prepare($this->consulta);
      $this->resultado->execute();
      if($this->resultado->rowCount()>=1){
            $this->retorno=1;
      }
      else{
         $this->retorno=0;
      }
      return $this->retorno;       
   }

    public function mostrarMiPedido()
    {
       if ($this->idCliente == '') {
         session_start();
         $idCliente = $_SESSION['id'];
       }
       else {
         $idCliente = $this->idCliente;
       }
      
      $this->consulta="SELECT pedidos.idPedido, pizzas.pizNombre, pedidos.pedCantidad, pizzas.pizValor, pedidos.pedCantidad*pizzas.pizValor AS subtotal,pedidos.pedEstado FROM pedidos INNER JOIN pizzas ON pedidos.pedPizza=pizzas.idPizza WHERE pedidos.pedCliente='$idCliente' AND pedidos.pedEstado!='Atendido' ORDER BY pedidos.idPedido ASC";
      $this->resultado=$this->conexion->con->prepare($this->consulta);
      $this->resultado->execute();
      return $this->resultado->fetchAll(PDO::FETCH_ASSOC);     
    }

    public function mostrarClientesPedidos()
    {
      $this->consulta="SELECT DISTINCT clientes.idCliente, clientes.cliNombre, clientes.cliCorreo, clientes.cliTelefono, pedidos.pedFechaHora, pedidos.pedDireccion, pedidos.pedEstado FROM pedidos INNER JOIN clientes ON pedidos.pedCliente=clientes.idCliente WHERE pedidos.pedEstado='$this->estado' AND clientes.cliNombre LIKE '%$this->idCliente%'";
      $this->resultado=$this->conexion->con->prepare($this->consulta);
      $this->resultado->execute();
      return $this->resultado->fetchAll(PDO::FETCH_ASSOC);     
    }
}

?>