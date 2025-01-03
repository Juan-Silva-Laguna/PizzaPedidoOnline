<?php
namespace modeloPizza;
use PDO;

include_once("../ENTIDAD/pizza.entity.php");
include_once("../ENTORNO/conexion.php");
class Pizza{
      private $id;
      private $nombre;
      private $ingredientes;
      private $valor;
      private $foto;
      private $estado;
      private $conexion;
      private $consulta;
      private $resultado;
      private $retorno;
      public function __construct(\entidadPizza\Pizza $PizzaE)
      {
         $this->conexion = new \Conexion();
         $this->id=$PizzaE->getId();  
         $this->nombre=$PizzaE->getNombre();  
         $this->ingredientes=$PizzaE->getIngredientes(); 
         $this->valor=$PizzaE->getValor();
         $this->foto=$PizzaE->getFoto();
         $this->estado=$PizzaE->getEstado(); 
      }

    public function crear()
    {
       $this->consulta="INSERT INTO pizzas VALUES(null, '$this->nombre', '$this->ingredientes', '$this->valor', '$this->foto', 'Activa')";
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
       $this->consulta="SELECT * FROM pizzas WHERE idPizza LIKE '%$this->id%' AND pizNombre LIKE '%$this->nombre%' $complemento";
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       return $this->resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function desactivar()
   {
      $this->consulta="UPDATE pizzas SET pizEstado='Desactiva' WHERE idPizza='$this->id'";
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
      $this->consulta="UPDATE pizzas SET pizEstado='Activa' WHERE idPizza='$this->id'";
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

    public function editar()
    {
         $this->consulta="UPDATE pizzas SET pizNombre='$this->nombre', pizIngredientes='$this->ingredientes', pizValor='$this->valor', pizImagen='$this->foto' WHERE idPizza='$this->id'";
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
}

?>